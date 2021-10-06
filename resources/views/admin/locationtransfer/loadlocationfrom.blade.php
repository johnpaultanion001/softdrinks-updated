

<div class="card-header border-0">
    <div class="row align-items-center">
    <div class="col">
        <h3 class="mb-0 text-uppercase" id="titletable">Location From <small>Filter By: {{$location_title}}</small></h3>
    </div>
    </div>
</div>
<div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush datatable-location_from display" cellspacing="0" width="100%">
        <thead class="thead-light">
          <tr>
          
            <th scope="col">Product ID</th>
            <th scope="col">Product Code</th>
            <th scope="col">Description</th>
            <th scope="col">QTY</th>
            <th scope="col">Stock</th>
            <th scope="col">Sold</th>

            <th scope="col">Category</th>
            <th scope="col">Unit Sales</th>
            <th scope="col">Total Sales</th>

          </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
          @foreach($location_from as $key => $inventory)
                <tr data-entry-id="{{ $inventory->id ?? '' }}">
                

                  <td>
                      {{  $inventory->product_id ?? '' }}
                  </td>

                  <td>
                      {{  $inventory->product_code ?? '' }}
                  </td>
                  <td>
                      {{  $inventory->short_description ?? '' }}
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
                      {{  $inventory->category->name ?? '' }}
                  </td>
                  <td>
                      <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($inventory->price , 0, ',', ',') }}
                  </td>
              
                  <td>
                      <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->total_price , 0, ',', ',') }}

                  </td>
                
                </tr>
            @endforeach
        </tbody>
      </table>
</div>

<script>
$(function () {

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $('.datatable-location_from:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});

</script>