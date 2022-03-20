@extends('../layouts.admin')
@section('sub-title','TRANSACTIONS')
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
        
        <div class="col-xl-12" id="load_transactions">
          
        </div>
       

       
        <!-- Footer -->
        @section('footer')
            @include('../partials.footer')
        @endsection
      </div>
</div>

<!-- modal for Filter -->
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
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label" >To: </label>
                    <input type="date"  name="fbd_to_date" id="fbd_to_date"  class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
        </div>
        <div class="col text-right">
          <button id="filter_by_date" name="filter_by_date" filter="fbd"  type="button" class="btn btn-default filter">Submit</button>
        </div>
            
      </div>
    </div>
  </div>
</div>




@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
var filter_inventory = null;

$(function () {
    
    return load();
});

function load(){
    $.ajax({
        url: "transactions_load", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#load_transactions').hide();
            $('#loading-container').show();
            $('.button-loading').show();
            
        },
        success: function(response){
            $('#load_transactions').show();
            $('#loading-container').hide();
            $('.button-loading').hide();
            $("#load_transactions").html(response);
        }
        	
    })
}



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

$(document).on('click', '#btn_print_inventory_report', function(){
    $('#table_inventory_report').DataTable().buttons(0,1).trigger()
});

$(document).on('click', '#btn_excel_inventory_report', function(){
    $('#table_inventory_report').DataTable().buttons(0,0).trigger()
});

$(document).on('click', '#btn_sales_for_today', function(){
    var table = $('#table_inventory_report').DataTable();
     $.fn.dataTable.ext.search.push(
         function (settings, data, dataIndex){
            return (data[3] > 0) ? true : false;
         }
      );
    table.draw();
});

$(document).on('click', '#btn_print_assign_deliver', function(){
    var contents = $(".print_assign_deliver").html();
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


 //Filter
 $(document).on('click', '.filter', function(){
    var filter = $(this).attr('filter');
    var from = $('#fbd_from_date').val();
    var to = $('#fbd_to_date').val();

    $.ajax({
        url: "/admin/transactions_filter", 
        type: "get",
        data: {filter:filter,from:from,to:to, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {
            $('#filter_loading').show();
        },
        success: function(response){
            $('#filter_loading').hide();
            filter_inventory = filter;
            $("#load_transactions").html(response);
        }	
    })
});

$(document).on('change', '.dd_filter', function(){
    var value = $(this).val();
    var filter = $(this).attr('filter');
    $.ajax({
        url: "/admin/transactions_filter", 
        type: "get",
        data: {filter:filter,value:value, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {
            $('#filter_loading').show();
        },
        success: function(response){
            $('#filter_loading').hide();
            $("#load_transactions").html(response);
        }	
    })
});


$(document).on('click', '#btn_inventory_report', function(){

    $.ajax({
        url: "/admin/transactions/inventory_report", 
        type: "get",
        data: {_token: '{!! csrf_token() !!}'},
        dataType: "json",
        beforeSend: function() {
            $('#btn_inventory_report').attr('disabled', true);
        },
        success: function(data){
            $('#btn_inventory_report').attr('disabled', false);
            
            var list = '';
            $.each(data.data, function(key,value){
                list += '<tr>';
                    list += '<td>';
                        list += value.product;
                    list += '</td>';
                    list += '<td>';
                        list += value.category;
                    list += '</td>';
                    list += '<td>';
                        list += value.beginning_inventory;
                    list += '</td>';
                    list += '<td>';
                        list += value.sales_inventory;
                    list += '</td>';
                    list += '<td>';
                        list += value.ending_inventory;
                    list += '</td>';
                    list += '<td>';
                        list += value.delivery_inventory;
                    list += '</td>';
                list += '</tr>';
            });
            
            $('#list_inventory_report').empty().append(list);
            $('#modal_inventory').modal('show');
            table_inventory_report()

        }	
    })
    
});

function table_inventory_report(){
    var title = $('#title_inv_report').text();
    var header = $('#header_inventory').html();
    $('#table_inventory_report').DataTable({
        bDestroy: true,
        buttons: [
            { 
                extend: 'excel',
                className: 'd-none',
                title: title,
                exportOptions: {
                    columns: ':visible'
                }
            },
            { 
                extend: 'print',
                title:  '<center>' + header + '</center>',
                className: 'd-none',
                
            }
        ],
    });
}


</script>
@endsection


