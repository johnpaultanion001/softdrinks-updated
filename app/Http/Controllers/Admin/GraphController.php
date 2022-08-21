<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Sales;
use App\Models\UCS;
use App\Models\ReceivingProduct;
use Gate;
use DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class GraphController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('graph_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.graph.graph');
    }

    public function daily()
    {
         //DAILY
         date_default_timezone_set('Asia/Manila');
         $sales_record = Sales::select(
             \DB::raw("SUM(profit) - SUM(discounted) as profit"),
             \DB::raw("SUM(total) as sales"),
             \DB::raw("DAYNAME(created_at) as day_name"),
             \DB::raw("DAY(created_at) as day"),
             \DB::raw("SUM(purchase_qty) as sold"))
             ->where('created_at', '>', Carbon::today()->subDay(6))
             ->where('status' , 0)
             ->groupBy('day_name','day')
             ->orderBy('day')
             ->get();
         
         $ucs_record = UCS::select(
                 'created_at',
                 \DB::raw("SUM(ucs) as total_ucs"),
                 \DB::raw("DAYNAME(created_at) as day_name"),
                 \DB::raw("DAY(created_at) as day"))
                 ->where('created_at', '>', Carbon::today()->subDay(6))
                 ->where('isComplete' , true)
                 ->groupBy('day_name','day')
                 ->orderBy('day')
                 ->get();
        
 
 
          $profit_data = [];
          $sold_data = [];
          $ucs_data = [];
      
         foreach($sales_record as $row) {
             $total = $row->profit / $row->sales;
             $persentage = $total * 100;
             
             $profit_data['label'][] = $row->day_name;
             $profit_data['data'][] =  number_format($persentage, 2, '.', ',');
 
             $sold_data['label'][] = $row->day_name;
             $sold_data['data'][] =  $row->sold;
         }
         
         foreach($ucs_record as $row) {
 
             $total_cost = ReceivingProduct::whereDate('created_at', $row->created_at)
                                             ->whereIn('supplier_id', [1,2,3])
                                             ->sum('total_cost');
             $p = $total_cost / $row->total_ucs;
 
             $ucs_data['label'][] = $row->day_name;
             $ucs_data['data'][] =  number_format($p, 2, '.', ',');
         }
         
         
      
         $profit = json_encode($profit_data);
         $sold = json_encode($sold_data);
         $ucs = json_encode($ucs_data);
 
         return view('admin.graph.loadgraph', compact('profit','sold','ucs'));

       

       
    }

    public function monthly()
    {
        //MONTHLY
        date_default_timezone_set('Asia/Manila');
        $sales_record = Sales::select(
            \DB::raw("SUM(profit) - SUM(discounted) as profit"),
            \DB::raw("SUM(total) as sales"),
            \DB::raw("SUM(purchase_qty) as sold"),
            \DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
            \DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->where('status' , 0)
            ->groupby('year','month')
            ->orderBy('year')
            ->get();
        
        $ucs_record = UCS::select(
                'created_at',
                \DB::raw("SUM(ucs) as total_ucs"),
                
                \DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
                \DB::raw('YEAR(created_at) year, MONTH(created_at) month'))

                ->where('isComplete' , true)
                ->groupby('year','month')
                ->orderBy('year')
                ->get();
       


         $profit_data = [];
         $sold_data = [];
         $ucs_data = [];
     
        foreach($sales_record as $row) {
            $total = $row->profit / $row->sales;
            $persentage = $total * 100;
         
            
            $profit_data['label'][] = $row->new_date;
            $profit_data['data'][] =  number_format($persentage, 2, '.', ',');

            $sold_data['label'][] = $row->new_date;
            $sold_data['data'][] =  $row->sold;
        }
        
        foreach($ucs_record as $row) {

            $total_cost = ReceivingProduct::whereMonth('created_at', $row->created_at)
                                            ->whereIn('supplier_id', [1,2,3])
                                            ->sum('total_cost');
            $p = $total_cost / $row->total_ucs;

            $ucs_data['label'][] = $row->new_date;
            $ucs_data['data'][] =  number_format($p, 2, '.', ',');
        }
        
        
     
        $profit = json_encode($profit_data);
        $sold = json_encode($sold_data);
        $ucs = json_encode($ucs_data);

        return view('admin.graph.loadgraph', compact('profit','sold','ucs'));
    }

    public function yearly()
    {
        //YEARLY
        date_default_timezone_set('Asia/Manila');
        $sales_record = Sales::select(
            \DB::raw("SUM(profit) - SUM(discounted) as profit"),
            \DB::raw("SUM(total) as sales"),
            \DB::raw("SUM(purchase_qty) as sold"),
            \DB::raw("DATE_FORMAT(created_at, '%Y') new_date"),
            \DB::raw('YEAR(created_at) year'))
            ->where('status' , 0)
            ->groupby('year')
            ->orderBy('year')
            ->get();
        
        $ucs_record = UCS::select(
                'created_at',
                \DB::raw("SUM(ucs) as total_ucs"),
                
                \DB::raw("DATE_FORMAT(created_at, '%Y') new_date"),
                \DB::raw('YEAR(created_at) year'))

                ->where('isComplete' , true)
                ->groupby('year')
                ->orderBy('year')
                ->get();
       


         $profit_data = [];
         $sold_data = [];
         $ucs_data = [];
     
        foreach($sales_record as $row) {
            $total = $row->profit / $row->sales;
            $persentage = $total * 100;
         
            
            $profit_data['label'][] = $row->new_date;
            $profit_data['data'][] =  number_format($persentage, 2, '.', ',');

            $sold_data['label'][] = $row->new_date;
            $sold_data['data'][] =  $row->sold;
        }
        
        foreach($ucs_record as $row) {

            $total_cost = ReceivingProduct::whereYear('created_at', $row->created_at)
                                            ->whereIn('supplier_id', [1,2,3])
                                            ->sum('total_cost');
            $p = $total_cost / $row->total_ucs;

            $ucs_data['label'][] = $row->new_date;
            $ucs_data['data'][] =  number_format($p, 2, '.', ',');
        }
        
        
     
        $profit = json_encode($profit_data);
        $sold = json_encode($sold_data);
        $ucs = json_encode($ucs_data);

        return view('admin.graph.loadgraph', compact('profit','sold','ucs'));
    }

    public function sample_graph(){
        //DAILY
        date_default_timezone_set('Asia/Manila');
        $sales_record = Sales::select(
            \DB::raw("SUM(profit) - SUM(discounted) as profit"),
            \DB::raw("SUM(total) as sales"),
            \DB::raw("DAYNAME(created_at) as day_name"),
            \DB::raw("DAY(created_at) as day"),
            \DB::raw("SUM(purchase_qty) as sold"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->where('status' , 0)
            ->groupBy('day_name','day')
            ->orderBy('day')
            ->get();
        
        $ucs_record = UCS::select(
                'created_at',
                \DB::raw("SUM(ucs) as total_ucs"),
                \DB::raw("DAYNAME(created_at) as day_name"),
                \DB::raw("DAY(created_at) as day"))
                ->where('created_at', '>', Carbon::today()->subDay(6))
                ->where('isComplete' , true)
                ->groupBy('day_name','day')
                ->orderBy('day')
                ->get();
       


         $profit_data = [];
         $sold_data = [];
         $ucs_data = [];
     
        foreach($sales_record as $row) {
            $total = $row->profit / $row->sales;
            $persentage = $total * 100;
            
            $profit_data['label'][] = $row->day_name;
            $profit_data['data'][] =  number_format($persentage, 2, '.', ',');

            $sold_data['label'][] = $row->day_name;
            $sold_data['data'][] =  $row->sold;
        }
        
        foreach($ucs_record as $row) {

            $total_cost = ReceivingProduct::whereDate('created_at', $row->created_at)
                                            ->whereIn('supplier_id', [1,2,3])
                                            ->sum('total_cost');
            $p = $total_cost / $row->total_ucs;

            $ucs_data['label'][] = $row->day_name;
            $ucs_data['data'][] =  number_format($p, 2, '.', ',');
        }
        
        
     
        $profit = json_encode($profit_data);
        $sold = json_encode($sold_data);
        $ucs = json_encode($ucs_data);

        return view('admin.graph.loadgraph', compact('profit','sold','ucs'));
    }
       
}
