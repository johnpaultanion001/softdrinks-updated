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
        $locations = Location::where('isRemove', 0)->latest()->get();
        $locationtransfer = LocationTransfer::where('isRemove', 0)->latest()->get();
      
        return view('admin.locationtransfer.locationtransfer',compact('locations' , 'locationtransfer'));
    }

    
    // public function locationfrom(Request $request, $location)
    // {
    //     $location_from = SalesInventory::where('isRemove', 0)->where('isComplete', true)->where('location_id', $location)->where('stock' , '>' , 0)->latest()->get();
    //     $location = Location::where('isRemove', 0)->where('id', $location)->firstorfail();
    //     $location_title = $location->location_name;
    //     return view('admin.locationtransfer.loadlocationfrom', compact('location_from' , 'location_title'));
    // }
    // public function locationto(Request $request, $location)
    // {
    //     $location_to = SalesInventory::where('isRemove', 0)->where('isComplete', true)->where('location_id', $location)->where('stock' , '>' , 0)->latest()->get();
    //     $location = Location::where('isRemove', 0)->where('id', $location)->firstorfail();
    //     $location_title = $location->location_name;
    //     return view('admin.locationtransfer.loadlocationto', compact('location_to', 'location_title'));
    // }



    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'entry_date' => ['required' ,'date','after:yesterday'],
            'reference' => ['nullable'],
            'reference_date' => ['nullable','date' ,'after:yesterday'],
            'location_from' => ['required'],
            'location_to' => ['required'],
            'prepared_by' => ['nullable'],
            'remarks' => ['nullable'],
           
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $transferCount = SalesInventory::where('location_id', $request->input('location_from'))->where('isRemove', 0)->where('isComplete', true)->where('stock' , '>' , 0)->latest()->count();
        
        if($transferCount < 1){
            return response()->json(['nodata' => 'No Available Data']);
        }

        LocationTransfer::create([
            'entry_date' => $request->input('entry_date'),
            'reference' => $request->input('reference'),
            'reference_date' => $request->input('reference_date'),
            'location_from' => $request->input('location_from'),
            'location_to' => $request->input('location_to'),
            'prepared_by' => $request->input('prepared_by'),
            'remarks' => $request->input('remarks'),
            'transfer_count' => $transferCount,
        ]);

        SalesInventory::where('location_id', $request->input('location_from'))->where('isRemove', 0)->where('isComplete', true)->where('stock' , '>' , 0)
            ->update([
                'location_id' => $request->input('location_to'),
                ]);
        

        return response()->json(['success' => 'Location Transfer Successfully.']);
    }

    
    public function show(LocationTransfer $locationTransfer)
    {
        
    }

    
    public function edit(LocationTransfer $locationTransfer)
    {
        
    }

    
    public function update(Request $request, LocationTransfer $locationTransfer)
    {
        
    }

   
    public function destroy(LocationTransfer $locationTransfer)
    {
        // LocationTransfer::find($locationTransfer->id)->update([
        //     'isRemove' => '1',
        // ]);
        // return response()->json(['success' => 'Removed Successfully.']);
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

}
