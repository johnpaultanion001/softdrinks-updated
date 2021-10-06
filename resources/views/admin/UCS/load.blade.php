
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
              <h3 class="mb-0 text-uppercase" id="titletable">UCS REPORTS</h3>
            </div>
            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-md-8">
                      <div class="col-sm-5">
                        <h4 class="text-dark">Total Overall UCS:</h4>
                          <div class="input-group ">
                          <div class="input-group-prepend ">
                              <div class="input-group-text text-primary">UCS</div>
                          </div>
                             <input type="text" class="form-control" name="ucstotal" id="ucstotal" value="{{ number_format($totalucs->sum('ucs') ?? '' , 2, '.', ',') }}" readonly>
                          </div>
                      </div>
                      
                    </div>
              
                    <div class="col-md-4 text-right mt-2">
                      <div class="col">
                        <button type="button" name="all_ucs_report" id="all_ucs_report" class="text-uppercase btn btn-sm btn-primary">All UCS Reports</button>
                      </div>
                      <div class="col mt-2">
                        <button type="button" name="back_to_zero" id="back_to_zero" class="text-uppercase btn btn-sm btn-primary">Back To Zero</button>
                      </div>
                    </div>

                </div>
                
               
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-ucs display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Receiving Good ID / Supplier</th>
                <th>Product ID</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Category</th>
                <th>Product Size / UCS</th>
                <th>QTY</th>
                <th>UCS Total</th>
                <th>Date</th>
                
                
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($totalucs as $key => $ucs)
                    <tr data-entry-id="{{ $ucs->id ?? '' }}">
                        <td>
                          {{  $ucs->purchase_order_number_id ?? '' }} - {{  $ucs->purchase_order->supplier->name ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->product_id ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->product_code ?? '' }}
                        </td>
                        
                        <td>
                            {{  $ucs->inventory->short_description ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->category->name ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->size->title ?? '' }}  {{  $ucs->inventory->size->size ?? '' }} / {{ number_format($ucs->inventory->size->ucs ?? '' , 2, '.', ',') }} 
                        </td>
                        <td>
                            {{  $ucs->qty ?? '' }}
                        </td>
                        <td>
                            {{ number_format( $ucs->ucs ?? '' , 2, '.', ',') }} 
                        </td>
                        <td>
                            {{ $ucs->created_at->format('F d,Y h:i A') }}
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

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-ucs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});



</script>