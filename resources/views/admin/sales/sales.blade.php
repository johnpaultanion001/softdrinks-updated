@extends('../layouts.admin')
@section('sub-title','Sales')
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

<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
      <div class="row">
        
        <div class="col-xl-12" id="loadsales">
          
        </div>
       

       
        <!-- Footer -->
        @section('footer')
            @include('../partials.footer')
        @endsection
      </div>
</div>

<!-- modal Filter -->
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
                    <input type="date" name="from_date" id="from_date"  class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label" >To: </label>
                    <input type="date"  name="to_date" id="to_date"  class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
        </div>
        <div class="col text-right">
          <button id="filter" name="filter"  type="button" class="btn btn-default">Submit</button>
        </div>
            
      </div>
    </div>
  </div>
</div>

<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="loading-productmodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="receiptmodal">
                    
                    </div>
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Print Receipt"/>
                </div>
        
            </div>
        </div>
    </div>
</form>



@endsection

@section('script')
<script>

$(function () {
    
    return loadSales();
});

function loadSales(){
    $.ajax({
        url: "loadsales", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loadsales').hide();
            $('#title-sales').html('Loading...');
            $('#loading-container').show();
            $('.button-loading').show();
            
        },
        success: function(response){
            $('#loadsales').show();
            $("#loadsales").html(response);
            $('#title-sales').html('All Sales');
            $('#loading-container').hide();
            $('.button-loading').hide();
        }
        	
    })
}
//daily
$(document).on('click', '#daily', function(){
   $.ajax({
        url: "sales-daily", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('.button-loading').show();
        },
        success: function(response){
            $("#loadsales").html(response);
            $('#title-sales').html('Daily Sales');
            $('.button-loading').hide();
        }	
    })
});
//monthly
$(document).on('click', '#monthly', function(){
   $.ajax({
        url: "sales-monthly", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('.button-loading').show();
        },
        success: function(response){
            $("#loadsales").html(response);
            $('#title-sales').html('Monthly Sales');
            $('.button-loading').hide();
        }	
    })
});
//yearly
$(document).on('click', '#yearly', function(){
    $.ajax({
        url: "sales-yearly", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('.button-loading').show();
        },
        success: function(response){
            $("#loadsales").html(response);
            $('#title-sales').html('Yearly Sales');
            $('.button-loading').hide();
        }	
    })
});
//all
$(document).on('click', '#all', function(){
    return loadSales();
});

//filter by date
function fetch_data(from_date = '', to_date = '')
    {
        $.ajax({
            url:"{{ route('admin.daterange.fetch_data') }}",
            method:"POST",
            data:{from_date:from_date, to_date:to_date, _token:_token},
            dataType:"HTMl",
            beforeSend: function() {
                 $('#title-sales').html('Loading...');
                 $('.button-loading').show();
            },
            success:function(data)
            {
                $('#modalfilter').modal('hide');
                $("#loadsales").html(data);
                $('#title-sales').html('Filter By Date');
                $('.button-loading').hide();
            }
        });
    }
    
    $(document).on('click', '#filter', function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if(from_date != '' &&  to_date != '')
        {
            fetch_data(from_date, to_date);
        }
        else
        {
            $.alert({
                    title: 'Error Message',
                    content: 'Both Date is required',
                    type: 'red',
                })  
        }
    });

$(document).on('click', '.receipt', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('Print Receipt');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    var id = $(this).attr('receipt');

    $.ajax({
        url :"/admin/sales/"+id,
        type: "get",
        dataType: "HTMl",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('#loading-productmodal').show();
            $('#modalbody').hide();
            
        },
        success:function(response){

            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Print Receipt");
            $('#loading-productmodal').hide();
            $("#receiptmodal").html(response);
        }
    })
}); 

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('#receipt-body').removeClass('receipt-body');
        var contents = $("#receiptreport").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Title</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="/assets/css/argon.css" rel="stylesheet" type="text/css" />');
        frameDoc.document.write('<style>size: A4 portrait;</style>');
        var source = 'bootstrap.min.js';
        var script = document.createElement('script');
        script.setAttribute('type', 'text/javascript');
        script.setAttribute('src', source);
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
        }, 500);
        $('#receipt-body').addClass('receipt-body');
});

$(document).on('click', '#btn_show_profit_report', function(){
    $('#modal_profit_report').modal('show');
    $('.modal-title-profit-report').text('Profit Report');
    
});

$(document).on('click', '#btn_print_profit_report', function(){
    var contents = $(".print_report").html();
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({ "position": "absolute", "top": "-1000000px" });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html><head><title>Title</title>');
    frameDoc.document.write('</head><body>');
    //Append the external CSS file.
    frameDoc.document.write('<link href="/assets/css/argon.css" rel="stylesheet" type="text/css" />');
    frameDoc.document.write('<style>size: A4 portrait;</style>');
    var source = 'bootstrap.min.js';
    var script = document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.setAttribute('src', source);
    //Append the DIV contents.
    frameDoc.document.write(contents);
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();
    setTimeout(function () {
    window.frames["frame1"].focus();
    window.frames["frame1"].print();
    frame1.remove();
    }, 500);
});

</script>
@endsection


