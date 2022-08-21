
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->

<div class="mt--6 card">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0 text-uppercase" id="titletable">Suppliers</h3>
      </div>
      <div class="col text-right">
        @can('account_payables')
          <button type="button" id="account_payable" class="text-uppercase btn btn-sm btn-default">Account Payables</button>
        @endcan
        <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Supplier</button>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-suppliers display" cellspacing="0" width="100%">
      <thead class="thead-white">
        <tr>
          <th>Actions</th>
          <th>Supplier Code</th>
          <th>Supplier Name</th>
          <th>Address</th>
          <th>Contact Number</th>
          <th>Current Balance</th>
          <th>Remarks</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($suppliers as $key => $supplier)
              <tr data-entry-id="{{ $supplier->id ?? '' }}">
                  <td>
                      <button type="button" name="edit" edit="{{  $supplier->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                      <button type="button" name="remove" remove="{{  $supplier->id ?? '' }}" id="{{  $supplier->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </td>
                  <td>
                      {{  $supplier->id ?? '' }}
                  </td>
                  <td>
                      {{  $supplier->name ?? '' }}
                  </td>
                  <td>
                      {{  $supplier->address ?? '' }}
                  </td>
                  <td>
                        {{ $supplier->contact_number ?? '' }}
                  </td>
                  <td>
                        {{  number_format($supplier->current_balance , 2, '.', ',') }}
                    </td>
                  <td>
                      {{  $supplier->remarks ?? '' }}
                  </td>
                  <td>
                      {{ $supplier->created_at->format('M j , Y h:i A') }}
                  </td>
                  
              </tr>
          @endforeach
      </tbody>
      <tfoot class="thead-white">
        <tr>
          <th>TOTAL:</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th>Current Balance</th>
          <th></th>
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
    
<div class="modal payableModal" id="payableModal" data-keyboard="false" data-backdrop="static">
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
                  <div class="col text-center" id="header_payable">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase">Account Payables</h5>
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" id="table_payable_report" cellspacing="0" width="100%">
                      <thead class="thead-white">
                        <tr>
                          <th>Supplier Code</th>
                          <th>Supplier Name</th>
                          <th>Address</th>
                          <th>Current Balance</th>
                          <th>Updated At</th>
                        
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold">
                        @foreach($account_payables as $key => $supplier)
                              <tr>
                                  <td>
                                      {{  $supplier->id ?? '' }}
                                  </td>
                                  <td>
                                      {{  $supplier->name ?? '' }}
                                  </td>
                                  <td>
                                      {{ $supplier->address ?? '' }}
                                  </td>
                                
                                  <td>
                                    {{  number_format($supplier->current_balance , 2, '.', ',') }}
                                  </td>
                                  <td>
                                    {{ $supplier->updated_at->format('M j , Y h:i A') }}
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
                                  {{  number_format($account_payables->sum->current_balance , 2, '.', ',') }}
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
                <button type="button" id="btn_excel_payable_report" class="text-uppercase btn btn-default">Excel Report</button>
                <button type="button" id="btn_print_payable_report" class="text-uppercase btn btn-default">Print Report</button>

            </div>
    
        </div>
    </div>
</div>

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
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

    $('.datatable-suppliers').DataTable({ 
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
            

            // Update footer
            $(api.column(5).footer()).html(number_format(bal, 2,'.', ','));
        },
   })
    
});



</script>