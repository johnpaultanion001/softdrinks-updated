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
            'qty' => ['required' ,'integer','min:1'],
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

        $price =  $request->input('unit_cost') + $request->input('regular_discount') + $request->input('hauling_discount');
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

                'stock' => $request->input('qty'),
                'qty' => $request->input('qty'),

                'size_id' => $request->input('size_id'),
                'expiration' => $request->input('expiration'),

                'unit_cost' => $request->input('unit_cost'),
                'price' => $price,
                'total_cost' => $total_cost ,
                'regular_discount' => $request->input('regular_discount'),
                'hauling_discount' => $request->input('hauling_discount'),

                'product_remarks' => $request->input('product_remarks'),
            ]
        );

        $ucs = Size::where('id', $request->input('size_id'))->first();
        $ucs_percase = $ucs->ucs * $request->input('qty');

        UCS::updateOrCreate(
            [
                'receiving_good_id' => $receiving_good_id,
                'product_id' => $product->id,
            ],
            [
                'receiving_good_id' => $receiving_good_id,
                'product_id' => $product->id,
                'ucs' => $ucs_percase,
                'qty' => $product->qty,
                'ucs_size' => $ucs->ucs,
            ]
        );
        return response()->json(['success' => 'Product Added Successfully.']);

    }

   
    public function show(SalesInventory $sales_inventory)
    {
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        return view('admin.salesinvoice.product_sales_modal.viewmodal', compact('sales_inventory','pricetypes'));
    }

    
    public function edit(SalesInventory $sales_inventory)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $sales_inventory]);
        }
    }

    
    public function update(Request $request, SalesInventory $sales_inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'category_id' => ['required'],
            'description' => ['required'],
            'product_code' => ['required', 'string', 'max:255'],
            'qty' => ['required' ,'integer','min:1'],
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

        $price =  $request->input('unit_cost') + $request->input('regular_discount') + $request->input('hauling_discount');
        $cost =  $request->input('unit_cost') - $request->input('regular_discount') - $request->input('hauling_discount');
        $total_cost = $request->input('qty') * $cost;

        $product = SalesInventory::find($sales_inventory->id)->update(
            [
                'product_code' => trim(strtoupper($request->input('product_code'))),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
    
                'stock' => $request->input('qty'),
                'qty' => $request->input('qty'),

                'size_id' => $request->input('size_id'),
                'expiration' => $request->input('expiration'),

                'unit_cost' => $request->input('unit_cost'),
                'price' => $price,
                'total_cost' => $total_cost ,
                'regular_discount' => $request->input('regular_discount'),
                'hauling_discount' => $request->input('hauling_discount'),

                'product_remarks' => $request->input('product_remarks'),
            ]
        );

        $ucs = Size::where('id', $request->input('size_id'))->first();
        $ucs_percase = $ucs->ucs * $request->input('qty');

        UCS::where('product_id', $sales_inventory->id)->update([
                'ucs' => $ucs_percase,
                'qty' => $request->input('qty'),
                'ucs_size' => $ucs->ucs,
            ]
        );
        return response()->json(['success' => 'Product Updated Successfully.']);
    }

    
    public function destroy(SalesInventory $sales_inventory)
    {
        UCS::where('product_id', $sales_inventory->id)->delete();
        return response()->json(['success' => 'Product Removed Successfully.' , $sales_inventory->delete()]);
    }
}
