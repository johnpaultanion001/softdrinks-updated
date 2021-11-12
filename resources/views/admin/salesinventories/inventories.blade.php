@extends('../layouts.admin')
@section('sub-title','Inventories')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                <small class="text-white">Filer By Category</small>
                    <select name="filter_category" id="filter_category" class="form-control select2">
                        <option value="">Filter Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->name}}"> {{$category->name}}</option>
                        @endforeach
                    </select>
                
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <small class="text-white">Filer By Supplier</small>
                    <select name="filter_supplier" id="filter_supplier" class="form-control select2">
                        <option value="">Filter By Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{$supplier->name}}"> {{$supplier->name}}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <small class="text-white">Filer By Size</small>
                    <select name="filter_size" id="filter_size" class="form-control select2">
                        <option value="">Filter Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{$size->title}} {{$size->size}}"> {{$size->title}} {{$size->size}} </option>
                        @endforeach
                    </select>
                
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <small class="text-white">Filer By Location</small>
                    <select name="filter_location" id="filter_location" class="form-control select2">
                        <option value="" disabled selected>Filter By Location</option>
                        @foreach ($locations as $location)
                            <option value="{{$location->location_name}}"> {{$location->location_name}}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>
<div id="loadinventories">
    
</div>




<form method="post" id="myForm" class="form-horizontal">
    @csrf
    <div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div id="loading-productmodal" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div> 
                <div id="modal-body-product" class="modal-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Product Code: </label>
                                <input type="text" name="product_code" id="product_code" class="form-control" autocomplete="off" readonly/>
                                <div id="productCodeList"></div>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_code"></strong>
                                </span>
                               
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Long Description: </label>
                               <input type="text" name="long_description" id="long_description" class="form-control" readonly/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-long_description"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Short Description: </label>
                                <input type="text" name="short_description" id="short_description" class="form-control" readonly />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-short_description"></strong>
                                </span>
                            </div>
                        </div>
                  

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col"><label class="control-label text-uppercase" >Category: </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/categories">New Category?</a>
                                    </div>
                                </div>
                                <select name="category_id" id="category_id" class="form-control select2" disabled>
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
                                    <div class="col"><label class="control-label text-uppercase" >Size: </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/sizes">New Size?</a>
                                    </div>
                                </div>
                                <select name="size_id" id="size_id" class="form-control select2" disabled>
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
                                <label class="control-label" >Expiration: </label>
                                <input type="date" name="expiration" id="expiration" class="form-control" readonly/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-expiration"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Purchase QTY: </label>
                                <input type="number" name="qty" id="qty" class="form-control" readonly/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-qty"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Unit Cost:</label>
                                <input type="number" name="purchase_amount" id="purchase_amount" class="form-control" readonly />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-purchase_amount"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Unit Profit:</label>
                                <input type="number" name="profit" id="profit" class="form-control" readonly />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-profit"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" >Product Remarks: </label>
                                <textarea name="product_remarks" id="product_remarks" class="form-control" readonly></textarea>
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
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal" >Close</button>
                    <input type="submit" name="product_button" id="product_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>


@endsection

@section('script')
<script>

$(function () {
    return loadInventories();
});



function loadInventories(){
    $.ajax({
        url: "load_products", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadinventories").html(response);
        }	
    })
}

$(document).on('click', '.view', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('View Product');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('.form_disable').attr('readonly' , true)
    $('#form_result').html('');
    $('#puchase-order-number-view').show();
    $('#puchase-order-number-edit').hide();
    $('#purhase-number').show();
    var id = $(this).attr('view');
    $.ajax({
        url :"/admin/inventories/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
           
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'category_id'){
                        $("#category_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'purchase_order_number_id'){
                        $("#purchase_order_number_id_view").select2("trigger", "select", {
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
            $('#product_button').hide();
        }
    })
});








</script>
@endsection
