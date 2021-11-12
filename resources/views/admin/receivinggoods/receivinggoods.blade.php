@extends('../layouts.admin')
@section('sub-title','Purchase Orders')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loadpurchaseorder">
    <div id="loading-container" class="loading-container">
        <div class="loading"></div>
        <div id="loading-text">loading</div>
    </div>
</div>

@section('footer')
    @include('../partials.footer')
@endsection


<!-- view modal -->
<div class="modal" id="viewModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header bg-primary">
                <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div id="loading-container" class="loading-container">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div>
                <div class="modal-body" id="view-receiving_goods">
                    
                </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-primary text-uppercase text-white" data-dismiss="modal">Close</button>
            </div>
        
        </div>
    </div>
</div>

<!-- Create Purchase Order Modal -->
<form method="post" id="purchaseorderForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="purchaseorderModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="modal-title-purchase font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><label class="control-label text-uppercase" >Supplier<span class="text-danger">*</span> </label></div>
                                        <div class="col text-right">
                                            <a class="btn btn-sm btn-white text-uppercase" href="/admin/suppliers">New Supplier?</a>
                                        </div>
                                    </div>
                                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                                        <option value="" disabled selected>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">Supplier Code: {{$supplier->id}} - {{$supplier->name}}</option>
                                            
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-supplier_id"></strong>
                                    </span>
                                   
                                </div>
                               
                            </div>
                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><label class="control-label text-uppercase" >Location<span class="text-danger">*</span></label></div>
                                        <div class="col text-right">
                                            <a class="btn btn-sm btn-white text-uppercase" href="/admin/locations">New Location?</a>
                                        </div>
                                    </div>
                                    <select name="location_id" id="location_id" class="form-control select2">
                                        <option value="" disabled selected>Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{$location->id}}">Location Code: {{$location->id}} - {{$location->location_name}}</option>
                                            
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-location_id"></strong>
                                    </span>
                                   
                                </div>
                               
                            </div>        

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >DOC NO.</label>
                                    <input type="text" name="doc_no" id="doc_no" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-doc_no"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Entry Date<span class="text-danger">*</span></label>
                                    <input type="date" name="entry_date" id="entry_date" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-entry_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO NO.</label>
                                    <input type="text" name="po_no" id="po_no" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_no"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO Date.</label>
                                    <input type="date" name="po_date" id="po_date" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_date"></strong>
                                    </span>
                                </div>
                            </div>
                          

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Name of a Driver<span class="text-danger">*</span></label>
                                    <input type="text" name="name_of_a_driver" id="name_of_a_driver" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-name_of_a_driver"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Plate Number<span class="text-danger">*</span> </label>
                                    <input type="text" name="plate_number" id="plate_number" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-plate_number"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Trade Discount:</label>
                                    <input type="text" name="trade_discount" id="trade_discount" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-trade_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Terms Discount: </label>
                                    <input type="text" name="terms_discount" id="terms_discount" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-terms_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks: </label>
                                    <textarea name="remarks" id="remarks" autocomplete="on" class="form-control"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-remarks"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Reference: </label>
                                    <textarea name="reference" id="reference" autocomplete="on" class="form-control"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-reference"></strong>
                                    </span>
                                </div>
                            </div>
                            
                    </div>
 
                    <div id="alltotal"> 

                    </div>
                   
                   
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0 text-uppercase" id="titletable">Pending Products</h3>
                        </div>
                        
                        <div class="col text-right">
                            <button type="button" name="create_product" id="create_product" class="text-uppercase create_product btn btn-sm btn-default">New Product</button>
                        </div>
                    </div>
                    <div id="loading-containermodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div>
                    <div id="sales_inventory" class="sales_inventory col mt-4">
                   
                    </div>

                    <br>

                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0 text-uppercase" id="titletablereturn">Returning Products</h3>
                        </div>
                        
                        <div class="col text-right">
                            <button type="button" name="create_return" id="create_return" class="text-uppercase btn btn-sm btn-default">New Return</button>
                        </div>
                    </div>
                    <div id="return-product" class="return-product col mt-4">
                   
                    </div>

                   

                    <input type="hidden" name="purchase_action" id="purchase_action" value="Add" />
                    <input type="hidden" name="purchase_hidden_id" id="purchase_hidden_id" />
                    
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="purchase_button" id="purchase_button" class="text-uppercase btn btn-primary" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>

<!-- Create Product Order Modal -->
<form method="post" id="productForm" class="form-horizontal">
    @csrf
    <div class="modal" id="productModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <p class="modal-title-product font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div id="loading-productmodal" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div> 
                <div id="modal-body-product" class="modal-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Product Code<span class="text-danger">*</span> </label>
                                <input type="text" name="product_code"  id="product_code" class="form-control" autocomplete="off" style="text-transform: uppercase;"/>
                                        <div id="productCodeList">

                                        </div>
                                 
                                   
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_code"></strong>
                                </span>
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Description<span class="text-danger">*</span> </label>
                               <input type="text" name="description" id="description" class="form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-description"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col"><label class="control-label text-uppercase" >Category<span class="text-danger">*</span> </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/categories">New Category?</a>
                                    </div>
                                </div>
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"> {{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-category_id"></strong>
                                </span>
                            </div>
                        </div>
                       <div class="col-sm-6">
                            <div class="form-group">
                               <div class="row">
                                    <div class="col"><label class="control-label text-uppercase" >Size<span class="text-danger">*</span> </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/sizes">New Size?</a>
                                    </div>
                                </div>
                                <select name="size_id" id="size_id" class="form-control select2">
                                    <option value="" disabled selected>Select Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{$size->id}}"> {{$size->title}} {{$size->size}} - {{$size->category->name}} - UCS:{{$size->ucs}} </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-size_id"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Expiration </label>
                                <input type="date" name="expiration" id="expiration" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-expiration"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >QTY<span class="text-danger">*</span> </label>
                                <input type="number" name="qty" id="qty" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-qty"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Unit Cost<span class="text-danger">*</span></label>
                                <input type="number" name="unit_cost" id="unit_cost" class="form-control" step="any" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-unit_cost"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Regular Discount<span class="text-danger">*</span></label>
                                <input type="number" name="regular_discount" id="regular_discount" class="form-control" step="any"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-regular_discount"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Hauling Discount<span class="text-danger">*</span></label>
                                <input type="number" name="hauling_discount" id="hauling_discount" class="form-control" step="any"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-hauling_discount"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" >Product Remarks </label>
                                <textarea name="product_remarks" id="product_remarks" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_remarks"></strong>
                                </span>
                            </div>
                        </div>
                              
                    </div>
                    <input type="hidden" name="product_action" id="product_action" value="Add" />
                    <input type="hidden" name="product_hidden_id" id="product_hidden_id" />
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase"  id="back-button" >Back</button>
                    <input type="submit" name="product_button" id="product_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>

<!-- Create Return Product -->
<form method="post" id="returnForm" class="form-horizontal">
    @csrf
    <div class="modal" id="returnModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <p class="modal-title-return font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div id="loading-returnmodal" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div> 
                <div id="modal-body-return" class="modal-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Product Code: </label>
                                <select name="product_id" id="product_id" class="form-control select2">
                                    <option value="" disabled selected>Select Product Code</option>
                                    @foreach ($product_code as $product)
                                        <option value="{{$product->product_id}}" class="text-uppercase"> {{$product->product_code}} - {{$product->short_description}}  </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_id"></strong>
                                </span>
                               
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col"><label class="control-label text-uppercase" >Status: </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/status-return">New Status?</a>
                                    </div>
                                </div>
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

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >QTY: </label>
                                <input type="number" name="qty" id="qty" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-qty"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Unit Price:</label>
                                <input type="number" name="unit_price" id="unit_price" class="form-control" step="any" />
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
                    <input type="hidden" name="return_action" id="return_action" value="Add" />
                    <input type="hidden" name="return_hidden_id" id="return_hidden_id" />
                    <input type="hidden" name="existing_purchase" id="existing_purchase" value="no" />
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase"  id="back-button" >Back</button>
                    <input type="submit" name="return_button" id="return_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>


@endsection

@section('script')
<script>

$(function () {
    return loadPurchaseOrder() , alltotal();
});

//alltotal 
function alltotal(){
    $.ajax({
        url: "total_product", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#alltotal").html(response);
        }	
    })
}

function loadPurchaseOrder(){
    $.ajax({
        url: "loadreceivinggoods", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadpurchaseorder").html(response);
            
        }	
    })
}

//pending product
function loadPendingProduct(){
    var receiving_good_id = $('#purchase_hidden_id').val();
    var _token =  $('input[name="_token"]').val();

    $.ajax({
        url: "pending_product", 
        type: "get",
        data: {
                receiving_good_id:receiving_good_id,_token:_token,
                },
        dataType: "HTMl",
        beforeSend: function() {
          
            $('#loading-containermodal').show();
            $("#sales_inventory").hide();

        },
        success: function(response){
            $('#loading-containermodal').hide();
            $("#sales_inventory").show();
            $("#sales_inventory").html(response);
        }	
    })
}

//Return Products
function loadReturnProduct(){
  
    $.ajax({
        url: "loadreturningproduct", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-containermodal').show();
            $("#return-product").hide();
        },
        success: function(response){
            $('#loading-containermodal').hide();
            $("#return-product").show();
            $("#return-product").html(response);
        }	
    })
}
//view purchase order modal
$(document).on('click', '.view', function(){
    $('#viewModal').modal('show');
    var id = $(this).attr('view');
    $('.modal-title').text('VIEW RECEIVING GOODS');
    $.ajax({
        url: "/admin/receiving_goods/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loading-container").show();
            $("#view-receiving_goods").hide();
        },
        success: function(response){
            $("#loading-container").hide();
            $("#view-receiving_goods").show();
            $("#view-receiving_goods").html(response);
        }
    })
});

// back button
$(document).on('click', '#back-button', function(){
    $('#productModal').modal('hide');
    $('#returnModal').modal('hide');
    purchaseModal();
});

//create purchase order
function purchaseModal(){
    $('#purchaseorderModal').modal('show');
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-purchase').text('INSERT RECEIVING GOODS');
    $('#purchase_button').val('Submit');
    $('#purchase_action').val('Add');
    $('#purchase_hidden_id').val(null);

    loadPendingProduct();
    loadReturnProduct();
    alltotal();
}
//store and update purchase order
$('#purchaseorderForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.receiving_goods.store') }}";
    var type = "POST";

    if($('#purchase_action').val() == 'Edit'){
        var id = $('#purchase_hidden_id').val();
        action_url = "receiving_goods/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $("#sales_inventory").hide();
        },
        success:function(data){
            var html = '';
            $('#loading-containermodal').hide();
            $("#sales_inventory").show();
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if($('#purchase_action').val() == 'Edit'){
                        $("#purchase_button").attr("disabled", false);
                        $("#purchase_button").attr("value", "Update");
                    }else{
                        $("#purchase_button").attr("disabled", false);
                        $("#purchase_button").attr("value", "Submit");
                    }
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.nodata){
                if($('#purchase_action').val() == 'Edit'){
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Update");
                }else{
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Submit");
                }
                $.alert({
                    title: 'Error Message',
                    content: data.nodata,
                    type: 'red',
                });
            }
            if(data.success){
                if($('#purchase_action').val() == 'Edit'){
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Update");
                }else{
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Submit");
                }
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#purchaseorderForm')[0].reset();
                $('#supplier_id').select2({
                    placeholder: 'Select supplier'
                });
                $('#purchaseorderModal').modal('hide');
                loadPurchaseOrder();
                
            }  
        }
    });
});

//edit product
$(document).on('click', '.edit_rg', function(){
    $('#purchaseorderModal').modal('show');
    
    $('.modal-title-purchase').text('EDIT RECEIVING GOODS');
    $('#purchaseorderForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    
    var id = $(this).attr('edit_rg');
    
    $.ajax({
        url :"/admin/receiving_goods/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Loading..");
        },
        success:function(data){
            $("#purchase_button").attr("disabled", false);
            $("#purchase_button").attr("value", "Submit");
            
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'supplier_id'){
                        $("#supplier_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'location_id'){
                        $("#location_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                }
            })
            
            $('#purchase_action').val('Edit');
            $('#purchase_hidden_id').val(id);
            loadPendingProduct();
        }
    })
});

$(document).on('click', '#create_record', function(){
   purchaseModal();
});
//create product
$(document).on('click', '#create_product', function(){
    $('#purchaseorderModal').modal('hide');
    $('#productModal').modal('show');
    $('#productForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-product').text('Add New Product');
    $('#product_button').val('Submit');
    $('#category_id').select2({
        placeholder: 'Select Category'
    })
    $('#size_id').select2({
        placeholder: 'Select Size'
    })
    $('#product_action').val('Add');
    $('#loading-productmodal').hide();
});

//create return product
$(document).on('click', '#create_return', function(){
    $('#purchaseorderModal').modal('hide');
    $('#returnModal').modal('show');
    $('#returnForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-return').text('Add New Return Product');
    $('#return_button').val('Submit');
    $('#return_action').val('Add');
    $('#loading-returnmodal').hide();
});


//edit product
$(document).on('click', '.edit', function(){
    $('#purchaseorderModal').modal('hide');
    $('#productModal').modal('show');
    $('.modal-title-product').text('Edit Product');
    $('#productForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    $('#productCodeList').fadeOut();
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/sales_inventory/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading..");
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            if($('#product_action').val() == 'Edit'){
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Update");
            }else{
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Submit");
            }
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'category_id'){
                        $("#category_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'size_id'){
                        $("#size_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                }
            })
            $('#product_hidden_id').val(id);
            $('#product_button').val('Update');
            $('#product_action').val('Edit');
        }
    })
});

// store and update product
$('#productForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.sales_inventory.store') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "sales_inventory/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading..");
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            var html = '';
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            if($('#product_action').val() == 'Edit'){
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Update");
            }else{
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Submit");
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
                $('#productForm')[0].reset();
                $('#category_id').select2({
                    placeholder: 'Select Category'
                });
                $('#size_id').select2({
                    placeholder: 'Select Size'
                });
                $('#productModal').modal('hide');
                purchaseModal();
                alltotal();
                
            }
          
            
           
        }
    });
});

// store and update return product
$('#returnForm').on('submit', function(event){
  
});

//edit return
$(document).on('click', '.editreturn', function(){
   
});

//remove return
$(document).on('click', '.removereturn', function(){
  var id = $(this).attr('removereturn');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this data?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/returningproduct/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('#loading-containermodal').show();
                        $("#return-product").hide();
                      },
                      success:function(data){
                          if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            purchaseModal();
                            $('#loading-containermodal').hide();
                            $("#return-product").show();
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

//remove product
$(document).on('click', '.remove', function(){
 
});

//autocomplete

$('#product_code').keyup(function(){ 
       
    if($('#product_action').val() == 'Edit'){
        $('#productCodeList').fadeOut();
    }else{
    var query = $(this).val();
    if(query != '')
    {
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('admin.sales_inventory.autocomplete') }}",
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
    
    }
});

$(document).on('click', 'li', function(){  
    var query = $(this).text();
    if(query != '')
    {
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('admin.sales_inventory.autocompleteresult') }}",
        method:"POST",
        dataType:"json",
        data:{query:query, _token:_token},
        success:function(data){

        $.each(data.result, function(key,value){
            if(key == $('#'+key).attr('id')){
                $('#'+key).val(value)
            }
            if(key == 'category_id'){
                    $("#category_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
                if(key == 'size_id'){
                    $("#size_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
        })
        $('#productCodeList').fadeOut(); 
        }
        });
    }
});  


$('select[name="supplier_id"]').on("change", function(event){
        var supplier = $('#supplier_id').val();
        var _token = $('input[name="_token"]').val();
        $.confirm({
        title: 'Confirmation',
        content: 'Do you want to reuse Product & Data of this supplier?',
        type: 'green',
        buttons: {
            confirm: {
                text: 'Yes',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                    if(supplier != '')
                    {
                        return $.ajax({
                            url:"receiving_goods/reuseproduct",
                            method:"POST",
                            data: {
                                supplier:supplier, _token:_token,
                            },
                            dataType: "json",
                            beforeSend:function(){
                                $('#loading-productmodal').show();
                                $('#modal-body-product').hide();
                            },
                            success:function(data){
                                $.each(data.result, function(key,value){
                                    if(key == $('#'+key).attr('id')){
                                        $('#'+key).val(value)
                                        if(key == 'location_id'){
                                            $("#location_id").select2("trigger", "select", {
                                                data: { id: value }
                                            });
                                        }
                                    }
                                })

                                if(data.success){
                                    $('#success-alert').addClass('bg-primary');
                                    $('#success-alert').html('<strong>' + data.success + '</strong>');
                                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-alert").slideUp(500);
                                    });
                                    purchaseModal();
                                    alltotal();
                                    $('#loading-productmodal').hide();
                                    $('#modal-body-product').show();
                                }
                                if(data.nodata){
                                    $('#success-alert').addClass('bg-danger');
                                    $('#success-alert').html('<strong>' + data.nodata + '</strong>');
                                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-alert").slideUp(500);
                                    });
                                    purchaseModal();
                                    alltotal();
                                    $('#loading-productmodal').hide();
                                    $('#modal-body-product').show();
                                }
                               
                            }
                        })
                    }
                }
            },
            cancel:  {
                text: 'No',
                btnClass: 'btn-red',
                keys: ['enter', 'shift'],
            }
        }
    });
        
});
  

</script>
@endsection
