@extends('../layouts.admin')
@section('sub-title','TRANSACTIONS')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection

@section('content')
<style>
   .input_ending {
        background-color: transparent;
        cursor: not-allowed;
        border: none;
    }
    .input_ending:focus{
        background-color: transparent;
        cursor: not-allowed;
        border: none;
    }
</style>

<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>
<!-- Page content -->
  
<div id="load_transactions">
    
</div>

<!-- Footer -->
@section('footer')
    @include('../partials.footer')
@endsection

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

number_format = function (number, decimals, dec_point, thousands_sep) {
    number = number.toFixed(decimals);

    var nstr = number.toString();
    nstr += '';
    x = nstr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? dec_point + x[1] : '';
    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

    return x1 + x2;
}

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

    var title = $('.modal-title-profit-report').text();
    var header = $('#header_profit').html();
    $('#table_profit_report').DataTable({
        bDestroy: true,
        responsive: true,
        scrollY: 500,
        scrollCollapse: true,
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
});

$(document).on('click', '#btn_print_profit_report', function(){
    $('#table_profit_report').DataTable().buttons(0,1).trigger()
});

$(document).on('click', '#btn_excel_profit_report', function(){
    $('#table_profit_report').DataTable().buttons(0,0).trigger()
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
            return (data[4] > 0) ? true : false;
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
                        list += value.description;
                    list += '</td>';
                    list += '<td>';
                        list += value.category;
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.beginning_inventory, 2,'.', ',');
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.sales_inventory, 2,'.', ',');
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.delivery_inventory, 2,'.', ',');
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.ending_inventory, 2,'.', ',');;
                    list += '</td>';
                    
                list += '</tr>';
            });
            
            $('#list_inventory_report').empty().append(list);
            $("#date_inv").text(data.filter_date);
            $("#filter_by_date_inv").val(null);
            $('#modal_inventory').modal('show');
            table_inventory_report();
        }	
    })
});

function table_inventory_report(){
    var title = $('#title_inv_report').text();
    var header = $('#header_inventory').html();
    $('#table_inventory_report').DataTable({
        bDestroy: true,
        responsive: true,
        scrollY: 500,
        scrollCollapse: true,
        buttons: [
            { 
                extend: 'excel',
                className: 'd-none',
                title: title,
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            { 
                extend: 'print',
                title:  '<center>' + header + '</center>',
                footer: true,
                className: 'd-none',
                
            }
        ],
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            beg_inv = api
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            sales_inv = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            del_inv = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            end_inv = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
           
            // Update footer
            $(api.column(3).footer()).html(number_format(beg_inv, 2,'.', ','));
            $(api.column(4).footer()).html(number_format(sales_inv, 2,'.', ','));
            $(api.column(5).footer()).html(number_format(del_inv, 2,'.', ','));
            $(api.column(6).footer()).html(number_format(end_inv, 2,'.', ','));
          
            
        },
    });
}

$(document).on('click', '#btn_ending_inventory_report', function(){
    $('#modal_ending_inventory').modal('show');
    
    data_ending_inventory();
    
});

function data_ending_inventory(){
    
    $.ajax({
        url: "/admin/transactions/ending_inventory_report", 
        type: "get",
        data: {_token: '{!! csrf_token() !!}'},
        dataType: "json",
        beforeSend: function() {
            $('#btn_ending_inventory_report').attr('disabled', true);
        },
        success: function(data){
            $('#btn_ending_inventory_report').attr('disabled', false);
            
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
                        list += value.full_goods;
                    list += '</td>';
                    list += '<td>';
                        list += value.full_emptys;
                    list += '</td>';
                    list += '<td>';
                        list += value.shell;
                    list += '</td>';
                    list += '<td>';
                        list += value.bottles;
                    list += '</td>';
                list += '</tr>';
            });
                list += '<tr>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                list += '</tr>';
                list += '<tr>';
                    list += '<td>';
                        list += 'PALLETS';
                    list += '</td>';
                    list += '<td>';
                        list += 'STOCKS';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                list += '</tr>';
                $.each(data.pallets, function(key,value){
                    list += '<tr>';
                        list += '<td>';
                            list += value.title;
                        list += '</td>';
                        list += '<td>';
                            list += value.stock;
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                    list += '</tr>';
                });
            $('#list_ending_inventory_report').empty().append(list);
            $("#date_end_inv").text(data.filter_date);
            $("#filter_by_date_end_inv").val(null);
            table_ending_inventory_report();
        }	
    })

    
}

function table_ending_inventory_report(){
    var title = $('#title_ending_inv_report').text();
    var header = $('#header_ending_inventory').html();
    $('#table_ending_inventory_report').DataTable({
        bDestroy: true,
        responsive: true,
        scrollY: 500,
        scrollCollapse: true,
        buttons: [
            { 
                extend: 'excel',
                className: 'd-none',
                title: title,
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
            },
            { 
                extend: 'print',
                title:  '<center>' + header + '</center>',
                footer: true,
                className: 'd-none',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],

        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            stock = api
                .column(1)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            full_goods = api
                .column(2)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            full_empties = api
                .column(3)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            shell = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            bottles = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
           
            
           
            // Update footer
            $(api.column(1).footer()).html(number_format(stock, 2,'.', ','));
            $(api.column(2).footer()).html(number_format(full_goods, 2,'.', ','));
            $(api.column(3).footer()).html(number_format(full_empties, 2,'.', ','));
            $(api.column(4).footer()).html(number_format(shell, 2,'.', ','));
            $(api.column(5).footer()).html(number_format(bottles, 2,'.', ','));
           
            
          
            
        },
    });
}

$(document).on('click', '#btn_print_ending_inventory_report', function(){
    $('#table_ending_inventory_report').DataTable().buttons(0,1).trigger()
});

$(document).on('click', '#btn_excel_ending_inventory_report', function(){
    $('#table_ending_inventory_report').DataTable().buttons(0,0).trigger()
});

$(document).on('change', '#filter_by_date_inv', function(){
    var date = $(this).val();
    $.ajax({
        url: "/admin/transactions/inventory_report_date", 
        type: "get",
        data: {_token: '{!! csrf_token() !!}', date:date},
        dataType: "json",
        beforeSend: function() {
            $(this).attr('disabled', true);
        },
        success: function(data){
            $(this).attr('disabled', false);
            $('#table_inventory_report').DataTable().destroy();
            var list = '';
            $.each(data.data, function(key,value){
                list += '<tr>';
                    list += '<td>';
                        list += value.product;
                    list += '</td>';
                    list += '<td>';
                        list += value.description;
                    list += '</td>';
                    list += '<td>';
                        list += value.category;
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.beginning_inventory, 2,'.', ',');
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.sales_inventory, 2,'.', ',');
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.delivery_inventory, 2,'.', ',');
                    list += '</td>';
                    list += '<td>';
                        list += number_format(value.ending_inventory, 2,'.', ',');;
                    list += '</td>';
                    
                list += '</tr>';
            });
            
            $('#list_inventory_report').empty().append(list);
            $("#date_inv").text(data.filter_date);
            table_inventory_report();
            

        }	
    })
});

$(document).on('change', '#filter_by_date_end_inv', function(){
    var date = $(this).val();
    $.ajax({
        url: "/admin/transactions/ending_inventory_report_date", 
        type: "get",
        data: {_token: '{!! csrf_token() !!}', date:date},
        dataType: "json",
        beforeSend: function() {
            $(this).attr('disabled', true);
        },
        success: function(data){
            $(this).attr('disabled', false);
            $('#table_ending_inventory_report').DataTable().destroy();
          
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
                        list += number_format(value.full_goods, 2,'.', ',');
                    list += '</td>';
                    list += '<td>';
                        list += value.full_emptys;
                    list += '</td>';
                    list += '<td>';
                        list += value.shell;
                    list += '</td>';
                    list += '<td>';
                        list += value.bottles;
                    list += '</td>';
                list += '</tr>';
            });
                list += '<tr>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                list += '</tr>';
                list += '<tr>';
                    list += '<td>';
                        list += 'PALLETS';
                    list += '</td>';
                    list += '<td>';
                        list += 'STOCKS';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                    list += '<td>';
                    list += '</td>';
                list += '</tr>';
                $.each(data.pallets, function(key,value){
                    list += '<tr>';
                        list += '<td>';
                            list += value.title;
                        list += '</td>';
                        list += '<td>';
                            list += value.stock;
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                        list += '<td>';
                        list += '</td>';
                    list += '</tr>';
                });
            $('#list_ending_inventory_report').empty().append(list);
            $("#date_end_inv").text(data.filter_date);
            table_ending_inventory_report();


            

        }	
    })
});

</script>
@endsection


