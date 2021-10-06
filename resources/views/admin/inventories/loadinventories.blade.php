
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Inventories</h3> 
             
            </div>
            <!-- <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="create_record text-uppercase btn btn-sm btn-primary">New Product</button>
            </div> -->
          </div>
        </div>

        <!-- table -->
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Receiving Goods ID</th>
                <th scope="col">Product ID</th>

                <th scope="col">Product Code</th>
                <th scope="col">Long Description</th>
                <th scope="col">Short Description</th>

                <th scope="col">Supplier Code/Name</th>

                <th scope="col">Size</th>
                <th scope="col">Category</th>
                <th scope="col">Location Code/Name</th>
                <th scope="col">Expiration</th>

                <th scope="col">Purchase QTY</th>
                <th scope="col">Stock</th>
                <th scope="col">Sold</th>

                <th scope="col">Unit Cost</th>
                <th scope="col">Unit Profit</th>
                <th scope="col">Unit Sales</th>
                <th scope="col">Total Cost</th>
                <th scope="col">Total Profit</th>
                <th scope="col">Total Sales</th>
                <th scope="col">Remarks</th>
                <th scope="col">Created By</th>
                <th scope="col">Date</th>

              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($inventories as $key => $inventory)
                    <tr data-entry-id="{{ $inventory->id ?? '' }}">
                    
                      <td>
                          <button type="button" name="view" view="{{  $inventory->id ?? '' }}"  class="view text-uppercase btn btn-warning btn-sm">View</button>
                          <!-- @if ($inventory->purchase_order->isReturn == 0)
                              <button type="button" name="edit" edit="{{  $inventory->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                          @elseif ($inventory->purchase_order->isReturn == 1)

                          @endif  -->
                          <button type="button" name="remove" remove="{{  $inventory->id ?? '' }}" id="{{  $inventory->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                      </td>

                      <td>
                          {{  $inventory->purchase_order_number_id ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->product_id ?? '' }}
                      </td>

                      <td>
                          {{  $inventory->product_code ?? '' }}
                      </td>
                      
                      <td>
                          {{  $inventory->long_description ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->short_description ?? '' }}
                      </td>

                      <td>
                          {{  $inventory->supplier->id ?? '' }}/{{  $inventory->supplier->name ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->size->title ?? '' }}  {{  $inventory->size->size ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->category->name ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->location->id ?? '' }}/{{  $inventory->location->location_name ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->expiration ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->qty ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->stock ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->sold ?? '' }}
                      </td>

                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->purchase_amount , 2, '.', ',') }}
            
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->profit , 2, '.', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($inventory->price , 2, '.', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($inventory->total_amount_purchase , 2, '.', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->total_profit , 2, '.', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->total_price , 2, '.', ',') }}

                      </td>
                      <td>
                          {{  $inventory->product_remarks ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->purchase_order->user->name ?? '' }}
                      </td>
                      <td>
                          {{ $inventory->created_at->format('F d,Y h:i A') }}
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

    
});

</script>