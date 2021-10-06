<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Inventory;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Size;
use App\Models\UCS;
use App\Models\Location;
use App\Models\StatusReturn;
use App\Models\PendingProduct;
use App\Models\PendingReturnedProduct;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $products = PendingProduct::latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();
        $status = StatusReturn::where('isRemove', 0)->latest()->get();
        $product_code = Inventory::where('isSame' , 0)->where('isRemove' , 0)->latest()->get();
        
        return view('admin.purchaseorders.purchaseorders', compact('suppliers','products','categories','sizes','locations','status','product_code'));
    }
    public function total()
    {
        $products = PendingProduct::latest()->get();
        return view('admin.purchaseorders.alltotal', compact('products'));
    }
    public function load()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orders = PurchaseOrder::where('isRemove', 0)->latest()->get();
        return view('admin.purchaseorders.loadpurchaseorders', compact('orders'));
    }

    public function view(PurchaseOrder $purchasenumber)
    {
        $products = Inventory::where('isRemove', 0)->where('isSame', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        $updatedproduct = Inventory::where('isRemove', 0)->where('isSame', 1)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $returnproduct = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        return view('admin.purchaseorders.viewmodal', compact('products', 'suppliers', 'purchasenumber', 'updatedproduct' , 'returnproduct'));
    }
    public function edit(PurchaseOrder $purchasenumber)
    {
        $orders = Inventory::where('isRemove', 0)->where('isSame', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $purchaseorder = PurchaseOrder::latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();

        $status = StatusReturn::where('isRemove', 0)->latest()->get();
        $product_code = Inventory::where('isSame' , 0)->where('isRemove' , 0)->latest()->get();
        return view('admin.purchaseorders.editpurchase.edit', compact('orders', 'suppliers' , 'categories' , 'purchaseorder', 'purchasenumber' , 'sizes' , 'locations', 'status', 'product_code'));
    }
    public function loadedit(PurchaseOrder $purchasenumber)
    {
        $products = Inventory::where('isRemove', 0)->where('isSame', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        $updatedproduct = Inventory::where('isRemove', 0)->where('isSame', 1)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        $returnproduct = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();

        return view('admin.purchaseorders.editpurchase.load', compact('products', 'updatedproduct', 'returnproduct' , 'purchasenumber'));
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
            'po_date' => ['required' , 'date' ,'after:yesterday'],
            'location_id' => ['required'],
            'reference' => ['nullable'],

            'trade_discount' => ['nullable' ,'numeric','min:0'],
            'terms_discount' => ['nullable' ,'numeric','min:0'],
        ]);

        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $products = PendingProduct::all()->count();
        if($products < 1){
            return response()->json(['nodata' => 'No available Product.']);
        }

        $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
        $id = $purchaseorderid->purchase_order_number + 1;
        $userid = auth()->user()->id;

        $totalpurchasedorder = PendingProduct::sum('total_amount_purchase');
        $totalprofit = PendingProduct::sum('total_profit');
        $totalprice = PendingProduct::sum('total_price');
        UCS::where('purchase_order_number_id', $id)->update([
            'isPurchase' => '1',
        ]);
        PurchaseOrder::create([
            'user_id' => $userid,
            'supplier_id' => $request->input('supplier_id'),
            'name_of_a_driver' => $request->input('name_of_a_driver'),
            'plate_number' => $request->input('plate_number'),
            'purchase_order_number' => $id,
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
            'remarks' => $request->input('remarks'),

            'doc_no' => $request->input('doc_no'),
            'entry_date' => $request->input('entry_date'),
            'po_no' => $request->input('po_no'),
            'po_date' => $request->input('po_date'),
            'location_id' => $request->input('location_id'),
            'reference' => $request->input('reference'),
            'trade_discount' => $request->input('trade_discount'),
            'terms_discount' => $request->input('terms_discount'),
        ]);

        PendingProduct::latest()->update([
            'location_id' => $request->input('location_id'),
            'supplier_id' => $request->input('supplier_id'),
        ]);

        $pcode = PendingProduct::pluck('product_code');
        Inventory::whereIn('product_code' , $pcode)
                    ->where('isSame', 0)
                    ->update([
                        'stock' => DB::raw ('stock + add_qty'),
                        'qty' => DB::raw ('qty + add_qty'),
                        'total_amount_purchase' => DB::raw ('purchase_amount * qty'),
                        'total_profit' => DB::raw ('profit * qty'),
                        'total_price' => DB::raw ('price * qty'),
                        'add_qty' => 0,
                    ]);

        PendingProduct::query()
        ->latest()
        ->each(function ($oldRecord) {
            $newPost = $oldRecord->replicate();
            $newPost->setTable('inventories');
            $newPost->save();
        });
        PendingProduct::latest()->delete();


        return response()->json(['success' => 'Added Purchased Order Successfully.']);
    }
    public function update(Request $request,PurchaseOrder $purchasenumber)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'supplier_id' => ['required'],
            'notes' => ['nullable'],
            'name_of_a_driver' => ['required'],
            'plate_number' => ['required'],

            'doc_no' => ['nullable'],
            'entry_date' => ['required' , 'date'],
            'po_no' => ['nullable'],
            'po_date' => ['required' , 'date'],
            'location_id' => ['required'],
            'reference' => ['nullable'],

            'trade_discount' => ['nullable'],
            'terms_discount' => ['nullable'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $userid = auth()->user()->id;
        $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->sum('total_amount_purchase');
        $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->sum('total_profit');
        $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->sum('total_price');
        $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->count();
        
        PurchaseOrder::find($purchasenumber->id)->update([
            'user_id' => $userid,
            'supplier_id' => $request->input('supplier_id'),
            'name_of_a_driver' => $request->input('name_of_a_driver'),
            'plate_number' => $request->input('plate_number'),
            'purchase_order_number' => $request->input('purchase_order_number'),
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
            'remarks' => $request->input('remarks'),

            'doc_no' => $request->input('doc_no'),
            'entry_date' => $request->input('entry_date'),
            'po_no' => $request->input('po_no'),
            'po_date' => $request->input('po_date'),
            'location_id' => $request->input('location_id'),
            'reference' => $request->input('reference'),
            'trade_discount' => $request->input('trade_discount'),
            'terms_discount' => $request->input('terms_discount'),
        ]);

        Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->update([
            'supplier_id' => $request->input('supplier_id'),
        ]);

        return response()->json(['success' => 'Purchased Order Updated Successfully.']);
    }
  
    public function reuseproduct(Request $request){
        // $userid = auth()->user()->id;
        $query = Inventory::query();

        if($request->get('supplier'))
        {
            $countproducts = Inventory::where('supplier_id' ,$request->get('supplier'))
                                        ->where('isSame', 0)
                                        ->where('isRemove', 0)
                                        ->count();
            if($countproducts < 1){   
                return response()->json([
                   'nodata' => 'No product available in this supplier',
                ]);
            }elseif($countproducts > 0){
                $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
                $id = $purchaseorderid->purchase_order_number + 1;

                PendingProduct::latest()->delete();
                UCS::where('purchase_order_number_id' , $id)->delete();

                $query->where('supplier_id', $request->get('supplier'));
                $po = PurchaseOrder::where('supplier_id', $request->get('supplier'))->latest()->firstorfail();
    
                $query->where('isRemove', 0)->where('isSame', 0)->latest()
                ->each(function ($oldRecord) {
                    $newPost = $oldRecord->replicate();
                    $newPost->setTable('pending_products');
                    $newPost->save();
                });
    
                
    
                PendingProduct::latest()->update([
                    'product_id' => DB::raw ('product_id -'. sprintf("%06d", mt_rand(1900, 2000))),
                    'purchase_order_number_id' => $id,
                    'qty' =>  DB::raw ('pqty'),
                    'stock' =>  DB::raw ('pqty'),
                    'isSame' => 1,
                    'add_qty' => 0,
                ]);
    
                Inventory::where('supplier_id', $request->get('supplier'))
                            ->where('isSame', '0')
                            ->update([
                                'add_qty' => DB::raw ('add_qty + pqty'),
                            ]);

                //UCS Mutli Insert
                $data = PendingProduct::select('purchase_order_number_id', 'product_id', 'qty', 'ucs_size')->get()->toarray();
                UCS::insert($data);

                UCS::where('purchase_order_number_id', $id)
                ->update([
                        'ucs' => DB::raw ('qty * ucs_size'),
                    ]);


                return response()->json([
                    'result' =>  $po,
                    'success' =>  'Successfully Inserted',
                ]);

            }
        }

      
    }
}
