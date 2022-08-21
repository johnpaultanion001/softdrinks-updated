<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">RETURNS</h3>
            </div>
            <div class="col text-right">
                <button type="button" id="remove_all_returns" class="text-uppercase btn btn-danger btn-sm">Remove All</button>
                <button type="button" name="create_return" id="create_return" class="text-uppercase btn btn-primary btn-sm">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-returnproducts display" cellspacing="0" width="100%">
            <thead class="thead-white">
                <tr>
                <th scope="col">Actions</th>
                <th scope="col">Product Code</th>
                <th scope="col">Description</th>
                <th scope="col">Return Qty</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total Amount</th>
                
                <th scope="col">Type Of Return</th>
                <th scope="col">Status</th>
                <th scope="col">Remarks</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
                @foreach($returns as $key => $product)
                    <tr data-entry-id="{{ $product->id ?? '' }}">
                        <td>
                            <button type="button" name="editreturn" editreturn="{{  $product->id ?? '' }}"  class="editreturn text-uppercase btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                            <button type="button" name="removereturn" removereturn="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="removereturn text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                        <td>
                            {{  $product->product->product_code ?? '' }}
                        </td>
                        <td>
                            {{  $product->product->description ?? '' }}
                        </td>
                        <td>
                            {{  $product->return_qty ?? '' }}
                        </td>
                        <td>
                            {{  number_format($product->unit_price , 2, '.', ',') }}
                        </td>
                        <td>
                        {{  number_format($product->amount , 2, '.', ',') }}
                        </td>
                        <td>
                            {{ $product->type_of_return ?? '' }}
                        </td>
                        <td>
                            @if($product->type_of_return == 'EMPTY')
                                {{ $product->status->title ?? '' }}
                            @endif
                        </td>
                        <td>
                            {{  $product->remarks ?? '' }}
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
                <th scope="col">Return Qty</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total Amount</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection



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

    $('.datatable-returnproducts').DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            qty = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            unit_price = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_amt = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            $(api.column(3).footer()).html(number_format(qty, 2,'.', ','));
            $(api.column(4).footer()).html(number_format(unit_price, 2,'.', ','));
            $(api.column(5).footer()).html(number_format(total_amt, 2,'.', ','));
            
        },
    });

    if($('#purchase_hidden_id').val() == ""){
        $('.editreturn').attr("disabled", false);
        $('.editreturn').show();
        $('#create_return').attr("disabled", false);
        $('#create_return').show();
        $('#remove_all_returns').show();
    }else{
        $('.editreturn').attr("disabled", true);
        $('.editreturn').hide();
        $('#create_return').attr("disabled", true);
        $('#create_return').hide();
        $('#remove_all_returns').hide();
    }
    
    
});
</script>