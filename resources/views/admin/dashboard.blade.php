@extends('../layouts.admin')
@section('sub-title','DASHBOARD')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection

@section('content')
  <div id="loaddashboard">
    <div id="loading-container" class="loading-container">
        <div class="loading"></div>
            <div id="loading-text">loading</div>
    </div>
  </div>
  <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
@endsection


@section('script')
<script>

$(function () {
    
    return loadDashboard();
});

function loadDashboard(){
    $.ajax({
        url: "loaddashboard", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loaddashboard").html(response);
        }	
    })
}

 

</script>
@endsection




