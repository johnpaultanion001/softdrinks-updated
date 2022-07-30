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
use App\Models\Deposit;
use App\Models\SalesInvoice;
use App\Models\Customer;
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

      // PRODUCTS
      $allproducts = SalesInventory::latest()->where('isRemove', 0)->where('isComplete', 1)->get();
      $productsmonthly = SalesInventory::whereMonth('created_at', '=', date('m'))->where('isRemove', 0)->where('isComplete', 1)->get();

      $allprofit = Sales::all();
      $profitmonthly = Sales::whereMonth('created_at', '=', date('m'))->get(); 
    
      $sales = Sales::latest()->whereDate('created_at', Carbon::today())->latest()->get();
      $returns = SalesReturn::latest()->whereDate('created_at', Carbon::today())->where('isComplete', true)->get();
      $deposits = Deposit::latest()->whereDate('created_at', Carbon::today())->where('isComplete', true)->get();

      
      //ALL
      $sales_invioce_bal_all =  
                SalesInvoice::where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('new_bal') - 
                SalesInvoice::where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('prev_bal');

      $allsales = Sales::sum('total') + Deposit::where('isComplete', true)->sum('amount');
      $allreturns = SalesReturn::where('isComplete', true)->sum('amount');
      $alltotal_sales = $allsales - $allreturns - $sales_invioce_bal_all;

      
      //Mountly Sales
      $sales_invioce_bal_m =  
                SalesInvoice::whereMonth('created_at', '=', date('m'))
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('new_bal') - 
                SalesInvoice::whereMonth('created_at', '=', date('m'))
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('prev_bal');

      $msales = Sales::whereMonth('created_at', '=', date('m'))->sum('total') + Deposit::whereMonth('created_at', '=', date('m'))->where('isComplete', true)->sum('amount');
      $mreturns = SalesReturn::whereMonth('created_at', '=', date('m'))->where('isComplete', true)->sum('amount');
      $mtotal_sales = $msales - $mreturns - $sales_invioce_bal_m;

      $sales_invioce_bal =  
                SalesInvoice::whereDate('created_at', Carbon::today())
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('new_bal') - 
                SalesInvoice::whereDate('created_at', Carbon::today())
                            ->where('isVoid', false)
                            ->where('isReceivable', true)
                            ->sum('prev_bal');

                         
      $plus_over_payments =  SalesInvoice::whereDate('created_at', Carbon::today())   
                              ->where('isOverPayment', true)
                              ->where('isVoid', false)
                              ->sum('over_payment');

      $minus_over_payments = SalesInvoice::whereDate('created_at', Carbon::today())   
                              ->where('isOverPayment', false)
                              ->where('isVoid', false)
                              ->sum('over_payment');
                            
    
      
      return view('admin.loaddashboard', compact('plus_over_payments','minus_over_payments','sales_invioce_bal','alltotal_sales','mtotal_sales','allproducts', 'productsmonthly' , 'allprofit','profitmonthly','sales','returns','deposits'));
    }

}
