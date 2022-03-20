
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
              <h3 class="mb-0 text-uppercase" id="titletable">Returned Products</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-returned display" cellspacing="0" width="100%">
            <thead class="thead-light">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Purchase Order Number</th>
                <th scope="col">Supplier</th>
                <th scope="col">Date Of Purchase</th>
                <th scope="col">Total Products Returned</th>
                <th scope="col">Total Case Returned</th>
                <th scope="col">Total Deposit</th>
                <th scope="col">Created By</th>
                <th scope="col">Date Returned</th>

               
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($returned as $key => $return)
                    <tr data-entry-id="{{ $return->id ?? '' }}">
                      <td>
                          <button type="button" name="view" view="{{  $return->id ?? '' }}"  class="view text-uppercase btn btn-warning btn-sm">View</button>
                          <button type="button" name="edit" edit="{{  $return->id ?? '' }}" purchaseid="{{  $return->purchase_order_number_id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                          <button type="button" name="remove" remove="{{  $return->id ?? '' }}" id="{{  $return->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                      </td>
                      <td>
                          {{  $return->purchase_order_number_id ?? '' }}
                      </td>
                      <td>
                          {{  $return->purchase_order->supplier->name ?? '' }}
                      </td>
                      <td>
                          {{  $return->purchase_order->created_at->format('F d,Y h:i A') ?? '' }}
                      </td>
                      <td>
                          {{  $return->total_orders_returned ?? '' }}
                      </td>              
                      <td>
                          {{  number_format($return->total_case_return , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($return->total_deposit , 0, ',', ',') }}
                      </td>
                      <td>
                          {{  $return->user->name ?? '' }}
                      </td>
                      <td>
                          {{ $return->created_at->format('F d,Y h:i A') }}
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

  $('.datatable-returned:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>