<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase loadingReturn" id="loadingReturn">Returns</h3>
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
                <th scope="col">Product Code/Desc</th>
                <th scope="col">Return QTY</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
                <th scope="col">Type Of Return</th> 
                <th scope="col">Status</th> 
                <th scope="col">Remarks</th> 
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
            @foreach($returned as $key => $return)
                <tr data-entry-id="{{ $return->id ?? '' }}">
                    <td>
                        <button type="button" name="editreturn" editreturn="{{  $return->id ?? '' }}" class="text-uppercase editreturn btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                        <button type="button" name="removereturn" removereturn="{{  $return->id ?? '' }}" class="text-uppercase removereturn btn btn-danger btn-sm"><i class="fas fa-trash"></i></button> 
                    </td>
                    <td>
                        {{  $return->product->product_code ?? '' }}/{{  $return->product->description ?? '' }} 
                            
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
                    <td>
                            {{ $return->type_of_return ?? '' }}
                    </td>
                    <td>
                        @if($return->type_of_return == 'EMPTY')
                            {{ $return->status->title ?? '' }}
                        @endif
                    </td>
                    <td>
                            {{ $return->remarks ?? '' }}
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
        <tfoot class="thead-white">
            <tr>
                <th scope="col">TOTAL:</th> 
                <th scope="col"></th>
                <th scope="col">Return QTY</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
                <th scope="col"></th> 
                <th scope="col"></th> 
                <th scope="col"></th> 
            </tr>
        </tfoot>
    
        </table>
    </div>
</div>


<script>
$(function () {
      number_format = function (number, decimals, dec_point, thousands_sep) {
          number = number.toFixed(decimals);

          var nstr = number.toString();
          nstr += '';
          x = nstr.split('.');
          x1 = x[0];
          x2 = x.length > 1 ? dec_point + x[1] : '';
          var rgx = /(\d+)(\d{3})/;

          while (rgx.test(x1))
              x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

          return x1 + x2;
      }
      
      $('.datatable-return').DataTable({
          bDestroy: true,
          responsive: true,
          scrollY: 500,
          scrollCollapse: true,
          buttons: [
              
          ],
          footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            qty = api
                .column(2, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
           

            unit_price = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            amt = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            $(api.column(2).footer()).html(number_format(qty, 2,'.', ','));
            $(api.column(3).footer()).html(number_format(unit_price, 2,'.', ','));
            $(api.column(4).footer()).html(number_format(amt, 2,'.', ','));
        },
      });
});
</script>
