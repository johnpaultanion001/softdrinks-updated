
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-returns display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Type Of Return</th>
                <th scope="col">Product Code</th>
                <th scope="col">Description</th>
                <th scope="col">Return Qty</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>

            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
                @foreach($returns as $return)
                <tr data-entry-id="{{ $return->id ?? '' }}">
                    <td>
                        <button type="button" remove_return="{{  $return->id ?? '' }}" is_purchase="YES" class="remove_return text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                    <td>
                        {{$return->type_of_return ?? '' }}
                    </td>
                    <td>
                        {{$return->product->product_code ?? '' }}
                    </td>
                    <td>
                        {{$return->product->description ?? '' }}
                    </td>
                    <td>
                        {{$return->return_qty ?? '' }}
                    </td>
                    <td>
                        {{ number_format($return->unit_price ?? '' , 2, '.', ',') }}
                    </td>
                    <td>
                        {{ number_format($return->amount ?? '' , 2, '.', ',') }}
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
    $('.datatable-returns:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>