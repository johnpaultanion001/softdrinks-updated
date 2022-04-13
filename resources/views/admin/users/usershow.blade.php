
@extends('../layouts.admin')
@section('sub-title','User Show')
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

<div class="card mt--6">
    <div class="card-header border-0">
        <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0 text-uppercase" id="titletable">User - {{$user->name}}</h3>
        </div>
        
        </div>
    </div>

    <div class="card-body">
        <form method="post" id="myForm" class="form-horizontal">
            @csrf
        
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label text-uppercase" >Name: </label>
                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-name"></strong>
                    </span>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label text-uppercase" >Email: </label>
                    <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-email"></strong>
                    </span>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label text-uppercase" >Current Password: </label>
                    <input type="password" name="current_password" id="current_password" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-current_password"></strong>
                    </span>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label text-uppercase" >New Password: </label>
                    <input type="password" name="new_password" id="new_password" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-new_password"></strong>
                    </span>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label text-uppercase" >Confirm New Password: </label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-confirm_password"></strong>
                    </span>
                </div>
            </div>
            <input type="hidden" name="hidden_id" id="hidden_id" value="{{$user->id}}">
            <div class="form-group text-right">
                <a href="{{ route("admin.dashboard") }}" class="btn-secondary btn">Back</a>
                <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Submit" />
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
@section('footer')
    @include('../partials.footer')
@endsection



@endsection


@section('script')
<script>

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#hidden_id').val();
    var action_url = "/admin/user/" + id;
    var type = "PUT";


    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
           
        },
        success:function(data){
            var html = '';
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Submit");
            
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#myForm')[0].reset();
            }
           
        }
    });
});

</script>
@endsection


