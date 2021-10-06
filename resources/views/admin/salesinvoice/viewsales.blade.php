<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-viewsales display" cellspacing="0" width="100%">
    <thead class="thead-white">
        <tr>
            <th>ID</th>
            <th>Product Code</th>
            <th>Discription</th>
            <th>Quantity</th>
            <th>Price Type / Discount</th>
            <th>Unit Price</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody class="text-uppercase font-weight-bold">
        @foreach($sales as $key => $sale)
            <tr data-entry-id="{{ $sale->id ?? '' }}">
                <td>
                    {{ $sale->id  ?? '' }}
                </td>
                <td>
                    {{ $sale->inventory->product_code  ?? '' }}
                </td>
                <td>
                    {{ $sale->inventory->short_description ?? '' }}
                </td>
                <td>
                    {{ $sale->purchase_qty  ?? '' }}
                </td>
                <td>
                    {{ $sale->pricetype->price_type  ?? '' }} / <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($sale->pricetype->discount , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($sale->inventory->price , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($sale->total , 2, '.', ',') }}
                </td>
    
                
            </tr>
        @endforeach
    </tbody>
   unj

    </table>
</div>

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 50,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-viewsales:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>