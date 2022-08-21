@extends('../layouts.admin')
@section('sub-title','EMPTY BOTTLES INVENTORIES')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->
<div class="card mt--6">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">EMPTY BOTTLES INVENTORIES</h3>
            </div>
         
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-emptybottles display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Remarks</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>QTY EMPTIES</th>
                <th>QTY SHELLS</th>
                <th>QTY BOTTLES</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($emptybottles as $bottle)
                  
                    <tr data-entry-id="{{ $bottle->id ?? '' }}">
                        <td>
                              <div style="max-height: 250px; overflow: auto;">
                                @foreach($bottle->sales_returns as $return)
                                  <div class="bg-info text-white" style="border-radius: 5px; padding: 5px;">
                                    {{$return->salesinvoice->customer->customer_name ?? ''}} <br>
                                    QTY: + {{$return->return_qty ?? ''}} <br>
                                    Status: {{$return->status->title ?? ''}} <br> 
                                    {{$return->remarks ?? ''}}
                                  </div> <br>
                                @endforeach
                                @foreach($bottle->recieve_returns as $return)
                                  <div class="bg-warning text-white" style="border-radius: 5px; padding: 5px;">
                                    {{$return->receiving_good->supplier->name ?? ''}} <br>
                                    QTY: - {{$return->return_qty ?? ''}} <br>
                                    Status: {{$return->status->title ?? ''}} <br> 
                                    {{$return->remarks ?? ''}}
                                  </div> <br>
                                @endforeach
                                @foreach($bottle->deposits as $deposit)
                                  <div class="bg-success text-white" style="border-radius: 5px; padding: 5px;">
                                    {{$deposit->salesinvoice->customer->customer_name ?? ''}} <br>
                                    QTY: - {{$deposit->qty ?? ''}} <br>
                                    Status: {{$deposit->status->title ?? ''}} <br> 
                                    {{$deposit->remarks ?? ''}}
                                  </div> <br>
                                @endforeach
                              </div>
                              
                              
                        </td>
                        <td>
                          {{  $bottle->product->product_code ?? '' }}
                            
                        </td>
                        <td>
                          {{  $bottle->product->description ?? '' }}
                        </td>
                        <td>
                            {{$bottle->empties_qty() ?? ''}}
                        </td>
                        <td>
                            {{$bottle->shells_qty() ?? ''}}
                        </td>
                        <td>
                            {{$bottle->bottles_qty() ?? ''}}
                        </td>
                        <td>
                            {{ $bottle->updated_at->format('M j , Y h:i A') }}
                            
                        </td>
                     
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="thead-white">
              <tr>
                <th>TOTAL:</th>
                <th></th>
                <th></th>
                <th>QTY EMPTIES</th>
                <th>QTY SHELLS</th>
                <th>QTY BOTTLES</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
</div>
@endsection

@section('script')
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

      $('.datatable-emptybottles').DataTable({
          bDestroy: true,
          responsive: true,
          scrollY: 600,
          scrollCollapse: true,
          buttons: [
              
          ],
          footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            empties = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
           
            shells = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            bottles = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            $(api.column(3).footer()).html(number_format(empties, 2,'.', ','));
            $(api.column(4).footer()).html(number_format(shells, 2,'.', ','));
            $(api.column(5).footer()).html(number_format(bottles, 2,'.', ','));
        },
      });
    
    });
</script>
@endsection
