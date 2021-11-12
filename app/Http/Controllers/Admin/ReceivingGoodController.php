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
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\ReceivingProduct;

class ReceivingGoodController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $products = SalesInventory::latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();
        $status = StatusReturn::where('isRemove', 0)->latest()->get();
        $product_code = SalesInventory::where('isRemove' , false)->latest()->get();

        return view('admin.receivinggoods.receivinggoods', compact('suppliers','products','categories','sizes','locations','status','product_code'));
    }
 
    public function load()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orders = ReceivingGood::where('isRemove', false)->latest()->get();
        return view('admin.receivinggoods.loadreceivinggoods', compact('orders'));
    }
    public function edit(ReceivingGood $receiving_good)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $receiving_good]);
        }
    }

    public function pending_product(Request $request)
    {
        $receiving_good_id = $request->get('receiving_good_id'); 
        if($receiving_good_id){
            $existingproductsids = ReceivingProduct::where('receiving_good_id', $receiving_good_id)->select('product_id')->get();
            $products = SalesInventory::whereIn('id', $existingproductsids)->where('isComplete', true)->where('isRemove', false)->latest()->get(); 
            $pendingproducts = SalesInventory::where('isComplete', false)->where('isRemove', false)->latest()->get();
            return view('admin.receivinggoods.pending_products', compact('pendingproducts'));
        }else{
            $pendingproducts = SalesInventory::where('isComplete', false)->where('isRemove', false)->latest()->get();
            return view('admin.receivinggoods.pending_products', compact('pendingproducts'));
        }
        
       
        
        
    }

    public function total()
    {
        $products = SalesInventory::where('isComplete', false)->where('isRemove', false)->latest()->get();
        return view('admin.receivinggoods.alltotal', compact('products'));
    }

    public function store(Request $request)
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

        
        $products = SalesInventory::where('isComplete', false)->count();
        if($products < 1){
            return response()->json(['nodata' => 'No available Product.']);
        }

        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }
        
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

        UCS::where('receiving_good_id', $receiving_good_id)->update([
            'isComplete' => true,
        ]);

        $pendingproducts = SalesInventory::where('isComplete', false)->get();
        $existingproducts = SalesInventory::where('isComplete', true)->where('isRemove', false)->get();

        foreach ($pendingproducts as $product){
                SalesInventory::where('product_code', $product->product_code)
                    ->where('isComplete', true)
                    ->increment('stock', $product->qty);
                $ep = SalesInventory::where('product_code', $product->product_code)
                                    ->where('isComplete', true)->first();

                ReceivingProduct::create([
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
                    'location_id'       => $product->location_id,
                    'supplier_id'       => $product->supplier_id,
                ]) ;
        }

        foreach($existingproducts as $eproduct){
            SalesInventory::where('product_code', $eproduct->product_code)
                            ->where('isComplete', false)
                            ->delete();
        }
        
        SalesInventory::where('isComplete', false)->update(
            [
                'supplier_id'   => $request->input('supplier_id'),
                'location_id'   => $request->input('location_id'),
                'isComplete'    => true,
            ]
        );



        

        return response()->json(['success' => 'Added Receiving Good Successfully.']);

    }

}
