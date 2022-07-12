<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-deposits display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Actions</th>
                <th scope="col">Product Code/Desc</th>
                <th scope="col">Qty</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th> 
                <th scope="col">Remarks</th> 
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
            @foreach($deposits as $deposit)
                <tr>
                    <td>
                        <button type="button" remove_deposit="{{  $deposit->id ?? '' }}" class="remove_deposit text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                    <td>
                            {{  $deposit->product->product_code ?? '' }}/{{  $deposit->product->description ?? '' }} 
                    </td>
                    <td>
                        {{  $deposit->qty ?? '' }}
                    </td>
                    <td>
                        {{  number_format($deposit->unit_price , 2, '.', ',') }}
                    </td>
                    <td>
                        {{  number_format($deposit->amount , 2, '.', ',') }}
                    </td>
                    <td>
                        {{ $deposit->status->title ?? '' }}
                    </td>
                    <td>
                        {{ $deposit->remarks ?? '' }}
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
        bDestroy: true,
        responsive: true,
        scrollY: 500,
        scrollCollapse: true,
        'columnDefs': [{ 'orderable': false, 'targets': 0 }],
    });
    $('.datatable-deposits:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>