@extends('../layouts.admin')
@section('sub-title','Graph')
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
        
        <div class="col-xl-12 ">
            <div class="bg-white p-4" style="border-radius: 10px;">
                 <h3 id="title-sales" class="text-uppercase font-weight-bold">Graph By Daily</h3>  
                 <button id="daily" name="daily" class="text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
                <button id="monthly" name="monthly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                <button id="yearly" name="yearly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                
               
                <div id="loading-container" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div>

                <div id="loadgraph">
                        
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

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> {!! $chart1->renderJs() !!}
<script>

$(function () {
    
   
});

$(function () {
    
    return loadgraph();
});

//default
function loadgraph(){
    $.ajax({
        url: "graph-daily", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('#loading-container').show();
            $("#loadgraph").hide();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadgraph").show();
            $("#loadgraph").html(response);
            $('#title-sales').html('Graph By Daily');
        }	
        	
    })
}

//daily
$(document).on('click', '#daily', function(){
   $.ajax({
        url: "graph-daily", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('.loading').show();
            $("#loadgraph").hide();
        },
        success: function(response){
            $('.loading').hide();
            $("#loadgraph").show();
            $("#loadgraph").html(response);
            $('#title-sales').html('Graph By Daily');
        }	
    })
});

//daily
$(document).on('click', '#monthly', function(){
   $.ajax({
        url: "graph-monthly", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('.loading').show();
            $("#loadgraph").hide();
        },
        success: function(response){
            $('.loading').hide();
            $("#loadgraph").show();
            $("#loadgraph").html(response);
            $('#title-sales').html('Graph By Monthly');
        }	
    })
});

//yearly
$(document).on('click', '#yearly', function(){
   $.ajax({
        url: "graph-yearly", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('.loading').show();
            $("#loadgraph").hide();
        },
        success: function(response){
            $('.loading').hide();
            $("#loadgraph").show();
            $("#loadgraph").html(response);
            $('#title-sales').html('Graph By Yearly');
        }	
    })
});
</script>
@endsection
