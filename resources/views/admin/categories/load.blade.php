
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>


<div class="mt--6 card">
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
          <th>Remarks</th>
          <th>Created At</th>
          
        </tr>
      </thead>
      <tbody class="text-uppercase font-weight-bold">
        @foreach($categories as $key => $category)
              <tr data-entry-id="{{ $category->id ?? '' }}">
                  <td>
                      <button type="button" name="edit" edit="{{  $category->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                      <button type="button" name="remove" remove="{{  $category->id ?? '' }}" id="{{  $category->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </td>
                  <td>
                      {{  $category->name ?? '' }}
                  </td>
                  <td>
                      {{  $category->note ?? '' }}
                  </td>
                  <td>
                      {{ $category->created_at->format('M j , Y h:i A') }}
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
    $('.datatable-categories').DataTable({
        bDestroy: true,
        buttons: [
           
        ],
        pageLength: 100,
    });

});

</script>