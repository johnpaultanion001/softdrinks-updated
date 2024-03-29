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
use App\Models\ReceivingPallet;
use App\Models\Pallet;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\ReceivingProduct;
use Carbon\Carbon;

class ReceivingGoodController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('receiving_goods_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        date_default_timezone_set('Asia/Manila');
        $account_payables = Supplier::where('current_balance', '>' , 0)->orderBy('id', 'asc')->get();
        $suppliers = Supplier::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $locations = Location::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $title_filter_daily  = date('F d, Y');
        return view('admin.receivinggoods.receivinggoods', compact('account_payables','locations','suppliers','title_filter_daily'));
    }
    public function create()
    {
        abort_if(Gate::denies('receiving_goods_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $suppliers = Supplier::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $locations = Location::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $products = SalesInventory::latest()->get();
        $categories = Category::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $sizes = Size::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $status = StatusReturn::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $product_code = EmptyBottlesInventory::orderBy('product_id', 'asc')->get();
       

        return view('admin.receivinggoods.receiving_goods_form', compact('suppliers','products','categories','sizes','locations','status','product_code'));
    }
 
    public function load()
    {
        $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
        $orders = ReceivingGood::where('isVoid', false)->whereDate('created_at', Carbon::today())->orderBy('id','desc')->get();

        return view('admin.receivinggoods.loadreceivinggoods', compact('orders','title_filter'));
    }
    public function edit(ReceivingGood $receiving_good)
    {
        $total_cost = $receiving_good->products->sum('total_cost') + $receiving_good->pallets->sum('amount');
        $total_return = $receiving_good->returns->sum('amount') + $receiving_good->pallets_returns->sum('amount');
        $payment = $total_cost - $total_return;
        $change  = $receiving_good->cash1 - $payment;

        if (request()->ajax()) {
            return response()->json(
                [
                    'supplier_id' => $receiving_good->supplier_id,
                    'location_id' => $receiving_good->location_id,
                    'doc_no' => $receiving_good->doc_no,
                    'entry_date' => $receiving_good->entry_date,
                    'po_no' => $receiving_good->po_no,
                    'po_date' => $receiving_good->po_date,
                    'name_of_a_driver' => $receiving_good->name_of_a_driver,
                    'plate_number' => $receiving_good->plate_number,
                    'trade_discount' => $receiving_good->trade_discount,
                    'terms_discount' => $receiving_good->terms_discount,
                    'remarks' => $receiving_good->remarks,
                    'reference' => $receiving_good->reference,
                    'products'  => $receiving_good->products()->get(),
                    'total_product_cost'  => number_format($total_cost, 2, '.', ','),
                    'total_return_amount'  => '('.number_format($total_return, 2, '.', ',').')',
                    'payment'               => number_format($payment, 2, '.', ','),
                    'total_product_qty'  => $receiving_good->products()->sum('qty'),
                    'total_return_qty'  => $receiving_good->returns()->sum('return_qty'),
                    'balance'           => number_format($receiving_good->supplier->current_balance, 2, '.', ','),
                    'cash1'              => $receiving_good->cash1,
                    'change'            => number_format($change, 2, '.', ','),
                ]);
        }
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

        $returns = RecieveReturn::where('receiving_good_id', $receiving_good_id)->latest()->get();
        $products = SalesInventory::where('isComplete', false)->where('isRemove', false)->latest()->get();

        $total_pallets = ReceivingPallet::where('receiving_good_id', $receiving_good_id)
                                            ->where('type', 'BUY')
                                            ->latest()->get();
        $total_return_pallets = ReceivingPallet::where('receiving_good_id', $receiving_good_id)
                                            ->where('type', 'RETURN')
                                            ->latest()->get();

        $total_cost = $products->sum('total_cost') + $total_pallets->sum('amount');
        $total_return = $returns->sum('amount') + $total_return_pallets->sum('amount');

        $payment = $total_cost - $total_return;
        
        
    
        return view('admin.receivinggoods.alltotal', compact('products', 'returns' , 'payment','total_cost','total_return'));
    }



    public function compute(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'cash1' => ['required','numeric','min:0'],
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
        date_default_timezone_set('Asia/Manila');

        $cash     = floatval(str_replace(",", "", $request->get('cash1')));
        $payment  = floatval(str_replace(",", "", $request->get('payment')));

        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }

        if($cash < $payment){
            $validated =  Validator::make($request->all(), [
                'payables' =>'accepted'
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }
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
            'cash1'          => $request->get('cash1'),
        ]);


        $pendingproducts = SalesInventory::where('isComplete', false)->get();
        $existingproducts = SalesInventory::where('isComplete', true)->where('isRemove', false)->get();

        foreach ($pendingproducts as $product){
               
                $ep = SalesInventory::where('product_code', $product->product_code)
                                    ->where('isComplete', true)->first();

                $rp = ReceivingProduct::create([
                    'receiving_good_id'   => $product->receiving_good_id,
                    'product_id'          => $ep->id ?? $product->id,

                    'product_code'        => $product->product_code,
                    'category_id'         => $product->category_id,
                    'description'         => $product->description,

                    'qty'                 => $product->qty,
                    'size_id'             => $product->size_id,
                    'expiration'          => $product->expiration,

                    'unit_cost'           => $product->unit_cost,
                    'regular_discount'    => $product->regular_discount,
                    'hauling_discount'    => $product->hauling_discount,
                    'additional_discount' => $product->additional_discount,
                    'price'               => $product->price,
                    'total_cost'          => $product->total_cost,


                    'product_remarks'     => $product->product_remarks,
                    'location_id'         => $request->input('location_id'),
                    'supplier_id'         => $request->input('supplier_id'),
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

        // $product_ids = EmptyBottlesInventory::select(['product_id'])->get()->toArray();
        // $returnBottle = RecieveReturn::where('receiving_good_id', $receiving_good_id)->where('type_of_return', 'EMPTY')->get();
        // foreach($returnBottle as $return){
        //     if (in_array(array('product_id' => $return->product_id), $product_ids)){
        //         EmptyBottlesInventory::where('product_id', $return->product_id)
        //                                 ->decrement('qty', $return->return_qty);
        //     }
        // } 

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
        RecieveReturn::where('receiving_good_id', $receiving_good_id)->update(['isComplete' => true]);

        $pallets = ReceivingPallet::where('receiving_good_id', $receiving_good_id)->latest()->get();
        foreach($pallets as $pallet){
            if($pallet->type == "RETURN"){
                Pallet::where('id', $pallet->pallet_id)
                        ->decrement('stock', $pallet->qty);
            }
            if($pallet->type == "BUY"){
                Pallet::where('id', $pallet->pallet_id)
                        ->increment('stock', $pallet->qty);
            }
        }  

        return response()->json(['success' => 'Added Receiving Good Successfully.']);

    }

    public function update(Request $request, ReceivingGood $receiving_good)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'cash1' => ['required','numeric','min:0'],
            'supplier_id' => ['required'],
            'location_id' => ['required'],
            'entry_date' => ['required' , 'date', 'after:yesterday'],
            'po_date' => ['nullable', 'date' ,'after:yesterday'],

            'name_of_a_driver' => ['required'],
            'plate_number' => ['required'],

            'trade_discount' => ['nullable' ,'numeric','min:0'],
            'terms_discount' => ['nullable' ,'numeric','min:0'],
        ]);

        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $total_cost = $receiving_good->products->sum('total_cost') + $receiving_good->pallets->sum('amount');
        $total_return = $receiving_good->returns->sum('amount') + $receiving_good->pallets_returns->sum('amount');
        $payment = $total_cost - $total_return;


        $change  = $request->input('cash1') - $payment;

        foreach($receiving_good->products()->get() as $rp){
            if($rp->qty >  LocationProduct::where('product_id', $rp->product_id)->where('location_id',$rp->location_id)->sum('stock')){
                return response()->json(['error_stock' => 'This receiving goods is unable to be change location.']);
            }
        }

        foreach($receiving_good->products()->get() as $rp){
            LocationProduct::where('product_id', $rp->product_id)
                    ->where('location_id',$receiving_good->location_id)
                    ->decrement('stock', $rp->qty);
            $location_product = LocationProduct::where('product_id', $rp->product_id)
                            ->where('location_id',$request->input('location_id'))
                            ->first();

            if($location_product === null){
                LocationProduct::create([
                    'product_id'    => $rp->product_id,
                    'location_id'   => $request->input('location_id'),
                    'stock'         => $rp->qty,
                ]);
            }else{
                LocationProduct::where('product_id', $rp->product_id)
                                ->where('location_id',$request->input('location_id'))
                                ->increment('stock', $rp->qty);
            }
        }

        ReceivingProduct::where('receiving_good_id',$receiving_good->id)->update([
            'supplier_id'             => $request->input('supplier_id'),
            'location_id'             => $request->input('location_id'),
        ]);

        ReceivingGood::find($receiving_good->id)->update([
            'supplier_id'             => $request->input('supplier_id'),
            'location_id'             => $request->input('location_id'),
            'doc_no'                  => $request->input('doc_no'),
            'entry_date'              => $request->input('entry_date'),
            'po_no'                   => $request->input('po_no'),
            'po_date'                 => $request->input('po_date'),
            'name_of_a_driver'        => $request->input('name_of_a_driver'),
            'plate_number'            => $request->input('plate_number'),
            'trade_discount'          => $request->input('trade_discount'),
            'terms_discount'          => $request->input('terms_discount'),
            'remarks'                 => $request->input('remarks'),
            'reference'               => $request->input('reference'),
            'cash1'                   => $request->input('cash1'),
        ]);

        return response()->json([
            
            'payment'  => number_format($payment, 2, '.', ','),
            'change'  =>  number_format($change, 2, '.', ','),
            'total_product_cost' =>  number_format($total_cost, 2, '.', ','),
            'total_return_amount' => '('.number_format($total_return, 2, '.', ',').')',
            'total_product_qty' => $receiving_good->products()->sum('qty'),
            'total_return_qty'  => $receiving_good->returns()->sum('return_qty'),
            'success' => 'Updated Successfully.'
        ]);
    }

    
    public function filter(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter = $request->get('filter');
        if($filter == 'daily'){
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $orders = ReceivingGood::where('isVoid', false)->whereDate('created_at', Carbon::today())->orderBy('id','desc')->get();
        }
        if($filter == 'weekly'){
            $title_filter  = 'From: ' . Carbon::now()->startOfWeek()->format('F d, Y') . ' To: ' . Carbon::now()->endOfWeek()->format('F d, Y');
            $orders = ReceivingGood::where('isVoid', false)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id','desc')->get();
        }
        if($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $orders = ReceivingGood::where('isVoid', false)->orderBy('id','desc')->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->whereYear('created_at', '=', date('Y'))->get();
        }
        if($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $orders = ReceivingGood::where('isVoid', false)->orderBy('id','desc')->whereYear('created_at', '=', date('Y'))->get();
        }
        if($filter == 'all'){
            $title_filter  = 'All Receiving Goods';
            $orders = ReceivingGood::where('isVoid', false)->orderBy('id','desc')->get();
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');
            $title_filter =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));

            
            $orders = ReceivingGood::where('isVoid', false)->orderBy('id','desc')->whereBetween('created_at', [$from, $to])->get();
               

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

        return response()->json(['bad_orders' => $bad_orders ?? '']);
    }
    
    public function empty_dd(){
        $products =  EmptyBottlesInventory::orderBy('product_id', 'asc')->get();

        foreach($products as $product){
            $empties[] = array(
                'id'           => $product->product_id,
                'product_code' => $product->product->product_code ?? '',
                'empties'      => $product->empties_qty(),
                'shells'      => $product->shells_qty(),
                'bottles'      => $product->bottles_qty(),
            );
        }

        return response()->json(['empties' => $empties ?? '']);
    }
    
    public function get_supplier_id(Request $request){
        $supplier_id = $request->get('supplier');
        $supplier_prev = Supplier::where('id', $supplier_id)->first();

        return response()->json([
            'supplier_prev' => number_format($supplier_prev->current_balance, 2, '.', ',')
        ]);
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

    }

    public function payables(Request $request){
        $new_bal = $request->get('new_bal');
        $supplier = $request->get('supplier');
        $new_bal = floatval(str_replace(",", "", $new_bal));

        Supplier::where('id', $supplier)->update([
            'current_balance' => $new_bal,
        ]);
        return response()->json(['success' => 'SUCCESSFULLY UPDATED ACCOUNT PAYABLE IN THIS SUPPLIER']);
    }

    public function void(ReceivingGood $receiving_good)
    {   
        foreach($receiving_good->products()->get() as $rp){
            if($rp->qty >  LocationProduct::where('product_id', $rp->product_id)->where('location_id',$rp->location_id)->sum('stock')){
                return response()->json(['error_stock' => 'This receiving goods is unable to be void.']);
            }
        }
        
        foreach($receiving_good->products()->get() as $rp){
            LocationProduct::where('product_id', $rp->product_id)
                            ->where('location_id', $rp->location_id)
                            ->decrement('stock', $rp->qty);
            UCS::where('product_id', $rp->id)->where('receiving_good_id', $rp->receiving_good_id)->delete();
            $rp->delete();
        }
        foreach($receiving_good->returns()->get() as $receivingReturn){
            if($receivingReturn->type_of_return == 'BAD_ORDER'){
                LocationProduct::where('product_id', $receivingReturn->product_id)
                                ->where('location_id', 3)
                                ->increment('stock', $receivingReturn->return_qty);
            }
            $receivingReturn->delete();
        }
        foreach($receiving_good->pallets()->get() as $pallet){
            Pallet::where('id', $pallet->pallet_id)->decrement('stock', $pallet->qty);
            $pallet->delete();
        }
        foreach($receiving_good->pallets_returns()->get() as $pallet){
            Pallet::where('id', $pallet->pallet_id)->increment('stock', $pallet->qty);
            $pallet->delete();
        }
        $receiving_good->update([
            'isVoid'    => true,
        ]);
        return response()->json(['success' => 'Transaction Successfully Void.']);
    }

    public function delivery_report(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter = $request->get('filter');

            $products    = SalesInventory::where('isComplete', true)->get();
            if($filter == 'daily'){
                $title_filter_daily  =  date('F d, Y');
                $delivery_product_ids = ReceivingProduct::whereDate('created_at', Carbon::today())
                ->select(['product_id'])->get()->toArray();
            }
            if($filter == 'weekly'){
                $title_filter_daily  =  'From: ' . Carbon::now()->startOfWeek()->format('F d, Y') . ' To: ' . Carbon::now()->endOfWeek()->format('F d, Y');
                $delivery_product_ids = ReceivingProduct::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->select(['product_id'])->get()->toArray();
            }
            if($filter == 'monthly'){
                $title_filter_daily  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
                $delivery_product_ids = ReceivingProduct::whereMonth('created_at', '=', date('m'))
                ->whereYear('created_at', '=', date('Y'))->select(['product_id'])->get()->toArray();
            }
            if($filter == 'yearly'){
                $title_filter_daily  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');;
                $delivery_product_ids = ReceivingProduct::whereYear('created_at', '=', date('Y'))
                ->select(['product_id'])->get()->toArray();
            }
            if($filter == 'all'){
                $title_filter_daily  = 'ALL DELIVERY';
                $delivery_product_ids = ReceivingProduct::select(['product_id'])->get()->toArray();
            }
            if($filter == 'fbd'){
                $from = $request->get('from');
                $to = $request->get('to');
                $title_filter_daily =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));

                $delivery_product_ids = ReceivingProduct::whereBetween('created_at', [$from, $to])->select(['product_id'])->get()->toArray();
            }

        foreach($products as $product){

            
            if (in_array(array('product_id' => $product->id), $delivery_product_ids)){
                $delivery_inventory = ReceivingProduct::where('product_id', $product->id)->sum('qty');
                
                $deliveries[] = array(
                    'supplier'             => $product->receiving_good->supplier->name,
                    'category'             => $product->category->name,
                    'product'              => $product->product_code .'/'.$product->description,
                    'total_delivery'       => $delivery_inventory,    
                );
            }  
              
        }

        return response()->json(['data' => $deliveries, 'title_filter' => $title_filter_daily]);
    }
    

    

}
