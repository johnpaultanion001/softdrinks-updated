<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendingReturnedProduct;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ReceivingGoodReturnController extends Controller
{
   
    public function loadreturningproduct(){
      
        $returnedproducts = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $id)->latest()->get();
        return view('admin.purchaseorders.returningproducts', compact('returnedproducts'));
        
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'product_id' => ['required'],
            'qty' => ['required','integer','min:1'],
            'unit_price' => ['required' ,'numeric','min:1'],
            'status_id' => ['required' ],
            'remarks' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $amount = $request->input('qty') * $request->input('unit_price');

        if($request->input('existing_purchase') == 'yes'){
            $purchaseid = $request->input('purchase_id_return');

            PendingReturnedProduct::create([
                'purchase_order_number_id' => $purchaseid,
                'product_id' => $request->input('product_id'),
                'qty' => $request->input('qty'),
                'unit_price' => $request->input('unit_price'),
                'amount' => $amount,
                'status_id' => $request->input('status_id'),
                'remarks' => $request->input('remarks'),
            ]);
            return response()->json(['success' => 'Returned Product Added Successfully.']);
        }
        elseif($request->input('existing_purchase') == 'no'){
                $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
                $id = $purchaseorderid->purchase_order_number + 1;
                
                PendingReturnedProduct::create([
                    'purchase_order_number_id' => $id,
                    'product_id' => $request->input('product_id'),
                    'qty' => $request->input('qty'),
                    'unit_price' => $request->input('unit_price'),
                    'amount' => $amount,
                    'status_id' => $request->input('status_id'),
                    'remarks' => $request->input('remarks'),
                ]);
                return response()->json(['success' => 'Returned Product Added Successfully.']);

        }
    }

    public function edit(PendingReturnedProduct $returningproduct)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $returningproduct]);
        }
    }

    public function update(Request $request, PendingReturnedProduct $returningproduct)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'product_id' => ['required'],
            'qty' => ['required','integer','min:1'],
            'unit_price' => ['required' ,'numeric','min:1'],
            'status_id' => ['required' ],
            'remarks' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $amount = $request->input('qty') * $request->input('unit_price');
        PendingReturnedProduct::find($returningproduct->id)->update([
            'product_id' => $request->input('product_id'),
            'qty' => $request->input('qty'),
            'unit_price' => $request->input('unit_price'),
            'amount' => $amount,
            'status_id' => $request->input('status_id'),
            'remarks' => $request->input('remarks'),
        ]);
        return response()->json(['success' => 'Returned Product Updated Successfully.']);
    }

    public function destroy(PendingReturnedProduct $returningproduct)
    {
        PendingReturnedProduct::find($returningproduct->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Returned Product Removed Successfully.']);
    }

 
}
