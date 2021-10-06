
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Return List</h3> 
             
            </div>
            <div class="col text-right">
              <button type="button" name="btn_add_return" id="btn_add_return" class="btn_add_return text-uppercase btn btn-sm btn-primary">Insert Return</button>
            </div>
          </div>
        </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-salesreturn display" cellspacing="0" width="100%">
            <thead class="thead-light">
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Product Code</th>
                <th scope="col">Description</th>
                <th scope="col">QTY</th>
                <th scope="col">Price Type / Discount</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Date</th>
                <th scope="col">Amount</th>

            </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
            @foreach($returned as $key => $return)
                    <tr>
                        <td>
                            <button type="button" name="editreturn" editreturn="{{  $return->id ?? '' }}" class="text-uppercase editreturn btn btn-info btn-sm">Edit</button>
                            <button type="button" name="removereturn" removereturn="{{  $return->id ?? '' }}" class="text-uppercase removereturn btn btn-danger btn-sm">Remove</button>
                        </td>
                        <td>
                            {{  $return->inventory->product_code ?? '' }}
                        </td>
                        <td>
                            {{  $return->inventory->short_description ?? '' }}
                        </td>
                        
                        <td>
                            {{  $return->return_qty ?? '' }}
                        </td>
                        <td>
                            {{  $return->pricetype->price_type ?? '' }} / <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($return->pricetype->discount , 2, '.', ',') }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($return->unit_price , 2, '.', ',') }}
                        </td>
                        <td>
                            {{ $return->created_at->format('F d,Y h:i A') }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($return->amount , 2, '.', ',') }}
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
                    <td>Total Return:</td>
                    <td> <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($returned->sum->amount ?? '' , 2, '.', ',') }}</td>
                    
                </tr>
            </tfoot>

        
        </table>
    </div>


<script>
$(function () {
  
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 

  $('.datatable-salesreturn:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});

</script>