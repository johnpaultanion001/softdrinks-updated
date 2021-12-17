<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesReturn;
use App\Models\SalesInvoice;
use App\Models\SalesInventory;
use Carbon\Carbon;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.transactions.transactions');
    }
    public function load()
    {
        $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
        $sales         = Sales::latest()->whereDay('created_at', '=', date('d'))->get();
        $returns       = SalesReturn::latest()->whereDay('created_at', '=', date('d'))->get();
        $products      = SalesInventory::latest()->get();
        $salesinvoices = SalesInvoice::latest()->get();
        return view('admin.transactions.loadtransactions', compact('sales','returns', 'products','salesinvoices', 'title_filter'));
    }
    public function filter(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter        = $request->get('filter');
        $products      = SalesInventory::latest()->get();
        $salesinvoices = SalesInvoice::latest()->get();

        if($filter == 'daily'){
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $sales         = Sales::latest()->whereDay('created_at', '=', date('d'))->get();
            $returns       = SalesReturn::latest()->whereDay('created_at', '=', date('d'))->get();
        }
        if($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $sales         = Sales::latest()->whereMonth('created_at', '=', date('m'))->get();
            $returns       = SalesReturn::latest()->whereMonth('created_at', '=', date('m'))->get();
        }
        if($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $sales         = Sales::latest()->whereYear('created_at', '=', date('Y'))->get();
            $returns       = SalesReturn::latest()->whereYear('created_at', '=', date('Y'))->get();
        }
        if($filter == 'all'){
            $title_filter  = 'ALL TRANSACTIONS RECORDS';
            $sales = Sales::latest()->get();
            $returns = SalesReturn::latest()->get();
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');

            $title_filter  =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));
            $sales         = Sales::latest()->whereBetween('created_at', [$from, $to])->get();
            $returns       = SalesReturn::latest()->whereBetween('created_at', [$from, $to])->get();
        }
        if($filter == 'dd_products'){
            $title_filter  = 'PRODUCT';
            $product_id = $request->get('value');
            $sales = Sales::latest()->where('product_id', $product_id)->get();
            $returns = SalesReturn::latest()->where('product_id', $product_id)->get();
        }
        if($filter == 'dd_orders#'){
            $order_id = $request->get('value');
            $title_filter  = 'ORDER #: '.$order_id;
            
            $sales = Sales::latest()->where('salesinvoice_id', $order_id)->get();
            $returns = SalesReturn::latest()->where('salesinvoice_id', $order_id)->get();
        }
         return view('admin.transactions.loadtransactions', compact('sales','returns', 'products','salesinvoices', 'title_filter'));
    }
}
