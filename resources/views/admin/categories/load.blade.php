
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
              <h3 class="mb-0 text-uppercase" id="titletable">Categories</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Category</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-categories display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Actions</th>
                <th>Name</th>
                <th>Note</th>
                <th>Created At</th>
                
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($categories as $key => $category)
                    <tr data-entry-id="{{ $category->id ?? '' }}">
                        <td>
                            <button type="button" name="edit" edit="{{  $category->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm">Edit</button>
                            <button type="button" name="remove" remove="{{  $category->id ?? '' }}" id="{{  $category->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm">Remove</button>
                        </td>
                        <td>
                            {{  $category->name ?? '' }}
                        </td>
                        <td>
                            {{  $category->note ?? '' }}
                        </td>
                        <td>
                            {{ $category->created_at->format('F d,Y h:i A') }}
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

  $('.datatable-categories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>