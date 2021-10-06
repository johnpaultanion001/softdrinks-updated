
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
              <h3 class="mb-0" id="titletable">Users</h3>
            </div>
            <div class="col text-right">
              <a href="{{ route("admin.users.create") }}"  class="btn btn-sm btn-primary">New User</a>
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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                 </tr>
            </thead>
            <tbody>
              @foreach($users as $key => $user)
                    <tr data-entry-id="{{ $user->id ?? '' }}">
                       <td>
                            <button type="button" name="view" view="{{  $user->id ?? '' }}" class="view btn btn-success btn-sm">View</button>
                            <a href="{{ route('admin.users.edit', $user->id) }}"  class="edit btn btn-info btn-sm">Edit</a>
                            <button type="button" name="delete" delete="{{  $user->id ?? '' }}" id="{{  $user->id ?? '' }}" class="delete btn btn-danger btn-sm">Delete</button>
                        </td>
                        <td>
                            {{  $user->id ?? '' }}
                        </td>
                        <td>
                            {{  $user->name ?? '' }}
                        </td>
                        <td>
                            {{  $user->email ?? '' }}
                        </td>
                        <td> 
                               @foreach($user->roles as $key => $item)
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

