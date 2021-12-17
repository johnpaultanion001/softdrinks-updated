<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesInventory;
use App\Models\Category;
use Validator;
use App\Models\Order;
use App\Models\Sales;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function dashboard(){

      abort_if(Gate::denies('manager_dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      return view('admin.dashboard');

    }
    public function loaddashboard(){
      date_default_timezone_set('Asia/Manila');
      $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
      if($userid == '2'){
        $allproducts = SalesInventory::latest()->where('isRemove', 0)->where('isComplete', 1)->get();
        $productsmonthly = SalesInventory::whereMonth('created_at', '=', date('m'))->where('isRemove', 0)->where('isComplete', 1)->get();

        $outofstock = SalesInventory::where('stock', '0')->where('isRemove', 0)->where('isComplete', 1)->get();
        $outofstockmonthly = SalesInventory::where('stock', '0')->where('isRemove', 0)->where('isComplete', 1)
                                      ->whereMonth('created_at', '=', date('m'))->get();
        $salesmonthly = Sales::where('user_id', $userid)->whereMonth('created_at', '=', date('m'))->get();

        $allprofit = Sales::where('user_id', $userid)->get();
        $profitmonthly = Sales::where('user_id', $userid)->whereMonth('created_at', '=', date('m'))->get(); 
        
        $newproduct = SalesInventory::latest()->where('isRemove', 0)->where('isComplete', 1)->paginate(5);
        $salestoday = Sales::where('user_id', $userid)->whereDay('created_at', '=', date('d'))->get();
        return view('admin.dashboardcashier', compact('allproducts', 'productsmonthly' , 'outofstock', 'outofstockmonthly', 'salesmonthly', 'allprofit','profitmonthly', 'newproduct','salestoday'));
      }

      $allproducts = SalesInventory::latest()->where('isRemove', 0)->where('isComplete', 1)->get();
      $productsmonthly = SalesInventory::whereMonth('created_at', '=', date('m'))->where('isRemove', 0)->where('isComplete', 1)->get();

      $outofstock = SalesInventory::where('stock', '0')->where('isRemove', 0)->where('isComplete', 1)->get();
      $outofstockmonthly = SalesInventory::where('stock', '0')->where('isRemove', 0)->where('isComplete', 1)
                                     ->whereMonth('created_at', '=', date('m'))->get();

      $salesmonthly = Sales::whereMonth('created_at', '=', date('m'))->get();

      $allprofit = Sales::all();
      $profitmonthly = Sales::whereMonth('created_at', '=', date('m'))->get(); 
      
      $newproduct = SalesInventory::latest()->where('isRemove', 0)->where('isComplete', 1)->paginate(5);
      $salestoday = Sales::whereDay('created_at', '=', date('d'))->get();
      return view('admin.loaddashboard', compact('allproducts', 'productsmonthly' , 'outofstock', 'outofstockmonthly', 'salesmonthly', 'allprofit','profitmonthly', 'newproduct','salestoday'));
    }

}
