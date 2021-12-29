<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesReturn;
use App\Models\Inventory;
use App\Models\PriceType;
use App\Models\EmptyBottlesInventory;
use Validator;

class SalesReturnController extends Controller
{
    
    public function index()
    {
        $returned = SalesReturn::latest()->get();
        return view('admin.ordering.salesreturn.salesreturn', compact('returned'));
    }

   
    public function create()
    {
      
    }

    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'product_id' => ['required'],
            'unit_price' => ['required' ,'numeric','min:0'],
            'return_qty' => ['required' ,'numeric','min:0'],
            'status_id' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        
        $amount =  $request->input('return_qty') * $request->input('unit_price');

        SalesReturn::updateOrCreate(
        [
            'product_id'      => $request->input('product_id'),
            'salesinvoice_id' => $request->input('salesinvoice_id_return'),
        ],
        [
            'product_id'        => $request->input('product_id'),
            'unit_price'        => $request->input('unit_price'),
            'return_qty'        => $request->input('return_qty'),
            'salesinvoice_id'   => $request->input('salesinvoice_id_return'),
            'amount'            => $amount,
            'status_id'         => $request->input('status_id'),
            'remarks'           => $request->input('remarks'),
        ]);

        return response()->json(['success' => 'Returned Successfully.']);
    }

  
    public function show(SalesReturn $salesReturn)
    {
        
    }

   
    public function edit(SalesReturn $salesReturn)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $salesReturn ]);
        }
    }

   
    public function update(Request $request, SalesReturn $salesReturn)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'product_id' => ['required'],
            'unit_price' => ['required' ,'numeric','min:0'],
            'return_qty' => ['required' ,'numeric','min:0'],
            'status_id' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $amount =  $request->input('return_qty') * $request->input('unit_price');

        SalesReturn::find($salesReturn->id)->update([

            'product_id'        => $request->input('product_id'),
            'unit_price'        => $request->input('unit_price'),
            'return_qty'        => $request->input('return_qty'),
            'amount'            => $amount,
            'status_id'         => $request->input('status_id'),
            'remarks'           => $request->input('remarks'),
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }

   
    public function destroy(Request $request ,SalesReturn $salesReturn)
    {
        $is_purchase = $request->get('is_purchase');
        if($is_purchase == 'YES'){
            EmptyBottlesInventory::where('product_id', $salesReturn->product_id)->decrement('qty', $salesReturn->return_qty);
            $salesReturn->delete();
        }else{
            $salesReturn->delete();
        }
        return response()->json(['success' => 'Removed Successfully.']);
    }
}
