@extends('../layouts.admin')
@section('sub-title','GRAPH')
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
<div class="mt--6 card">
     
        
            <div class="bg-white p-4" style="border-radius: 10px;">
                 <h3 id="title-sales" class="text-uppercase font-weight-bold">Graph By Daily</h3>  
                 <button id="daily" name="daily" class="text-uppercase btn btn-sm btn-primary mt-2 ">Last 7 Days</button>
                 <button id="monthly" name="monthly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                 <button id="yearly" name="yearly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                 <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
                
               
                <div id="loading-container" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div>
              
                <div id="loadgraph" class="mt-2">

                </div>
                
            </div>

        <!-- Footer -->
        @section('footer')
            @include('../partials.footer')
        @endsection
      
</div>
<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">Filter Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
               <div class="form-group">
                    <label class="control-label" >From: </label>
                    <input type="date" name="fbd_from_date" id="fbd_from_date"  class="form-control" />
                  
                </div>
                <div class="form-group">
                    <label class="control-label" >To: </label>
                    <input type="date"  name="fbd_to_date" id="fbd_to_date"  class="form-control" />
                    
                </div>
        </div>
        <div class="col text-right">
          <button id="filter_by_date" name="filter_by_date" type="button" class="btn btn-default filter">Submit</button>
        </div>
            
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>

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
            $('#title-sales').html('Graph By Last 7 Days');
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
            $('#title-sales').html('Graph By Last 7 Days');
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

$(document).on('click', '#filter_by_date', function(){
    var from = $('#fbd_from_date').val();
    var to = $('#fbd_to_date').val();

    $.ajax({
        url: "graph-date", 
        type: "get",
        data: {from:from,to:to, _token: '{!! csrf_token() !!}'},
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
            $('#title-sales').html('Graph By Custom Date');
        }	
    })
   
});

</script>
@endsection
