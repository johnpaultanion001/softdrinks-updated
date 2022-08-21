
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>


<!-- Page content -->
<div class="card mt--6">
          <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-md-12">
                  <small class="text-uppercase">Filter By: {{$title_filter}} </small> 
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
                <h3 class="mb-0 text-uppercase" id="titletable">Receiving Goods</h3>
              </div>
              <div class="col text-right">
                <button type="button" id="btn_delivery_report" class="text-uppercase btn btn-sm btn-default mt-2 ">Delivery Report</button>
                @can('account_payables')
                  <button type="button" id="account_payable" class="text-uppercase btn btn-sm btn-default mt-2 ">Account Payables</button>
                @endcan
                <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary mt-2 ">Insert Receiving Goods</button>
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
                  <th scope="col">Driver/Plate #</th>
                  <th scope="col">Supplier Code/Name</th>
                  <th scope="col">Cash</th>
                  <th scope="col">Change</th>
                  <th scope="col">Payment</th>
                  <th scope="col">Total Product Cost</th>
                  <th scope="col">Total Return Amount</th>
                  <th scope="col">Created By</th>
                  <th scope="col">Remarks</th>
                  <th scope="col">Created At</th>
                </tr>
              </thead>
              <tbody class="text-uppercase font-weight-bold">
                @foreach($orders as $key => $order)
                      <?php 
                        $total_cost = $order->products->sum('total_cost') + $order->pallets->sum('amount');
                        $total_return = $order->returns->sum('amount') + $order->pallets_returns->sum('amount');
                
                        $payment = $total_cost - $total_return;
                        $change  =  $order->cash1 - $payment;
                      ?>
                      <tr data-entry-id="{{ $order->id ?? '' }}">
                        <td>
                        @can('void_receiving_goods')
                          <button type="button"  void="{{  $order->id ?? '' }}" class="void text-uppercase btn btn-danger btn-sm">Void</button>
                        @endcan
                        @can('update_receiving_goods')
                          <button type="button"  edit_rg="{{  $order->id ?? '' }}" class="edit_rg text-uppercase btn btn-info btn-sm">View/Edit</button>
                        @endcan
                          </td>
                          <td>
                              {{  $order->id ?? '' }}
                          </td>
                          <td>
                              {{  $order->name_of_a_driver ?? '' }} / {{  $order->plate_number ?? '' }}
                          </td>
                          <td>
                            {{  $order->supplier->id ?? '' }} / {{  $order->supplier->name ?? '' }}
                          </td>
                          <td>
                            {{ number_format($order->cash1 ?? '' , 2, '.', ',') }}
                          </td>
                          <td>
                            {{ number_format($change ?? '' , 2, '.', ',') }}
                          </td>
                          <td>
                            {{ number_format($payment ?? '' , 2, '.', ',') }}
                          </td>
                          <td>
                              {{ number_format($total_cost ?? '' , 2, '.', ',') }}
                          </td>
                          <td>
                              ({{ number_format($total_return ?? '' , 2, '.', ',') }})
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
              <tfoot class="thead-white">
                <tr>
                  <th scope="col">TOTAL:</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col">Cash</th>
                  <th scope="col"></th>
                  <th scope="col">Payment</th>
                  <th scope="col">Total Product Cost</th>
                  <th scope="col">Total Return Amount</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </tfoot>
            </table>
          </div>
      <!-- Footer -->
      @section('footer')
          @include('../partials.footer')
      @endsection
</div>


<script>
$(function () {
 
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
    $.extend(true, $.fn.dataTable.defaults, {
      pageLength: 100,
      bDestroy: true,
      responsive: true,
      scrollY: 500,
      scrollCollapse: true,
      'columnDefs': [{ 'orderable': false, 'targets': 0 }],
    });

    number_format = function (number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }

    $('.datatable-inventries').DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            cash = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            payment = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_cost = api
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_return = api
                .column(8)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            

            // Update footer
            $(api.column(4).footer()).html(number_format(cash, 2,'.', ','));
            $(api.column(6).footer()).html(number_format(payment, 2,'.', ','));
            $(api.column(7).footer()).html(number_format(total_cost, 2,'.', ','));
            $(api.column(8).footer()).html(number_format(total_return, 2,'.', ','));
            
            
        },
    });

  $('#filter_loading').hide();
});


</script>