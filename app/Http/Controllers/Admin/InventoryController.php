<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\PurchaseOrder;
use App\Models\Size;
use App\Models\Supplier;
use App\Models\UCS;
use App\Models\Location;
use App\Models\PriceType;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use datetime;
use DB;


class InventoryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('inventories_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $purchaseorder = PurchaseOrder::where('isReturn', 0)->latest()->get();
        $allpurchaseorder = PurchaseOrder::latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();

        return view('admin.inventories.inventories',compact('categories','purchaseorder', 'allpurchaseorder', 'sizes' ,'locations'  ,'suppliers'));
    }
    public function loadinventories()
    {
        $inventories = Inventory::where('isRemove', 0)->where('isSame', 0)->latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        return view('admin.inventories.loadinventories', compact('categories','inventories' ,'locations'));
    }


  
    public function filter(Request $request){
        //filter

        
        $query = Inventory::query();

        if($request->get('category'))
        {
            $query->where('category_id', $request->get('category'));
        }
        if($request->get('location'))
        {
            $query->where('location_id', $request->get('location'));
            
        }
        if($request->get('supplier'))
        {
            $query->where('supplier_id', $request->get('supplier'));
        }
        if($request->get('size'))
        {
            $query->where('size_id', $request->get('size'));
        }
        
        
        $inventories = $query->where('isRemove', 0)->where('isSame', 0)->latest()->get();
        
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        return view('admin.inventories.loadinventories', compact('categories','inventories' ,'locations'));

    }


    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'purchase_id' => ['required'],
            'category_id' => ['required'],
            'long_description' => ['required'],
            'short_description' => ['required'],
            'product_code' => ['required', 'string', 'max:255'],
            'stock' => ['required' ,'integer','min:1'],
            'size_id' => ['required'],
            'expiration' => ['required' ,'date','after:today'],
            'purchase_amount' => ['required' ,'numeric','min:1'],
            'profit' => ['required' ,'numeric','min:1'],
            'product_remarks' => ['nullable'],  
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $price = $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;

        $userid = auth()->user()->id;
        $ucs = Size::where('id', $request->input('size_id'))->firstorfail();
        $po = PurchaseOrder::where('purchase_order_number', $request->input('purchase_id'))->firstorfail();

        $existingcode = Inventory::select(['product_code'])->where('isSame', 0)->where('isRemove', 0)->get()->toArray();
        if (in_array(array('product_code' => $request->input('product_code')), $existingcode))
        {
            $product = Inventory::create([
                'purchase_order_number_id' => $request->input('purchase_id'),
                'category_id' => $request->input('category_id'),
                'long_description' => $request->input('long_description'),
                'short_description' => $request->input('short_description'),
                'product_code' => trim(strtoupper($request->input('product_code'))),
                'stock' => $request->input('stock'),
                'qty' => $request->input('stock'),
                'pqty' => $request->input('stock'),
                'size_id' => $request->input('size_id'),
                'expiration' => $request->input('expiration'),
                'purchase_amount' => $request->input('purchase_amount'),
                'profit' => $request->input('profit'),
                'price' => $price,
                'total_amount_purchase' => $total_amount_purchase,
                'total_profit' => $total_profit,
                'total_price' => $total_price,
                'product_remarks' => $request->input('product_remarks'),
                'product_id' => time().$userid,
                'location_id' => $po->location_id,
                'supplier_id' => $po->supplier_id,
                'isSame' => 1,
                'ucs_size' => $ucs->ucs,
            ]);


            Inventory::where('product_code' , $request->input('product_code'))
                        ->where('isSame', '0')
                        ->where('isRemove', '0')
                        ->update([
                            'stock' => DB::raw ('stock +'. $request->input('stock')),
                            'qty' => DB::raw ('qty +'. $request->input('stock')),
                            'total_amount_purchase' => DB::raw ('purchase_amount * qty'),
                            'total_profit' => DB::raw ('profit * qty'),
                            'total_price' => DB::raw ('price * qty'),
                        ]);

            $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_amount_purchase');
            $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_profit');
            $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_price');
            $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->count();

            PurchaseOrder::where('purchase_order_number',$request->input('purchase_id'))->update([
                'total_purchased_order' => $totalpurchasedorder,
                'total_profit' => $totalprofit,
                'total_price' => $totalprice,
                'total_orders' => $products,
            ]);
            
            $ucs_percase = $ucs->ucs * $request->input('stock');
            UCS::create([
                'purchase_order_number_id' => $request->input('purchase_id'),
                'product_id' => $product->product_id,
                'ucs' => $ucs_percase,
                'qty' => $product->qty,
                'ucs_size' => $ucs->ucs,
                'isPurchase' => 1,
            ]);

            return response()->json(['success' => 'Product Added Successfully.']);
        }
        $product = Inventory::create([
            'purchase_order_number_id' => $request->input('purchase_id'),
            'category_id' => $request->input('category_id'),
            'long_description' => $request->input('long_description'),
            'short_description' => $request->input('short_description'),
            'product_code' => trim(strtoupper($request->input('product_code'))),
            'stock' => $request->input('stock'),
            'qty' => $request->input('stock'),
            'pqty' => $request->input('stock'),
            'size_id' => $request->input('size_id'),
            'expiration' => $request->input('expiration'),
            'purchase_amount' => $request->input('purchase_amount'),
            'profit' => $request->input('profit'),
            'price' => $price,
            'total_amount_purchase' => $total_amount_purchase,
            'total_profit' => $total_profit,
            'total_price' => $total_price,
            'product_remarks' => $request->input('product_remarks'),
            'product_id' => time().$userid,
            'location_id' => $po->location_id,
            'supplier_id' => $po->supplier_id,
            'ucs_size' => $ucs->ucs,
        ]);

        $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_amount_purchase');
        $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_profit');
        $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_price');
        $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->count();

        PurchaseOrder::where('purchase_order_number',$request->input('purchase_id'))->update([
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
        ]);
       
        $ucs_percase = $ucs->ucs * $request->input('stock');
        UCS::create([
            'purchase_order_number_id' => $request->input('purchase_id'),
            'product_id' => $product->product_id,
            'ucs' => $ucs_percase,
            'qty' => $product->qty,
            'ucs_size' => $ucs->ucs,
            'isPurchase' => 1,
        ]);

        return response()->json(['success' => 'Product Added Successfully.']);
    }


    public function show(Inventory $inventory)
    {
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        return view('admin.ordering.viewmodal', compact('inventory','pricetypes'));
    }

  
    public function edit(Inventory $inventory)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $inventory]);
        }
    }

   
    public function update(Request $request, Inventory $inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'category_id' => ['required'],
            'long_description' => ['required'],
            'short_description' => ['required'],
            'product_code' => ['required', 'string', 'max:255'],
            'stock' => ['required' ,'integer','min:1'],
            'size_id' => ['required'],
            'expiration' => ['required' ,'date','after:today'],
            'purchase_amount' => ['required' ,'numeric','min:1'],
            'profit' => ['required' ,'numeric','min:1'],
            'product_remarks' => ['nullable'],  
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $price = $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;
        
        $ucs = Size::where('id', $request->input('size_id'))->firstorfail();
        $existingcode = Inventory::select(['product_code'])->where('isSame', 0)->where('isRemove', 0)->get()->toArray();

        if($inventory->isSame == 0){
            if (in_array(array('product_code' => $request->input('product_code')), $existingcode))
            {

                Inventory::find($inventory->id)->update([
                    'category_id' => $request->input('category_id'),
                    'long_description' => $request->input('long_description'),
                    'short_description' => $request->input('short_description'),
                    'product_code' => trim(strtoupper($request->input('product_code'))),
                    'stock' => $request->input('stock'),
                    'qty' => $request->input('stock'),
                    'pqty' => $request->input('stock'),
                    'size_id' => $request->input('size_id'),
                    'expiration' => $request->input('expiration'),
                    'purchase_amount' => $request->input('purchase_amount'),
                    'profit' => $request->input('profit'),
                    'price' => $price,
                    'total_amount_purchase' => $total_amount_purchase,
                    'total_profit' => $total_profit,
                    'total_price' => $total_price,
                    'product_remarks' => $request->input('product_remarks'),
                    'ucs_size' => $ucs->ucs,
                    
                ]);
        
                $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_amount_purchase');
                $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_profit');
                $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_price');
                $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->count();
                
                PurchaseOrder::where('purchase_order_number',$request->input('purchase_id'))->update([
                    'total_purchased_order' => $totalpurchasedorder,
                    'total_profit' => $totalprofit,
                    'total_price' => $totalprice,
                    'total_orders' => $products,
                ]);
        
                
                $ucs_percase = $ucs->ucs * $request->input('stock');
                UCS::where('product_id',$inventory->product_id)->update([
                    'ucs' => $ucs_percase,
                    'qty' =>  $request->input('stock'),
                    'ucs_size' => $ucs->ucs,
                ]);
                if($inventory->isSame == 1){
                    Inventory::where('product_code' , $request->input('product_code'))
                        ->where('isSame', '0')
                        ->where('isRemove', '0')
                        ->update([
                        'stock' => DB::raw ('stock +'. $request->input('stock')),
                        'qty' => DB::raw ('qty +'. $request->input('stock')),
                        'total_amount_purchase' => DB::raw ('purchase_amount * qty'),
                        'total_profit' => DB::raw ('profit * qty'),
                        'total_price' => DB::raw ('price * qty'),
                    ]);
                }
                return response()->json(['success' => 'Product Updated successfully.']);
            }

            Inventory::find($inventory->id)->update([
                'category_id' => $request->input('category_id'),
                'long_description' => $request->input('long_description'),
                'short_description' => $request->input('short_description'),
                'product_code' => trim(strtoupper($request->input('product_code'))),
                'stock' => $request->input('stock'),
                'qty' => $request->input('stock'),
                'pqty' => $request->input('stock'),
                'size_id' => $request->input('size_id'),
                'expiration' => $request->input('expiration'),
                'purchase_amount' => $request->input('purchase_amount'),
                'profit' => $request->input('profit'),
                'price' => $price,
                'total_amount_purchase' => $total_amount_purchase,
                'total_profit' => $total_profit,
                'total_price' => $total_price,
                'product_remarks' => $request->input('product_remarks'),
                'ucs_size' => $ucs->ucs,
                'isSame' => 0,
            ]);
    
            $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_amount_purchase');
            $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_profit');
            $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_price');
            $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->count();
            
            PurchaseOrder::where('purchase_order_number',$request->input('purchase_id'))->update([
                'total_purchased_order' => $totalpurchasedorder,
                'total_profit' => $totalprofit,
                'total_price' => $totalprice,
                'total_orders' => $products,
            ]);
    
            
            $ucs_percase = $ucs->ucs * $request->input('stock');
            UCS::where('product_id',$inventory->product_id)->update([
                'ucs' => $ucs_percase,
                'qty' =>  $request->input('stock'),
                'ucs_size' => $ucs->ucs,
            ]);
            return response()->json(['success' => 'Product Updated successfully.']);


        }
        elseif($inventory->isSame == 1)
        {
            if (in_array(array('product_code' => $request->input('product_code')), $existingcode))
                {
                    Inventory::where('product_code' , $request->input('product_code'))
                        ->where('isSame', '0')
                        ->where('isRemove', '0')
                        ->update([
                            'stock' => DB::raw ('stock -'. $inventory->qty),
                            'qty' => DB::raw ('qty -'. $inventory->qty),
                    ]);

                    Inventory::find($inventory->id)->update([
                        'category_id' => $request->input('category_id'),
                        'long_description' => $request->input('long_description'),
                        'short_description' => $request->input('short_description'),
                        'product_code' => trim(strtoupper($request->input('product_code'))),
                        'stock' => $request->input('stock'),
                        'qty' => $request->input('stock'),
                        'pqty' => $request->input('stock'),
                        'size_id' => $request->input('size_id'),
                        'expiration' => $request->input('expiration'),
                        'purchase_amount' => $request->input('purchase_amount'),
                        'profit' => $request->input('profit'),
                        'price' => $price,
                        'total_amount_purchase' => $total_amount_purchase,
                        'total_profit' => $total_profit,
                        'total_price' => $total_price,
                        'product_remarks' => $request->input('product_remarks'),
                        'ucs_size' => $ucs->ucs,
                        'isSame' => 1,
                    ]);

                    Inventory::where('product_code' , $request->input('product_code'))
                        ->where('isSame', '0')
                        ->where('isRemove', '0')
                        ->update([
                        'stock' => DB::raw ('stock +'. $request->input('stock')),
                        'qty' => DB::raw ('qty +'. $request->input('stock')),
                        'total_amount_purchase' => DB::raw ('purchase_amount * qty'),
                        'total_profit' => DB::raw ('profit * qty'),
                        'total_price' => DB::raw ('price * qty'),
                    ]);

                    $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_amount_purchase');
                    $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_profit');
                    $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_price');
                    $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->count();

                    PurchaseOrder::where('purchase_order_number',$request->input('purchase_id'))->update([
                        'total_purchased_order' => $totalpurchasedorder,
                        'total_profit' => $totalprofit,
                        'total_price' => $totalprice,
                        'total_orders' => $products,
                    ]);


                    $ucs_percase = $ucs->ucs * $request->input('stock');
                    UCS::where('product_id',$inventory->product_id)->update([
                        'ucs' => $ucs_percase,
                        'qty' =>  $request->input('stock'),
                        'ucs_size' => $ucs->ucs,
                    ]);
                    return response()->json(['success' => 'Product Updated successfully.']);
                }
                Inventory::where('product_code' , $inventory->product_code)
                        ->where('isSame', '0')
                        ->where('isRemove', '0')
                        ->update([
                            'stock' => DB::raw ('stock -'. $inventory->qty),
                            'qty' => DB::raw ('qty -'. $inventory->qty),
                            'total_amount_purchase' => DB::raw ('purchase_amount * qty'),
                            'total_profit' => DB::raw ('profit * qty'),
                            'total_price' => DB::raw ('price * qty'),
                    ]);

                    Inventory::find($inventory->id)->update([
                        'category_id' => $request->input('category_id'),
                        'long_description' => $request->input('long_description'),
                        'short_description' => $request->input('short_description'),
                        'product_code' => trim(strtoupper($request->input('product_code'))),
                        'stock' => $request->input('stock'),
                        'qty' => $request->input('stock'),
                        'pqty' => $request->input('stock'),
                        'size_id' => $request->input('size_id'),
                        'expiration' => $request->input('expiration'),
                        'purchase_amount' => $request->input('purchase_amount'),
                        'profit' => $request->input('profit'),
                        'price' => $price,
                        'total_amount_purchase' => $total_amount_purchase,
                        'total_profit' => $total_profit,
                        'total_price' => $total_price,
                        'product_remarks' => $request->input('product_remarks'),
                        'ucs_size' => $ucs->ucs,
                        'isSame' => 0,
                    ]);

                    $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_amount_purchase');
                    $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_profit');
                    $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->sum('total_price');
                    $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_id'))->count();

                    PurchaseOrder::where('purchase_order_number',$request->input('purchase_id'))->update([
                        'total_purchased_order' => $totalpurchasedorder,
                        'total_profit' => $totalprofit,
                        'total_price' => $totalprice,
                        'total_orders' => $products,
                    ]);


                    $ucs_percase = $ucs->ucs * $request->input('stock');
                    UCS::where('product_id',$inventory->product_id)->update([
                        'ucs' => $ucs_percase,
                        'qty' =>  $request->input('stock'),
                        'ucs_size' => $ucs->ucs,
                    ]);
                    return response()->json(['success' => 'Product Updated successfully.']);
        }

           

      
    }

   
    public function destroy(Inventory $inventory)
    {
        
       if($inventory->isSame == 1){
            Inventory::where('product_code' , $inventory->product_code)
                ->where('isSame', '0')
                ->where('isRemove', '0')
                ->update([
                'stock' => DB::raw ('stock -'. $inventory->qty),
                'qty' => DB::raw ('qty -'. $inventory->qty),
                'total_amount_purchase' => DB::raw ('purchase_amount * qty'),
                'total_profit' => DB::raw ('profit * qty'),
                'total_price' => DB::raw ('price * qty'),
            ]);
        }

        Inventory::find($inventory->id)->update([
            'isRemove' => '1',
        ]);

        $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $inventory->purchase_order_number_id)->sum('total_amount_purchase');
        $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $inventory->purchase_order_number_id)->sum('total_profit');
        $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $inventory->purchase_order_number_id)->sum('total_price');
        $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $inventory->purchase_order_number_id)->count();

        PurchaseOrder::where('purchase_order_number',$inventory->purchase_order_number_id)->update([
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
        ]);

        return response()->json(['success' => 'Product Removed Successfully.']);
    }
}
