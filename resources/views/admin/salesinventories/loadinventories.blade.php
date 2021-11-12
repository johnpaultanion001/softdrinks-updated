
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Inventories</h3> 
             
            </div>
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
                <th scope="col">Description</th>
                <th scope="col">Stock</th>
                <th scope="col">Sold</th>

                <th scope="col">Size</th>
                <th scope="col">Category</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>

                

                <th scope="col">Unit Price</th>
                <th scope="col">Remarks</th>
                <th scope="col">Updated At</th>
                <th scope="col">Created At</th>
               

              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($products as $key => $product)
                    <tr data-entry-id="{{ $product->id ?? '' }}">
                    
                      <td>
                          <button type="button" name="view" view="{{  $product->id ?? '' }}"  class="view text-uppercase btn btn-warning btn-sm">View</button>
                      </td>

                      <td>
                          {{  $product->receiving_good_id ?? '' }}
                      </td>
                      <td>
                          {{  $product->id ?? '' }}
                      </td>

                      <td>
                          {{  $product->product_code ?? '' }}
                      </td>
                      
                      <td>
                          {{  $product->description ?? '' }}
                      </td>
                      <td>
                          {{  $product->stock ?? '' }}
                      </td>
                      <td>
                          {{  $product->sold ?? '' }}
                      </td>
                      
                      <td>
                          {{  $product->size->title ?? '' }}  {{  $product->size->size ?? '' }}
                      </td>
                      <td>
                          {{  $product->category->name ?? '' }}
                      </td>
                      <td>
                          {{  $product->supplier->name ?? '' }}
                      </td>
                      <td>
                          {{  $product->location->location_name ?? '' }}
                      </td>

                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->price , 2, '.', ',') }}
                      </td>
    
                      <td>
                          {{  $product->product_remarks ?? '' }}
                      </td>
                      <td>
                          {{ $product->updated_at->format('F d,Y h:i A') }}
                      </td>
                      <td>
                          {{ $product->created_at->format('F d,Y h:i A') }}
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

  var table = $('.datatable-inventries:not(.ajaxTable)').DataTable({ buttons: dtButtons });
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
  });

  $('select[name="filter_category"]').on("change", function(event){
    table.columns(8).search( this.value ).draw();
  });

  $('select[name="filter_supplier"]').on('change', function () {
    table.columns(9).search( this.value ).draw();
  });

  $('select[name="filter_size"]').on('change', function () {
    table.columns(7).search( this.value ).draw();
  });

  $('select[name="filter_location"]').on('change', function () {
    table.columns(10).search( this.value ).draw();
  });

    
});

</script>