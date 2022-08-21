<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">Deposits</h3>
            </div>
            <div class="col text-right">
              <button type="button" id="create_deposit" class="text-uppercase btn btn-sm btn-primary">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-deposits display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Product Code/Desc</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th> 
                    <th scope="col">Remarks</th> 
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
                @foreach($deposits as $deposit)
                        <tr>
                            <td>
                                <button type="button" edit_deposit="{{  $deposit->id ?? '' }}"  class="edit_deposit text-uppercase btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                <button type="button" remove_deposit="{{  $deposit->id ?? '' }}" class="remove_deposit text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>
                                 {{  $deposit->product->product_code ?? '' }}/{{  $deposit->product->description ?? '' }} 
                            </td>
                            <td>
                                {{  $deposit->qty ?? '' }}
                            </td>
                            <td>
                                {{  number_format($deposit->unit_price , 2, '.', ',') }}
                            </td>
                            <td>
                                {{  number_format($deposit->amount , 2, '.', ',') }}
                            </td>
                            <td>
                                {{ $deposit->status->title ?? '' }}
                            </td>
                            <td>
                                {{ $deposit->remarks ?? '' }}
                            </td>
                        </tr>
                @endforeach
        </tbody>
        <tfoot class="thead-white">
            <tr>
                    <th scope="col">TOTAL:</th>
                    <th scope="col"></th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col"></th> 
                    <th scope="col"></th> 
            </tr>
        </tfo>
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
      
      $('.datatable-deposits').DataTable({
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
