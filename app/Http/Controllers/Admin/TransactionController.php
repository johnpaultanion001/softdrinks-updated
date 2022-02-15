<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesReturn;
use App\Models\SalesInvoice;
use App\Models\SalesInventory;
use App\Models\AssignDeliver;
use App\Models\LocationProduct;
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
        date_default_timezone_set('Asia/Manila');
        $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
        $sales         = Sales::latest()->whereDate('created_at', Carbon::today())->get();
        $returns       = SalesReturn::latest()->whereDate('created_at', Carbon::today())->where('isComplete', true)->get();
        $products      = SalesInventory::orderBy('id', 'asc')->where('isComplete',true)->get();
        $salesinvoices = SalesInvoice::latest()->get();
        $delivers      = AssignDeliver::orderBy('id', 'asc')->get();
        return view('admin.transactions.loadtransactions', compact('sales','returns', 'products','salesinvoices', 'title_filter', 'delivers'));
    }
    public function filter(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter        = $request->get('filter');
        $products      = SalesInventory::orderBy('id', 'asc')->where('isComplete',true)->get();
        $salesinvoices = SalesInvoice::latest()->get();
        $delivers      = AssignDeliver::orderBy('id', 'asc')->get();

        if($filter == 'daily'){
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $sales         = Sales::latest()->whereDate('created_at', Carbon::today())->get();
            $returns       = SalesReturn::latest()->whereDate('created_at', Carbon::today())->where('isComplete', true)->get();
        }
        if($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $sales         = Sales::latest()->whereMonth('created_at', '=', date('m'))->get();
            $returns       = SalesReturn::latest()->whereMonth('created_at', '=', date('m'))->where('isComplete', true)->get();
        }
        if($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $sales         = Sales::latest()->whereYear('created_at', '=', date('Y'))->get();
            $returns       = SalesReturn::latest()->whereYear('created_at', '=', date('Y'))->where('isComplete', true)->get();
        }
        if($filter == 'all'){
            $title_filter  = 'ALL TRANSACTIONS RECORDS';
            $sales = Sales::latest()->get();
            $returns = SalesReturn::latest()->where('isComplete', true)->get();
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');

            $title_filter  =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));
            $sales         = Sales::latest()->whereBetween('created_at', [$from, $to])->get();
            $returns       = SalesReturn::latest()->whereBetween('created_at', [$from, $to])->where('isComplete', true)->get();
        }
        if($filter == 'dd_products'){
            $title_filter  = 'PRODUCT';
            $product_id = $request->get('value');
            $sales = Sales::latest()->where('product_id', $product_id)->get();
            $returns = SalesReturn::latest()->where('product_id', $product_id)->where('isComplete', true)->get();
        }
        if($filter == 'dd_orders#'){
            $order_id = $request->get('value');
            $title_filter  = 'ORDER #: '.$order_id;
            
            $sales = Sales::latest()->where('salesinvoice_id', $order_id)->get();
            $returns = SalesReturn::latest()->where('salesinvoice_id', $order_id)->where('isComplete', true)->get();
        }
        

        return view('admin.transactions.loadtransactions', compact('sales','returns', 'products','salesinvoices', 'title_filter', 'delivers'));
    }

    public function destroy_sales(Sales $sales){
        LocationProduct::where('product_id', $sales->product_id)
                            ->where('location_id', 1)
                            ->increment('stock', $sales->purchase_qty);
                            
        SalesInventory::where('id', $sales->product_id)->decrement('sold', $sales->purchase_qty);
        
        $sales->delete();
        return response()->json(['success' => 'Sales Removed Successfully.']);
    }

    public function inventory_report(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter        = $request->get('filter');
        $products    = SalesInventory::where('isComplete', true)->get();

        if($filter == 'daily'){
            $sales_product_ids = Sales::whereDate('created_at', Carbon::today())->select(['product_id'])->get()->toArray();
        }
        if($filter == 'monthly'){
            $sales_product_ids = Sales::whereMonth('created_at', '=', date('m'))->select(['product_id'])->get()->toArray();
        }
        if($filter == 'yearly'){
            $sales_product_ids = Sales::whereYear('created_at', '=', date('Y'))->select(['product_id'])->get()->toArray();
        }
        if($filter == 'all'){
            $sales_product_ids = Sales::select(['product_id'])->get()->toArray();
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');
            $sales_product_ids = Sales::whereBetween('created_at', [$from, $to])->select(['product_id'])->get()->toArray();
        }
        if($filter == null){
            $sales_product_ids = Sales::whereDate('created_at', Carbon::today())->select(['product_id'])->get()->toArray();
        }

        foreach($products as $product){
            if (in_array(array('product_id' => $product->id), $sales_product_ids)){
                $beginning_inventory = Sales::where('product_id', $product->id)->sum('purchase_qty');
                $sales[] = array(
                    'product'              => $product->product_code .'/'.$product->description,
                    'category'             => $product->category->name,
                    'beginning_inventory'  => $beginning_inventory ,
                    'ending_inventory'     => $product->location_products_stock(),    
                );

            }
        }

        return response()->json(['data' => $sales ]);
    }

    public function assign_deliver_report(Request $request){
        
      
    }
    
}