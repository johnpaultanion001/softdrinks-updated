
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-sales display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Action</th>
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col">Sold Qty</th>
                <th scope="col">Price Type/Discounted</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>

            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
                @foreach($sales as $sale)
                <tr data-entry-id="{{ $sale->id ?? '' }}">
                    <td>
                        <button type="button" remove_sales="{{  $sale->id ?? '' }}" class="remove_sales text-uppercase btn btn-danger btn-sm">Remove</button>
                    </td>
                    <td>
                        {{$sale->id ?? '' }}
                    </td>
                    <td>
                        {{$sale->product->product_code ?? '' }}
                    </td>
                    <td>
                        {{$sale->purchase_qty ?? '' }}
                    </td>
                    <td>
                        {{$sale->pricetype->price_type ?? ''}} / ₱ ( {{ number_format($sale->discounted ?? '' , 2, '.', ',') }} )
                    </td>
                    <td>
                        ₱ {{ number_format($sale->product_price ?? '' , 2, '.', ',') }}
                    </td>
                    <td>
                        ₱ {{ number_format($sale->total ?? '' , 2, '.', ',') }}
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
        pageLength: 10,
        'columnDefs': [{ 'orderable': false, 'targets': 0 }],
    });
    $('.datatable-sales:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>