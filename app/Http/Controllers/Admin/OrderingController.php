<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use Validator;
use App\Models\Order;
use App\Models\Sales;
use App\Models\OrderNumber;
use App\Models\Customer;
use App\Models\PriceType;
use App\Models\OrderSales;
use App\Models\SalesReturn;
use Gate;
use DB;
use Symfony\Component\HttpFoundation\Response;



class OrderingController extends Controller
{
    public function getproducts()
    {
        abort_if(Gate::denies('ordering_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $inventories = Inventory::where('isRemove', 0)->where('isSame', 0)->where('stock' , '>' , 0)->where('location_id', 2)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->orderBy('expiration', 'ASC')->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->get();
        $customers = Customer::where('isRemove', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        return view('admin.ordering.ordering', compact('categories','inventories' , 'orders','customers','pricetypes'));
    }
    public function loadproduct()
    {
        date_default_timezone_set('Asia/Manila');
        $inventories = Inventory::where('isRemove', 0)->where('isSame', 0)->where('stock' , '>' , 0)->where('location_id', 2)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->orderBy('expiration', 'ASC')->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.loadproduct', compact('categories','inventories', 'orders'));
    }

    public function selectcustomer(Request $request,Customer $customer){
       
        return response()->json([
            'name' => $customer->customer_code,
            'area' => $customer->area,
            'balance' => number_format($customer->current_balance, 2, '.', ','),
            'over_payment' => number_format($customer->over_payment, 2, '.', ','),

        ]);
        
    }
    public function selectpricetype(Request $request, PriceType $pricetype){
        if (request()->ajax()) {
            return response()->json(['result' => $pricetype]);
        }
    }
  

    public function cartsbutton(){
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.cartsbutton', compact('orders'));
    }
    public function checkout()
    {
        date_default_timezone_set('Asia/Manila');
        // $inventories = Inventory::latest()->get();
        $inventories = Inventory::where('isRemove', 0)->where('isSame', 0)->where('stock' , '>' , 0)->where('location_id', 2)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->orderBy('expiration', 'ASC')->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->latest()->get();
        $receipts = Order::where('status', '0')->latest()->get();
        $date = date("F d,Y h:i A");
        $customers = Customer::where('isRemove', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $orderid = $ordernumber->order_number;

        return view('admin.ordering.checkoutmodal', compact('categories','inventories', 'orders', 'receipts' , 'date' ,'customers' , 'pricetypes' , 'orderid'));
    }
    public function checkout_order(Request $request){
        date_default_timezone_set('Asia/Manila');

        $orders = Order::all()->count();
        if($orders < 1){
            return response()->json(['nodata' => 'No data available']);
        }

        Order::latest()->update([
            'customer_id' => $request->get('customer'),
        ]);

        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $id = $ordernumber->order_number;
        $total_profit = Order::sum('profit');
        $total_sales = Order::sum('total');
        $total_cost = Order::sum('total_cost');
        $total_qty = Order::sum('purchase_qty');
        $subtotal = Order::sum('total_amount_receipt');

        OrderSales::create([
            'order_number_id' => $id,
            'total_profit' => $total_profit,
            'total_sales' => $total_sales,
            'total_cost' => $total_cost,
            'customer_id' => $request->get('customer'),
            'total_qty' => $total_qty,
            'subtotal' => $subtotal,
            'total' => $total_sales,
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

            return response()->json(['success' => 'Successfully Check Out.']);
        }
    }
    public function loadcart()
    {
        // $inventories = Inventory::latest()->get();
        $inventories = Inventory::where('isRemove', 0)->where('isSame', 0)->where('stock' , '>' , 0)->where('location_id', 2)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->orderBy('expiration', 'ASC')->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.loadcart', compact('categories','inventories', 'orders'));
    }
    public function search(Request $request)
    {
        if($request->ajax()){
            $output="";
            $inventories = Inventory::where('long_description','LIKE','%'.$request->search."%")
                                    ->Orwhere('short_description','LIKE','%'.$request->search."%")
                                    ->Orwhere('price','LIKE','%'.$request->search."%")
                                    ->Orwhere('product_code','LIKE','%'.$request->search."%")
                                    ->where('isRemove', 0)
                                    ->where('isSame', 0)
                                    ->latest()
                                    ->get();
            return view('admin.ordering.loadproduct', compact('inventories'));
            
        }
    }

    
}
