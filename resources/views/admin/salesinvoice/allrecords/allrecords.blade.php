
<div class="card mt--3">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-md-12">
            <small class="text-uppercase">Filter By: {{$title_filter}}</small> 
            <i id="filter_loading" class="fa fa-spinner fa-spin text-primary ml-2"></i>
            </div>
            <div class="col-xl-12">
                <button id="daily" name="daily" filter="daily" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
                <button id="weekly" name="weekly" filter="weekly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Weekly</button>
                <button id="monthly" name="monthly" filter="monthly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                <button id="yearly" name="yearly" filter="yearly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                <button id="all" name="all" filter="all" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">All</button>
                <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
            </div>
        <div class="col mt-2">
            <h3 class="mb-0 text-uppercase" id="titletable">All Records Sales Invoice</h3> 
        </div>
        <div class="col text-right">
            @can('account_receivable')
                <button type="button"  id="account_receivables" class="text-uppercase btn btn-sm btn-default">Account Receivables</button>
            @endcan
            <button type="button" id="btn_sales_invoice" class="text-uppercase btn_sales_invoice btn btn-sm btn-primary">Sales Invoice</button>
        </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-allrecords display" cellspacing="0" width="100%">
            <thead class="thead-white">
                <tr>
                    <th>Actions</th>
                    <th>ORDER #</th>
                    <th>Customer</th>
                    <th>Assign Deliver</th>
                    <th>Cash</th>
                    <th>Change</th>
                    <th>Payment</th>
                    <th>Total Sales Amt</th>
                    <th>Total Discount</th>
                    <th>Total Return Amt</th>
                    <th>Created By</th>
                    <th>Remarks</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
                @foreach($allrecords as $allrecord)
                    <?php 

                        $total_cost   = $allrecord->sales->sum('total') + $allrecord->pallets->sum('amount');
                        $total_return = $allrecord->returns->sum('amount') + $allrecord->pallets_returns->sum('amount');

                        $payment = $total_cost - $total_return;
                        $change  =  $allrecord->cash  - $payment;

                    ?>
                    <tr data-entry-id="{{ $allrecord->id ?? '' }}">
                        <td>
                            @can('void_sales_invoice')
                                <button type="button" name="void"  void="{{  $allrecord->id ?? '' }}" class="text-uppercase void btn btn-danger btn-sm">Void</button>
                            @endcan
                            <button type="button" name="sales_receipt"  sales_receipt="{{  $allrecord->salesinvoice_id ?? '' }}" class="text-uppercase sales_receipt btn btn-success btn-sm">RECEIPT</button>
                            @can('update_sales_invoice')
                                <button type="button" name="view"  view="{{  $allrecord->id ?? '' }}" class="text-uppercase view btn btn-info btn-sm">View/Edit</button>
                            @endcan
                        </td>
                        <td>
                            {{ $allrecord->salesinvoice_id  ?? '' }}
                        </td>
                        <td>
                            {{ $allrecord->customer->customer_name  ?? '' }}
                        </td>
                        <td>
                            {{ $allrecord->deliver->title  ?? '' }}
                        </td>
                        
                        <td>
                            {{  number_format($allrecord->cash , 2, '.', ',') }}
                        </td>
                        <td>
                            {{  number_format($change , 2, '.', ',') }}
                        </td>
                        <td>
                            {{  number_format($payment , 2, '.', ',') }}
                        </td>
                        <td>
                            {{  number_format($total_cost , 2, '.', ',') }}
                        </td>
                        <td>
                            ({{  number_format($allrecord->sales->sum('discounted') , 2, '.', ',') }})
                        </td>
                        <td>
                            ({{  number_format($total_return , 2, '.', ',') }})
                        </td>
                        <td>
                            {{  $allrecord->user->name ?? '' }}
                        </td>
                        <td>
                            {{ $allrecord->remarks  ?? '' }}
                        </td>
                        <td>
                            {{ $allrecord->created_at->format('F d,Y h:i A') }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>







<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-allrecords:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    $('#filter_loading').hide();
});
</script>