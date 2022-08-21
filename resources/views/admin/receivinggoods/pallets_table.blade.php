<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">PALLETS</h3>
            </div>
            <div class="col text-right">
              <button type="button" id="create_pallet" class="text-uppercase create_pallet btn btn-primary btn-sm">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-pallets"  width="100%">
            <thead class="thead-white">
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold display">
                @foreach($pallets as $pallet)
                        <tr>
                            <td>
                                <button type="button" edit_pallet="{{  $pallet->id ?? '' }}"  class="edit_pallet text-uppercase btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                <button type="button" remove_pallet="{{  $pallet->id ?? '' }}" class="remove_pallet text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>
                                {{  $pallet->pallet->title ?? '' }}
                            </td>
                            <td>
                                {{  $pallet->type ?? '' }}
                            </td>
                            <td>
                                {{  $pallet->qty ?? '' }}
                            </td>
                            <td>
                                {{  number_format($pallet->unit_price , 2, '.', ',') }}
                            </td>
                            <td>
                                {{  number_format($pallet->amount , 2, '.', ',') }}
                            </td>
                            <td>
                                {{ $pallet->created_at->format('M j , Y h:i A') }}
                            </td>
                        </tr>
                @endforeach
            </tbody>
            <tfoot class="thead-white">
                <tr>
                    <th scope="col">TOTAL:</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col"></th>
                </tr>
            </tfoor>
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

    $('.datatable-pallets').DataTable({
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
        $('.edit_pallet').attr("disabled", false);
        $('#create_pallet').attr("disabled", false);
        $('#create_pallet').show();
        $('.edit_pallet').show();
    }else{
        $('.edit_pallet').hide();
        $('#create_pallet').attr("disabled", true);
        $('#create_pallet').hide();
        $('.edit_pallet').attr("disabled", true);
    }

    
});
</script>

