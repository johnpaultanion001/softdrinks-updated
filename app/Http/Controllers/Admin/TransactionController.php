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
use App\Models\ReceivingProduct;
use App\Models\Deposit;
use App\Models\EmptyBottlesInventory;
use App\Models\Pallet;
use App\Models\Customer;
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
        $deposits      = Deposit::latest()->whereDate('created_at', Carbon::today())->where('isComplete', true)->get();
        $plus_over_payments =  SalesInvoice::whereDate('created_at', Carbon::today())   
                              ->where('isOverPayment', true)
                              ->where('isVoid', false)
                              ->sum('over_payment');

        $minus_over_payments = SalesInvoice::whereDate('created_at', Carbon::today())   
                              ->where('isOverPayment', false)
                              ->where('isVoid', false)
                              ->sum('over_payment');

        $title_filter_daily  = date('F d, Y');

        $sales_invioce_bal =  
                SalesInvoice::whereDate('created_at', Carbon::today())
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('new_bal') - 
                SalesInvoice::whereDate('created_at', Carbon::today())
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('prev_bal');

        return view('admin.transactions.loadtransactions', compact('plus_over_payments','minus_over_payments','sales_invioce_bal','sales','returns', 'products','salesinvoices', 'title_filter', 'delivers','title_filter_daily','deposits'));
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
            $deposits      = Deposit::latest()->whereDate('created_at', Carbon::today())->get();
            $plus_over_payments =  SalesInvoice::whereDate('created_at', Carbon::today())   
                              ->where('isOverPayment', true)
                              ->where('isVoid', false)
                              ->sum('over_payment');

            $minus_over_payments = SalesInvoice::whereDate('created_at', Carbon::today())   
                                ->where('isOverPayment', false)
                                ->where('isVoid', false)
                                ->sum('over_payment');

            $sales_invioce_bal =  
                SalesInvoice::whereDate('created_at', Carbon::today())
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('new_bal') - 
                SalesInvoice::whereDate('created_at', Carbon::today())
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('prev_bal');
        }
        if($filter == 'weekly'){
            $title_filter  = 'From: ' . Carbon::now()->startOfWeek()->format('F d, Y') . ' To: ' . Carbon::now()->endOfWeek()->format('F d, Y');
            $sales         = Sales::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $returns       = SalesReturn::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('isComplete', true)->get();
            $deposits      = Deposit::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            $plus_over_payments =  SalesInvoice::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])   
                              ->where('isOverPayment', true)
                              ->where('isVoid', false)
                              ->sum('over_payment');

            $minus_over_payments = SalesInvoice::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])   
                                ->where('isOverPayment', false)
                                ->where('isVoid', false)
                                ->sum('over_payment');

            $sales_invioce_bal =  
                            SalesInvoice::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('new_bal') - 
                            SalesInvoice::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('prev_bal');
        }
        if($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $sales         = Sales::latest()->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
            $returns       = SalesReturn::latest()->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('isComplete', true)->get();
            $deposits      = Deposit::latest()->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
            
            $plus_over_payments =  SalesInvoice::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))   
                        ->where('isOverPayment', true)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $minus_over_payments = SalesInvoice::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))
                        ->where('isOverPayment', false)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $sales_invioce_bal =  
                            SalesInvoice::whereMonth('created_at', '=', date('m'))
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('new_bal') - 
                            SalesInvoice::whereMonth('created_at', '=', date('m'))
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('prev_bal');
        }
        if($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $sales         = Sales::latest()->whereYear('created_at', '=', date('Y'))->get();
            $returns       = SalesReturn::latest()->whereYear('created_at', '=', date('Y'))->where('isComplete', true)->get();
            $deposits      = Deposit::latest()->whereYear('created_at', '=', date('Y'))->get();
            $plus_over_payments =  SalesInvoice::whereYear('created_at', '=', date('Y'))   
                        ->where('isOverPayment', true)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $minus_over_payments = SalesInvoice::whereYear('created_at', '=', date('Y'))
                        ->where('isOverPayment', false)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $sales_invioce_bal =  
                            SalesInvoice::whereYear('created_at', '=', date('Y'))
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('new_bal') - 
                            SalesInvoice::whereYear('created_at', '=', date('Y'))
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('prev_bal');
        }
        if($filter == 'all'){
            $title_filter  = 'ALL TRANSACTIONS RECORDS';
            $sales = Sales::latest()->get();
            $returns = SalesReturn::latest()->where('isComplete', true)->get();
            $deposits      = Deposit::latest()->get();
            $plus_over_payments =  SalesInvoice::where('isOverPayment', true)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $minus_over_payments = SalesInvoice::where('isOverPayment', false)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $sales_invioce_bal =  
                            SalesInvoice::where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('new_bal') - 
                            SalesInvoice::where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('prev_bal');
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');

            $title_filter  =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));
            $sales         = Sales::latest()->whereBetween('created_at', [$from, $to])->get();
            $returns       = SalesReturn::latest()->whereBetween('created_at', [$from, $to])->where('isComplete', true)->get();
            $deposits      = Deposit::latest()->whereBetween('created_at', [$from, $to])->get();
            
            $plus_over_payments =  SalesInvoice::whereBetween('created_at', [$from, $to])
                        ->where('isOverPayment', true)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $minus_over_payments = SalesInvoice::whereBetween('created_at', [$from, $to])
                        ->where('isOverPayment', false)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $sales_invioce_bal =  
                            SalesInvoice::whereBetween('created_at', [$from, $to])
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('new_bal') - 
                            SalesInvoice::whereBetween('created_at', [$from, $to])
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('prev_bal');
        }
        if($filter == 'dd_products'){
            $title_filter  = 'PRODUCT';
            $product_id = $request->get('value');
            $sales = Sales::latest()->where('product_id', $product_id)->get();
            $returns = SalesReturn::latest()->where('product_id', $product_id)->where('isComplete', true)->get();
            $deposits      = Deposit::latest()->where('product_id', $product_id)->get();
            $plus_over_payments =  SalesInvoice::where('isOverPayment', true)
                        ->where('isVoid', false)
                        ->sum('over_payment');

            $minus_over_payments = SalesInvoice::where('isOverPayment', false)
                        ->where('isVoid', false)
                        ->sum('over_payment');


            $sales_invioce_bal =  
                            SalesInvoice::where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('new_bal') - 
                            SalesInvoice::where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('prev_bal');
        }
        if($filter == 'dd_orders#'){
            $order_id = $request->get('value');
            $title_filter  = 'ORDER #: '.$order_id;
            
            $sales = Sales::latest()->where('salesinvoice_id', $order_id)->get();
            $returns = SalesReturn::latest()->where('salesinvoice_id', $order_id)->where('isComplete', true)->get();
            $deposits      = Deposit::latest()->where('salesinvoice_id', $order_id)->get();
            
            $plus_over_payments =  SalesInvoice::where('salesinvoice_id', $order_id)
                                    ->where('isOverPayment', true)
                                    ->where('isVoid', false)
                                    ->sum('over_payment');

            $minus_over_payments = SalesInvoice::where('salesinvoice_id', $order_id)
                                    ->where('isOverPayment', false)
                                    ->where('isVoid', false)
                                    ->sum('over_payment');

            $sales_invioce_bal =  
                            SalesInvoice::where('salesinvoice_id', $order_id)
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('new_bal') - 
                            SalesInvoice::where('salesinvoice_id', $order_id)
                                        ->where('isVoid', false)
                                        ->where('isReceivable', true)
                                        ->sum('prev_bal');
        }
        $title_filter_daily  = date('F d, Y');

        return view('admin.transactions.loadtransactions', compact('plus_over_payments','minus_over_payments','sales_invioce_bal','sales','returns', 'products','salesinvoices', 'title_filter', 'delivers','title_filter_daily','deposits'));
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

        $products    = SalesInventory::where('isComplete', true)->get();

        foreach($products as $product){
          
            //PREVIOS DATE
            $sales_inventory_prev = Sales::where('product_id', $product->id)
                ->whereBetween('created_at', ['2022-01-01', Carbon::today()])->sum('purchase_qty');
            $delivery_inventory_prev = ReceivingProduct::where('product_id', $product->id)
                ->whereBetween('created_at', ['2022-01-01', Carbon::today()])->sum('qty');

            //CURRENT DATE
            $beginning_inventory = $delivery_inventory_prev - $sales_inventory_prev;


            $sales_inventory = Sales::where('product_id', $product->id)->whereDate('created_at', Carbon::today())->sum('purchase_qty');
            $delivery_inventory = ReceivingProduct::where('product_id', $product->id)->whereDate('created_at', Carbon::today())->sum('qty');
            
            $ending_inventory = $beginning_inventory + $delivery_inventory - $sales_inventory;
            
            $sales[] = array(
                'product'              => $product->product_code,
                'description'          => $product->description,
                'category'             => $product->category->name,
                'beginning_inventory'  => $beginning_inventory,
                'sales_inventory'      => $sales_inventory,
                'delivery_inventory'   => $delivery_inventory,
                'ending_inventory'     => $ending_inventory,    
            );

        

        }

        return response()->json(['data' => $sales ]);
    }

    public function ending_inventory_report(Request $request){
        $products_list    = SalesInventory::where('isComplete', true)->get();
        $pallets1          = Pallet::latest()->get();

        foreach($products_list as $product){
            $empty_record = EmptyBottlesInventory::where('product_id', $product->id)->first();
            if($empty_record == null){
                $empties = '0';
                $shells = '0';
                $bottles = '0';
            }else{
                $empties = $empty_record->empties_qty();
                $shells = $empty_record->shells_qty();
                $bottles = $empty_record->bottles_qty();
            }
            $products[] = array(
                'product_id'           => $product->id,
                'product'              => $product->product_code .'/'.$product->description,
                'category'             => $product->category->name,
                'full_goods'           => $product->location_products->sum('stock'),
                'full_emptys'          => $empties,
                'shell'                => $shells,
                'bottles'              => $bottles,
                'big_palettes'         => $product->big_palettes ?? '0',
                'small_palettes'       => $product->small_palettes ?? '0',
            );
        }

        foreach($pallets1 as $pallet){
            $pallets[] = array(
                'title' => $pallet->title,
                'stock'   => $pallet->stock,
            );
        }
        

        return response()->json(['data' => $products , 'pallets' => $pallets]);
      
    }

    public function ending_inventory_update(Request $request, SalesInventory $product){
        $product->update([
            'shell'     => $request->get('shell'),
            'bottles'     => $request->get('bottles'),
            'big_palettes'     => $request->get('big_palettes'),
            'small_palettes'     => $request->get('small_palettes'),
        ]);
        return response()->json(['success' => 'success']);
    }
    
    
}
