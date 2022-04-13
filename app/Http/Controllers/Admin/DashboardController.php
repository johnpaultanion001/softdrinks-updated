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
    
      $sales = Sales::latest()->whereDate('created_at', Carbon::today())->latest()->get();
      $returns = SalesReturn::latest()->whereDate('created_at', Carbon::today())->where('isComplete', true)->get();
    

      
      return view('admin.loaddashboard', compact('allproducts', 'productsmonthly' , 'salesmonthly', 'allprofit','profitmonthly','sales','returns'));
    }

}
