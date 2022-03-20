@extends('../layouts.admin')
@section('sub-title','SALES INVENTORIES')
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
                        <option value="">Filter Location</option>
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

@section('footer')
    @include('../partials.footer')
@endsection

<form method="post" id="productForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="productModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div id="product_loading" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div>
                <div class="modal-body" id="product_body">
                    
                    <div class="row">
                        <div class="col-lg-12 row">
                            <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Receiving Goods ID</label>
                                        <input type="text" name="receiving_good_id" id="receiving_good_id" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-receiving_good_id"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Product ID</label>
                                        <input type="text" name="id" id="id" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-id"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Product Code</label>
                                        <input type="text" name="product_code" id="product_code" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-product_code"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Description</label>
                                        <input type="text" name="description" id="description" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-description"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Size</label>
                                        <input type="text" name="size" id="size" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-size"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Category</label>
                                        <input type="text" name="category" id="category" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-category"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Supplier</label>
                                        <input type="text" name="supplier" id="supplier" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-supplier"></strong>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Overall Stock</label>
                                        <input type="text" name="stock" id="stock" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-stock"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Sold</label>
                                        <input type="text" name="sold" id="sold" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-sold"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Unit Price</label>
                                        <input type="text" name="unit_price" id="unit_price" class="form-control" readonly/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-unit_price"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Created At</label>
                                        <input type="text" name="created_date" id="created_date" class="form-control" readonly/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Created By</label>
                                        <input type="text" name="created_by" id="created_by" class="form-control" readonly/>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <h5 class="text-uppercase">Editable Field</h5>
                                </div> 
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Unit Cost <span class="text-danger">*</span></label>
                                        <input type="number" name="unit_cost" id="unit_cost" step="any" class="form-control"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-unit_cost"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Regular Discount <span class="text-danger">*</span></label>
                                        <input type="number" name="regular_discount" id="regular_discount" step="any" class="form-control"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-regular_discount"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Houling Discount <span class="text-danger">*</span></label>
                                        <input type="number" name="hauling_discount" id="hauling_discount" step="any" class="form-control"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-hauling_discount"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Expiration</label>
                                        <input type="date" name="expiration" id="expiration" class="form-control"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-expiration"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Remarks</label>
                                        <input type="text" name="product_remarks" id="product_remarks" class="form-control"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-product_remarks"></strong>
                                        </span>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="col-sm-12 row">
                            <div class="col-sm-6 mb-2">
                                <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Stock History</h4>
                            </div>
                           <div class="col-sm-12" id="stock_history">

                           </div>

                        </div>

                        <div class="col-sm-12 row">
                            <div class="col-sm-6 mb-2">
                                <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Sales History</h4>
                            </div>
                           <div class="col-sm-12" id="sales_history">

                           </div>

                        </div>

                        <div class="col-sm-12 row">
                            <div class="col-sm-6 mb-2">
                                <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Location Stock</h4>
                            </div>
                           <div class="col-sm-12" id="location_stocks">

                           </div>

                        </div>
                       
                    </div>
                    

                    <input type="hidden" name="product_hidden_id" id="product_hidden_id" />

                   
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                    <input type="submit" name="product_button" id="product_button" class="text-uppercase btn btn-primary" value="UPDATE" />
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

$(document).on('click', '.ev_product', function(){
    $('#productModal').modal('show');
    $('.modal-title').text('VEIW/EDIT PRODUCT');
    $('#productForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    var id = $(this).attr('ev_product');
    $('#product_hidden_id').val(id);
    $.ajax({
        url :"/admin/sales_inventory/"+id+"/edit_view",
        dataType:"json",
        beforeSend:function(){
            $('#product_loading').show();
            $('#product_body').hide();
            $("#product_button").attr("disabled", true);
        },
        success:function(data){
            $('#product_loading').hide();
            $('#product_body').show();
            $("#product_button").attr("disabled", false);
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                }
            })
            if(data.size){
                $('#size').val(data.size);
            }
            if(data.category){
                $('#category').val(data.category);
            }
            if(data.supplier){
                $('#supplier').val(data.supplier);
            }
            if(data.created_by){
                $('#created_by').val(data.created_by);
            }
            if(data.created_date){
                $('#created_date').val(data.created_date);
            }
            if(data.unit_price){
                $('#unit_price').val(data.unit_price);
            }
            if(data.stock){
                $('#stock').val(data.stock);
            }
            
            stock_history();
            sales_history();
            location_stocks();

        }
    })
});

function stock_history(){
    var id = $('#product_hidden_id').val();

    $.ajax({
        url: "/admin/sales_inventory/"+id+"/stock_history", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
           
        },
        success: function(response){
            $("#stock_history").html(response);
        }	
    })
}
function sales_history(){
    var id = $('#product_hidden_id').val();

    $.ajax({
        url: "/admin/sales_inventory/"+id+"/sales_history", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
           
        },
        success: function(response){
            $("#sales_history").html(response);
        }	
    })
}
function location_stocks(){
    var id = $('#product_hidden_id').val();

    $.ajax({
        url: "/admin/sales_inventory/"+id+"/location_stocks", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
           
        },
        success: function(response){
            $("#location_stocks").html(response);
        }	
    })
}

// store and update product
$('#productForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#product_hidden_id').val();
    action_url = "/admin/sales_inventory/"+id+"/update_ev";
    type = "PUT";
   

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $('#product_loading').show();
            $('#product_body').hide();
            $("#product_button").attr("disabled", true);
        },
        success:function(data){
            $('#product_loading').hide();
            $('#product_body').show();
            $("#product_button").attr("disabled", false);
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('#productModal').modal('hide');
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
            }
            if(data.unit_price){
                $('#unit_price').val(data.unit_price);
            }
          
            
           
        }
    });
});









</script>
@endsection
