<div class="card">
   
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-productlist display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Actions</th> 
                <th scope="col">Product Code</th>
                <th scope="col">Description</th>
                <th scope="col">Size</th>
                <th scope="col">Supplier Code / Name</th>
                <th scope="col">Category</th>
                <th scope="col">Expiration</th>
                <th scope="col">Stock</th>
                <th scope="col">Orders</th>
                <th scope="col">Sold</th>

            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
            @foreach($inventories as $key => $inv)
                <tr data-entry-id="{{ $inv->id ?? '' }}">
                    <td>
                        <button type="button" id="order" name="order" order="{{  $inv->id ?? '' }}" class="text-uppercase order btn btn-info btn-sm">Order</button>
                        
                    </td>
                    <td>
                          {{  $inv->product_code ?? '' }}
                      </td>
                      <td>
                          {{  $inv->description ?? '' }}
                      </td>
                      <td>
                          {{  $inv->size->title ?? '' }}  {{  $inv->size->size ?? '' }}
                      </td>
                      <td>
                          {{  $inv->supplier->id ?? '' }}/{{  $inv->supplier->name ?? '' }}
                      </td>
                     
                      <td>
                          {{  $inv->category->name ?? '' }}
                      </td>
                      <td>
                          {{  $inv->expiration ?? '' }}
                      </td>
                      <td>
                          {{  $inv->stock ?? '' }}
                      </td>
                      <td>
                          {{  $inv->orders ?? '' }}
                      </td>
                      <td>
                          {{  $inv->sold ?? '' }}
                      </td>
                </tr>

                
            @endforeach
        </tbody>
    
        </table>
    </div>
</div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 10,
  });

  $('.datatable-productlist:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>
