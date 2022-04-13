<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">PRODUCTS</h3>
            </div>
            <div class="col text-right">
              <button type="button" id="remove_all_products" class="text-uppercase btn btn-danger btn-sm">Remove All</button>
              <button type="button" name="create_product" id="create_product" class="text-uppercase create_product btn btn-primary btn-sm">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-products">
            <thead class="thead-white">
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">RG ID</th>
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
            <tbody class="text-uppercase font-weight-bold display" cellspacing="0" width="100%" style="font-weight: bold;"-*>
                @foreach($pendingproducts as $key => $product)
                        <tr data-entry-id="{{ $product->id ?? '' }}">
                            <td>
                                <button type="button" name="edit" edit="{{  $product->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                <button type="button" name="remove" remove="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>
                                {{  $product->receiving_good_id ?? '' }}
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
                                {{  number_format($product->unit_cost , 2, '.', ',') }}
                            </td>
                            <td>
                                ( {{  number_format($product->regular_discount , 2, '.', ',') }} )
                            </td>
                            <td>
                                ( {{  number_format($product->hauling_discount , 2, '.', ',') }} )
                            </td>
                            <td>
                                {{  number_format($product->total_cost , 2, '.', ',') }}
                            </td>
                            <td>
                                {{  $product->product_remarks ?? '' }}
                            </td>
                            <td>
                                {{ $product->created_at->format('M j , Y h:i A') }}
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
    pageLength: 100,
    responsive: true,
    scrollY: 500,
    scrollCollapse: true,
  });

    $('.datatable-products:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    if($('#purchase_hidden_id').val() == ""){
        $('.edit').attr("disabled", false);
        $('#create_product').attr("disabled", false);
        $('#create_product').show();
        $('.edit').show();
        $('#remove_all_products').show();

    }else{
        $('.edit').hide();
        $('#create_product').attr("disabled", true);
        $('#create_product').hide();
        $('.edit').attr("disabled", true);
        $('#remove_all_products').hide();
    }

    
});
</script>

