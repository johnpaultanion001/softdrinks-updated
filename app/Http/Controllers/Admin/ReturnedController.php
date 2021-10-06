<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Returned;
use App\Models\StatusReturn;
use App\Models\PendingReturnedProduct;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ReturnedController extends Controller
{

    public function index()
    {
        // abort_if(Gate::denies('returned_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $status = StatusReturn::where('isRemove', 0)->latest()->get();
        // return view('admin.returned.returned', compact('status'));
    }

   

    public function loadreturned(){

        // $returned = Returned::where('isRemove', 0)->latest()->get();
        // return view('admin.returned.loadreturned', compact('returned'));
    }

    
    public function store(Request $request)
    {
        // $products = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id',$request->input('hidden_id'))->count();
        // if($products < 1){
        //     return response()->json(['nodata' => 'No available Product.']);
        // }
        // date_default_timezone_set('Asia/Manila');
        // $userid = auth()->user()->id;
        // $orders = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id',$request->input('hidden_id'))->count();
        // Returned::create([
        //     'user_id' => $userid,
        //     'purchase_order_number_id' => $request->input('hidden_id'),
        //     'total_case_return' => $request->input('hidden_total_case'),
        //     'total_deposit' => $request->input('hidden_total_deposit'),
        //     'total_orders_returned' => $orders,

        // ]);
        // PurchaseOrder::where('purchase_order_number', $request->input('hidden_id'))->update([
        //     'isReturn' => '1',
        // ]);
        // return response()->json(['success' => 'Returned Product Successfully.']);
    }

    
    public function show(PurchaseOrder $returned)
    {
        // $status = StatusReturn::where('isRemove', 0)->latest()->get();
        // $returnedproducts = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id',$returned->purchase_order_number)->latest()->get();
      
        // return view('admin.returned.returnedproduct', compact('returned','status','returnedproducts'));
    }

    public function loadreturnedproduct(PurchaseOrder $returned){

        // $returnedproducts = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id',$returned->purchase_order_number)->latest()->get();
        // return view('admin.returned.loadpendingreturnedproduct', compact('returned','returnedproducts'));
    }

    public function viewreturn(Returned $returned)
    {
        // $returnedproducts = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id',$returned->purchase_order_number_id)->latest()->get();
        // return view('admin.returned.viewmodal', compact('returned', 'returnedproducts'));
    }
    
    public function edit(Returned $returned)
    {

        // $returnedproducts = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id',$returned->purchase_order_number_id)->latest()->get();
        // return view('admin.returned.editmodal', compact('returned', 'returnedproducts'));
    }

    public function update(Request $request, Returned $returned)
    {
        //
    }

  
    public function destroy(Returned $returned)
    {
        // Returned::find($returned->id)->update([
        //     'isRemove' => '1',
        // ]);
        // return response()->json(['success' => 'Returned Item Removed Successfully.']);
    }
}
