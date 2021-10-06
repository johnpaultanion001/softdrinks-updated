<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use App\Models\Sales;
use App\Models\Order;
use App\Models\OrderSales;
use App\Models\SalesReturn;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\OrderNumber;
use App\Models\PriceType;

use Validator;
use DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SalesInvoiceController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('salesinvoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        date_default_timezone_set('Asia/Manila');

        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $customers = Customer::where('isRemove', '0')->latest()->get();
        $orders = Order::where('status', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        $product_codes = Inventory::where('isSame' , 0)->where('isRemove' , 0)->latest()->get();

        $returned = SalesReturn::where('isRemove', 0)->where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        $date = date("F d,Y h:i A");


        return view('admin.salesinvoice.salesinvoice', compact('customers' , 'orders' , 'pricetypes' , 'salesinvoice_id' , 'returned' , 'product_codes' ,'date'));
    }

    public function alltotal(){
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;


        $orders = Order::where('status', '0')->latest()->get();
        $returned = SalesReturn::where('isRemove', 0)->where('salesinvoice_id', $salesinvoice_id)->latest()->get();

        $total_order_amount = Order::sum('total');
        $total_return_amount = SalesReturn::where('isRemove', 0)->where('salesinvoice_id', $salesinvoice_id)->sum('amount');
        $total_amount = $total_order_amount - $total_return_amount;

        return view('admin.salesinvoice.alltotal', compact('orders', 'returned','total_amount'));
    }

    public function sales()
    {
        date_default_timezone_set('Asia/Manila');
        $orders = Order::where('status', '0')->latest()->get();
        return view('admin.salesinvoice.sales', compact('orders'));
    }

    public function return()
    {
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $returned = SalesReturn::where('isRemove', 0)->where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.return', compact('returned'));
    }

    public function allreturn()
    {
        $returned = SalesReturn::where('isRemove', 0)->latest()->get();
        return view('admin.salesinvoice.allrecordsreturn', compact('returned'));
    }

    public function productlist(){
        date_default_timezone_set('Asia/Manila');
        $inventories = Inventory::where('isRemove', 0)->where('isSame' , 0)->where('stock' , '>' , 0)->where('location_id', 2)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->orderBy('expiration', 'ASC')->get();
        return view('admin.salesinvoice.productlist', compact('inventories'));
    }

    public function receipt()
    {
        date_default_timezone_set('Asia/Manila');
        $receipts = Order::where('status', '0')->latest()->get();

        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;
        $totalsalesreturn = SalesReturn::where('isRemove', 0)->where('salesinvoice_id',$salesinvoice_id)->sum('amount');
        $total = $receipts->sum('total') - $totalsalesreturn;

        return view('admin.salesinvoice.receiptmodal', compact('receipts', 'salesinvoice_id', 'totalsalesreturn','total'));
    }
   
   
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'doc_no' => ['required', 'string', 'max:255'],
            'entry_date' => ['required' ,'date','after:yesterday'],
            'remarks' => ['nullable'],
            'customer_id' => ['required'],
            'cash' => ['required' ,'numeric','min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $orders = Order::all()->count();
        if($orders < 1){
            return response()->json(['nodata' => 'NO DATA AVAILABLE IN SALES TABLE']);
        }

        $totalsales = Order::sum('total');
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;
        $totalsalesreturn = SalesReturn::where('isRemove', 0)->where('salesinvoice_id',$salesinvoice_id)->sum('amount');
    
        $payment = $totalsales - $totalsalesreturn;


        if($request->input('cash') < $payment)
        {
            return response()->json(['invalidcash' => 'CASH FIELD MUST BE GREATER THAN TO THE TOTAL AMOUNT / PAYMENT FIELD <br> ( ₱ '.number_format($payment , 2, '.', ',').')']);
        }

        return response()->json(['print'  => 'PRINT']);
    }

    public function storeandcheckout(Request $request){
        date_default_timezone_set('Asia/Manila');
        Order::latest()->update([
            'customer_id' => $request->get('customer_id'),
        ]);


        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id ;

        $total_inv_amt = Order::sum('total');
        $totalsalesreturn = SalesReturn::where('isRemove', 0)->where('salesinvoice_id',$salesinvoice_id)->sum('amount');


        $total_amount = $total_inv_amt - $totalsalesreturn ;

        $subtotal = Order::sum('total_amount_receipt');
        $total_discounted = Order::sum('discounted');
        $total_return = SalesReturn::where('isRemove', 0)->sum('amount');
        $userid = auth()->user()->id;

        $change = $request->get('cash') - $total_amount;

        SalesInvoice::create([
            'salesinvoice_id' =>  $salesinvoice_id,
            'doc_no' =>  $request->get('doc_no'),
            'entry_date' =>  $request->get('entry_date'),
            'remarks' =>  $request->get('remarks'),
            'customer_id' => $request->get('customer_id'),

            'subtotal' =>  $subtotal,
            'total_discount' =>   $total_discounted,
            'total_amount' => $total_amount,

            'total_return' => $totalsalesreturn,
            'prev_bal' => $request->get('prev_bal'),
            'total_inv_amt' => $total_inv_amt,
            'cash' => $request->get('cash'),
            'change' => $change,
            'new_bal' => $total_amount,
            'user_id' => $userid,
        ]);

        $order_number_id = $ordernumber->order_number;
        $total_profit = Order::sum('profit');
        $total_cost = Order::sum('total_cost');
        $total_qty = Order::sum('purchase_qty');

        OrderSales::create([
            'order_number_id' => $order_number_id,
            'total_profit' => $total_profit,
            'total_sales' => $total_amount,
            'total_cost' => $total_cost,
            'customer_id' => $request->get('customer_id'),
            'total_qty' => $total_qty,
            'subtotal' => $subtotal,
            'total' => $total_amount,
        ]);

        $ids = Order::pluck('inventory_id');
        Inventory::whereIn('id' , $ids)->update([
            'stock' => DB::raw ('stock - orders'),
            'sold' => DB::raw ('sold + orders'),
            'orders' => 0,
        ]);

        $passdata = Order::query()
        ->each(function ($oldRecord) {
                $newPost = $oldRecord->replicate();
                $newPost->setTable('sales');
                $newPost->save();
        });

       
        if($passdata){
            Order::truncate();
            OrderNumber::where('id', 1)->increment('order_number', 1);
            OrderNumber::where('id', 1)->increment('salesinvoice_id', 1);

            return response()->json(['success' => 'Successfully Check Out.']);
        }

       


    }

    public function change(Request $request)
    {
        if($request->ajax()){
            $totalsales = Order::sum('total');

            
            $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
            $salesinvoice_id = $ordernumber->salesinvoice_id;

            $totalsalesreturn = SalesReturn::where('isRemove', 0)->where('salesinvoice_id',$salesinvoice_id)->sum('amount');


            $payment = $totalsales - $totalsalesreturn;

            $change = $request->changee - $payment;
    
            
            
            return response()->json(['success' =>  number_format($change , 2, '.', ',')]);
            
        }
    }
    public function allrecords(){
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        if($userid == '2'){
            $allrecords = SalesInvoice::where('isVoid' , 0)->where('user_id', $userid)->latest()->get();
            return view('admin.salesinvoice.allrecords', compact('allrecords'));
        }
        $allrecords = SalesInvoice::where('isVoid' , 0)->latest()->get();
        return view('admin.salesinvoice.allrecords', compact('allrecords'));
    }

    public function sales_receipt($sales_reciept){
        date_default_timezone_set('Asia/Manila');
        $receipts = Sales::where('isRemove', 0)->where('salesinvoice_id', $sales_reciept)->latest()->get();
        $ordernumber = SalesInvoice::where('salesinvoice_id', $sales_reciept)->first();
        return view('admin.salesinvoice.receiptmodalsales', compact('receipts', 'ordernumber'));
    }

    
    public function show(SalesInvoice $salesInvoice)
    {
        $sales = Sales::where('isRemove' , 0)->where('salesinvoice_id', $salesInvoice->salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.viewsales', compact('sales'));
    }

    
    public function edit(SalesInvoice $salesInvoice)
    {
        
    }

    
    public function update(Request $request, SalesInvoice $salesInvoice)
    {
        
    }

    public function destroy(SalesInvoice $salesInvoice)
    {
    
    }

    public function void(SalesInvoice $salesInvoice)
    {
        SalesInvoice::find($salesInvoice->id)->update([
            'isVoid' => '1',
        ]);
        Sales::where('salesinvoice_id' ,$salesInvoice->salesinvoice_id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Transaction Successfully Void.']);
    }
}
