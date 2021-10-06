
@extends('../layouts.admin')
@section('sub-title','Role - Edit')
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
              <h3 class="mb-0" id="titletable">Role - Edit</h3>
            </div>
            <div class="col text-right">
                <a href="{{ route("admin.roles.create") }}"  class="btn btn-sm btn-primary">New Role</a>
            </div>
          </div>
        </div>

        <div class="card-body">
        <form method="POST" action="{{ route("admin.roles.update", [$role->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">Title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $role->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
               
            </div>
            <div class="form-group">
                <label class="required" for="permissions">Permissions</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-sm select-all" style="border-radius: 0">Select All</span>
                    <span class="btn btn-info btn-sm deselect-all" style="border-radius: 0">Deselect All</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </div>
                @endif
                
            </div>
            <div class="form-group text-right">
                <a href="{{ route("admin.roles.index") }}" class="btn-secondary btn">Back</a>
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

