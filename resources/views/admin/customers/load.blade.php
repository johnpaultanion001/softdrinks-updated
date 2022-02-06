
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Customers</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="account_receivables" id="account_receivables" class="text-uppercase account_receivables btn btn-sm btn-primary">Account Receivables</button>
              <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Customer</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-customers display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Actions</th>
                <th>Customer Code</th>
                <th>Customer Name</th>
                <th>Area</th>
                <th>Contact Number</th>
                <th>Current Balance</th>
                <th>Created At</th>
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
                            {{ $customer->created_at->format('M j , Y h:i A') }}
                        </td>
                     
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
  </div>
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
                  <div class="col text-center">
                     <h3 class="text-uppercase">Jewel & Nickel Store</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase">Account Receivables</h5>
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" cellspacing="0" width="100%">
                      <thead class="thead-white">
                        <tr>
                          
                          <th>Customer Code</th>
                          <th>Customer Name</th>
                          <th>Area</th>
                          <th>Current Balance</th>
                        
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
                                
                              
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                 </div>
                </div>
                
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                <button type="button" name="print_acc" id="print_acc" class="text-uppercase print_acc btn btn-default">Print Account Receivables</button>

            </div>
    
        </div>
    </div>
</div>



<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 50,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-customers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>