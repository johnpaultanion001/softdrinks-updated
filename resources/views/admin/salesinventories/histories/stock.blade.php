
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-stock_history display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">RG ID/Supplier</th>
                <th scope="col">Product Code/Desc</th>
                <th scope="col">Stock QTY</th>
                <th scope="col">Unit Cost</th>
                <th scope="col">Regular Discount</th>
                <th scope="col">Hauling Discount</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Remarks</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
                @foreach($stock_history as $product)
                <tr data-entry-id="{{ $product->id ?? '' }}">
                    <td>
                        {{$product->id ?? '' }}
                    </td>
                    <td>
                        {{$product->receiving_good_id ?? '' }}/{{$product->supplier->name ?? '' }}
                    </td>
                    <td>
                        {{$product->product_code ?? '' }}/{{$product->description ?? '' }}
                    </td>
                    <td>
                        {{$product->qty ?? '' }}
                    </td>
                    <td>
                        {{  number_format($product->unit_cost , 2, '.', ',') }}
                    </td>
                    <td>
                        {{  number_format($product->regular_discount , 2, '.', ',') }}
                    </td>
                    <td>
                        {{  number_format($product->hauling_discount , 2, '.', ',') }}
                    </td>
                    <td>
                        {{  number_format($product->price , 2, '.', ',') }}
                    </td>
                    <td>
                        {{ $product->product_remarks ?? '' }}
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
        'columnDefs': [{ 'orderable': true, 'targets': 0 }],
    });
    $('.datatable-stock_history:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>