<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationTransfer;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\SalesInventory;
use App\Models\PendingTransfer;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use datetime;

class LocationTransferController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('location_transfer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $locations = Location::where('isRemove', 0)->orderBy('id', 'asc')->get();
    
        return view('admin.locationtransfer.locationtransfer',compact('locations'));
    }
    public function records(){
        abort_if(Gate::denies('location_transfer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $records = LocationTransfer::latest()->get();

        return view('admin.locationtransfer.records',compact('records'));
    }
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'entry_date' => ['required' ,'date','after:yesterday'],
            'reference' => ['nullable'],
            'reference_date' => ['nullable','date' ,'after:yesterday'],
            'remarks' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $transfer_count  = PendingTransfer::where('isComplete', false)->count();
        if($transfer_count < 1){
            return response()->json(['nodata' => 'NO TRANSFER DATA']);
        }
        
        $transfer_data = PendingTransfer::where('isComplete', false)->get();
        foreach($transfer_data as $transfer){

            $location_from = LocationProduct::where('product_id', $transfer->product_id)
                             ->where('location_id', $transfer->location_from)
                             ->first();
            if($location_from->stock < $transfer->qty){
                return response()->json(['nodata' => 'INSUFFICIENT STOCKS. <br> PRODUCT CODE/DESC: ' . $location_from->product->product_code .'/'. $location_from->product->description
                                                    .'<br>'. 'LOCATION/STOCK: ' .$location_from->location->location_name .'/'.$location_from->stock]);
            }

            //Location From Decrement
            LocationProduct::where('product_id', $transfer->product_id)
                             ->where('location_id', $transfer->location_from)
                             ->decrement('stock', $transfer->qty);
            //Location To Increment
            $location_to = LocationProduct::where('product_id', $transfer->product_id)
                             ->where('location_id', $transfer->location_to)
                             ->first();
            if($location_to == null){
                LocationProduct::create([
                    'product_id'    => $transfer->product_id,
                    'location_id'   => $transfer->location_to,
                    'stock'         => $transfer->qty,
                ]);
            }else{
                LocationProduct::where('product_id', $transfer->product_id)
                                ->where('location_id', $transfer->location_to)
                                ->increment('stock', $transfer->qty);
            }
            PendingTransfer::where('id', $transfer->id)->update([
                                'isComplete' => true,
                            ]);
        }
        LocationTransfer::create([
            'entry_date'        => $request->input('entry_date'),
            'reference'         => $request->input('reference'),
            'reference_date'    => $request->input('reference_date'),
            'prepared_by'       => auth()->user()->id,
            'remarks'           => $request->input('remarks'),
        ]);
        return response()->json(['success' => 'Location Transfer Successfully.']);
    }
    public function destroy(LocationTransfer $locationTransfer)
    {
      
    }
    public function products()
    {
        $products = SalesInventory::where('isComplete', true)->where('isRemove', false)->latest()->get();
        return view('admin.locationtransfer.product_location',compact('products'));
    }
    public function pending_transfer(){
        $transfers = PendingTransfer::where('isComplete', false)->latest()->get();
        return view('admin.locationtransfer.pending_transfer',compact('transfers'));
    }

    public function product(Request $request){
        $product_id = $request->get('product_id');
        $product_location = LocationProduct::where('product_id', $product_id)->get();
        return view('admin.locationtransfer.product_location_dd',compact('product_location'));
    }

    public function store_pending_transfer(Request $request){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'location_from' => ['required'],
            'location_to'   => ['required' , 'different:location_from'],
            'qty'           => ['required'],
        ]);
       

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $stock_location = LocationProduct::where('product_id', $request->input('product_id'))
                                        ->where('location_id', $request->input('location_from'))
                                        ->first();
        $total_stock = PendingTransfer::where('product_id', $request->input('product_id'))
                                            ->where('location_from', $request->input('location_from'))
                                            ->where('isComplete', false)
                                            ->sum('qty');
        $transfer_stock = $total_stock + $request->input('qty');

        if($request->input('qty') > $stock_location->stock)
        {
            return response()->json(['less_stock' => 'Insufficient Stocks. Available Stock: '.$stock_location->stock]);
        }
        if($transfer_stock > $stock_location->stock)
        {
            return response()->json(['less_stock' => 'Insufficient Stocks. Available Stock: '.$stock_location->stock]);
        }
        $lt_id = LocationTransfer::orderby('id', 'desc')->first();
        if($lt_id == null){
            $locationTransfer_id = 1;
        }else{
            $locationTransfer_id = $lt_id->id + 1;
        }
        PendingTransfer::create([
            'lt_id'          => $locationTransfer_id,
            'product_id'     => $request->input('product_id'),
            'location_from'  => $request->input('location_from'),
            'location_to'    => $request->input('location_to'),
            'qty'            => $request->input('qty'),
        ]);

        return response()->json(['success' => 'Added Successfully.']);
    }

    public function destroy_pending_transfer(PendingTransfer $pending_transfer)
    {
        $pending_transfer->delete();
        return response()->json(['success' => 'Removed Successfully.']);
    }

    public function edit_pending_transfer(PendingTransfer $pending_transfer)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $pending_transfer]);
        }
    }
    public function update_pending_transfer(Request $request , PendingTransfer $pending_transfer){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'location_from' => ['required'],
            'location_to'   => ['required' , 'different:location_from'],
            'qty'           => ['required'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $stock_location = LocationProduct::where('product_id', $request->input('product_id'))
                                        ->where('location_id', $request->input('location_from'))
                                        ->first();

        if($request->input('qty') > $stock_location->stock)
        {
            return response()->json(['less_stock' => 'Insufficient Stocks. Available Stock: '.$stock_location->stock]);
        }

        PendingTransfer::find($pending_transfer->id)->update([
            'location_from'  => $request->input('location_from'),
            'location_to'    => $request->input('location_to'),
            'qty'            => $request->input('qty'),
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }

}
