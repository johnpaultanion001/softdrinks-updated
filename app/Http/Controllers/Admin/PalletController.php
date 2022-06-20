<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReceivingPallet;
use App\Models\Pallet;
use App\Models\ReceivingGood;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class PalletController extends Controller
{
    public function rpallets_table(Request $request)
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
            $pallets = ReceivingPallet::where('receiving_good_id', $receiving_good_id)->latest()->get();
        }else{
            $pallets = ReceivingPallet::where('receiving_good_id', $rg_id)->latest()->get();
        }

        return view('admin.receivinggoods.pallets_table', compact('pallets'));
    }
    public function unit_price(Pallet $pallet)
    {
        if (request()->ajax()) {
            return response()->json(['unit_price' => $pallet->price]);
        }
    }
    public function edit_rpallet(ReceivingPallet $pallet)
    {
        if (request()->ajax()) {
            return response()->json(['data' => $pallet]);
        }
    }
    
    public function store_rpallet(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'pallet' => ['required'],
            'type' => ['required'],
            'pallet_qty' => ['required' ,'integer','min:1'],
            'pallet_unit_price' => ['required' ,'numeric','min:0'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        if($request->input('type') == "RETURN"){
            $avail_stock = Pallet::where('id',$request->input('pallet'))->first();
            if($request->input('pallet_qty') > $avail_stock->stock){
                return response()->json(['max_stock' => 'Out of stock, Available stock of this product is '.$avail_stock->stock]);
            }
        }

        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }
     
        $amount = $request->input('pallet_qty') * $request->input('pallet_unit_price');
        ReceivingPallet::updateOrCreate(
            [
                'receiving_good_id'  => $receiving_good_id,
                'pallet_id' => $request->input('pallet'),
                'type' => $request->input('type'),
            ],
            [
                'receiving_good_id'  => $receiving_good_id,
                'pallet_id' => $request->input('pallet'),
                'type' => $request->input('type'),
                'qty' => $request->input('pallet_qty'),
                'unit_price'    => $request->input('pallet_unit_price'),
                'amount'   => $amount,
            ]
        );

        return response()->json(['success' => 'Pallet Added Successfully.']);
    }

    public function destroy_rpallet(Request $request, ReceivingPallet $pallet)
    {
        $rg_id = $request->get('rg_id');
        if($rg_id == ""){
            $pallet->delete();
        }else{
            if($pallet->type == 'BUY'){
                Pallet::where('id', $pallet->pallet_id)->decrement('stock', $pallet->qty);
            }
            if($pallet->type == 'RETURN'){
                Pallet::where('id', $pallet->pallet_id)->increment('stock', $pallet->qty);
            }
            $pallet->delete();
        }
        
        return response()->json(['success' => 'Pallet Removed Successfully.']);
    }

    public function pallet(Pallet $pallet)
    {
        if (request()->ajax()) {
            return response()->json(['data' => $pallet]);
        }
    }
    public function stock_history(Pallet $pallet)
    {
        $pallets = ReceivingPallet::where('pallet_id', $pallet->id)->latest()->get();
        return view('admin.salesinventories.pallets.stocks', compact('pallets'));
    }
    
    
    
    
}
