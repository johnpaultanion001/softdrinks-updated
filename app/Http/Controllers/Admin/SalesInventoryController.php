<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SalesInventory;
use App\Models\UCS;
use App\Models\Size;
use App\Models\ReceivingGood;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\Location;
use App\Models\PriceType;
use App\Models\ReceivingProduct;
use App\Models\LocationProduct;



class SalesInventoryController extends Controller
{

    function autocomplete(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = SalesInventory::where('isComplete', true)->where('isRemove', false)->where('product_code', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute; margin-top: -20px; margin-left: 12px;">';
            foreach($data as $row)
            {
                $output .= '
                <li><a class="dropdown-item" href="#" class="text-dark">'.$row->product_code.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    function autocompleteresult(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = SalesInventory::where('isComplete', true)->where('isRemove', false)->where('product_code', 'LIKE', "%{$query}%")->get();
           
            foreach($data as $row)
            {
                return response()->json(['result' => $row , 'inventory_id' => $row->id]);
            }
        
        }
    }
   
    
    public function index()
    {
        abort_if(Gate::denies('sales_inventory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();

        return view('admin.salesinventories.inventories',compact('categories', 'sizes' ,'locations'  ,'suppliers'));
    }

    public function load()
    {
        $products = SalesInventory::where('isComplete', true)->where('isRemove', false)->latest()->get();
        return view('admin.salesinventories.loadinventories',compact('products'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'category_id' => ['required'],
            'description' => ['required'],
            'product_code' => ['required', 'string', 'max:255'],
            'qty' => ['required' ,'numeric','min:0'],
            'size_id' => ['required'],
            'expiration' => ['nullable','date','after:today'],
            'unit_cost' => ['required' ,'numeric','min:0'],
            'regular_discount' => ['required' ,'numeric','min:0'],
            'hauling_discount' => ['required' ,'numeric','min:0'],
            'product_remarks' => ['nullable'],  
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        
        $cost =  $request->input('unit_cost') - $request->input('regular_discount') - $request->input('hauling_discount');
        $total_cost = $request->input('qty') * $cost;

        $goods_id = ReceivingGood::orderby('id', 'desc')->first();
        if($goods_id == null){
            $receiving_good_id = 1;
        }else{
            $receiving_good_id = $goods_id->id + 1;
        }
       
        $product = SalesInventory::updateOrCreate(
                [
                    'isComplete'   => false,
                    'product_code' => trim(strtoupper($request->input('product_code'))),
                ],
                [
                'receiving_good_id' => $receiving_good_id,

                'product_code' => trim(strtoupper($request->input('product_code'))),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),

                'qty' => $request->input('qty'),

                'size_id' => $request->input('size_id'),
                'expiration' => $request->input('expiration'),

                'unit_cost' => $request->input('unit_cost'),
                'price' => $request->input('unit_cost'),
                'total_cost' => $total_cost ,
                'regular_discount' => $request->input('regular_discount'),
                'hauling_discount' => $request->input('hauling_discount'),

                'product_remarks' => $request->input('product_remarks'),
            ]
        );

        
      
        return response()->json(['success' => 'Product Added Successfully.']);

    }

   
    public function show(SalesInventory $sales_inventory)
    {
        $pricetypes = PriceType::where('isRemove', '0')->orderBy('id','asc')->get();
        return view('admin.salesinvoice.product_sales_modal.viewmodal', compact('sales_inventory','pricetypes'));
    }

    
    public function edit(SalesInventory $sales_inventory)
    {
        if (request()->ajax()) {
            return response()->json(
                [
                    'result' => $sales_inventory , 
                ]
            );
        }
    }


    
    public function update(Request $request, SalesInventory $sales_inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'category_id' => ['required'],
            'description' => ['required'],
            'product_code' => ['required', 'string', 'max:255'],
            'qty' => ['required' ,'numeric','min:0'],
            'size_id' => ['required'],
            'expiration' => ['nullable','date','after:today'],
            'unit_cost' => ['required' ,'numeric','min:0'],
            'regular_discount' => ['required' ,'numeric','min:0'],
            'hauling_discount' => ['required' ,'numeric','min:0'],
            'product_remarks' => ['nullable'],  
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        
        $cost =  $request->input('unit_cost') - $request->input('regular_discount') - $request->input('hauling_discount');
        $total_cost = $request->input('qty') * $cost;

        $product = SalesInventory::find($sales_inventory->id)->update(
            [
                'product_code' => trim(strtoupper($request->input('product_code'))),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),

                'qty' => $request->input('qty'),

                'size_id' => $request->input('size_id'),
                'expiration' => $request->input('expiration'),

                'unit_cost' => $request->input('unit_cost'),
                'price' =>  $request->input('unit_cost'),
                'total_cost' => $total_cost ,
                'regular_discount' => $request->input('regular_discount'),
                'hauling_discount' => $request->input('hauling_discount'),

                'product_remarks' => $request->input('product_remarks'),
            ]
        );
        
        return response()->json(['success' => 'Product Updated Successfully.']);
    }

    
    public function destroy(Request $request,$sales_inventory)
    {
        $rg_id = $request->get('rg_id');
        if($rg_id == ""){
            SalesInventory::find($sales_inventory)->delete();
        }else{
            $rp = ReceivingProduct::find($sales_inventory);
            
            LocationProduct::where('product_id', $rp->product_id)
                                ->where('location_id',$rp->location_id)
                                ->decrement('stock', $rp->qty);

            UCS::where('product_id', $rp->id)->where('receiving_good_id', $rp->receiving_good_id)->delete();
            
            $rp->delete();
        }

        return response()->json(['success' => 'Product Removed Successfully.']);
    }

    public function size_status(Request $request) {
        $status = $request->get('status');
        if($status == "clear"){
            $get_status = Size::where('isRemove', 0)->latest()->get();
        }else{
            $get_status = Size::where('status', $status)->where('isRemove', 0)->latest()->get();
        }
        
        return response()->json(['result' => $get_status]);
    }

    public function edit_view(SalesInventory $sales_inventory){
      
        if (request()->ajax()) {
            return response()->json(
                [
                    'result'         => $sales_inventory,
                    'size'           => $sales_inventory->size->size,
                    'category'       => $sales_inventory->category->name,
                    'supplier'       => $sales_inventory->supplier->name,
                    'created_by'     => $sales_inventory->receiving_good->user->name,
                    'created_date'   => $sales_inventory->created_at->format('F d,Y h:i A'),
                    'unit_price'     => '₱ ' . number_format($sales_inventory->price , 2, '.', ','),
                    'stock'          => $sales_inventory->location_products->sum('stock'),
                ]
            );
        }
    }
    public function stock_history(SalesInventory $sales_inventory){
        $stock_history = $sales_inventory->stock_histories()->latest()->get();
        return view('admin.salesinventories.histories.stock',compact('stock_history'));
    }
    public function sales_history(SalesInventory $sales_inventory){
        $sales_history = $sales_inventory->sales_histories()->latest()->get();
        return view('admin.salesinventories.histories.sales',compact('sales_history'));
    }
    public function location_stocks(SalesInventory $sales_inventory){
        $location_stocks = $sales_inventory->location_products()->orderBy('id', 'asc')->get();
        return view('admin.salesinventories.histories.location_stocks',compact('location_stocks'));
    }

    public function update_ev(Request $request, SalesInventory $sales_inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'expiration' => ['nullable','date','after:today'],
            'unit_cost' => ['required' ,'numeric','min:0'],
            'regular_discount' => ['required' ,'numeric','min:0'],
            'hauling_discount' => ['required' ,'numeric','min:0'],
            'product_remarks' => ['nullable'],  
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        
        
        SalesInventory::find($sales_inventory->id)->update(
            [
                'expiration' => $request->input('expiration'),
                'unit_cost' => $request->input('unit_cost'),
                'price' => $request->input('unit_cost'),
                'regular_discount' => $request->input('regular_discount'),
                'hauling_discount' => $request->input('hauling_discount'),
                'product_remarks' => $request->input('product_remarks'),
            ]
        );
        
        return response()->json([
                'success'        => 'Product Updated Successfully.',
                'unit_price'     => '₱ ' . number_format( $request->input('unit_cost') , 2, '.', ','),
            ]);
    }
}
