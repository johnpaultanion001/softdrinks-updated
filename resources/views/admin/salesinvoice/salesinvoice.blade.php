@extends('../layouts.admin')
@section('sub-title','Sales Invoice')
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


<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0 text-uppercase title-head" >SALES INVOICE</h3> 
                        </div>
                        <div class="col text-right">
                            <button type="button" name="all_records_btn" id="all_records_btn" class="all_records_btn text-uppercase btn btn-sm btn-primary">All Records</button>
                        </div> 
                    
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" id="myForm" class="form-horizontal">
                    @csrf
                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <small class="text-dark">Doc No:</small>
                                <input type="text" name="doc_no" id="doc_no" class="form-control" />
                                <span class="invalid-feedback " role="alert">
                                    <strong id="error-doc_no"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <small class="text-dark">Entry Date<span class="text-danger">*</span></small>
                                <input type="date" name="entry_date" id="entry_date" class="form-control" />
                                <span class="invalid-feedback " role="alert">
                                    <strong id="error-entry_date"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <small class="text-dark">Remarks</small>
                                <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                <span class="invalid-feedback " role="alert">
                                    <strong id="error-remarks"></strong>
                                </span>
                            </div>
                        </div>
                        
                        


                        <div class="col-sm-4">
                            <div class="form-group">
                            <small class="text-dark">Customer:<span class="text-danger">*</span></small>
                                <select name="customer_id" id="customer_id" class="form-control select2">
                                    <option value="" disabled selected>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->customer_code}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback " role="alert">
                                    <strong id="error-customer_id"></strong>
                                </span>
                                
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <small class="text-dark">Customer Name:</small>
                                <input type="text" name="customer_name" id="customer_name" class="form-control" readonly/>
                                <span class="invalid-feedback " role="alert">
                                    <strong id="error-customer_name"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <small class="text-dark">Area:</small>
                                <input type="text" name="area" id="area" class="form-control" readonly/>
                                <span class="invalid-feedback " role="alert">
                                    <strong id="error-area"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div id="loadsales"></div>

                                   
                                     
                                    
                                </div>
                                <div class="col-xl-6">
                                   <div id="loadreturn"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                           
                                <div id="alltotal">

                                </div>
                           
                        </div>
                        
                        
            
                    </div>
                        <div class="modal" id="receiptModal" data-keyboard="false" data-backdrop="static">
                            <div class="modal-dialog modal-lg modal-dialog-centered ">
                                <div class="modal-content">
                            
                                    <!-- Modal Header -->
                                    <div class="modal-header bg-primary">
                                        <p class="modal-title-receipt font-weight-bold text-uppercase text-white ">Modal Heading</p>
                                        <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                                    </div>
                            
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                            <div id="receiptreport" class="d-print-inline-flex receiptreport p4 bg-white mt-2" style="border-radius: 5px;">
                                            <div class="col">
                                                <h4 class="text-center card-title text-uppercase text-dark mb-0">Jewel & Nickel <br> Store </h4>
                                                <h5 class="text-center card-title text-muted mb-0">J.P Extension Libis Binangonan , Rizal <br>
                                                Fernando L. Arada - Prop. <br>
                                                Tel. No. 986-2433 Cel No. 0923-6738-296 </h5>
                                                <br>
                                                <div class="col text-right"><h6 class="card-title text-uppercase text-muted mb-0">Date:  {{ $date }} </h6></div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <small class="text-muted mt-3 ml-1">Sold To:</small>
                                                        <div class="col-sm-8">
                                                            <small id="sold_to_receipt"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <small class="text-muted mt-3 ml-1 address">Address:</small>
                                                        <div class="col-sm-8">
                                                            <small id="area_receipt"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="receiptmodal">
                                            
                                            </div>
                                        </div>
                                        <!-- <input type="hidden" name="action" id="action" value="Add" />
                                        <input type="hidden" name="hidden_id" id="hidden_id" /> -->
                                    </div>
                            
                                    <!-- Modal footer -->
                                    <div class="modal-footer bg-white">
                                        <input type="button" name="print_button" id="print_button" class="btn btn-primary text-uppercase" value="Print & Save"/>
                                        <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                                    </div>
                            
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- product list modal -->
<div class="modal " id="productlistModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-productlist font-weight-bold text-uppercase text-white">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="productlist">
                        
                        </div>
                    </div>
                </div>
                   
            </div>

            <div class="modal-footer bg-white">
                
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>

            

        </div>
    </div>
</div>

<!-- addtocart form cart -->
<form method="post" id="orderForm" class="form-horizontal ">
    @csrf
    <div class="modal fade" id="orderModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title-order font-weight-bold text-uppercase text-white ">Modal Heading</p>
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

                    <input type="hidden" name="salesinvoice_id" id="salesinvoice_id" value="{{$salesinvoice_id}}"/>
                    <input type="hidden" name="order_action" id="order_action" value="Add" />
                    <input type="hidden" name="order_hidden_id" id="order_hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_button_order" id="action_button_order" class="text-uppercase btn btn-default" value="Submit" />
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                </div>
        
            </div>
        </div>
    </div>
</form>

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
                            <label class="control-label text-uppercase" >Select Product:<span class="text-danger">*</span></label>
                                <select name="product_id" id="product_id" class="form-control select2">
                                    <option value="" disabled selected>Select Product</option>
                                    @foreach ($product_codes as $product_code)
                                        <option value="{{$product_code->id}}">{{$product_code->product_code}} / {{$product_code->description}} / {{  $product_code->size->title ?? '' }}  {{  $product_code->size->size ?? '' }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_id"></strong>
                                </span>
                                
                            </div>
                        </div>

                        <div class="col-sm-6">
                             <label class="control-label text-uppercase" >Select Price Type:<span class="text-danger">*</span> </label>
                            <select name="pricetype_id" id="pricetype_id" class="form-control select2" required>
                                @foreach ($pricetypes as $pricetype)
                                <option value="{{$pricetype->id}}"> {{$pricetype->price_type}} / Discount: {{$pricetype->discount}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-pricetype_id"></strong>
                            </span>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Status:<span class="text-danger">*</span> </label> 
                                <select name="status_id" id="status_id" class="form-control select2">
                                    <option value="" disabled selected>Select Status</option>
                                    @foreach ($status as $sp)
                                        <option value="{{$sp->id}}" class="text-uppercase"> {{$sp->code}} - {{$sp->title}}  </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-status_id"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Return QTY:<span class="text-danger">*</span> </label>
                                <input type="number" name="return_qty" id="return_qty" class="return_qty form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-return_qty"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Unit Price:<span class="text-danger">*</span> </label>
                                <input type="number" name="unit_price" id="unit_price" step="any" class="unit_price form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-unit_price"></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" >Remarks: </label>
                                <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-remarks"></strong>
                                </span>
                            </div>
                        </div>

                    
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="return_action" id="return_action" value="Add" />
                <input type="hidden" name="return_hidden_id" id="return_hidden_id" />
                <input type="hidden" name="salesinvoice_id_return" id="salesinvoice_id_return" value="{{$salesinvoice_id}}"/>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="btn_submit_return" id="btn_submit_return" class="text-uppercase btn btn-default" value="Submit" />
            </div>
            </div>
        </div>
    </div>
</form>

<!-- modal for All Records -->
<div class="modal" id="allrecordsModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-allrecords font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <div id="allrecords">
                    
                    </div>
               
                <!-- <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" /> -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal for View Sales -->
<div class="modal" id="viewsalesModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-viewsales font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <div id="viewsales">
                    
                    </div>
               
                <!-- <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" /> -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- modal for Sales Receipt -->
<form method="post" id="frm_sales_receipt" class="form-horizontal ">
    @csrf
    <div class="modal" id="modal_sales_receipt" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title-sales-receipt font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="loading-sales-receipt" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="sales_receipt">
                    
                    </div>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_sales_receipt" id="action_sales_receipt" class="text-uppercase btn btn-default" value="Print Receipt" />
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                </div>
        
            </div>
        </div>
    </div>
</form>

<!-- modal for All Records For return -->
<div class="modal" id="allrecordsreturnModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-allrecordsreturn font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <div id="allrecordsreturn">
                    
                    </div>
               
                <!-- <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" /> -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>

        </div>
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
    
    return loadSales() , loadReturn() , loadAllTotal();
    
});



function loadSales(){
    $.ajax({
        url: "salesInvoice-sales", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $(".loadingSales").text('Loading Sales...');
        },
        success: function(response){
            $(".loadingSales").text('Sales');
            $("#loadsales").html(response);
        }	
    })
}




function loadReturn(){
    $.ajax({
        url: "salesInvoice-return", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $(".loadingReturn").text('Loading Return...');
        },
        success: function(response){
            $(".loadingReturn").text('Return');
            $("#loadreturn").html(response);
        }	
    })
}

function loadAllTotal(){
    $.ajax({
        url: "salesInvoice-alltotal", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $(".title-head").text('Computing...');
        },
        success: function(response){
            $(".title-head").text('SALES INVOICE');
            $("#alltotal").html(response);
        }	
    })
}


//show return modal

function loadProductList(){
    $.ajax({
        url: "salesInvoice-productlist", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-productlist').text('Loading Product...');
        },
        success: function(response){
            $('.modal-title-productlist').text('Choose a Product');
            $("#productlist").html(response);
        }	
    })
}

$(document).on('click', '#create_sales', function(){
    $('#productlistModal').modal('show');
    return loadProductList();
});

function loadAllRecords(){
    $.ajax({
        url: "salesInvoice-allrecords", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-allrecords').text('Loading Records...');
         
        },
        success: function(response){
            $('.modal-title-allrecords').text('All Sales Invoice Records');
            $("#allrecords").html(response);
        }	
    })
}

$(document).on('click', '#all_records_btn', function(){
    $('#allrecordsModal').modal('show');
    return loadAllRecords();
});



//modal for return
$(document).on('click', '#create_return', function(){
    $('#modal_return_cu').modal('show');
    $('.modal_return_cu_title').text('Insert Return');
    $('#frm_return_cu')[0].reset();
    $('.form-control').removeClass('is-invalid')

   
    $('#btn_submit_return').val('Submit');
    $('#return_action').val('Add');
    $('#loading-containermodal').hide();
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
                    if(key == 'product_id'){
                        $('#error-product_id').text('Invalid Product')
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
                $('#pricetype_id').select2({
                    placeholder: 'Select Price Type'
                });
                $('#modal_return_cu').modal('hide');
                return loadReturn() , loadAllTotal();
                
            }
           
        }
    });
});

//show print modal
function printmodal(){
    $('#receiptModal').modal('show');
    $.ajax({
        url: "salesInvoice-receipt", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-receipt').text('Loading Receipt...');
            $("#print_button").attr("disabled", true);
            $("#print_button").attr("value", "Loading..");
            $("#receiptmodal").hide();
        },
        success: function(response){
            $('.modal-title-receipt').text('Print Receipt');
            $("#print_button").attr("disabled", false);
            $('#print_button').val('Print & Save');
            $("#receiptmodal").show();
            $("#receiptmodal").html(response);
        }	
    })
}


$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.salesInvoice.store') }}";
    var type = "POST";

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
            if(data.nodata){
                    $.alert({
                        title: 'Message Error',
                        content: data.nodata,
                        type: 'red',
                    });
                }
            if(data.invalidcash){
                $.alert({
                    title: 'Message Error',
                    content: data.invalidcash,
                    type: 'red',
                });
            }
            if(data.print){
                return printmodal();
            }
           
           
        }
    });
   
   
});



$(document).on('click', '#print_button', function(){
    $('.form-control').removeClass('is-invalid')
    var doc_no = $('#doc_no').val();
    var entry_date = $('#entry_date').val();
    var remarks = $('#remarks').val();
    var customer_id = $('#customer_id').val();
    var prev_bal = $('#current_balance').val();
    var cash = $('#cash').val();
   
    var action_url = "{{ route('admin.salesInvoice.storeandcheckout') }}";
    var type = "POST";
    $.ajax({
        url: action_url,
        method:type,
        data:{doc_no:doc_no, entry_date:entry_date, remarks:remarks, customer_id:customer_id,
                prev_bal:prev_bal, cash:cash, _token:_token},
        dataType:"json",
        beforeSend:function(){
            $("#print_button").attr("disabled", true);
            $("#print_button").attr("value", "Printing & Saving..");
        },
        success:function(data){
            $("#print_button").attr("disabled", false);
            $("#print_button").attr("value", "Print & Save");
            if(data.success){
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
                $('#success-checkout').html('Click <a href="/admin/sales" class="btn-white btn btn-sm">HERE</a> To view your reports' );
                $("#success-checkout").fadeTo(10000, 500).slideUp(500, function(){
                    $("#success-checkout").slideUp(500);
                });
                $('#receiptModal').modal('hide');
                $('#myForm')[0].reset();
                $('.form-control').removeClass('is-invalid');
                $('#customer_id').select2({
                     placeholder: 'Select Customer'
                })
                

                return loadSales() , loadReturn() , loadAllTotal();
            }
           
        }
    });
});



$(document).on('click', '.editreturn', function(){
    $('#allrecordsreturnModal').modal('hide');
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
                    if(key == 'product_id'){
                        $("#product_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                }
            })
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
                        $("#action_button").attr("disabled", true);
                        $("#action_button").attr("value", "Loading...");
                      },
                      success:function(data){
                        $("#action_button").attr("disabled", false);
                        $("#action_button").attr("value", "Submit");
                        if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            return loadReturn() , loadAllRecordReturn() , loadAllTotal();;
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


//view order
$(document).on('click', '#order', function(){
    $('#orderModal').modal('show');
    $('#modalbody-edit').hide();
    $('#loading-productmodal').hide();
    $('#orderForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    var id = $(this).attr('order');
    $.ajax({
        url: "/admin/sales_inventory/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button_order").attr("disabled", true);
            $("#action_button_order").attr("value", "Loading..");
            $('.modal-title-order').text('Loading Order...');

            $('#modalbody-view').hide();
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#loading-productmodal').hide();
            $('#modalbody-view').show();
            
            $("#action_button_order").attr("disabled", false);
            $("#action_button_order").attr("value", "Order");
            $('.modal-title-order').text('View Order');
            $('#order_hidden_id').val(id)
            $('#order_action').val('Add');

            $("#modalbody-view").html(response);
        }
    })
});

//addtocart 
$('#orderForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#order_hidden_id').val();
    var action_url = "/admin/addtocart/" + id;
    var type = "POST";
    if($('#order_action').val() == 'Edit'){
        id = $('#order_hidden_id').val();
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
            $("#action_button_order").attr("disabled", true);
            $("#action_button_order").attr("value", "Loading..");
            $('.modal-title-order').text('Loading Order...');
        },
        success:function(data){
            $("#action_button_order").attr("disabled", false);
            $("#action_button_order").attr("value", "Order");
            $('.modal-title-order').text('View Order');
            if(data.errors){
               $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.nostock){
                $.alert({
                    title: 'Error Message',
                    content: data.nostock,
                    type: 'red',
                })  
            }
            if(data.expiration){
                $.alert({
                    title: 'Error Message',
                    content: data.expiration,
                    type: 'red',
                })  
            }
            if(data.expirationtoday){
                $.alert({
                    title: 'Error Message',
                    content: data.expirationtoday,
                    type: 'red',
                })  
            }
            if(data.maxstock){
                $.alert({
                    title: 'Error Message',
                    content: data.maxstock,
                    type: 'red',
                })  
            }
            
            if(data.success){
                $('#orderModal').modal('hide');
                $('.form-control').removeClass('is-invalid');

                $('#success-order').addClass('bg-primary');
                $('#success-order').html('<strong>' + data.success + '</strong>' );
                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                    $("#success-order").slideUp(500);
                });

               
                return loadProductList() , loadSales() , loadAllTotal();
               

            }
            
        }
    });
});

//edit modal
$(document).on('click', '.editorder', function(){
    $('#orderModal').modal('show');
    $('#modalbody-view').hide();
    $('#loading-productmodal').hide();
    $('#orderForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    var id = $(this).attr('editorder');
    
    $.ajax({
        url: "/admin/orders/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button_order").attr("disabled", true);
            $("#action_button_order").attr("value", "Loading..");
            $('.modal-title-order').text('Loading Order...');

            $('#modalbody-edit').hide();           
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#loading-productmodal').hide();
            $('#modalbody-edit').show();

            $("#action_button_order").attr("disabled", false);
            $("#action_button_order").attr("value", "Update");
            $('.modal-title-order').text('Update Order');

            $('#order_hidden_id').val(id);
            $('#order_action').val('Edit');
            $("#modalbody-edit").html(response);
        }
    })
});

//remove
$(document).on('click', '.remove-order', function(){
    var id = $(this).attr('removeorder');
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
                            $("#action_button").attr("disabled", true);
                            $("#action_button").attr("value", "Loading...");
                        },
                        success:function(data){
                            if(data.success){
                                $("#action_button").attr("disabled", false);
                                $("#action_button").attr("value", "Submit");

                                $('#success-alert').addClass('bg-primary');
                                $('#success-alert').html('<strong>' + data.success + '</strong>');
                                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                    $("#success-alert").slideUp(500);
                                });
                                return loadProductList() , loadSales() , loadAllTotal();
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

//select customer
$('select[name="customer_id"]').on("change", function(event){
  
  var customer = $('#customer_id').val();
  if(customer != '')
        { 
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"ordering/" +customer+ "/customer",
          method:"GET",
          dataType:"json",
          success:function(data){
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                }
                if(key == 'customer_name'){
                    $('#sold_to_receipt').text(value)
                }
                if(key == 'area'){
                    $('#area_receipt').text(value)
                }
                
            }) 
            
                
          }
         });
        }
});

/// Sales Receipt
//frm_sales_receipt
$(document).on('click', '.sales_receipt', function(){
    $('#modal_sales_receipt').modal('show');
    $('.modal-title-sales-receipt').text('Print Receipt');
    var id = $(this).attr('sales_receipt');

    $.ajax({
        url :"/admin/salesInvoice-sales_receipt/"+id,
        type: "get",
        dataType: "HTMl",
        beforeSend:function(){
            $("#action_sales_receipt").attr("disabled", true);
            $("#action_sales_receipt").attr("value", "Loading..");
            $('#loading-sales-receipt').show();
            $('#sales_receipt').hide();
            
        },
        success:function(response){
            $('#sales_receipt').show();
            $("#action_sales_receipt").attr("disabled", false);
            $("#action_sales_receipt").attr("value", "Print Receipt");
            $('#loading-sales-receipt').hide();
            $("#sales_receipt").html(response);
        }
    })
}); 


$('#frm_sales_receipt').on('submit', function(event){
    event.preventDefault();
    $('#receipt-body-sales').removeClass('receipt-body');
        var contents = $("#receiptreportsales").html();
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
        $('#receipt-body-sales').addClass('receipt-body');
});

// load all records for returned
function loadAllRecordReturn(){
    $.ajax({
        url: "salesInvoice-allreturn", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-allrecordsreturn').text('Loading Records...');
         
        },
        success: function(response){
            $('.modal-title-allrecordsreturn').text('All Returned Records');
            $("#allrecordsreturn").html(response);
        }	
    })
}


/// All Records Return
$(document).on('click', '#all_record_return', function(){
    $('#allrecordsreturnModal').modal('show');
    return loadAllRecordReturn();
});


//View Sales
$(document).on('click', '.viewsales', function(){
    var id = $(this).attr('viewsales');
    $('#viewsalesModal').modal('show');
    $.ajax({
        url: "salesInvoice/" + id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-viewsales').text('Loading Sales...');
         
        },
        success: function(response){
            $('.modal-title-viewsales').text('All Sales');
            $("#viewsales").html(response);
        }	
    })
});

// //void sales invoice
// $(document).on('click', '.void', function(){
//     var id = $(this).attr('void');
//     $.confirm({
//         title: 'Confirmation',
//         content: 'You really want to void this transaction?',
//         type: 'red',
//         buttons: {
//             confirm: {
//                 text: 'confirm',
//                 btnClass: 'btn-blue',
//                 keys: ['enter', 'shift'],
//                 action: function(){
//                     return $.ajax({
//                         url:"/admin/salesInvoice-void/"+id,
//                         method:'DELETE',
//                         data: {
//                             _token: '{!! csrf_token() !!}',
//                         },
//                         dataType:"json",
//                         beforeSend:function(){
//                             $('.modal-title-allrecords').text('Loading Records...');
//                         },
//                         success:function(data){
//                             if(data.success){
//                                 $('.modal-title-allrecords').text('All Sales Invoice Records');
                                
//                                 $('#success-alert').addClass('bg-primary');
//                                 $('#success-alert').html('<strong>' + data.success + '</strong>');
//                                 $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
//                                     $("#success-alert").slideUp(500);
//                                 });
//                                 return loadAllRecords();
//                             }
//                         }
//                     })
//                 }
//             },
//             cancel:  {
//                 text: 'cancel',
//                 btnClass: 'btn-red',
//                 keys: ['enter', 'shift'],
//             }
//         }
//     });
// });

</script>
@endsection
