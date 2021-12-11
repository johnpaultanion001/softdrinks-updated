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
use App\Models\SalesInventory;
use App\Models\OrderNumber;
use App\Models\PriceType;
use App\Models\StatusReturn;
use App\Models\EmptyBottlesInventory;


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

        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $status = StatusReturn::where('isRemove', 0)->latest()->get();
        $customers = Customer::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $orders = Order::where('status', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        $product_codes = SalesInventory::where('isComplete' , true)->where('isRemove' , false)->latest()->get();

        $returned = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        $date = date("F d,Y h:i A");


        return view('admin.salesinvoice.salesinvoice', compact('customers' , 'orders' , 'pricetypes' , 'salesinvoice_id' , 'returned' , 'product_codes' ,'date','status'));
    }

    public function alltotal(){
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;


        $orders = Order::where('status', '0')->latest()->get();
        $returned = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->latest()->get();

        $total_order_amount = Order::sum('total');
        $total_return_amount = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->sum('amount');
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

        $returned = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.return', compact('returned'));
    }

    public function allreturn()
    {
        $returned = SalesReturn::latest()->get();
        return view('admin.salesinvoice.allrecordsreturn', compact('returned'));
    }

    public function productlist(){
        date_default_timezone_set('Asia/Manila');
        $inventories = SalesInventory::where('isComplete' , true)->where('isRemove', false)->where('stock' , '>' , 0)->where('location_id', 2)
        ->get();
        return view('admin.salesinvoice.product_sales_modal.productlist', compact('inventories'));
    }

    public function receipt()
    {
        date_default_timezone_set('Asia/Manila');
        $receipts = Order::where('status', '0')->latest()->get();

        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;
        $totalsalesreturn = SalesReturn::where('salesinvoice_id',$salesinvoice_id)->sum('amount');
        $returns = SalesReturn::where('salesinvoice_id',$salesinvoice_id)->latest()->get();
        $total = $receipts->sum('total') - $totalsalesreturn;

        return view('admin.salesinvoice.receiptmodal', compact('receipts', 'salesinvoice_id', 'totalsalesreturn','total','returns'));
    }
   
   
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'entry_date' => ['required' ,'date','after:yesterday'],
            'remarks' => ['nullable'],
            'customer_id' => ['required'],
            'cash' => ['required' ,'numeric','min:0'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        

        $totalsales = Order::sum('total');
        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;
        $totalsalesreturn = SalesReturn::where('salesinvoice_id',$salesinvoice_id)->sum('amount');
    
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

        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id ;

        $total_inv_amt = Order::sum('total');
        $totalsalesreturn = SalesReturn::where('salesinvoice_id',$salesinvoice_id)->sum('amount');


        $total_amount = $total_inv_amt - $totalsalesreturn ;

        $subtotal = Order::sum('total_amount_receipt');
        $total_discounted = Order::sum('discounted');
  
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

        $ids = Order::pluck('product_id');
        SalesInventory::whereIn('id' , $ids)->update([
            'stock' => DB::raw ('stock - orders'),
            'sold' => DB::raw ('sold + orders'),
            'orders' => 0,
        ]);

        $product_ids = EmptyBottlesInventory::select(['product_id'])->get()->toArray();
        $returnBottle = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->get();
        foreach($returnBottle as $return){
            if (in_array(array('product_id' => $return->product_id), $product_ids)){
                EmptyBottlesInventory::where('product_id', $return->product_id)
                                ->increment('qty', $return->return_qty);
            }else{
                EmptyBottlesInventory::create([
                    'product_id' => $return->product_id,
                    'qty'        => $return->return_qty
                ]);
            }
        }    

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

            $totalsalesreturn = SalesReturn::where('salesinvoice_id',$salesinvoice_id)->sum('amount');


            $payment = $totalsales - $totalsalesreturn;

            $change = $request->changee - $payment;
    
            
            
            return response()->json(['success' =>  number_format($change , 2, '.', ',')]);
            
        }
    }
    public function allrecords(){
        date_default_timezone_set('Asia/Manila');
        return view('admin.salesinvoice.allrecords.record_sales_invoice');
    }
    public function records(){
        $allrecords = SalesInvoice::where('isVoid' , 0)->latest()->get();
        return view('admin.salesinvoice.allrecords.allrecords', compact('allrecords'));
    }

    public function sales_receipt($sales_reciept){
        date_default_timezone_set('Asia/Manila');
        $salesInvoices = SalesInvoice::where('salesinvoice_id', $sales_reciept)->first();
        
        return view('admin.salesinvoice.receiptmodalsales', compact('salesInvoices'));
    }

    
    public function show(SalesInvoice $salesInvoice)
    {
        $sales = Sales::where('salesinvoice_id', $salesInvoice->salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.viewsales', compact('sales'));
    }

    
    public function edit(SalesInvoice $salesInvoice)
    {
        if (request()->ajax()) {
            return response()->json(
                [
                    'result'                  => $salesInvoice,
                    'customer_name'           => $salesInvoice->customer->customer_name,
                    'customer_area'           => $salesInvoice->customer->area,
                    'payment'                 => '₱ ' . number_format($salesInvoice->total_amount , 2, '.', ','),
                    'tsa'                     => '₱ ' . number_format($salesInvoice->subtotal , 2, '.', ','),
                    'sold_qty'                => $salesInvoice->sales->sum->purchase_qty,
                    'discounted'              => '₱ ( ' . number_format($salesInvoice->sales->sum->discounted, 2, '.', ',') . ' )',
                    'tra'                     => '₱ ( ' . number_format($salesInvoice->returns->sum->amount, 2, '.', ',') . ' )',
                    'return_qty'              => $salesInvoice->returns->sum->return_qty,
                    'cash1'                   => '₱ ' . number_format($salesInvoice->cash , 2, '.', ','),
                    'change1'                 => '₱ ' . number_format($salesInvoice->change , 2, '.', ','),
                    'created_by'              => $salesInvoice->user->name,
                    
                ]
            );
        }
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
    
    public function addtocart(Request $request, SalesInventory $sales_inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $errors =  Validator::make($request->all(), [
            'purchase_qty' => ['required' ,'integer','min:1'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }
        if($request->purchase_qty > $sales_inventory->stock){
            return response()->json(['nostock' => 'Insufficient Stocks. Availalbe Stock:'.$sales_inventory->stock]);
        }
        if($sales_inventory->orders > $sales_inventory->stock){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$sales_inventory->orders.' has reach maximum stock of this product']);
        }
        if($sales_inventory->orders == $sales_inventory->stock){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$sales_inventory->orders.' has reach maximum stock of this product']);
        }
        if( $sales_inventory->orders + $request->purchase_qty > $sales_inventory->stock){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$sales_inventory->orders.' has reach maximum stock of this product']);
        }

        $discount = PriceType::where('id', $request->select_pricetype)->first();
        
        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $id = $ordernumber->order_number;
    
        $profit                 = $sales_inventory->regular_discount + $sales_inventory->hauling_discount;
        $discounted             = $discount->discount;
        $profit_minus_discount  = $profit - $discounted;
        $overall_profit         = $request->purchase_qty * $profit_minus_discount;
        $overall_discounted     = $request->purchase_qty * $discounted;
        $subtotal               = $request->purchase_qty * $sales_inventory->price;
        $total                  = $subtotal - $overall_discounted;
        $over_all_cost          = $request->purchase_qty * $sales_inventory->unit_cost; 

        Order::create([
            'salesinvoice_id'       =>  $request->input('salesinvoice_id'),
            'order_number'          =>  $id,
            'product_id'            =>  $sales_inventory->id,
            'product_price'         =>  $sales_inventory->price,
            'purchase_qty'          =>  $request->input('purchase_qty'),
            'profit'                =>  $overall_profit,
            'total'                 =>  $total,
            'total_amount_receipt'  =>  $subtotal,
            'pricetype_id'          =>  $request->input('select_pricetype'),
            'discounted'            =>  $overall_discounted,
            'total_cost'            =>  $over_all_cost,
        ]);

        SalesInventory::where('id', $sales_inventory->id)->increment('orders', $request->purchase_qty);
        return response()->json(['success' => 'Order Successfully Inserted.']);

    }
}
