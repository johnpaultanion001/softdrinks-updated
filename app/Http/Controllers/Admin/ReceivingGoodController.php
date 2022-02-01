<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReceivingGood;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Size;
use App\Models\UCS;
use App\Models\Location;
use App\Models\StatusReturn;
use App\Models\SalesInventory;
use App\Models\PendingReturnedProduct;
use App\Models\RecieveReturn;
use App\Models\EmptyBottlesInventory;
use App\Models\LocationProduct;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\ReceivingProduct;

class ReceivingGoodController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('receiving_goods_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $account_payables = Supplier::where('current_balance', '>' , 0)->orderBy('id', 'asc')->get();
        return view('admin.receivinggoods.receivinggoods', compact('account_payables'));
    }
    public function create()
    {
        abort_if(Gate::denies('receiving_goods_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $products = SalesInventory::latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();
        $status = StatusReturn::where('isRemove', 0)->latest()->get();
        $product_code = EmptyBottlesInventory::orderBy('product_id', 'asc')->get();
       

        return view('admin.receivinggoods.receiving_goods_form', compact('suppliers','products','categories','sizes','locations','status','product_code'));
    }
 
    public function load()
    {
        $orders = ReceivingGood::where('isRemove', false)->latest()->get();
        $title_filter  = 'All Receiving Goods';

        return view('admin.receivinggoods.loadreceivinggoods', compact('orders','title_filter'));
    }
    public function edit(ReceivingGood $receiving_good)
    {
        abort_if(Gate::denies('receiving_goods_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $action = 'Edit';
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $products = SalesInventory::latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();
        $status = StatusReturn::where('isRemove', 0)->latest()->get();
        $product_code = EmptyBottlesInventory::orderBy('product_id', 'asc')->get();
        

        return view('admin.receivinggoods.receiving_goods_form', compact('receiving_good','action','suppliers','products','categories','sizes','locations','status','product_code'));
    }

    public function pending_product(Request $request)
    {
        $rg_id = $request->get('rg_id');
        if($rg_id == ""){
            $pendingproducts = SalesInventory::where('isComplete', false)->where('isRemove', false)->latest()->get();
        }else{
            $pendingproducts = ReceivingProduct::where('receiving_good_id', $rg_id)->latest()->get();
        }
        return view('admin.receivinggoods.pending_products', compact('pendingproducts'));
    }

    public function total(Request $request)
    {
        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }

        $rg_id = $request->get('rg_id');
        if($rg_id == ""){
            $returns = RecieveReturn::where('receiving_good_id', $receiving_good_id)->latest()->get();
            $products = SalesInventory::where('isComplete', false)->where('isRemove', false)->latest()->get();

            $payment = $products->sum('total_cost') - $returns->sum('amount');
        }else{
            $returns = RecieveReturn::where('receiving_good_id', $rg_id)->latest()->get();
            $products = ReceivingProduct::where('receiving_good_id', $rg_id)->latest()->get();

            $payment = $products->sum('total_cost') - $returns->sum('amount');
        }
        
    
        return view('admin.receivinggoods.alltotal', compact('products', 'returns' , 'payment'));
    }



    public function compute(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'cash1' => ['required'],
            'supplier_id' => ['required'],
            'name_of_a_driver' => ['required'],
            'plate_number' => ['required'],
            'remarks' => ['nullable'],

            'doc_no' => ['nullable'],
            'entry_date' => ['required' , 'date', 'after:yesterday'],
            'po_no' => ['nullable'],
            'po_date' => ['nullable', 'date' ,'after:yesterday'],
            'location_id' => ['required'],
            
            'reference' => ['nullable'],

            'trade_discount' => ['nullable' ,'numeric','min:0'],
            'terms_discount' => ['nullable' ,'numeric','min:0'],
        ]);

        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }

        $products = SalesInventory::where('isComplete', false)->where('isRemove', false)->count();
        $returns = RecieveReturn::where('receiving_good_id', $receiving_good_id)->count();
        
        if($products < 1 && $returns < 1){
            return response()->json(['nodata' => 'NO AVAILABLE PRODUCT & RETURNS.']);
        }
        //BAD ORDER VALIDATION
        $bad_orders = RecieveReturn::where('receiving_good_id', $receiving_good_id)->where('type_of_return', 'BAD_ORDER')->get();
        foreach($bad_orders as $return){
            $location = LocationProduct::where('product_id', $return->product_id)
                ->where('location_id', 3)
                ->first();

            if($return->return_qty > $location->stock){
                return response()->json(['nodata' => 'INSUFFICIENT STOCKS. <br> PRODUCT CODE/DESC: ' . $return->product->product_code .'/'. $return->product->description
                                                .'<br>'. 'AVAILABLE STOCK: ' .$location->stock]);
            }
        }

        $cash1     = $request->get('cash1');
        $payment1  = $request->get('payment');
        $prev_bal1 = $request->get('prev_bal');

        $cash     = floatval(str_replace(",", "", $cash1));
        $payment  = floatval(str_replace(",", "", $payment1));
        $prev_bal = floatval(str_replace(",", "", $prev_bal1));
        
        
        if($cash < $payment){
            $change   = $cash - $payment;
            $change1  = $payment - $cash;
            $new_bal  = $prev_bal + $change1;
        }else{
            $change = $cash - $payment;
            if($prev_bal < $change){
                $new_bal = 0;
            }else{
                $new_bal = $prev_bal - $change;
            }
            
        }

        if($cash < $payment){
            $validated =  Validator::make($request->all(), [
                'payables' =>'accepted'
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }
        }

        return response()->json(
            [
              'submit'  => 'Add',
              'change' => number_format($change, 2, '.', ','),
              'new_bal' => number_format($new_bal, 2, '.', ','),
            ]
        );
    }

    public function store(Request $request)
    {
       

        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }

        $products = SalesInventory::where('isComplete', false)->where('isRemove', false)->count();
        $returns = RecieveReturn::where('receiving_good_id', $receiving_good_id)->count();
        
        ReceivingGood::create([
            'user_id' => auth()->user()->id,
            'supplier_id' => $request->input('supplier_id'),
            'location_id' => $request->input('location_id'),

            'doc_no' => $request->input('doc_no'),
            'entry_date' => $request->input('entry_date'),
            'po_no' => $request->input('po_no'),
            'po_date' => $request->input('po_date'),

            'plate_number' => $request->input('plate_number'),
            'name_of_a_driver' => $request->input('name_of_a_driver'),
            'trade_discount' => $request->input('trade_discount'),
            'terms_discount' => $request->input('terms_discount'),
            'remarks' => $request->input('remarks'),
            'reference' => $request->input('reference'),
            
            'total_orders' => $products,
            'over_all_cost' => SalesInventory::where('isComplete', false)->sum('total_cost'),
        ]);


        $pendingproducts = SalesInventory::where('isComplete', false)->get();
        $existingproducts = SalesInventory::where('isComplete', true)->where('isRemove', false)->get();

        foreach ($pendingproducts as $product){
               
                $ep = SalesInventory::where('product_code', $product->product_code)
                                    ->where('isComplete', true)->first();

                $rp = ReceivingProduct::create([
                    'receiving_good_id' => $product->receiving_good_id,
                    'product_id'        => $ep->id ?? $product->id,

                    'product_code'      => $product->product_code,
                    'category_id'       => $product->category_id,
                    'description'       => $product->description,

                    'qty'               => $product->qty,
                    'size_id'           => $product->size_id,
                    'expiration'        => $product->expiration,

                    'unit_cost'         => $product->unit_cost,
                    'regular_discount'  => $product->regular_discount,
                    'hauling_discount'  => $product->hauling_discount,
                    'price'             => $product->price,
                    'total_cost'        => $product->total_cost,


                    'product_remarks'   => $product->product_remarks,
                    'location_id'       => $request->input('location_id'),
                    'supplier_id'       => $request->input('supplier_id'),
                ]);

                $ucs = Size::where('id', $product->size_id)->first();
                if($ucs->ucs != ""){
                    $ucs_percase = $ucs->ucs * $product->qty;
                    UCS::create(
                        [
                            'receiving_good_id'     => $product->receiving_good_id,
                            'product_id'            => $rp->id,
                            'ucs'                   => $ucs_percase,
                            'status_size'           => $ucs->status,
                            'qty'                   => $product->qty,
                            'ucs_size'              => $ucs->ucs,
                            'isComplete'            => true,
                        ]
                    );
                }

                $location_product = LocationProduct::where('product_id', $ep->id ?? $product->id)
                                                    ->where('location_id',$request->input('location_id'))
                                                    ->first();
                if($location_product === null){
                    LocationProduct::create([
                        'product_id'    => $ep->id ?? $product->id,
                        'location_id'   => $request->input('location_id'),
                        'stock'         => $product->qty,
                    ]);
                }else{
                    LocationProduct::where('product_id', $ep->id ?? $product->id)
                                    ->where('location_id',$request->input('location_id'))
                                    ->increment('stock', $product->qty);
                }
                
        }

        foreach($existingproducts as $eproduct){
            SalesInventory::where('product_code', $eproduct->product_code)
                            ->where('isComplete', false)
                            ->delete();
        }
        
        SalesInventory::where('isComplete', false)->update(
            [
                'supplier_id'   => $request->input('supplier_id'),
                'isComplete'    => true,
            ]
        );

        $product_ids = EmptyBottlesInventory::select(['product_id'])->get()->toArray();
        $returnBottle = RecieveReturn::where('receiving_good_id', $receiving_good_id)->where('type_of_return', 'EMPTY')->get();
        foreach($returnBottle as $return){
            if (in_array(array('product_id' => $return->product_id), $product_ids)){
                EmptyBottlesInventory::where('product_id', $return->product_id)
                                        ->decrement('qty', $return->return_qty);
            }
        } 

        //BAD ORDER
        $bad_orders = RecieveReturn::where('receiving_good_id', $receiving_good_id)->where('type_of_return', 'BAD_ORDER')->get();
        foreach($bad_orders as $return){
                $location = LocationProduct::where('product_id', $return->product_id)
                    ->where('location_id', 3)
                    ->first();

                    LocationProduct::where('product_id', $return->product_id)
                        ->where('location_id', 3)
                        ->decrement('stock', $return->return_qty);
                
            
        }  

        return response()->json(['success' => 'Added Receiving Good Successfully.']);

    }

    public function update(Request $request, ReceivingGood $receiving_good)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'supplier_id' => ['required'],
            'name_of_a_driver' => ['required'],
            'plate_number' => ['required'],
            'remarks' => ['nullable'],

            'doc_no' => ['nullable'],
            'entry_date' => ['required' , 'date', 'after:yesterday'],
            'po_no' => ['nullable'],
            'po_date' => ['nullable', 'date' ,'after:yesterday'],
            'location_id' => ['required'],
            'reference' => ['nullable'],

            'trade_discount' => ['nullable' ,'numeric','min:0'],
            'terms_discount' => ['nullable' ,'numeric','min:0'],
        ]);

        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        
        ReceivingGood::find($receiving_good->id)->update([
            'supplier_id' => $request->input('supplier_id'),
            'location_id' => $request->input('location_id'),

            'doc_no' => $request->input('doc_no'),
            'entry_date' => $request->input('entry_date'),
            'po_no' => $request->input('po_no'),
            'po_date' => $request->input('po_date'),

            'plate_number' => $request->input('plate_number'),
            'name_of_a_driver' => $request->input('name_of_a_driver'),
            'trade_discount' => $request->input('trade_discount'),
            'terms_discount' => $request->input('terms_discount'),
            'remarks' => $request->input('remarks'),
            'reference' => $request->input('reference'),
            
        ]);

        return response()->json(['success' => 'Updated Receiving Good Successfully.']);

    }

    
    public function filter(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter = $request->get('filter');
        if($filter == 'daily'){
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $orders = ReceivingGood::where('isRemove', false)->latest()->whereDay('created_at', '=', date('d'))->get();
        }
        if($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $orders = ReceivingGood::where('isRemove', false)->latest()->whereMonth('created_at', '=', date('m'))->get();
        }
        if($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $orders = ReceivingGood::where('isRemove', false)->latest()->whereYear('created_at', '=', date('Y'))->get();
        }
        if($filter == 'all'){
            $title_filter  = 'All Receiving Goods';
            $orders = ReceivingGood::where('isRemove', false)->latest()->get();
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');
            $title_filter =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));

            
            $orders = ReceivingGood::where('isRemove', false)->latest()->whereBetween('created_at', [$from, $to])->get();
               

        }
        return view('admin.receivinggoods.loadreceivinggoods', compact('orders','title_filter'));
    }

    public function bad_order_dd(){
        $products = LocationProduct::where('location_id', 3)->where('stock', '>', 0)->orderBy('id','asc')->get();
        
        foreach ($products as $product) {
            $bad_orders[] = array(
                'id'           => $product->product_id,
                'product_code' => $product->product->product_code,
                'description'  => $product->product->description,
                'stock'        => $product->stock,    
            );
        }

        return response()->json(['bad_orders' => $bad_orders]);
    }
    public function empty_dd(){
        $products =  EmptyBottlesInventory::orderBy('product_id', 'asc')->get();

        foreach($products as $product){
            $empties[] = array(
                'id'           => $product->product_id,
                'product_code' => $product->product->product_code ?? 'NO BRAND',
                'description'  => $product->product->description ?? '',
                'stock'        => $product->qty,    
            );
        }

        return response()->json(['empties' => $empties]);
    }
    
    public function get_supplier_id(Request $request){
        $supplier_id = $request->get('supplier');
        $rg = ReceivingGood::where('supplier_id', $supplier_id)->first();
        $supplier_prev = Supplier::where('id', $supplier_id)->first();

        return response()->json(['receiving_goods' => $rg, 'supplier_prev' => $supplier_prev->current_balance]);

    }
    public function list_receiving_goods(Request $request){
        $supplier_id = $request->get('supplier');
        $rgs         = ReceivingGood::where('supplier_id', $supplier_id)->latest()->get();

        
        foreach($rgs as $rg){

            foreach($rg->returns()->get() as $return){
                $returns[] = array(
                    'product_code' => $return->product->product_code,
                    'description'  => $return->product->description,
                    'qty'          => $return->return_qty,
                );
            }

            $list[] = array(
                'id'           => $rg->id, 
                'supplier'     => $rg->supplier->name, 
                'products'     => $rg->products()->get(),
                'returns'      => $returns ?? '',
            );
        }
        return response()->json(['list' => $list]);
    }

    public function select_reuse(ReceivingGood $receiving_good)
    {
        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }
        foreach($receiving_good->products()->get() as $product)
        {
            SalesInventory::create([
                'receiving_good_id'  => $receiving_good_id,
                'product_code'       => $product->product_code,
                'category_id'        => $product->category_id,
                'description'        => $product->description,
                'qty'                => $product->qty,
                'size_id'            => $product->size_id,
                'expiration'         => $product->expiration,
                'unit_cost'          => $product->unit_cost,
                'regular_discount'   => $product->regular_discount,
                'hauling_discount'   => $product->hauling_discount,
                'price'              => $product->price,
                'total_cost'         => $product->total_cost,
                'product_remarks'    => $product->product_remarks,
            ]);
        }
        foreach($receiving_good->returns()->get() as $return)
        {
            RecieveReturn::create([
                'receiving_good_id'  => $receiving_good_id,
                'product_id'         => $return->product_id,
                'return_qty'         => $return->return_qty,
                'unit_price'         => $return->unit_price,
                'amount'             => $return->amount,
                'status_id'          => $return->status_id,
                'remarks'            => $return->remarks,
            ]);
        }

        return response()->json(
            [
                'success' => 'The data of this supplier successfully inserted.',
                'result'  => $receiving_good,
            ]);

        // $supplier_id = $request->get('supplier');
        // $rg = ReceivingGood::where('supplier_id', $supplier_id)->orderBy('id', 'desc')->first();
        // if($rg == null){
        //     return response()->json(['nodata' => 'No available data in this supplier']);
        // }

        // $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        // if($goods_id == null){
        //     $receiving_good_id = 1;
        // }else{
        //     $receiving_good_id = $goods_id->id + 1;
        // }
        // SalesInventory::where('receiving_good_id',$receiving_good_id)->delete();
        // RecieveReturn::where('receiving_good_id',$receiving_good_id)->delete();
        
        // foreach($rg->products()->get() as $product)
        // {
        //     SalesInventory::create([
        //         'receiving_good_id'  => $receiving_good_id,
        //         'product_code'       => $product->product_code,
        //         'category_id'        => $product->category_id,
        //         'description'        => $product->description,
        //         'qty'                => $product->qty,
        //         'size_id'            => $product->size_id,
        //         'expiration'         => $product->expiration,
        //         'unit_cost'          => $product->unit_cost,
        //         'regular_discount'   => $product->regular_discount,
        //         'hauling_discount'   => $product->hauling_discount,
        //         'price'              => $product->price,
        //         'total_cost'         => $product->total_cost,
        //         'product_remarks'    => $product->product_remarks,
        //     ]);
        // }
        // foreach($rg->returns()->get() as $return)
        // {
        //     RecieveReturn::create([
        //         'receiving_good_id'  => $receiving_good_id,
        //         'product_id'         => $return->product_id,
        //         'return_qty'         => $return->return_qty,
        //         'unit_price'         => $return->unit_price,
        //         'amount'             => $return->amount,
        //         'status_id'          => $return->status_id,
        //         'remarks'            => $return->remarks,
        //     ]);
        // }

        // return response()->json(
        //         [
        //             'result' => $rg,
        //             'success' => 'The data of this supplier successfully inserted.'
        //         ]);
    }

    public function payables(Request $request){
        $new_bal = $request->get('new_bal');
        $supplier = $request->get('supplier');
        Supplier::where('id', $supplier)->update([
            'current_balance' => $new_bal,
        ]);
        return response()->json(['success' => 'Successfully Updated Account Payable In This Supplier']);
    }

    

}
