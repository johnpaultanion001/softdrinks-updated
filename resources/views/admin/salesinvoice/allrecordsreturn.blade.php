<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-allrecordsreturn display" cellspacing="0" width="100%">
    <thead class="thead-white">
        <tr>
                <th scope="col">Actions</th> 
                <th scope="col">Product Code</th>
                <th scope="col">Customer Code / Customer Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price Type / Discount</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
         
        </tr>
    </thead>
    <tbody class="text-uppercase font-weight-bold">
            @foreach($returned as $key => $return)
                <tr data-entry-id="{{ $return->id ?? '' }}">
                    <td>
                        <button type="button" name="editreturn" editreturn="{{  $return->id ?? '' }}" class="text-uppercase editreturn btn btn-info btn-sm">Edit</button>
                        <button type="button" name="removereturn" removereturn="{{  $return->id ?? '' }}" class="text-uppercase removereturn btn btn-danger btn-sm">Remove</button> 
                    </td>
                    <td>
                        {{  $return->inventory->product_code ?? '' }}
                    </td>
                    <td>
                        {{  $return->salesinvoice->customer->customer_code ?? '' }} / {{  $return->salesinvoice->customer->customer_name ?? '' }}
                    </td>
                    <td>
                        {{  $return->return_qty ?? '' }}
                    </td>
                    <td>
                             {{$return->pricetype->id}} /  <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($return->pricetype->discount ?? '' , 2, '.', ',') }}
                    </td>
                    <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($return->unit_price ?? '' , 2, '.', ',') }}
                    </td>
                    <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($return->amount ?? '' , 2, '.', ',') }}
                    </td>   
                    <td>
                        {{ $return->created_at->format('F d,Y h:i A') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="text-uppercase font-weight-bold">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total Return:</td>
                <td> <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($returned->sum->amount ?? '' , 2, '.', ',') }}</td>
               
            </tr>
        </tfoot>
    </table>
</div>

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 50,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-allrecordsreturn:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>