<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use App\Models\Sales;
use App\Models\Order;
use App\Models\OrderSales;
use App\Models\SalesReturn;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SalesInventory;
use App\Models\OrderNumber;
use App\Models\PriceType;
use App\Models\StatusReturn;
use App\Models\EmptyBottlesInventory;
use App\Models\LocationProduct;
use App\Models\AssignDeliver;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Size;
use App\Models\SalesPallet;
use App\Models\Pallet;
use Carbon\Carbon;
use Validator;
use DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SalesInvoiceController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('sales_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        date_default_timezone_set('Asia/Manila');

        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $status = StatusReturn::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $customers = Customer::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $deliveries = AssignDeliver::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $orders = Order::where('status', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->orderBy('id', 'asc')->get();
        $product_codes = SalesInventory::where('isComplete' , true)->where('isRemove' , false)->orderBy('id', 'asc')->get();

        $returned = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        $date = date("F d,Y h:i A");

        $categories = Category::where('isRemove', '0')->orderBy('id', 'asc')->get();
        $suppliers = Supplier::where('isRemove', '0')->orderBy('id', 'asc')->get();
        $sizes = Size::where('isRemove', '0')->orderBy('id', 'asc')->get();
        $product_deposits = EmptyBottlesInventory::orderby('id','asc')->get();


        return view('admin.salesinvoice.salesinvoice', compact('customers' ,'deliveries', 'orders' , 'pricetypes' , 'salesinvoice_id' , 'returned' , 'product_codes' ,'date','status','categories','suppliers','sizes','product_deposits'));
    }

    public function alltotal(){
        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;


        $orders = Order::where('status', '0')->latest()->get();
        $returned = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->latest()->get();


        $total_pallets = SalesPallet::where('salesinvoice_id', $salesinvoice_id)
                                            ->where('type', 'BUY')
                                            ->latest()->get();

        $total_return_pallets = SalesPallet::where('salesinvoice_id', $salesinvoice_id)
                                            ->where('type', 'RETURN')
                                            ->latest()->get();

        $total_deposits = Deposit::where('salesinvoice_id', $salesinvoice_id)->latest()->get();

        $subtotal = $orders->sum('total_amount_receipt') + $total_pallets->sum('amount') + $total_deposits->sum('amount');
        $total_cost = $orders->sum('total') + $total_pallets->sum('amount') + $total_deposits->sum('amount');
        $total_return = $returned->sum('amount') + $total_return_pallets->sum('amount');

        $total_amount = $total_cost - $total_return;


        return view('admin.salesinvoice.alltotal', compact('orders', 'returned','total_amount','total_cost','total_return','subtotal'));
    }

    public function sales()
    {
        date_default_timezone_set('Asia/Manila');
        $orders = Order::where('status', '0')->latest()->get();
        return view('admin.salesinvoice.sales', compact('orders'));
    }

    public function return()
    {
        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $returned = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.return', compact('returned'));
    }

    public function deposits()
    {
        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $deposits = Deposit::where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.deposits_table', compact('deposits'));
    }

    public function allreturn()
    {
        $returned = SalesReturn::latest()->get();
        return view('admin.salesinvoice.allrecordsreturn', compact('returned'));
    }

    public function productlist(Request $request){
        date_default_timezone_set('Asia/Manila');
        $products_list = LocationProduct::where('location_id', 1)->where('stock' , '>' , 0)->orderBy('id','asc')->get();

        foreach($products_list as $product){
            $products[] = array(
                'product_id'            => $product->product->id,
                'product'               => $product->product->product_code .'/'.$product->product->description,
                'size'                  => $product->product->size->title .' '. $product->product->size->size,
                'supplier'              => $product->product->supplier->name,
                'category'              => $product->product->category->name,
                'expiration'            => $product->product->expiration,
                'selling_area_stock'    => $product->product->location_products_stock(),
                'orders'                => $product->product->orders,
                'sold'                  => $product->product->sold,
            );
        }
        return response()->json(['data' => $products ]);
    }

    public function receipt()
    {
        date_default_timezone_set('Asia/Manila');
        $receipts = Order::where('status', '0')->latest()->get();

        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $returns = SalesReturn::where('salesinvoice_id',$salesinvoice_id)->latest()->get();

        $total_deposit = Deposit::where('salesinvoice_id',$salesinvoice_id)->sum('amount');

        $pallets = SalesPallet::where('salesinvoice_id', $salesinvoice_id)
                                            ->where('type', 'BUY')
                                            ->latest()->get();

        $return_pallets = SalesPallet::where('salesinvoice_id', $salesinvoice_id)
                                            ->where('type', 'RETURN')
                                            ->latest()->get();


        return view('admin.salesinvoice.receiptmodal', 
        compact('receipts', 'salesinvoice_id','returns','pallets', 'return_pallets','total_deposit'));
    }
    public function compute(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'entry_date' => ['required' ,'date','after:yesterday'],
            'remarks' => ['nullable'],
            'customer_id' => ['required'],
            'deliver_id' => ['required'],
            'cash' => ['required' ,'numeric','min:0'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $cash1     = $request->get('cash');
        $payment1  = $request->get('payment');
        $prev_bal1 = $request->get('current_balance');

        $orders = Order::latest()->get();
        foreach($orders as $order){
            $stocks = LocationProduct::where('product_id', $order->product_id)->where('location_id', 1)->sum('stock');
            if($order->purchase_qty > $stocks){
                return response()->json(['maxstock' =>
                    'Insufficient Stocks. This Order '.$order->product->product_code.'( '.$order->purchase_qty.' )'.
                    ' has reach maximum stock of this product'. ' Available Stock:'
                    .$order->product->location_products_stock()]);
            }
        }

        $cash     = floatval(str_replace(",", "", $cash1));
        $payment  = floatval(str_replace(",", "", $payment1));
        $prev_bal = floatval(str_replace(",", "", $prev_bal1));
        
        
        if($cash < $payment){
            $change   = $cash - $payment;
            $change1  = $payment - $cash;
            $new_bal  = $prev_bal + $change1;
        }else{
            $change = $cash - $payment;
            if($prev_bal < $change){
                $new_bal = 0;
            }else{
                $new_bal = $prev_bal - $change;
            }
        }
        $payment = $payment - floatval(str_replace(",", "", $request->input('over_payment')));
        if($cash < $payment){
            // return response()->json(['insufficient_cash'  => 'cash must be greater than the payment <br> check the Receivable Checkbox to proceed this transaction']);
            $validated =  Validator::make($request->all(), [
                'receivables' =>'accepted',
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }
        }

        if ($request->input('receivables')){    
                $change = $change - $prev_bal;
                    if($change < 0 ){
                        $change = 0;
                    }
        }
        if($request->input('over_payment_checkbox')){
            $over_payment = $change;
            $change = '0.00';
        }
        if(0 < floatval(str_replace(",", "", $request->input('over_payment')))){
            $change = '0.00';
        }

        return response()->json(
            [
              'submit'  => 'submit',
              'change' => number_format($change, 2, '.', ','),
              'new_bal' => number_format($new_bal, 2, '.', ','),
              'over_payment' => number_format($over_payment ?? floatval(str_replace(",", "", $request->input('over_payment'))), 2, '.', ','),
            ]
        );
    }
   
   
    public function store(Request $request)
    {
        $cash     = floatval(str_replace(',', '.', $request->get('cash')));

        $ordernumber = OrderNumber::orderby('id', 'desc')->first();
        $salesinvoice_id = $ordernumber->salesinvoice_id;
        
        $total_order_amount = Order::sum('total');
        $total_return_amount = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->sum('amount');
        $payment = $total_order_amount - $total_return_amount;

        
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
            'deliver_id' => $request->get('deliver_id'),

            'subtotal' =>  $subtotal,
            'total_discount' =>   $total_discounted,
            'total_amount' => $total_amount,

            'total_return' => $totalsalesreturn,
            'prev_bal' => floatval(str_replace(",", "", $request->get('prev_bal'))),
            'total_inv_amt' => $total_inv_amt,
            'cash' => $request->get('cash'),
            'change' => $change,
            'new_bal' => floatval(str_replace(",", "", $request->get('new_bal'))),
            'user_id' => $userid,
            'isReceivable'  => $request->get('receivables'),
            'isOverPayment'  => $request->get('isOverPayment'),
            'over_payment' => floatval(str_replace(",", "", $request->get('over_payment')))
        ]);
        if($request->get('isOverPayment') == '1'){
            Customer::where('id', $request->get('customer_id'))->update([
                'over_payment' => floatval(str_replace(",", "", $request->get('over_payment'))),
            ]);
        }else{
            Customer::where('id', $request->get('customer_id'))->update([
                'over_payment' => '0',
            ]);
        }

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

        
        
        $orders = Order::latest()->get();
        foreach($orders as $order){
                LocationProduct::where('product_id', $order->product_id)->where('location_id', 1)
                                        ->decrement('stock', $order->purchase_qty);
                SalesInventory::where('id', $order->product_id)->increment('sold', $order->purchase_qty);
                SalesInventory::where('id', $order->product_id)->decrement('orders', $order->purchase_qty);
               
                                        
        }
        //EMPTY
        
        $returnBottle = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->where('type_of_return', 'EMPTY')->get();
        foreach($returnBottle as $return){
                EmptyBottlesInventory::updateOrCreate(
                    [
                        'product_id' => $return->product_id,
                    ],
                    [
                        'product_id' => $return->product_id,
                    ],
                );
        }
        //FULL
        $returnFullBottle = SalesReturn::where('salesinvoice_id', $salesinvoice_id)->where('type_of_return', 'FULL')->get();
        foreach($returnFullBottle as $return){
            $location = LocationProduct::where('product_id', $return->product_id)
                            ->where('location_id', 3)
                            ->first();
            if($location == null){
                LocationProduct::create([
                    'product_id'    => $return->product_id,
                    'location_id'   => 3,
                    'stock'         => $return->return_qty,
                ]);
            }else{
                LocationProduct::where('product_id', $return->product_id)
                                    ->where('location_id', 3)
                                    ->increment('stock', $return->return_qty);
            }
        }      
        SalesReturn::where('salesinvoice_id', $salesinvoice_id)
                        ->update([
                            'isComplete'    => true,
                            'user_id'       => auth()->user()->id,
                        ]);
        // DEPOSITS
        Deposit::where('salesinvoice_id', $salesinvoice_id)
                        ->update([
                            'isComplete'    => true,
                        ]);
        // PALLETS
        $pallets = SalesPallet::where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        foreach($pallets as $pallet){
            if($pallet->type == "BUY"){
                Pallet::where('id', $pallet->pallet_id)
                        ->decrement('stock', $pallet->qty);
            }
            if($pallet->type == "RETURN"){
                Pallet::where('id', $pallet->pallet_id)
                        ->increment('stock', $pallet->qty);
            }
        }

        Order::where('salesinvoice_id', $salesinvoice_id)
                        ->update([
                            'user_id'       => auth()->user()->id,
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

    public function receivables(Request $request){
        $new_bal = $request->get('new_bal');
        $new_bal = floatval(str_replace(",", "", $new_bal));
        
        $customer = $request->get('customer');
        Customer::where('id', $customer)->update([
            'current_balance' => $new_bal,
        ]);
        return response()->json(['success' => 'SUCCESSFULLY UPDATED ACCOUNT BALANCE IN THIS CUSTOMER']);
    }

    public function allrecords(){
        date_default_timezone_set('Asia/Manila');
        $customers = Customer::where('isRemove', 0)->where('isRemove', 0)->orderBy('id', 'asc')->get();
        $deliveries = AssignDeliver::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $account_receivables = Customer::where('isRemove', 0)->where('current_balance', '>' , 0)->orderBy('id', 'asc')->get();
        $over_payments = Customer::where('isRemove', 0)->where('over_payment', '>' , 0)->orderBy('id', 'asc')->get();

        return view('admin.salesinvoice.allrecords.record_sales_invoice', compact('over_payments','customers', 'deliveries','account_receivables'));
    }
    public function records(){
        $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
        $allrecords = SalesInvoice::where('isVoid' , 0)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('id','desc')->get();
        return view('admin.salesinvoice.allrecords.allrecords', compact('allrecords','title_filter'));
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
        $subtotal     = $salesInvoice->sales->sum('total_amount_receipt') + $salesInvoice->pallets->sum('amount') + $salesInvoice->deposits->sum('amount');
        $total_cost   = $salesInvoice->sales->sum('total') + $salesInvoice->pallets->sum('amount') + $salesInvoice->deposits->sum('amount');
        $total_return = $salesInvoice->returns->sum('amount') + $salesInvoice->pallets_returns->sum('amount');

        $payment = $total_cost - $total_return;
        $change  =  $salesInvoice->cash  - $payment;
        if ($salesInvoice->isReceivable == 1){    
            $change = $change - $salesInvoice->prev_bal;
                if($change < 0 ){
                    $change = 0;
                }
        }

        if (request()->ajax()) {
            return response()->json(
                [
                    'order_number'    => $salesInvoice->salesinvoice_id,
                    'doc_no'          => $salesInvoice->doc_no,
                    'entry_date'      => $salesInvoice->entry_date,
                    'remarks'         => $salesInvoice->remarks,
                    'deliver_id'      => $salesInvoice->deliver_id,
                    'customer_id'     => $salesInvoice->customer_id,

                    'sub_total'              => number_format($subtotal, 2, '.', ','),
                    'total_discount'       => '('. number_format($salesInvoice->sales()->sum('discounted'), 2, '.', ',') .')', 
                    'total_sales_amount'     => number_format($total_cost, 2, '.', ','),  
                    
                    'total_return_amount'    => '('. number_format($total_return, 2, '.', ',') .')', 

                    'balance'                => number_format($salesInvoice->customer->current_balance, 2, '.', ','),
                    'cash'                => $salesInvoice->cash,
                    'change'                => number_format($change, 2, '.', ','),
                    'payment'                => number_format($payment, 2, '.', ','),
                ]
            );
        }
    }

    
    public function update(Request $request, SalesInvoice $salesInvoice)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'deliver_id' => ['required'],
            'cash' => ['required' ,'numeric','min:0'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $payment    = $salesInvoice->sales()->sum('total') - $salesInvoice->returns()->sum('amount');
        $change       = $request->input('cash') - $payment;  

        SalesInvoice::find($salesInvoice->id)->update([
            'doc_no'         =>  $request->input('doc_no'),
            'entry_date'     =>  $request->input('entry_date'),
            'remarks'        =>  $request->input('remarks'),
           
            'deliver_id'     => $request->input('deliver_id'),

            'subtotal'       =>  $salesInvoice->sales()->sum('total_amount_receipt'),
            'total_discount' =>   $salesInvoice->sales()->sum('discounted'),
            'total_amount'   => $payment ,

            'total_return'   => $salesInvoice->returns()->sum('amount'),
           
            'total_inv_amt'  => $salesInvoice->sales()->sum('total'),
            'cash'           => $request->input('cash'),
            'change'         => $change,
        ]);

        return response()->json([
            'success' => 'Transaction Successfully Updated.',
            'change'  => number_format($change, 2, '.', ','),
            'payment'  => number_format($payment, 2, '.', ','),
        ]);
     
        
    }

    public function destroy(SalesInvoice $salesInvoice)
    {
    
    }

    public function void(SalesInvoice $salesInvoice)
    {   
        foreach($salesInvoice->sales()->get() as $sales){
            LocationProduct::where('product_id', $sales->product_id)
                            ->where('location_id', 1)
                            ->increment('stock', $sales->purchase_qty);
            SalesInventory::where('id', $sales->product_id)->decrement('sold', $sales->purchase_qty);
            $sales->delete();
        }
        foreach($salesInvoice->returns()->get() as $salesReturn){
            if($salesReturn->type_of_return == 'EMPTY'){
                EmptyBottlesInventory::where('product_id', $salesReturn->product_id)->decrement('qty', $salesReturn->return_qty);
            }
            if($salesReturn->type_of_return == 'FULL'){
                LocationProduct::where('product_id', $salesReturn->product_id)
                                ->where('location_id', 3)
                                ->decrement('stock', $salesReturn->return_qty);
            }
            $salesReturn->delete();
        }

        foreach($salesInvoice->pallets()->get() as $pallet){
            Pallet::where('id', $pallet->pallet_id)->increment('stock', $pallet->qty);
            $pallet->delete();
        }
        foreach($salesInvoice->pallets_returns()->get() as $pallet){
            Pallet::where('id', $pallet->pallet_id)->decrement('stock', $pallet->qty);
            $pallet->delete();
        }
        foreach($salesInvoice->deposits()->get() as $deposit){
            $deposit->delete();
        }

        $salesInvoice->delete();
        return response()->json(['success' => 'Transaction Successfully Void.']);
    }
    
    public function addtocart(Request $request, SalesInventory $sales_inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $errors =  Validator::make($request->all(), [
            'purchase_qty' =>  ['required' ,'numeric','min:0'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }
        if($request->purchase_qty > $sales_inventory->location_products_stock()){ 
            return response()->json(['nostock' => 'Insufficient Stocks. Available Stock:'.$sales_inventory->location_products_stock()]);
        }
        if($sales_inventory->orders > $sales_inventory->location_products_stock()){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$sales_inventory->orders.' has reach maximum stock of this product'. ' Available Stock:'.$sales_inventory->location_products_stock()]);
        }
        if($sales_inventory->orders == $sales_inventory->location_products_stock()){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$sales_inventory->orders.' has reach maximum stock of this product'. ' Available Stock:'.$sales_inventory->location_products_stock()]);
        }
        if( $sales_inventory->orders + $request->purchase_qty > $sales_inventory->location_products_stock()){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$sales_inventory->orders.' has reach maximum stock of this product'. ' Available Stock:'.$sales_inventory->location_products_stock()]);
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
        $cost                   = $sales_inventory->unit_cost - $profit;
        $over_all_cost          = $request->purchase_qty * $cost; 

        Order::updateOrCreate(
            [
                'salesinvoice_id'       =>  $id,
                'order_number'          =>  $id,
                'product_id'            =>  $sales_inventory->id,
                'user_id'               =>  auth()->user()->id,
            ],
            [
                'salesinvoice_id'       =>  $id,
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
                'user_id'               =>  auth()->user()->id,
            ]
        );


        SalesInventory::where('id', $sales_inventory->id)->update(['orders' =>
                                                Order::where('salesinvoice_id' , $request->input('salesinvoice_id'))
                                                        ->where('product_id', $sales_inventory->id)
                                                        ->sum('purchase_qty')]);

        return response()->json(['success' => 'Order Successfully Inserted.']);

    }

    public function sales_records(SalesInvoice $sales_records){
        $sales = $sales_records->sales()->get();
        return view('admin.salesinvoice.allrecords.sales',compact('sales'));
    }
    public function return_records(SalesInvoice $return_records){
        $returns = $return_records->returns()->get();
        return view('admin.salesinvoice.allrecords.returns',compact('returns'));
    }
    public function pallets_records(SalesInvoice $pallet){
        $pallets = SalesPallet::where('salesinvoice_id', $pallet->salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.allrecords.pallets',compact('pallets'));
    }
    public function deposits_records(SalesInvoice $deposit){
        $deposits = Deposit::where('salesinvoice_id', $deposit->salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.allrecords.deposits',compact('deposits'));
    }

    public function filter(Request $request){
        date_default_timezone_set('Asia/Manila');
        $filter = $request->get('filter');
        if($filter == 'daily'){
            $title_filter  = 'From: ' . date('F d, Y') . ' To: ' . date('F d, Y');
            $allrecords = SalesInvoice::where('isVoid' , 0)->whereDate('created_at', Carbon::today())->latest()->get();
        }
        if($filter == 'weekly'){
            $title_filter  = 'From: ' . Carbon::now()->startOfWeek()->format('F d, Y') . ' To: ' . Carbon::now()->endOfWeek()->format('F d, Y');
            $allrecords = SalesInvoice::where('isVoid' , 0)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->latest()->get();
        }
        if($filter == 'monthly'){
            $title_filter  = 'From: ' . date('F '. 1 .', Y') . ' To: ' . date('F '. 31 .', Y');
            $allrecords = SalesInvoice::where('isVoid' , 0)->latest()
                ->whereMonth('created_at', '=', date('m'))
                ->whereYear('created_at', '=', date('Y'))
                ->get();
        }
        if($filter == 'yearly'){
            $title_filter  = 'From: ' .'Jan 1'. date(', Y') . ' To: ' .'Dec 31'. date(', Y');
            $allrecords = SalesInvoice::where('isVoid' , 0)->latest()->whereYear('created_at', '=', date('Y'))->get();
        }
        if($filter == 'all'){
            $title_filter  = 'All SALES INVOICE';
            $allrecords = SalesInvoice::where('isVoid' , 0)->latest()->get();
        }
        if($filter == 'fbd'){
            $from = $request->get('from');
            $to = $request->get('to');
            $title_filter =  'From: '.date('F d, Y', strtotime($from)). ' To: ' .date('F d, Y', strtotime($to));
            $allrecords = SalesInvoice::where('isVoid' , 0)->latest()->whereBetween('created_at', [$from, $to])->get();
        }
        return view('admin.salesinvoice.allrecords.allrecords', compact('allrecords','title_filter'));
    }
    
}
