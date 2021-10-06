
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
              <h3 class="mb-0 text-uppercase" id="titletable">Sizes</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Size</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-sizes display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Actions</th>
                <th>Title</th>
                <th>UCS PER CATEGORY</th>
                <th>Size</th>
                <th>UCS</th>
                <th>Date</th>
                <th>Note</th>
                
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($sizes as $key => $size)
                    <tr data-entry-id="{{ $size->id ?? '' }}">
                        <td>
                            <button type="button" name="edit" edit="{{  $size->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm">Edit</button>
                            <button type="button" name="remove" remove="{{  $size->id ?? '' }}" id="{{  $size->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm">Remove</button>
                        </td>
                        <td>
                            {{  $size->title ?? '' }}
                        </td>
                        <td>
                            {{  $size->category->name ?? '' }}
                        </td>
                        <td>
                            {{  $size->size ?? '' }}
                        </td>
                        <td>
                            {{  $size->ucs ?? '' }}
                        </td>
                        <td>
                            {{ $size->created_at->format('F d,Y h:i A') }}
                        </td>
                        <td>
                            {{  $size->note ?? '' }}
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

  $('.datatable-sizes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>