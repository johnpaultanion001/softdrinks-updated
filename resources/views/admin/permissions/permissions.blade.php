@extends('../layouts.admin')
@section('sub-title','Permissions')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loadpermissions">
        <div id="loading-container" class="loading-container">
            <div class="loading"></div>
            <div id="loading-text">loading</div>
        </div>
</div>

@endsection

@section('script')
<script>
$(function () {
    
    return loadPermission();
});

function loadPermission(){
    $.ajax({
        url: "loadpermissions", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadpermissions").html(response);
        }	
    })
}

</script>
@endsection
