<div class="card-header border-0">
    <div class="row align-items-center">
    <div class="col">
        <h3 class="mb-0 text-uppercase" id="titletable">Location To  <small>Filter By: {{$location_title}}</small></h3>
    </div>
    </div>
</div>
<div class="table-responsive">
      <!-- Projects table -->
      <table class="table align-items-center table-flush datatable-location_to display" cellspacing="0" width="100%">
        <thead class="thead-light">
          <tr>

            <th scope="col">Product ID</th>
            <th scope="col">Product Code</th>
            <th scope="col">Description</th>
            <th scope="col">Stock</th>
            <th scope="col">Sold</th>
            <th scope="col">Category</th>
            <th scope="col">Unit Price</th>

          </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
          @foreach($location_to as $key => $product)
                <tr>
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
                        {{  $product->category->name ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($product->price , 2, '.', ',') }}
                    </td>
                
                </tr>
            @endforeach
        </tbody>
      </table>
</div>

<script>
$(function () {
  
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 

  $('.datatable-location_to:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});

</script>