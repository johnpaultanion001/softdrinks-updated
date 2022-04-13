
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->

<div class="mt--6 card">
  <div class="card-header border-0">
    <div class="row align-items-center">
      <div class="col">
        <h3 class="mb-0 text-uppercase" id="titletable">Status of Return</h3>
      </div>
      <div class="col text-right">
        <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Status</button>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-status display" cellspacing="0" width="100%">
      <thead class="thead-white">
        <tr>
          <th>Actions</th>
          <th>Code</th>
          <th>Title</th>
          <th>Created At</th>
          
          
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($status as $key => $stat)
              <tr data-entry-id="{{ $stat->id ?? '' }}">
                  
                  <td>
                      <button type="button" name="edit" edit="{{  $stat->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                      <button type="button" name="remove" remove="{{  $stat->id ?? '' }}" id="{{  $stat->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </td>
                  <td>
                      {{  $stat->code ?? '' }}
                  </td>
                  <td>
                      {{  $stat->title ?? '' }}
                  </td>
                  <td>
                      {{ $stat->created_at->format('M j , Y h:i A') }}
                  </td>
                  
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Footer -->
@section('footer')
  @include('../partials.footer')
@endsection


<script>
$(function () {
    $('.datatable-status').DataTable({
        bDestroy: true,
        buttons: [
           
        ],
        pageLength: 100,
    });

});



</script>