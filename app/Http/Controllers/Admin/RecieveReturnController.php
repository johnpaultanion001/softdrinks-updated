<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecieveReturn;
use App\Models\ReceivingGood;
use App\Models\SalesInventory;
use App\Models\EmptyBottlesInventory;
use App\Models\LocationProduct;
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
        if($request->input('type_of_return') == 'EMPTY'){
            $product = EmptyBottlesInventory::where('product_id', $request->input('product_id'))->first();
            if($request->input('status_id') == '1'){
                if($request->input('return_qty') > $product->empties_qty()){
                    return response()->json(['max_stock' => 'Out of stock, Available stock of this product is '.$product->empties_qty()]);
                }
            }
            if($request->input('status_id') == '2'){
                if($request->input('return_qty') > $product->shells_qty()){
                    return response()->json(['max_stock' => 'Out of stock, Available stock of this product is '.$product->shells_qty()]);
                }
            }
            if($request->input('status_id') == '3'){
                if($request->input('return_qty') > $product->bottles_qty()){
                    return response()->json(['max_stock' => 'Out of stock, Available stock of this product is '.$product->bottles_qty()]);
                }
            }
        }
        

        $amount = $request->input('return_qty') * $request->input('unit_price');


        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }
        
        RecieveReturn::updateOrCreate(
            [
                'receiving_good_id' => $receiving_good_id,
                'product_id' => $request->input('product_id'),
                'type_of_return'  => $request->input('type_of_return'),
                'status_id'         => $request->input('status_id'),
            ],
            [
                'product_id'        => $request->input('product_id'),
                'unit_price'        => $request->input('unit_price'),
                'return_qty'        => $request->input('return_qty'),
                'type_of_return'    => $request->input('type_of_return'),
                'receiving_good_id' => $receiving_good_id,
                'amount'            => $amount,
                'status_id'         => $request->input('status_id'),
                'remarks'           => $request->input('remarks'),
            ]);



        return response()->json(['success' => 'Return Product Added Successfully.']);

        
    }


    
    public function edit(RecieveReturn $recieve_return)
    {

        if($recieve_return->type_of_return == 'BAD_ORDER'){
            $product = $recieve_return->bad_order->product->product_code . '/' .  $recieve_return->bad_order->product->description .'('.$recieve_return->bad_order->stock.')';
        }else{
            $product = $recieve_return->empty_inventory->product->product_code . ' / ' 
                .'Empties('.$recieve_return->empty_inventory->empties_qty().')'
                .' Shells('.$recieve_return->empty_inventory->shells_qty().')'
                .' Bottles('.$recieve_return->empty_inventory->bottles_qty().')';
        }
        if (request()->ajax()) {
            return response()->json(
                [
                    'type_of_return' => $recieve_return->type_of_return,
                    'product'        => $product,
                    'unit_price'     => $recieve_return->unit_price,
                    'return_qty'     => $recieve_return->return_qty,
                    'status'         => $recieve_return->status_id,
                    'remarks'         => $recieve_return->remarks,
                ]);
        }
    }

   
    public function update(Request $request, RecieveReturn $recieve_return)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
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
            if($recieve_return->type_of_return == 'BAD_ORDER'){
                LocationProduct::where('product_id', $recieve_return->product_id)
                                ->where('location_id', 3)
                                ->increment('stock', $recieve_return->return_qty);
            }
            $recieve_return->delete();
        }
        return response()->json(['success' => 'Returned Product Removed Successfully.']);
    }

    public function remove_all()
    {
        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }
        

        RecieveReturn::where('receiving_good_id' , $receiving_good_id)->delete();
        return response()->json(['success' => 'All Pending Returns Removed Successfully.']);
    }

    public function return_amount(Request $request){
        $product_id = $request->get('product_id');
        $tor        = $request->get('tor');
        if($tor == 'EMPTY'){
            $recieve_return = RecieveReturn::where('product_id', $product_id)->where('type_of_return', 'EMPTY')->latest()->first();
            if($recieve_return == null){
                return response()->json(['unit_price' => ' ']);
            }else{
                return response()->json(['unit_price' => $recieve_return->unit_price]);
            }
        }else{
            $bad_order_product = SalesInventory::where('id', $product_id)->latest()->first();
            if($bad_order_product == null){
                return response()->json(['unit_price' => ' ']);
            }else{
                return response()->json(['unit_price' => $bad_order_product->price]);
            }
        }
        
    }
}
