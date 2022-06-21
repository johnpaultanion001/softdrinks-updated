
<div class="card-header border-0">
    <div class="row align-items-center">
    <div class="col">
        <h3 class="mb-0 text-uppercase">RECEIVING GOOD</h3> 
       
    </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-pallets_stocks display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">RG ID</th>
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
                        {{$pallet->receiving_good_id ?? '' }}
                    </td>
                    <td>
                        {{$pallet->pallet->title ?? '' }}
                    </td>
                    <td>
                        {{$pallet->type ?? '' }}
                    </td>
                    <td>
                        {{$pallet->qty ?? '' }}
                    </td>
                    <td>
                        {{  number_format($pallet->unit_price , 2, '.', ',') }}
                    </td>
                    <td>
                        {{  number_format($pallet->amount , 2, '.', ',') }}
                    </td>
                    <td>
                        {{ $pallet->updated_at->format('M j , Y h:i A') }}
                    </td>
                    
                </tr>
                @endforeach
        </tbody>
    </table>
</div>

<div class="card-header border-0">
    <div class="row align-items-center">
    <div class="col">
        <h3 class="mb-0 text-uppercase">SALES INVOICE</h3> 
       
    </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-pallets_stocks display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Order #</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Qty</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
                @foreach($sales_pallets as $pallet)
                <tr>
                    <td>
                        {{$pallet->salesinvoice_id ?? '' }}
                    </td>
                    <td>
                        {{$pallet->pallet->title ?? '' }}
                    </td>
                    <td>
                        {{$pallet->type ?? '' }}
                    </td>
                    <td>
                        {{$pallet->qty ?? '' }}
                    </td>
                    <td>
                        {{  number_format($pallet->unit_price , 2, '.', ',') }}
                    </td>
                    <td>
                        {{  number_format($pallet->amount , 2, '.', ',') }}
                    </td>
                    <td>
                        {{ $pallet->updated_at->format('M j , Y h:i A') }}
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
    $('.datatable-pallets_stocks:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>