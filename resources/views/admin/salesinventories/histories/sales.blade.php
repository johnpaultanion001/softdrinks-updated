
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-sales_history display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Order #</th>
                <th scope="col">Sold To</th>
                <th scope="col">Product</th>
                <th scope="col">Sold QTY</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
                @foreach($sales_history as $sales)
                <tr data-entry-id="{{ $sales->id ?? '' }}">
                    <td>
                        {{$sales->id ?? '' }}
                    </td>
                    <td>
                        {{$sales->order_number ?? '' }}
                    </td>
                    <td>
                        {{$sales->customer->customer_name ?? '' }}
                    </td>
                    <td>
                        {{$sales->product->product_code ?? '' }}
                    </td>
                    <td>
                        {{$sales->purchase_qty ?? '' }}
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
    });
    $('.datatable-sales_history:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>