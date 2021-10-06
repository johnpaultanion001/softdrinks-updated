@extends('../layouts.admin')
@section('sub-title','Ordering')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-6">
                <h6 class="h2 text-white d-inline-block mb-0">Choose Products</h6>
               
                </div>
                
             
                <div class="col-lg-6 col-6 text-right" id="cartsbutton">

                 
                    
                </div>
            </div>
            
            <div class="col-xl-10 mx-auto">
                <div class="form-group">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" id="search" name="search" placeholder="Search by description/Code of product or price" type="text">
                    </div>
                </div>
           </div>
        
        </div>

    </div>
    
</div>

<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>

<div class="container-fluid mt--6">
            
    
    <div id="loadproduct">
        
    </div>



    
    
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection

      
</div>



<!-- addtocart form cart -->
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
                    <div id="modalbody-edit">
                    </div>
                    
                    <div id="modalbody-view">
                    </div>

                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>



<!-- checkout form modal -->
<form method="post" id="myCheckoutForm" class="form-horizontal ">
    @csrf
    <div class="modal " id="formCheckoutModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title font-weight-bold text-uppercase text-white">Modal Heading</p>
                    <i class="fa fa-spinner fa-spin text-white button-loading pl-2"></i>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <span id="CheckoutForm_result"></span>
                        <div class="row" id="checkoutview">
                        
                        </div>  
                                 
                    <input type="hidden" name="action" id="checkout_action" value="Add" />
                    <input type="hidden" name="hidden_id" id="checkouthidden_id" />
                  
                </div>
        
             
        
            </div>
        </div>
    </div>
</form>

<!-- return modal -->
<div class="modal " id="returnModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-return font-weight-bold text-uppercase text-white">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="loading-salesreturmodal" class="loading-container">
                            <div class="loading"></div>
                            <div id="loading-text">loading</div>
                        </div>

                        <div id="salesreturn">
                        
                        </div>
                    </div>
                </div>
                   
            </div>

            

        </div>
    </div>
</div>

<!-- modal for return add and edit -->
<form method="post" id="frm_return_cu" class="form-horizontal ">
    @csrf
    <div class="modal fade" id="modal_return_cu" tabindex="-1" role="dialog"  data-keyboard="false" data-backdrop="static" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title modal_return_cu_title text-white" >Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div id="loading-containermodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    
                    <div id="modalbody" class="modalbody row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Product Code: </label>
                                <input type="text" name="product_code" id="product_code" class="form-control" />
                                <div id="productCodeList"></div>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_code"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                             <label class="control-label text-uppercase" >Select Price Type: </label>
                            <select name="pricetype_id" id="pricetype_id" class="form-control select2" required>
                                @foreach ($pricetypes as $pricetype)
                                <option value="{{$pricetype->id}}"> {{$pricetype->price_type}} / Discount: {{$pricetype->discount}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-pricetype_id"></strong>
                            </span>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Return QTY: </label>
                                <input type="number" name="return_qty" id="return_qty" class="return_qty form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-return_qty"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Unit Price: </label>
                                <input type="number" name="unit_price" id="unit_price" class="unit_price form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-unit_price"></strong>
                                </span>
                            </div>
                        </div>
                    
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="return_action" id="return_action" value="Add" />
                <input type="hidden" name="return_hidden_id" id="return_hidden_id" />
                <input type="hidden" name="inventory_id" id="inventory_id"/>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="btn_submit_return" id="btn_submit_return" class="text-uppercase btn btn-default" value="Submit" />
            </div>
            </div>
        </div>
    </div>
</form>


@endsection

@section('script')
<script>

$(function () {
    return loadProduct(),cartsButton();
});

function loadProduct(){
    $.ajax({
        url: "loadproduct", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
            $("#loadproduct").hide();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadproduct").html(response);
            $("#loadproduct").show();
        }	
    })
}
function loadCart(){
    $('#formCheckoutModal').modal('show');
    $('.modal-title').text('Orders Information');
    $.ajax({
        url: "checkout", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#checkoutaction_button").attr("disabled", true);
            $("#checkoutaction_button").attr("value", "Loading..");
            $(".print").attr("disabled", true);
            $(".print").text("Loading..");
            $('.button-loading').show();
        },
        success: function(response){
            $("#checkoutaction_button").attr("disabled", false);
            $("#checkoutaction_button").attr("value", "Check Out");
            $(".print").attr("disabled", false);
            $(".print").text("Print Reciept");
            $('.button-loading').hide();
            $("#checkoutview").html(response);
        }	
    })
}
//carts button
function cartsButton(){
   $.ajax({
        url: "cartsbutton", 
        type: "get",
        dataType: "HTMl",
        success: function(response){
            $("#cartsbutton").html(response);
        }	
    })
}
//print receipt automatic
function printreceipt(){
    $('#receipt-body').removeClass('receipt-body');
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
        // frameDoc.document.write('<style>size: A4 portrait;</style>');
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
}


//search
$('#search').on('keyup',function(){
    $value=$(this).val();
    
        $.ajax({
            type : 'get',
            url : '{{URL::to('/admin/search')}}',
            beforeSend: function() {
                $('#loading-container').show();
                $("#loadproduct").hide();
            },
            data:{'search':$value},
            success:function(data){
                $('#loading-container').hide();
                $('#loadproduct').html(data);
                $("#loadproduct").show();
            }
        });
})
//modal focus
$('#formModal').on('shown.bs.modal', function () {
    $('.purchase_qty').focus();
}) 

//view order
$(document).on('click', '#view', function(){
    $('#formModal').modal('show');
    $('#modalbody-edit').hide();
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('#form_result').html('');
    var id = $(this).attr('view');
    $('#formCheckoutModal').modal('hide');
    $('.modal-title').text('View Order');
    $.ajax({
        url: "/admin/inventories/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('#modalbody-view').hide();
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#loading-productmodal').hide();
            $('#modalbody-view').show();
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Order");
            $('#hidden_id').val(id);
            $('#action').val('Add');
            
            $("#modalbody-view").html(response);
        }
    })
});

//edit order
$(document).on('click', '#edit', function(){
    $('#formModal').modal('show');
    $('#modalbody-view').hide();
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('#form_result').html('');
    var id = $(this).attr('edit');
    $('#formCheckoutModal').modal('hide');
    $('.modal-title').text('Edit Record');
    $.ajax({
        url: "/admin/orders/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('#modalbody-edit').hide();
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#loading-productmodal').hide();
            $('#modalbody-edit').show();
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Update");
            $('#hidden_id').val(id);
            $('#action').val('Edit');
            $("#modalbody-edit").html(response);
        }
    })
});

 

//addtocart 
$('#myForm').on('submit', function(event){
    event.preventDefault();
    var bar = $('.bar');
    var percent = $('.progress-bar');

    var form = $(this);
    $('.form-control').removeClass('is-invalid')
    var id = $('#hidden_id').val();
    var action_url = "/admin/addtocart/" + id;
    var type = "POST";
    
    if($('#action').val() == 'Edit'){
        id = $('#hidden_id').val();
        action_url = "/admin/orders/" + id;
        type = "POST";
    }
    $.ajax({
        url: action_url,
        method:type,
        dataType:"json",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
              $("#action_button").attr("disabled", true);
              $("#action_button").attr("value", "Loading..");
              $('.button-loading').show();
        },
        success:function(data){
            var html = '';
            $('.button-loading').hide();
            if(data.errors){
               $("#action_button").attr("disabled", false);
               $("#action_button").attr("value", "Order");
               $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.nostock){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
                $.alert({
                    title: 'Error Message',
                    content: data.nostock,
                    type: 'red',
                })  
            }
            if(data.expiration){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
                $.alert({
                    title: 'Error Message',
                    content: data.expiration,
                    type: 'red',
                })  
            }
            if(data.expirationtoday){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
                $.alert({
                    title: 'Error Message',
                    content: data.expirationtoday,
                    type: 'red',
                })  
            }
            if(data.maxstock){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
                $.alert({
                    title: 'Error Message',
                    content: data.maxstock,
                    type: 'red',
                })  
            }
            
            if(data.success){
                
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
              
                $('#formModal').modal('hide');
                $('#myForm')[0].reset();
                $('.form-control').removeClass('is-invalid');
                
                if($('#action').val() == 'Edit'){

                    $('#success-alert').addClass('bg-primary');
                    $('#success-alert').html('<strong>' + data.success + '</strong>');
                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                        $("#success-alert").slideUp(500);
                    });
                    return loadProduct(), loadCart() , cartsButton();
                }

                $('#success-order').addClass('bg-primary');
                $('#success-order').html('<strong>' + data.success + '</strong> <br>' + 'Click <button id="vieworders" class="btn-white btn btn-sm">HERE</button> To view your orders' );
                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                    $("#success-order").slideUp(500);
                });
                return loadProduct() , cartsButton();

            }
            
        }
    });
});

//checkoutform modal show
$(document).on('click', '#checkout', function(){
    loadCart();
});
$(document).on('click', '#vieworders', function(){
    loadCart();
});
//checkout to sales
$('#myCheckoutForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.ordering.checkout_order') }}";
    var  method = "POST";
    var customer = $('#select_customer').val();


    $.confirm({
        title: 'Confirmation',
        content: 'You really want to chechout this orders?',
        type: 'green',
        buttons: {
            confirm: {
                text: 'confirm',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                    return $.ajax({
                    url: action_url,
                    method: method,
                    data: {
                        customer:customer, _token: '{!! csrf_token() !!}',
                    },
                    dataType:"json",
                    beforeSend: function(){
                        $("#checkoutaction_button").attr("disabled", true);
                        $("#checkoutaction_button").attr("value", "Loading..");
                    },
                        success:function(data){
                            $("#checkoutaction_button").attr("disabled", false);
                            $("#checkoutaction_button").attr("value", "Check Out");
                            if(data.nodata){
                                $.alert({
                                    title: 'Message Error',
                                    content: data.nodata,
                                    type: 'red',
                                });
                            }
                            if(data.success){

                                $('#receipt-body').removeClass('receipt-body');
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
                                // frameDoc.document.write('<style>size: A4 portrait;</style>');
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

                                $('#success-checkout').addClass('bg-primary');
                                $('#success-checkout').html('<strong>' + data.success + '</strong> <br>' + 'Click <a href="/admin/sales" class="btn-white btn btn-sm">HERE</a> To view your reports' );
                                $("#success-checkout").fadeTo(10000, 500).slideUp(500, function(){
                                    $("#success-checkout").slideUp(500);
                                });
                                $('#formCheckoutModal').modal('hide');

                                

                                return loadProduct(), cartsButton() ;
                            }
                            
                        }
                    })
                }
            },
            cancel:  {
                text: 'cancel',
                btnClass: 'btn-red',
                keys: ['enter', 'shift'],
            }
        }
    });
});

//delete cart
$(document).on('click', '.delete', function(){
    var id = $(this).attr('delete');
    $.confirm({
        title: 'Confirmation',
        content: 'You really want to remove this order?',
        type: 'red',
        buttons: {
            confirm: {
                text: 'confirm',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                    return $.ajax({
                        url:"/admin/orders/"+id,
                        method:'DELETE',
                        data: {
                            _token: '{!! csrf_token() !!}',
                        },
                        dataType:"json",
                        beforeSend:function(){
                            $("#checkoutaction_button").attr("disabled", true);
                            $("#checkoutaction_button").attr("value", "Loading..");
                        },
                        success:function(data){
                            if(data.success){
                                $("#checkoutaction_button").attr("disabled", false);
                                $("#checkoutaction_button").attr("value", "Check Out");

                                $('#success-alert').addClass('bg-primary');
                                $('#success-alert').html('<strong>' + data.success + '</strong>');
                                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                    $("#success-alert").slideUp(500);
                                });

                                return loadProduct(), loadCart() , cartsButton();;
                            }
                        }
                    })
                }
            },
            cancel:  {
                text: 'cancel',
                btnClass: 'btn-red',
                keys: ['enter', 'shift'],
            }
        }
    });
});

//print cart
$(document).on('click', '.print', function(){
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

//show return modal

function loadReturnList(){
    $('#returnModal').modal('show');
    $('.modal-title-return').text('Return List');

    $.ajax({
        url: "salesReturn", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#salesreturn").hide();
            $('#loading-salesreturmodal').show();
        },
        success: function(response){
            $('#loading-salesreturmodal').hide();
            $("#salesreturn").show();
            $("#salesreturn").html(response);
        }	
    })
}


$(document).on('click', '#btn_return', function(){
    return loadReturnList();
});


//Insert Modal Return
$(document).on('click', '#btn_add_return' ,function(){
    $('#modal_return_cu').modal('show');
    $('.modal_return_cu_title').text('Insert Return');


    $('#frm_return_cu')[0].reset();
    $('.form-control').removeClass('is-invalid')

    $('#pricetype_id').select2({
       placeholder: 'Select Price Type'
    })
    $('#btn_submit_return').val('Submit');
    $('#return_action').val('Add');
    $('#loading-containermodal').hide();
});

//product Code Function
$('#product_code').keyup(function(){ 
    var query = $(this).val();
    if(query != '')
    {
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('admin.pending-product.autocomplete') }}",
        method:"POST",
        data:{query:query, _token:_token},
        success:function(data){
            if (data == undefined){
                $('#productCodeList').fadeOut();
            }
            $('#productCodeList').fadeIn();  
            $('#productCodeList').html(data);
            }
        });
    }
    if(query == ''){
        $('#productCodeList').fadeOut();
        }
});

$(document).on('click', 'li', function(){  
    var query = $(this).text();
    if(query != '')
    {
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('admin.pending-product.autocompleteresult') }}",
        method:"POST",
        dataType:"json",
        data:{query:query, _token:_token},
        success:function(data){

        $.each(data.result, function(key,value){
            if(key == $('#'+key).attr('id')){
                $('#'+key).val(value)
            }
        })
        $('#inventory_id').val(data.inventory_id);
        $('#productCodeList').fadeOut(); 
        }
        });
    }
});  


//Store Return
$('#frm_return_cu').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.salesReturn.store') }}";
    var type = "POST";

    if($('#return_action').val() == 'Edit'){
        var id = $('#return_hidden_id').val();
        action_url = "salesReturn/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#btn_submit_return").attr("disabled", true);
            $("#btn_submit_return").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $('#modalbody').hide();
        },
        success:function(data){
            $('#loading-containermodal').hide();
            $('#modalbody').show();

            if($('#return_action').val() == 'Edit'){
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Update");
            }else{
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Submit");
            }

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
                $('#frm_return_cu')[0].reset();
                
                $('#pricetype_id').select2({
                    placeholder: 'Select Price Type'
                });
                $('#modal_return_cu').modal('hide');
                return loadReturnList();
                
            }
           
        }
    });
});


$(document).on('click', '.editreturn', function(){

    $('#modal_return_cu').modal('show');
    $('.modal_return_cu_title').text('Edit Return');

    
    $('#frm_return_cu')[0].reset();
    $('.form-control').removeClass('is-invalid')

    var id = $(this).attr('editreturn');

    $.ajax({
        url :"/admin/salesReturn/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#btn_submit_return").attr("disabled", true);
            $("#btn_submit_return").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $('#modalbody').hide();
            
        },
        success:function(data){
            $('#loading-containermodal').hide();
            $('#modalbody').show();
            if($('#return_action').val() == 'Edit'){
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Update");
            }else{
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Submit");
            }
            
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'pricetype_id'){
                        $("#pricetype_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                }
            })
            $('#product_code').val(data.productcode);
            $('#return_hidden_id').val(id);
            $('#btn_submit_return').val('Update');
            $('#return_action').val('Edit');
        }
    })
});


$(document).on('click', '.removereturn', function(){
  var id = $(this).attr('removereturn');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this Record?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/salesReturn/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('.modal_return_cu_title').text('Loading...');
                      },
                      success:function(data){
                          if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            return loadReturnList();
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });

});


</script>
@endsection


