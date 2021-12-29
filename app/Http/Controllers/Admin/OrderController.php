<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\SalesInventory;
use App\Models\Category;
use App\Models\PriceType;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $pricetypes = PriceType::where('isRemove', '0')->orderBy('id', 'asc')->get();
        return view('admin.salesinvoice.product_sales_modal.editmodal', compact('order', 'pricetypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        date_default_timezone_set('Asia/Manila');
        $errors =  Validator::make($request->all(), [
            'purchase_qty_edit' => ['required' ,'numeric','min:0'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        if($request->purchase_qty_edit > $order->product->location_products_stock()){
            return response()->json(['nostock' => 'Insufficient Stocks. Available Stock:'.$order->product->location_products_stock()]);
        }
        
        if($order->product->orders  >  $order->product->location_products_stock()){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$order->product->orders.' has reach maximum stock of the product' . ' Available Stock:'.$order->product->location_products_stock()]);
        }
        

        if($order->purchase_qty < $request->purchase_qty_edit){
            $changeqty = $request->purchase_qty_edit - $order->purchase_qty;
            if($changeqty  > $order->product->location_products_stock()){
                return response()->json(['nostock' => 'Insufficient Stocks. Available Stock:'.$order->product->location_products_stock()]);
            }
            if($order->product->orders + $changeqty  >  $order->product->location_products_stock()){
                return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$order->product->orders.' has reach maximum stock of the product' . ' Available Stock:'.$order->product->location_products_stock()]);
            }
         }
         if($order->purchase_qty > $request->purchase_qty_edit){
            $changeqty = $order->purchase_qty - $request->purchase_qty_edit;
         }


         $discount = PriceType::where('id', $request->select_pricetype_edit)->first();
     
         $profit                 = $order->product->regular_discount + $order->product->hauling_discount;
         $discounted             = $discount->discount;
         $profit_minus_discount  = $profit - $discounted;
         $overall_profit         = $request->purchase_qty_edit * $profit_minus_discount;
         $overall_discounted     = $request->purchase_qty_edit * $discounted;
         $subtotal               = $request->purchase_qty_edit * $order->product->price;
         $total                  = $subtotal - $overall_discounted;
         $cost                   = $order->product->unit_cost  - $profit;
         $over_all_cost          = $request->purchase_qty_edit * $cost; 

        Order::find($order->id)->update([
                'purchase_qty'           => $request->input('purchase_qty_edit'),
                'product_price'         =>  $order->product->price,
                'profit'                =>  $overall_profit,
                'total'                 =>  $total,
                'total_amount_receipt'  =>  $subtotal,
                'pricetype_id'          =>  $request->input('select_pricetype_edit'),
                'discounted'            =>  $overall_discounted,
                'total_cost'            =>  $over_all_cost,
        ]);

        SalesInventory::where('id', $order->product->id)->update(['orders' =>
                                                Order::where('product_id', $order->product->id)
                                                       ->sum('purchase_qty')]);

        return response()->json(['success' => 'Order Successfully Updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        SalesInventory::where('id', $order->product->id)->update(['orders' =>
                                                                Order::where('product_id', $order->product->id)
                                                                        ->sum('purchase_qty')]);
       return response()->json(['success' => 'Order Removed Successfully.']);
    }
}
