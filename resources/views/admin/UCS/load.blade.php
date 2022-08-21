
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>


<div class="mt--6 card">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col-md-12">
        <h3 class="mb-0 text-uppercase" id="title_records"></h3>
      </div>
      <div class="col-md-12">
        <small class="mb-0 text-uppercase font-weight-bold modal-title" id="title-sales"> </small> <small>Filter By: {{$title_filter}}</small> 
        <i id="filter_loading" class="fa fa-spinner fa-spin text-primary ml-2"></i>
      </div>
      <div class="col-md-12">
            <button id="daily" name="daily" filter="daily" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
            <button id="weekly" name="weekly" filter="weekly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Weekly</button>
            <button id="monthly" name="monthly" filter="monthly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
            <button id="yearly" name="yearly" filter="yearly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
            <button id="all" name="all" filter="all" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">All</button>
            <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
      </div>
      
      <div class="col-md-12 mt-2">
          <div class="row">
              <div class="col-md-3">
                <div class="col-sm-12">
                  <h4 class="text-dark">Total Softdrinks UCS:</h4>
                    <div class="input-group ">
                    <div class="input-group-prepend ">
                        <div class="input-group-text text-primary">UCS</div>
                    </div>
                        <input type="text" class="form-control" value="{{ number_format($ucs_softdrinks ?? '' , 2, '.', ',') }}" readonly>
                    </div>
                    
                </div>
                
                
              </div>
              <div class="col-md-3">
                <div class="col-sm-12">
                  <h4 class="text-dark">Total Water/Juice UCS:</h4>
                    <div class="input-group ">
                    <div class="input-group-prepend ">
                        <div class="input-group-text text-primary">UCS</div>
                    </div>
                        <input type="text" class="form-control" value="{{ number_format($ucs_wj ?? '' , 2, '.', ',') }}" readonly>
                    </div>
                    
                </div>
              </div>
              <div class="col-md-3">
                <div class="col-sm-12">
                  <h4 class="text-dark">Total Cost:</h4>
                    <div class="input-group ">
                    <div class="input-group-prepend ">
                        <div class="input-group-text text-primary">₱</div>
                    </div>
                        <input type="text" id="total_cost" class="form-control" value="0.00" readonly>
                    </div>
                    
                </div>
              </div>
              <div class="col-md-3 text-right mt-2">
                <div class="col">
                  <button type="button" name="all_ucs_report" id="all_ucs_report" class="text-uppercase btn btn-sm btn-primary">ALL UCS REPORTS</button>
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
          <th>RG ID / Supplier</th>
          <th>Product Code</th>
          <th>Description</th>
          <th>Category</th>
          <th>Product Size / UCS</th>
          <th>QTY</th>
          <th>UCS Total</th>
          <th>Total Cost</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($ucs_records as $ucs)
              <tr data-entry-id="{{ $ucs->id ?? '' }}">
                  <td>
                    {{  $ucs->receiving_good_id ?? '' }} / {{  $ucs->receiving_good->supplier->name ?? '' }}
                  </td>
                  <td>
                      {{  $ucs->product->product_code ?? '' }}
                  </td>
                  
                  <td>
                      {{  $ucs->product->description ?? '' }}
                  </td>
                  <td>
                      {{  $ucs->product->category->name ?? '' }}
                  </td>
                  <td>
                      {{  $ucs->product->size->title ?? '' }}  {{  $ucs->product->size->size ?? '' }} / {{ number_format($ucs->product->size->ucs ?? '' , 2, '.', ',') }} 
                  </td>
                  <td>
                      {{  $ucs->qty ?? '' }}
                  </td>
                  <td>
                      {{ number_format( $ucs->ucs ?? '' , 2, '.', ',') }} 
                  </td>
                  <td>
                      {{ number_format( $ucs->product->total_cost ?? '' , 2, '.', ',') }} 
                  </td>
                  <td>
                      {{ $ucs->created_at->format('M j , Y h:i A') }}
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
          <th>QTY</th>
          <th>UCS Total</th>
          <th>Total Cost</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<!-- Footer -->
@section('footer')
  @include('../partials.footer')
@endsection


<script>
$(function () {
 
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
    $.extend(true, $.fn.dataTable.defaults, {
      pageLength: 100,
      bDestroy: true,
      responsive: true,
      scrollY: 500,
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

    $('.datatable-ucs').DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            qty = api
                .column(5, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
           
            total_ucs = api
                .column(6, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            total_cost = api
                .column(7, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            $(api.column(5).footer()).html(number_format(qty, 2,'.', ','));
            $(api.column(6).footer()).html(number_format(total_ucs, 2,'.', ','));
            $(api.column(7).footer()).html(number_format(total_cost, 2,'.', ','));
            $('#total_cost').val(number_format(total_cost, 2,'.', ','));
            
        },
    });


    $('#filter_loading').hide();
    if($('#ucs').val() == 'all'){
      $("#all_ucs_report").text('ALL UCS RECORDS');
      $("#title_records").text('UCS RECORDS')
      $('#back_to_zero').show();
    }else{
      $("#all_ucs_report").text('UCS RECORDS');
      $("#title_records").text('ALL UCS RECORDS')
      $('#back_to_zero').hide();
    }
});



</script>