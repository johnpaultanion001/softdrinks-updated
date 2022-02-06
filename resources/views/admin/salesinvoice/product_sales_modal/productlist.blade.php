
<div class="table-responsive">
    
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-productlist display" cellspacing="0" width="100%">
    <thead class="thead-white">
        <tr>
            <th scope="col">Actions</th> 
            <th scope="col">Product ID</th>
            <th scope="col">Product Code/Desc</th>
            <th scope="col">Size</th>
            <th scope="col">Supplier</th>
            <th scope="col">Category</th>
            <th scope="col">Expiration</th>
            <th scope="col">Selling Area Stock</th>
            <th scope="col">Orders</th>
            <th scope="col">Sold</th>

        </tr>
    </thead>
    <tbody class="text-uppercase font-weight-bold">
        @foreach($products as $product)
            <tr data-entry-id="{{ $product->product->id ?? '' }}">
                <td>
                    <button type="button" id="order" name="order" order="{{  $product->product->id ?? '' }}" class="text-uppercase order btn btn-info btn-sm">Order</button>
                    
                </td>
                    <td>
                        {{  $product->product->id ?? '' }}
                    </td>
                    <td>
                        {{  $product->product->product_code ?? '' }}/{{  $product->product->description ?? '' }}
                    </td>
                    <td>
                        {{  $product->product->size->title ?? '' }}  {{  $product->product->size->size ?? '' }}
                    </td>
                    <td>
                        {{  $product->product->supplier->name ?? '' }}
                    </td>
                    
                    <td>
                        {{  $product->product->category->name ?? '' }}
                    </td>
                    <td>
                        {{  $product->product->expiration ?? '' }}
                    </td>
                    <td>
                        {{  $product->product->location_products_stock() ?? '' }}
                    </td>
                    <td>
                        {{  $product->product->orders ?? '' }}
                    </td>
                    <td>
                        {{  $product->product->sold ?? '' }}
                    </td>
            </tr>

            
        @endforeach
    </tbody>

    </table>
</div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
  });

  $('.datatable-productlist:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>
