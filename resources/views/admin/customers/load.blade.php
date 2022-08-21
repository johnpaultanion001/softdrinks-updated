
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->

<div class="card mt--6">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0 text-uppercase" id="titletable">Customers</h3>
      </div>
      <div class="col text-right">
        <button type="button" name="account_receivables" id="account_receivables" class="text-uppercase account_receivables btn btn-sm btn-default">Account Receivables</button>
        <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Customer</button>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-customers display" cellspacing="0" width="100%">
      <thead class="thead-white">
        <tr>
          <th scope="col">Actions</th>
          <th scope="col">Customer Code</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Area</th>
          <th scope="col">Contact Number</th>
          <th scope="col">Current Balance</th>
          <th scope="col">Over Payment</th>
          <th scope="col">Created At</th>
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($customers as $key => $customer)
              <tr data-entry-id="{{ $customer->id ?? '' }}">
                  <td>
                      <button type="button" name="edit" edit="{{  $customer->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                      <button type="button" name="remove" remove="{{  $customer->id ?? '' }}" id="{{  $customer->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </td>
                  <td>
                      {{  $customer->customer_code ?? '' }}
                  </td>
                  <td>
                      {{  $customer->customer_name ?? '' }}
                  </td>
                  <td>
                        {{ $customer->area ?? '' }}
                  </td>
                  <td>
                        {{ $customer->contact_number ?? '' }}
                  </td>
                  <td>
                      {{  number_format($customer->current_balance , 2, '.', ',') }}
                  </td>
                  <td>
                    {{  number_format($customer->over_payment , 2, '.', ',') }}
                  </td>
                  <td>
                      {{ $customer->created_at->format('M j , Y h:i A') }}
                  </td>
                
              </tr>
          @endforeach
      </tbody>
      <tfoot class="thead-white">
        <tr>
          <th scope="col">TOTAL: </th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col">Current Balance</th>
          <th scope="col">Over Payment</th>
          <th scope="col"></th>
        </tr>
      </tfoot>
    </table>
  </div>

      <!-- Footer -->
      @section('footer')
        @include('../partials.footer')
    @endsection
</div>

<div class="modal accModal" id="accModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-acc text-white text-uppercase font-weight-bold">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="modalbody" class="row print_report">
                  <div class="col text-center" id="header_account">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase">Account Receivables</h5>
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" id="table_account_report" cellspacing="0" width="100%">
                      <thead class="thead-white">
                        <tr>
                          
                          <th>Customer Code</th>
                          <th>Customer Name</th>
                          <th>Area</th>
                          <th>Current Balance</th>
                          <th>Updated At</th>
                        
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold">
                        @foreach($account_receivables as $key => $customer)
                              <tr data-entry-id="{{ $customer->id ?? '' }}">
                                  <td>
                                      {{  $customer->customer_code ?? '' }}
                                  </td>
                                  <td>
                                      {{  $customer->customer_name ?? '' }}
                                  </td>
                                  <td>
                                      {{ $customer->area ?? '' }}
                                  </td>
                                
                                  <td>
                                    {{  number_format($customer->current_balance , 2, ',', ',') }}
                                  </td>
                                  <td>
                                    {{ $customer->updated_at->format('M j , Y h:i A') }}
                                  </td>
                              </tr>
                          @endforeach
                              <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                
                                <td>
                                  Total Current Balance:
                                </td>
                                <td>
                                  {{  number_format($account_receivables->sum->current_balance , 2, '.', ',') }}
                                </td>
                                <td>
                                </td>
                              </tr>
                      </tbody>
                    </table>
                 </div>
                </div>
                
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                <button type="button" id="btn_excel_account_report" class="text-uppercase btn btn-default">Excel Report</button>
                <button type="button" id="btn_print_account_report" class="text-uppercase btn btn-default">Print Report</button>


            </div>
    
        </div>
    </div>
</div>

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
      pageLength: 100,
      bDestroy: true,
      responsive: true,
      scrollY: 600,
      scrollCollapse: true,
      'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

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

    $('.datatable-customers').DataTable({ 
      footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            bal = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            over = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            

            // Update footer
            $(api.column(5).footer()).html(number_format(bal, 2,'.', ','));
            $(api.column(6).footer()).html(number_format(over, 2,'.', ','));
        },
   })
    
});



</script>