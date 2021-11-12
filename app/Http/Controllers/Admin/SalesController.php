<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\OrderSales;
use App\Models\OrderNumber;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index()
    {
        return view('admin.sales.sales');
    }
    public function loadsales()
    {
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        $title_filter  = 'All Sales';
        if($userid == '2'){
            $sales = Sales::where('user_id', $userid)->latest()->get();
            return view('admin.sales.loadsales', compact('sales', 'title_filter'));
        }
        $sales = Sales::latest()->get();
        return view('admin.sales.loadsales', compact('sales', 'title_filter'));
    }
    public function daily(){
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');

        if($userid == '2'){
            $sales = Sales::where('user_id', $userid)->latest()->whereDay('created_at', '=', date('d'))
            ->get();
            return view('admin.sales.loadsales', compact('sales' , 'title_filter'));
        }
        $sales = Sales::latest()->whereDay('created_at', '=', date('d'))->get();
        return view('admin.sales.loadsales', compact('sales' , 'title_filter'));
    }
    public function monthly(){
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');

        if($userid == '2'){
            $sales = Sales::where('user_id', $userid)->latest()->whereMonth('created_at', '=', date('m'))
                        ->get();
            return view('admin.sales.loadsales', compact('sales', 'title_filter'));
        }
        $sales = Sales::latest()->whereMonth('created_at', '=', date('m'))
                        ->get();
        return view('admin.sales.loadsales', compact('sales', 'title_filter'));
    }
    public function yearly(){
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
        if($userid == '2'){ 
            $sales = Sales::where('user_id', $userid)->latest()->whereYear('created_at', '=', date('Y'))
            ->get();
            return view('admin.sales.loadsales', compact('sales', 'title_filter'));
        }
        $sales = Sales::latest()->whereYear('created_at', '=', date('Y'))
                        ->get();
        return view('admin.sales.loadsales', compact('sales', 'title_filter'));
    }
 
    function fetch_data(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();

        $from = $request->from_date;
        $to = $request->to_date;
       
        $title_filter =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));
        if($userid == '2'){
            if($request->ajax())
            {
                if($request->from_date != '' && $request->to_date != '')
                {
                    $sales = Sales::where('user_id', $userid)->latest()->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
                return view('admin.sales.loadsales', compact('sales', 'title_filter'));
            }
        }

        if($request->ajax())
            {
                if($request->from_date != '' && $request->to_date != '')
                {
                    $sales = Sales::latest()->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
                return view('admin.sales.loadsales', compact('sales', 'title_filter'));
            }
    }
    public function receipt(Sales $sale)
    {
       date_default_timezone_set('Asia/Manila');
       $receipts = Sales::where('order_number',$sale->order_number)->latest()->get();
       $ordernumber = OrderSales::where('order_number_id',$sale->order_number)->first();
       return view('admin.sales.receiptmodal', compact('receipts', 'ordernumber'));
    }
}
