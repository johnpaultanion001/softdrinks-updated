
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
              <h3 class="mb-0 text-uppercase" id="titletable">Suppliers</h3>
            </div>
            <div class="col text-right">
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
                <th>Remarks</th>
                <th>Date</th>
                
                
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($suppliers as $key => $supplier)
                    <tr data-entry-id="{{ $supplier->id ?? '' }}">
                        <td>
                            <button type="button" name="edit" edit="{{  $supplier->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm">Edit</button>
                            <button type="button" name="remove" remove="{{  $supplier->id ?? '' }}" id="{{  $supplier->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm">Remove</button>
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
                            {{  $supplier->remarks ?? '' }}
                        </td>
                        <td>
                            {{ $supplier->created_at->format('F d,Y h:i A') }}
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

  $('.datatable-suppliers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>