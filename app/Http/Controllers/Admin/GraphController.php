<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Sales;
use Gate;
use DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class GraphController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('graph_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $settings1 = [
            'chart_title'           => 'Sales by Date',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Sales',
            'conditions'            => [
                ['name' => 'Profit', 'condition' => 'status = 0', 'color' => 'orange' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'profit',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];


        $chart1 = new LaravelChart($settings1);
        return view('admin.graph.graph', compact('chart1'));
    }

    public function daily()
    {
        $settings1 = [
            'chart_title'           => 'Sales by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Sales',
            'conditions'            => [
                ['name' => 'Profit', 'condition' => 'status = 0', 'color' => 'orange' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'profit',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];

        $settings2 = [
            'chart_title'           => 'Sold by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Sales',
            'conditions'            => [
                ['name' => 'Sold', 'condition' => 'status = 0', 'color' => 'red' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'purchase_qty',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];

        $settings3 = [
            'chart_title'           => 'UCS by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\UCS',
            'conditions'            => [
                ['name' => 'UCS', 'condition' => 'isComplete = true', 'color' => 'blue' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'ucs',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];


        $chart1 = new LaravelChart($settings1);
        $chart2 = new LaravelChart($settings2);
        $chart3 = new LaravelChart($settings3);

        return view('admin.graph.loadgraph', compact('chart1','chart2','chart3'));
    }

    public function monthly()
    {
        $settings1 = [
            'chart_title'           => 'Sales by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Sales',
            'conditions'            => [
                ['name' => 'Profit', 'condition' => 'status = 0', 'color' => 'orange' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'profit',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];

        $settings2 = [
            'chart_title'           => 'Sold by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Sales',
            'conditions'            => [
                ['name' => 'Sold', 'condition' => 'status = 0', 'color' => 'red' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'purchase_qty',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];

        $settings3 = [
            'chart_title'           => 'UCS by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\UCS',
            'conditions'            => [
                ['name' => 'UCS', 'condition' => 'isComplete = true', 'color' => 'blue' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'ucs',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];

        $chart1 = new LaravelChart($settings1);
        $chart2 = new LaravelChart($settings2);
        $chart3 = new LaravelChart($settings3);

        return view('admin.graph.loadgraph', compact('chart1','chart2','chart3'));
    }

    public function yearly()
    {
        $settings1 = [
            'chart_title'           => 'Sales by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Sales',
            'conditions'            => [
                ['name' => 'Profit', 'condition' => 'status = 0', 'color' => 'orange' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'profit',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];
        $settings2 = [
            'chart_title'           => 'Sold by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Sales',
            'conditions'            => [
                ['name' => 'Sold', 'condition' => 'status = 0', 'color' => 'red' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'purchase_qty',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];

        $settings3 = [
            'chart_title'           => 'UCS by Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\UCS',
            'conditions'            => [
                ['name' => 'UCS', 'condition' => 'isComplete = true', 'color' => 'blue' , 'fill' => true],
               
            ],
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'ucs',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'entries_number'        => '5',
        ];

        $chart1 = new LaravelChart($settings1);
        $chart2 = new LaravelChart($settings2);
        $chart3 = new LaravelChart($settings3);

        return view('admin.graph.loadgraph', compact('chart1','chart2','chart3'));
    }
}
