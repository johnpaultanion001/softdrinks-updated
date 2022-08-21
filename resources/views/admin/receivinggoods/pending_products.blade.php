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
                    <th scope="col">Regular Disc</th>
                    <th scope="col">Hauling Disc</th>
                    <th scope="col">Additional Disc</th>
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
                                ( {{  number_format($product->additional_discount , 2, '.', ',') }} )
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
            <tfoot class="thead-white">
                <tr>
                    <th scope="col">TOTAL:</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                    <th scope="col">QTY</th>
                    <th scope="col">Unit Cost</th>
                    <th scope="col">Regular Disc</th>
                    <th scope="col">Hauling Disc</th>
                    <th scope="col">Additional Disc</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </tfoot>
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


    number_format = function (number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }

    $('.datatable-products').DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            qty = api
                .column(7, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            unit_cost = api
                .column(8, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            regular_disc = api
                .column(9, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            hauling_disc = api
                .column(10, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            add_disc = api
                .column(11, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_cost = api
                .column(12, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            

            // Update footer
            $(api.column(7).footer()).html(number_format(qty, 2,'.', ','));
            $(api.column(8).footer()).html(number_format(unit_cost, 2,'.', ','));
            $(api.column(9).footer()).html(number_format(regular_disc, 2,'.', ','));
            $(api.column(10).footer()).html(number_format(hauling_disc, 2,'.', ','));
            $(api.column(11).footer()).html(number_format(add_disc, 2,'.', ','));
            $(api.column(12).footer()).html(number_format(total_cost, 2,'.', ','));
            
        },
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

