<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderNumber;
use App\Models\EmptyBottlesInventory;
use App\Models\Deposit;
use Validator;


class DepositController extends Controller
{
   
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'product_deposit' => ['required'],
            'status_deposit' => ['required'],
            'qty_deposit' => ['required' ,'numeric','min:0'],
            'unit_price_deposit' => ['required' ,'numeric','min:0'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $product = EmptyBottlesInventory::where('product_id', $request->input('product_deposit'))->first();
        if($request->input('status_deposit') == '1'){
            if($request->input('qty_deposit') > $product->empties_qty()){
                return response()->json(['max_stock' => 'Out of stock, Available stock of this product is '.$product->empties_qty()]);
            }
        }
        if($request->input('status_deposit') == '2'){
            if($request->input('qty_deposit') > $product->shells_qty()){
                return response()->json(['max_stock' => 'Out of stock, Available stock of this product is '.$product->shells_qty()]);
            }
        }
        if($request->input('status_deposit') == '3'){
            if($request->input('qty_deposit') > $product->bottles_qty()){
                return response()->json(['max_stock' => 'Out of stock, Available stock of this product is '.$product->bottles_qty()]);
            }
        }
        
        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $id = $ordernumber->order_number;


        $amount = $request->input('qty_deposit') * $request->input('unit_price_deposit');
        Deposit::updateOrCreate(
            [
                'product_id'        => $request->input('product_deposit'),
                'salesinvoice_id'   => $id,
                'status_id'         => $request->input('status_deposit'),
            ],
            [
                'product_id'        => $request->input('product_deposit'),
                'unit_price'        => $request->input('unit_price_deposit'),
                'qty'               => $request->input('qty_deposit'),
                'salesinvoice_id'   => $id,
                'amount'            => $amount,
                'status_id'         => $request->input('status_deposit'),
                'remarks'           => $request->input('remarks_deposit'),
            ]
        );


        return response()->json(['success' => 'Deposit Successfully Saved.']);
        
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit(Deposit $deposit)
    {
        if (request()->ajax()) {
            return response()->json(['data' => $deposit]);
        }
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy(Deposit $deposit)
    {
        $deposit->delete();
        return response()->json(['success' => 'Deposit Successfully Removed.']);
    }
}
