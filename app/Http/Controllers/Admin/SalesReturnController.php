<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesReturn;
use App\Models\Inventory;
use App\Models\PriceType;
use Validator;

class SalesReturnController extends Controller
{
    
    public function index()
    {
        $returned = SalesReturn::where('isRemove', 0)->latest()->get();
        return view('admin.ordering.salesreturn.salesreturn', compact('returned'));
    }

   
    public function create()
    {
      
    }

    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'inventory_id' => ['required'],
            'pricetype_id' => ['required'],
            'unit_price' => ['required' ,'numeric','min:1'],
            'return_qty' => ['required' ,'integer','min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $discounted = PriceType::where('id', $request->pricetype_id)->firstorfail();
        $amount =  $request->input('return_qty') * $request->input('unit_price') - $discounted->discount;
        SalesReturn::create([
            'inventory_id' => $request->input('inventory_id'),
            'pricetype_id' => $request->input('pricetype_id'),
            'unit_price' => $request->input('unit_price'),
            'return_qty' => $request->input('return_qty'),
            'salesinvoice_id' => $request->input('salesinvoice_id_return'),
            'amount' => $amount,
            
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
            'pricetype_id' => ['required'],
            'unit_price' => ['required' ,'numeric','min:1'],
            'return_qty' => ['required' ,'integer','min:1'],
            'inventory_id' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $discounted = PriceType::where('id', $request->pricetype_id)->firstorfail();
        $amount =  $request->input('return_qty') * $request->input('unit_price') - $discounted->discount;

        SalesReturn::find($salesReturn->id)->update([
            'inventory_id' => $request->input('inventory_id'),
            'pricetype_id' => $request->input('pricetype_id'),
            'unit_price' => $request->input('unit_price'),
            'return_qty' => $request->input('return_qty'),
            'amount' => $amount,
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }

   
    public function destroy(SalesReturn $salesReturn)
    {
        SalesReturn::find($salesReturn->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Removed Successfully.']);
    }
}
