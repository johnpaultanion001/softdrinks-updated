<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UCS;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UCSController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('ucs_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.UCS.ucs');
    }
    public function load()
    {
        $totalucs = UCS::where('isRemove', false)->where('isComplete', true)->where('isHide', false)->latest()->get();
        $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)
                                ->where('isHide', false)->where('status_size', 'SOFTDRINKS')->sum('ucs');
        $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)
                                ->where('isHide', false)->where('status_size', 'WATER/JUICES')->sum('ucs');
        return view('admin.UCS.load', compact('totalucs','ucs_softdrinks','ucs_wj'));
    }

    public function backtozero()
    {
        $data = UCS::where('isHide', false)->count();
        if($data < 1){
            return response()->json(['nodata' => 'No Available Data.']);
        }

        UCS::where('isHide', false)->update([
            'isHide' => true,
        ]);
        return response()->json(['success' => 'Successfully Updated.']);
    }

    public function allucs()
    {
        $allucs = UCS::where('isRemove', false)->where('isComplete', 1)->latest()->get();
        $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)
                ->where('status_size', 'SOFTDRINKS')->sum('ucs');
        $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)
                ->where('status_size', 'WATER/JUICES')->sum('ucs');

        return view('admin.UCS.allucs', compact('allucs','ucs_softdrinks','ucs_wj'));
        
    }

  
}
