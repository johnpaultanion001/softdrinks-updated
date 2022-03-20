<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesInventory;
use App\Models\Category;
use Validator;
use App\Models\Order;
use App\Models\Sales;
use App\Models\SalesReturn;
use App\Models\SalesInvoice;
use Carbon\Carbon;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function dashboard(){

      return view('admin.dashboard');

    }
    public function loaddashboard(){
      date_default_timezone_set('Asia/Manila');

      $allproducts = SalesInventory::latest()->where('isRemove', 0)->where('isComplete', 1)->get();
      $productsmonthly = SalesInventory::whereMonth('created_at', '=', date('m'))->where('isRemove', 0)->where('isComplete', 1)->get();


      $salesmonthly = Sales::whereMonth('created_at', '=', date('m'))->get();

      $allprofit = Sales::all();
      $profitmonthly = Sales::whereMonth('created_at', '=', date('m'))->get(); 
      
      $newproduct = SalesInventory::latest()->where('isRemove', 0)->where('isComplete', 1)->paginate(5);
     

      if(auth()->user()->roles()->pluck('id')->implode(', ') == '1'){
        $sales = Sales::latest()->whereDate('created_at', Carbon::today())->latest()->get();
        $returns = SalesReturn::latest()->whereDate('created_at', Carbon::today())->where('isComplete', true)->get();
      }else{
        $sales = Sales::latest()->whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->get();
        $returns = SalesReturn::latest()->whereDate('created_at', Carbon::today())->where('user_id', auth()->user()->id)->where('isComplete', true)->get();
      }

      
      return view('admin.loaddashboard', compact('allproducts', 'productsmonthly' , 'salesmonthly', 'allprofit','profitmonthly', 'newproduct','sales','returns'));
    }

}
