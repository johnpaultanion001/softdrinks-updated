<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase loadingReturn" id="loadingReturn">Return</h3>
            </div>
            <div class="col text-right">
              <!-- <button type="button" name="all_record_return" id="all_record_return" class="text-uppercase all_record_return btn btn-sm btn-primary">All Records</button> -->
              <button type="button" name="create_return" id="create_return" class="text-uppercase create_return btn btn-sm btn-primary">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-return display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Actions</th> 
                <th scope="col">Product Code</th>
                <th scope="col">Return QTY</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
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
                            @if($return->product_id == 0)
                                    No Brand
                            @else
                                {{  $return->product->product_code ?? '' }}
                            @endif
                    </td>
                    <td>
                            {{ $return->return_qty ?? '' }}
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
</div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 10,
  });

  $('.datatable-return:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>
