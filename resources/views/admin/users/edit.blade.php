
@extends('../layouts.admin')
@section('sub-title','User - Edit')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')




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
              <h3 class="mb-0" id="titletable">User - Edit</h3>
            </div>
            <div class="col text-right">
                <a href="{{ route("admin.users.create") }}"  class="btn btn-sm btn-primary">New User</a>
            </div>
          </div>
        </div>

        <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name :</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="email">Email :</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                
            </div>
            <div class="form-group">
                <label class="required" for="password">Password :</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                
            </div>
            <div class="form-group">
                <label class="required" for="roles">Roles</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-sm select-all" style="border-radius: 0">Select All</span>
                    <span class="btn btn-info btn-sm deselect-all" style="border-radius: 0">Deselect All</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group text-right">
                <a href="{{ route("admin.users.index") }}" class="btn-secondary btn">Back</a>
                <button class="btn btn-primary " type="submit"> Submit</button>
            </div>
        </form>
    </div>
        
      </div>
    </div>
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
  </div>
</div>


@endsection

