<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase loadingSales" id="loadingSales">Sales</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_sales" id="create_sales" class="text-uppercase create_sales btn btn-sm btn-primary">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-sales display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Actions</th> 
                <th scope="col">Product Code/Desc</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price Type / Discounted</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
            @foreach($orders as $key => $order)
                <tr data-entry-id="{{ $order->id ?? '' }}">
                    <td>
                        <button type="button" name="editorder" editorder="{{  $order->id ?? '' }}" class="text-uppercase editorder btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                        <button type="button" name="removeorder" removeorder="{{  $order->id ?? '' }}" class="text-uppercase remove-order btn btn-danger btn-sm"><i class="fas fa-trash"></i></button> 
                    </td>
                    <td>
                        {{  $order->product->product_code ?? '' }}/{{  $order->product->description ?? '' }}
                    </td>
                    <td>
                        {{  $order->purchase_qty ?? '' }}
                    </td>
                    <td>
                             {{$order->pricetype->price_type  ?? ''}} / ({{ number_format($order->discounted ?? '' , 2, '.', ',') }})
                    </td>
                    <td>
                            {{ number_format($order->product->price ?? '' , 2, '.', ',') }}
                    </td>
                    <td>
                            {{ number_format($order->total ?? '' , 2, '.', ',') }}
                    </td>   
                </tr>
            @endforeach
        </tbody>
        <tfoot class="thead-white">
            <tr>
                <th scope="col">TOTAL:</th> 
                <th scope="col"></th>
                <th scope="col">Quantity</th>
                <th scope="col"></th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
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
      
      $('.datatable-sales').DataTable({
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
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            amt = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            $(api.column(2).footer()).html(number_format(qty, 2,'.', ','));
            $(api.column(4).footer()).html(number_format(unit_price, 2,'.', ','));
            $(api.column(5).footer()).html(number_format(amt, 2,'.', ','));
        },
      });
});
</script>
