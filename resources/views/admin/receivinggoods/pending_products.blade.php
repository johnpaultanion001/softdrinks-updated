<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-products">
        <thead class="thead-white">
        <tr>
            <th scope="col">Actions</th>
            <th scope="col">Product ID</th>
            <th scope="col">Product Code</th>
            <th scope="col">Description</th>

            <th scope="col">Size</th>
            <th scope="col">Category</th>
            <th scope="col">Expiration</th>

            <th scope="col">QTY</th>
            <th scope="col">Unit Cost</th>
            <th scope="col">Regular Discount</th>
            <th scope="col">Hauling Discount</th>
            <th scope="col">Total Cost</th>
            <th scope="col">Remarks</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold display" cellspacing="0" width="100%">
            @foreach($pendingproducts as $key => $product)
                    <tr data-entry-id="{{ $product->id ?? '' }}">
                        <td>
                            <button type="button" name="edit" edit="{{  $product->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                            <button type="button" name="remove" remove="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
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
                            {{  $product->size->title ?? '' }} {{  $product->size->size ?? '' }}
                        </td>
                        <td>
                            {{  $product->category->name ?? '' }}
                        </td>
                        <td>
                            {{  $product->expiration ?? '' }}
                        </td>                    
                        <td>
                            {{  $product->qty ?? '' }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->unit_cost , 2, '.', ',') }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->regular_discount , 2, '.', ',') }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->hauling_discount , 2, '.', ',') }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($product->total_cost , 2, '.', ',') }}
                        </td>
                        <td>
                            {{  $product->product_remarks ?? '' }}
                        </td>
                        <td>
                            {{ $product->created_at->format('l, j \\/ F / Y h:i:s A') }}
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
    sale: [[ 1, 'desc' ]],
    pageLength: 100,
  });

  $('.datatable-products:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>