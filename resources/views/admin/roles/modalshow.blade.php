<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label" >Title : </label>
            <input type="text" name="title" id="title" value="{{$role->title}}" class="form-control" readonly/>
            <span class="invalid-feedback" role="alert">
                <strong id="error-title"></strong>
            </span>
        </div>
        <div class="form-group">
                <label class="control-label" >Permissions: </label>
                @foreach($role->permissions as $key => $permissions)
                    <span class="badge badge-dark bg-yellow">{{ $permissions->title }}</span>
                @endforeach
            
        </div>
    </div>
</div>
    
