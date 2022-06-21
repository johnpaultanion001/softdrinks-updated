
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-pallets display" cellspacing="0" width="100%">
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
        <tbody class="text-uppercase font-weight-bold">
                @foreach($pallets as $pallet)
                <tr>
                    <td>
                        <button type="button" remove_pallet="{{  $pallet->id ?? '' }}" is_purchase="YES" class="remove_pallet text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
    $('.datatable-pallets:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>