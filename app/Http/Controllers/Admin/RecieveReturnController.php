<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecieveReturn;
use App\Models\ReceivingGood;
use App\Models\EmptyBottlesInventory;
use Validator;

class RecieveReturnController extends Controller
{
    
    public function index(Request $request)
    {
        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }

        $rg_id = $request->get('rg_id');
        if($rg_id == "")
        {
            $returns = RecieveReturn::where('receiving_good_id', $receiving_good_id)->latest()->get();
        }else{
            $returns = RecieveReturn::where('receiving_good_id', $rg_id)->latest()->get();
        }
        return view('admin.receivinggoods.receive_return', compact('returns'));
    }
    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'product_id' => ['required'],
            'return_qty' => ['required' ,'numeric','min:0'],
            'unit_price' => ['required' ,'numeric','min:0'],
            'status_id' => ['required' ],
            'remarks' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $amount = $request->input('return_qty') * $request->input('unit_price');


        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }
        
        RecieveReturn::create([
            'receiving_good_id' => $receiving_good_id,
            'product_id' => $request->input('product_id'),
            'return_qty' => $request->input('return_qty'),
            'unit_price' => $request->input('unit_price'),
            'amount' => $amount,
            'status_id' => $request->input('status_id'),
            'remarks' => $request->input('remarks'),
        ]);
        return response()->json(['success' => 'Return Product Added Successfully.']);

        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(RecieveReturn $recieve_return)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $recieve_return]);
        }
    }

   
    public function update(Request $request, RecieveReturn $recieve_return)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'product_id' => ['required'],
            'return_qty' => ['required' ,'numeric','min:0'],
            'unit_price' => ['required' ,'numeric','min:0'],
            'status_id' => ['required' ],
            'remarks' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $amount = $request->input('return_qty') * $request->input('unit_price');

        RecieveReturn::find($recieve_return->id)->update([
            'product_id' => $request->input('product_id'),
            'return_qty' => $request->input('return_qty'),
            'unit_price' => $request->input('unit_price'),
            'amount' => $amount,
            'status_id' => $request->input('status_id'),
            'remarks' => $request->input('remarks'),
        ]);
        return response()->json(['success' => 'Returned Product Updated Successfully.']);
    }

    public function destroy(Request $request , RecieveReturn $recieve_return)
    {
        $rg_id = $request->get('rg_id');
        if($rg_id == ""){
            RecieveReturn::find($recieve_return->id)->delete();
        }else{
            RecieveReturn::find($recieve_return->id)->delete();
            EmptyBottlesInventory::where('product_id', $recieve_return->product_id)
                                    ->increment('qty', $recieve_return->return_qty);
        }
        return response()->json(['success' => 'Returned Product Deleted Successfully.']);
    }
}
