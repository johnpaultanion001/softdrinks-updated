
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
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Receiving Goods</h3>
            </div>
            <div class="col text-right">
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
                <th scope="col">Doc No.</th>
                <th scope="col">Po No.</th>
                <th scope="col">Po Date</th>
                <th scope="col">Entry Date</th>
                <th scope="col">Location Code/Name</th>
                <th scope="col">Supplier Code/Name</th>
                <th scope="col">Name of a Driver</th>
                <th scope="col">Plate Number</th>

                <th scope="col">Trade Discount</th>
                <th scope="col">Terms Discount</th>
                <th scope="col">Reference</th>

                <th scope="col">Product Count</th>
                <th scope="col">Total Overall Cost</th>
                <th scope="col">Total Overall Profit</th>
                <th scope="col">Total Overall Sales</th>
                <th scope="col">Vat Amount</th>

                <th scope="col">Created By</th>
                <th scope="col">Remarks</th>
                <th scope="col">Last Update</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($orders as $key => $order)
                    <tr data-entry-id="{{ $order->id ?? '' }}">
                       <td>
                            <button type="button" name="view" view="{{  $order->id ?? '' }}" class="view text-uppercase btn btn-warning btn-sm">View</button>
                            
                            @if ($order->isReturn == 0)
                            <a href="{{ route('admin.purchase-order.edit', $order->id) }}"  class="text-uppercase btn btn-info btn-sm">Edit</a>
                         
                            @elseif ($order->isReturn == 1)

                            @endif
                            
                        </td>
                        <td>
                            {{  $order->purchase_order_number ?? '' }}
                        </td>
                        <td>
                            {{  $order->doc_no ?? '' }}
                        </td>
                        <td>
                            {{  $order->po_no ?? '' }}
                        </td>
                        <td>
                            {{  $order->po_date ?? '' }}
                        </td>
                        <td>
                            {{  $order->entry_date ?? '' }}
                        </td>
                        <td>
                            {{  $order->location->id ?? '' }} / {{  $order->location->location_name ?? '' }}
                        </td>
                        <td>
                           {{  $order->supplier->id ?? '' }} / {{  $order->supplier->name ?? '' }}
                        </td>
                        <td>
                            {{  $order->name_of_a_driver ?? '' }}
                        </td>
                        <td>
                            {{  $order->plate_number ?? '' }}
                        </td>
                        <td>
                            {{  $order->trade_discount ?? '' }}
                        </td>
                        <td>
                            {{  $order->terms_discount ?? '' }}
                        </td>
                        <td>
                            {{  $order->reference ?? '' }}
                        </td>
                        <td>
                            {{  $order->total_orders ?? '' }}
                        </td>
                        <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->total_purchased_order ?? '' , 2, '.', ',') }}
                        </td>
                        <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->total_profit ?? '' , 2, '.', ',') }}
                        </td>
                        <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->total_price ?? '' , 2, '.', ',') }}
                        </td>
                        <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> 0
                        </td>
                        <td>
                            {{  $order->user->name ?? '' }}
                        </td>
                        <td>
                            {{  $order->remarks ?? '' }}
                        </td>
                        <td>
                          {{ $order->updated_at->format('F d,Y h:i A') }}
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-inventries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});


</script>