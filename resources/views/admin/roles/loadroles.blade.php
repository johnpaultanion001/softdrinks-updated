
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0" id="titletable">Roles</h3>
            </div>
            <div class="col text-right">
              <a href="{{ route("admin.roles.create") }}"  class="btn btn-sm btn-primary">New Role</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries">
            <thead class="thead-light">
                 <tr>
                    <th scope="col">Action</th>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Permissions</th>
                 </tr>
            </thead>
            <tbody>
              @foreach($roles as $key => $role)
                    <tr data-entry-id="{{ $role->id ?? '' }}">
                       <td>
                            <button type="button" name="view" view="{{  $role->id ?? '' }}" class="view btn btn-success btn-sm">View</button>
                            <a href="{{ route('admin.roles.edit', $role->id) }}"  class="edit btn btn-info btn-sm">Edit</a>
                            <button type="button" name="delete" delete="{{  $role->id ?? '' }}" id="{{  $role->id ?? '' }}" class="delete btn btn-danger btn-sm">Delete</button>
                        </td>
                        <td>
                            {{  $role->id ?? '' }}
                        </td>
                        <td>
                            {{  $role->title ?? '' }}
                        </td>
                        <td> 
                            @foreach($role->permissions as $key => $item)
                                <span class="badge badge-dark bg-yellow">{{ $item->title }}</span>
                            @endforeach
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

