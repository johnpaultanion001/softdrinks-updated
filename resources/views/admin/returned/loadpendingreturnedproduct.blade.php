

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">RETURNING PRODUCTS</h3>
            </div>
          
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-returnproducts display" cellspacing="0" width="100%"">
            <thead class="thead-light">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Name</th>
                <th scope="col">Case Returned</th>
                <th scope="col">Status</th>
                <th scope="col">Deposit</th>
                <th scope="col">Purchase Order Number</th>
                <th scope="col">Note</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($returnedproducts as $key => $product)
                    <tr data-entry-id="{{ $product->id ?? '' }}">
                      <td>
                          <button type="button" name="edit" edit="{{  $product->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                          <button type="button" name="remove" remove="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                      </td>
                      
                      <td>
                          {{  $product->name ?? '' }}
                      </td>
                      <td>
                          {{  $product->case ?? '' }}
                      </td>
                      <td>
                        {{  $product->status->code ?? '' }} - {{  $product->status->title ?? '' }}
                      </td>
                      <td>
                         <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->deposit , 0, ',', ',') }}
                      </td>
                      <td>
                          {{  $product->purchase_order_number_id ?? '' }}
                      </td>
                      <td>
                          {{  $product->note ?? '' }}
                      </td>
                      <td>
                          {{ $product->created_at->format('l, j \\/ F / Y h:i:s A') }}
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


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
  });

  $('.datatable-returnproducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>