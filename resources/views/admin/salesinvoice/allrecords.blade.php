<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-allrecords display" cellspacing="0" width="100%">
    <thead class="thead-white">
        <tr>
            <th>Actions</th>
            <th>ID</th>
            <th>Doc No.</th>
            <th>Entry Date</th>
            <th>Customer Name / Area</th>
            <th>Sub Total</th>
            <th>Total Discount</th>
            <th>Total Return</th>
            <th>Total Amount</th>
            <th>Cash</th>
            <th>Change</th>
            <th>Created By</th>
            <th>Remarks</th>
            <th>Date</th>
         
        </tr>
    </thead>
    <tbody class="text-uppercase font-weight-bold">
        @foreach($allrecords as $key => $allrecord)
            <tr data-entry-id="{{ $allrecord->id ?? '' }}">
                <td>
                    <button type="button" name="sales_receipt"  sales_receipt="{{  $allrecord->salesinvoice_id ?? '' }}" class="text-uppercase sales_receipt btn btn-info btn-sm">RECEIPT</button>
                    <button type="button" name="viewsales"  viewsales="{{  $allrecord->id ?? '' }}" class="text-uppercase viewsales btn btn-success btn-sm">View Sales</button>
                   
                </td>
                <td>
                    {{ $allrecord->salesinvoice_id  ?? '' }}
                </td>
                <td>
                    {{ $allrecord->doc_no  ?? '' }}
                </td>
                <td>
                    {{ $allrecord->entry_date ?? '' }}
                </td>
                <td>
                    {{ $allrecord->customer->customer_name  ?? '' }} /  {{ $allrecord->customer->area  ?? '' }}
                </td>

                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($allrecord->subtotal , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($allrecord->total_discount , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($allrecord->total_return , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($allrecord->total_amount , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($allrecord->cash , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($allrecord->change , 2, '.', ',') }}
                </td>
                <td>
                    {{  $allrecord->user->name ?? '' }}
                </td>
                <td>
                    {{ $allrecord->remarks  ?? '' }}
                </td>
                <td>
                    {{ $allrecord->created_at->format('F d,Y h:i A') }}
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
    pageLength: 50,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-allrecords:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>