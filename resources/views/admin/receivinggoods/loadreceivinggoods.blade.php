
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
              <div class="col-md-12">
                <small class="text-uppercase">Filter By: {{$title_filter}} </small> 
                <i id="filter_loading" class="fa fa-spinner fa-spin text-primary ml-2"></i>
              </div>
              <div class="col-xl-12">
                    <button id="daily" name="daily" filter="daily" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
                    <button id="monthly" name="monthly" filter="monthly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                    <button id="yearly" name="yearly" filter="yearly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                    <button id="all" name="all" filter="all" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">All</button>
                    <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
              </div>
            <div class="col mt-2">
              <h3 class="mb-0 text-uppercase" id="titletable">Receiving Goods</h3>
            </div>
            <div class="col text-right">
              <button type="button" id="account_payable" class="text-uppercase btn btn-sm btn-primary">Account Payables</button>
              <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">Insert Receiving Goods</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Receiving Goods ID</th>
                <th scope="col">Supplier Code/Name</th>
                <th scope="col">Driver/Plate #</th>
                <th scope="col">Product Count</th>
                <th scope="col">Return Count</th>
                <th scope="col">Overall Product Cost</th>
                <th scope="col">Overall Return Amount</th>
                <th scope="col">Payment</th>
                <th scope="col">Created By</th>
                <th scope="col">Remarks</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($orders as $key => $order)
                <?php $payment =  $order->products->sum('total_cost') - $order->returns->sum('amount') ?>
                    <tr data-entry-id="{{ $order->id ?? '' }}">
                       <td>
                            <button type="button"  edit_rg="{{  $order->id ?? '' }}" class="edit_rg text-uppercase btn btn-info btn-sm">View/Edit</button>
                        </td>
                        <td>
                            {{  $order->id ?? '' }}
                        </td>
                        <td>
                           {{  $order->supplier->id ?? '' }} / {{  $order->supplier->name ?? '' }}
                        </td>
                        <td>
                            {{  $order->name_of_a_driver ?? '' }} / {{  $order->plate_number ?? '' }}
                        </td>
                        <td>
                            {{  $order->products->count() ?? '' }}
                        </td>
                        <td>
                            {{  $order->returns->count() ?? '' }}
                        </td>
                        <td>
                            {{ number_format($order->products->sum('total_cost') ?? '' , 2, '.', ',') }}
                        </td>
                        <td>
                            ({{ number_format($order->returns->sum('amount') ?? '' , 2, '.', ',') }})
                        </td>
                        <td>
                          {{ number_format($payment ?? '' , 2, '.', ',') }}
                        </td>
                        <td>
                            {{  $order->user->name ?? '' }}
                        </td>
                        <td>
                            {{  $order->remarks ?? '' }}
                        </td>
                        <td>
                          {{ $order->created_at->format('M j , Y h:i A') }}
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
  </div>
</div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-inventries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
  $('#filter_loading').hide();
});


</script>