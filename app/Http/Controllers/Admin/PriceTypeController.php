<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceType;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PriceTypeController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('price_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.pricetype.pricetype');
    }

    public function load()
    {
        $pricetypes = PriceType::where('isRemove', 0)->orderBy('id','asc')->get();
        return view('admin.pricetype.load', compact('pricetypes'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'price_type' => ['required', 'string', 'max:255'],
            'discount' => ['required' ,'integer','min:0'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        PriceType::create([
            'price_type' => $request->input('price_type'),
            'discount' => $request->input('discount'),
            
        ]);

        return response()->json(['success' => 'Price Type Added Successfully.']);
    }

  
    public function show(PriceType $priceType)
    {
        //
    }

  
    public function edit(PriceType $priceType)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $priceType]);
        }
    }


    public function update(Request $request, PriceType $priceType)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'price_type' => ['required', 'string', 'max:255'],
            'discount' => ['required' ,'integer','min:0'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        PriceType::find($priceType->id)->update([
            'price_type' => $request->input('price_type'),
            'discount' => $request->input('discount'),
            
        ]);
        return response()->json(['success' => 'Price Type Updated Successfully.']);
    }

  
    public function destroy(PriceType $priceType)
    {
        PriceType::find($priceType->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Price Type Removed Successfully.']);
    }
}
