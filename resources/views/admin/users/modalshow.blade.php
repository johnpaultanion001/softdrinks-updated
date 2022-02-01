<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="control-label" >Name : </label>
            <input type="text" name="title" id="title" value="{{$user->name}}" class="form-control" readonly/>
            <span class="invalid-feedback" role="alert">
                <strong id="error-title"></strong>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label" >Email : </label>
            <input type="text" name="title" id="title" value="{{$user->email}}" class="form-control" readonly/>
            <span class="invalid-feedback" role="alert">
                <strong id="error-title"></strong>
            </span>
        </div>
       

        <div class="form-group">
                <label class="control-label" >Roles: </label>
                    @foreach($user->roles as $key => $roles)
                        <span class="badge badge-dark bg-yellow">{{ $roles->title }}</span>
                    @endforeach
            
        </div>
    </div>
</div>
    
