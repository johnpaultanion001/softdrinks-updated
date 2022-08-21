<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UCS;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Carbon\Carbon;

class UCSController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('ucs_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.UCS.ucs');
    }
    public function load()
    {
        $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)->where('isHide', false)->latest()->get();
        $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)
                                ->where('isHide', false)->where('status_size', 'SOFTDRINKS')->sum('ucs');
        $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)
                                ->where('isHide', false)->where('status_size', 'WATER/JUICES')->sum('ucs');
        $title_filter  = 'UCS RECORDS';
        
        return view('admin.UCS.load', compact('ucs_records','ucs_softdrinks','ucs_wj','title_filter'));
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
        $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)
                            ->latest()->get();
        $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)
                ->where('status_size', 'SOFTDRINKS')->sum('ucs');
        $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)
                ->where('status_size', 'WATER/JUICES')->sum('ucs');
        
        $title_filter  = 'ALL UCS RECORDS';
        return view('admin.UCS.load', compact('ucs_records','ucs_softdrinks','ucs_wj','title_filter'));
    }

    public function filter(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter = $request->get('filter');
        $status = $request->get('status');
        if($status == 'all'){
            $is_hide = [false];
        }else{
            $is_hide = [true, false];
        }

        if($filter == 'daily'){
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->latest()
                                ->whereDate('created_at', Carbon::today())
                                ->get();
            $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'SOFTDRINKS')
                                ->whereDate('created_at', Carbon::today())
                                ->sum('ucs');
            $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'WATER/JUICES')
                                ->whereDate('created_at', Carbon::today())
                                ->sum('ucs');
        }
        if($filter == 'weekly'){
            $title_filter  = 'From: ' . Carbon::now()->startOfWeek()->format('F d, Y') . ' To: ' . Carbon::now()->endOfWeek()->format('F d, Y');
            $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->latest()
                                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()
                                ->get();
            $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'SOFTDRINKS')
                                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()
                                ->sum('ucs');
            $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'WATER/JUICES')
                                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()
                                ->sum('ucs');
        }
        if($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->latest()->whereMonth('created_at', '=', date('m'))
                                ->whereYear('created_at', '=', date('Y'))
                                ->get();
            $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'SOFTDRINKS')->whereMonth('created_at', '=', date('m'))
                                ->whereYear('created_at', '=', date('Y'))
                                ->sum('ucs');
            $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'WATER/JUICES')->whereMonth('created_at', '=', date('m'))
                                ->whereYear('created_at', '=', date('Y'))
                                ->sum('ucs');
        }
        if($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->latest()->whereYear('created_at', '=', date('Y'))->get();
            $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'SOFTDRINKS')->whereYear('created_at', '=', date('Y'))->sum('ucs');
            $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                                ->where('status_size', 'WATER/JUICES')->whereYear('created_at', '=', date('Y'))->sum('ucs');
            
        }
        if($filter == 'all'){
            $title_filter  = 'ALL UCS RECORDS';
            $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                            ->latest()->get();
            $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                            ->where('status_size', 'SOFTDRINKS')->sum('ucs');
            $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                            ->where('status_size', 'WATER/JUICES')->sum('ucs');
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');
            $title_filter =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));

            $ucs_records = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                        ->latest()->whereBetween('created_at', [$from, $to])->get();
            $ucs_softdrinks = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                        ->where('status_size', 'SOFTDRINKS')->whereBetween('created_at', [$from, $to])->sum('ucs');
            $ucs_wj = UCS::where('isRemove', false)->where('isComplete', true)->whereIn('isHide', $is_hide)
                        ->where('status_size', 'WATER/JUICES')->whereBetween('created_at', [$from, $to])->sum('ucs');
        }
        return view('admin.UCS.load', compact('ucs_records','ucs_softdrinks','ucs_wj','title_filter'));
    }

  
}
