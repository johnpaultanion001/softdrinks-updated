@extends('../layouts.admin')
@section('sub-title',' RECEIVING GOODS - Edit')
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
                    <h3 class="mb-0 text-uppercase" > RECEIVING GOODS - Edit</h3>
                    </div>
                  
                </div>
                </div>

                <div class="card-body">
                    <form method="post" id="myPurchaseForm" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >DOC NO.</label>
                                    <input type="text" name="doc_no" id="doc_no" class="form-control" value="{{$purchasenumber->doc_no}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-doc_no"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Entry Date:</label>
                                    <input type="date" name="entry_date" id="entry_date" class="form-control" value="{{$purchasenumber->entry_date}}" />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-entry_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO NO.</label>
                                    <input type="text" name="po_no" id="po_no" class="form-control"  value="{{$purchasenumber->po_no}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_no"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO Date.</label>
                                    <input type="date" name="po_date" id="po_date" class="form-control"  value="{{$purchasenumber->po_date}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_date"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Supplier: </label>
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
                                        <div class="col"><label class="control-label text-uppercase" >Location: </label></div>
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
                                    <label class="control-label text-uppercase" >Name of a Driver:</label>
                                    <input type="text" name="name_of_a_driver" id="name_of_a_driver" class="form-control" value="{{$purchasenumber->name_of_a_driver}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-name_of_a_driver"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Plate Number: </label>
                                    <input type="text" name="plate_number" id="plate_number" class="form-control" value="{{$purchasenumber->plate_number}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-plate_number"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Trade Discount:</label>
                                    <input type="text" name="trade_discount" id="trade_discount" class="form-control" value="{{$purchasenumber->trade_discount}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-trade_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Terms Discount: </label>
                                    <input type="text" name="terms_discount" id="terms_discount" class="form-control" value="{{$purchasenumber->terms_discount}}"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-terms_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks: </label>
                                    <textarea name="remarks" id="remarks" class="form-control">{{$purchasenumber->remarks}}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-remarks"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Reference: </label>
                                    <textarea name="reference" id="reference" class="form-control">{{$purchasenumber->reference}}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-reference"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                                                
                        <hr>
                        <div class="row">
                            
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Product Count:</label>
                                                <input type="text"  class="form-control" readonly value="{{$purchasenumber->total_orders}}"/>
                                        </div>
                                </div>

                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Total Overall Cost:</label>
                                                <input type="text"  class="form-control" readonly value="₱ {{  number_format($purchasenumber->total_purchased_order , 2, '.', ',') }}"/>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Total Overall Profit:</label>
                                                <input type="text"  class="form-control" readonly value="₱ {{  number_format($purchasenumber->total_profit , 2, '.', ',') }}"/>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Total Overall Sales:</label>
                                                <input type="text"  class="form-control" readonly value="₱ {{  number_format($purchasenumber->total_price , 2, '.', ',') }}"/>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Created By:</label>
                                                <input type="text"  class="form-control" readonly value="{{ $purchasenumber->user->name }}"/>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Vat Amount:</label>
                                                <input type="text"  class="form-control" readonly value="₱ 0"/>
                                        </div>
                                </div>
                        </div>


                        

                        <div class="col text-right mb-3">
                            <button type="button" name="create_record" id="create_record" class="create_record text-uppercase btn btn-sm btn-primary">New Product</button>
                        </div>
                        
                        <div id="loadeditpuchase">
                            
                            <div id="loading-container" class="loading-container">
                                <div class="loading"></div>
                                <div id="loading-text">loading</div>
                            </div>
                        </div>

                        
                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{$purchasenumber->id}}" />
                        <input type="hidden" name="current_supplier_id" id="current_supplier_id" value="{{$purchasenumber->supplier->id}}" />
                        <input type="hidden" name="current_location_id" id="current_location_id" value="{{$purchasenumber->location->id}}" />
                        <input type="hidden" name="purchase_order_number" id="purchase_order_number" value="{{$purchasenumber->purchase_order_number}}" />
                    
                        <div class="form-group text-right">
                            <a href="{{ route("admin.purchase-order.index") }}" class="btn-secondary btn">Back</a>
                            <button class="btn btn-primary" name="purchase_button" id="purchase_button" type="submit"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@section('footer')
    @include('../partials.footer')
@endsection

<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title text-white text-uppercase font-weight-bold">Modal Heading</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
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
                            <input type="text" name="product_code" id="product_code" class="form-control" autocomplete="off" style="text-transform: uppercase;"/>
                            <div id="productCodeList"></div>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-product_code"></strong>
                            </span>
                        
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" >Long Description: </label>
                        <input type="text" name="long_description" id="long_description" class="form-control"/>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-long_description"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" >Short Description: </label>
                            <input type="text" name="short_description" id="short_description" class="form-control" />
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
                                <div class="col"><label class="control-label text-uppercase" >Size: </label></div>
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
                            <label class="control-label" >Expiration: </label>
                            <input type="date" name="expiration" id="expiration" class="form-control" />
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-expiration"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" >Purchase QTY: </label>
                            <input type="number" name="stock" id="stock" class="form-control" />
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-stock"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" >Unit Cost:</label>
                            <input type="number" name="purchase_amount" id="purchase_amount" class="form-control" step="any" />
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-purchase_amount"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" >Unit Profit:</label>
                            <input type="number" name="profit" id="profit" class="form-control" step="any" />
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-profit"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label" >Product Remarks: </label>
                            <textarea name="product_remarks" id="product_remarks" class="form-control"></textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-product_remarks"></strong>
                            </span>
                        </div>
                    </div>
      
                </div>
                    <input type="hidden" name="product_action" id="product_action" value="Add" />
                    <input type="hidden" name="product_hidden_id" id="product_hidden_id" />
                    <input type="hidden" name="purchase_id" id="purchase_id" value="{{$purchasenumber->purchase_order_number}}" />
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
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
                    <input type="hidden" name="existing_purchase" id="existing_purchase" value="yes" />
                    <input type="hidden" name="purchase_id_return" id="purchase_id_return" value="{{$purchasenumber->purchase_order_number}}" />
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
    var supplier_id = $('#current_supplier_id').val();
    var location_id = $('#current_location_id').val();

    $("#supplier_id").select2("trigger", "select", {
        data: { id: supplier_id }
    });
    $("#location_id").select2("trigger", "select", {
        data: { id: location_id }
    });

    return loadEditPurchase();
});


function loadEditPurchase(){
    var id = $('#hidden_id').val();
    $.ajax({
        url: "/admin/loadeditpurchase/"+id+"/load", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadeditpuchase").html(response);
        }	
    })
}

$(document).on('click', '.edit', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('Edit Product');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/inventories/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading...");
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

$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this product?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/inventories/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('#titletable').text('Loading...');
                      },
                      success:function(data){
                          if(data.success){
                            $('#titletable').text('Products');
                        
                            $('#success-alert').addClass('bg-primary');                
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });

                            return loadEditPurchase();
                           
                            
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

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Product');
    $("#category_id").select2({
        placeholder: 'Select Category'
    });
    $('#size_id').select2({
        placeholder: 'Select Size'
    })
    $('#product_button').val('Submit');
    $('#product_action').val('Add');
    $('#form_result').html('');
    $('#loading-productmodal').hide();
    
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.inventories.store') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "/admin/inventories/" + id;
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
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if($('#product_action').val() == 'Edit'){
                        $("#product_button").attr("disabled", false);
                        $("#product_button").attr("value", "Update");
                    }else{
                        $("#product_button").attr("disabled", false);
                        $("#product_button").attr("value", "Submit");
                    }
                  
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                if($('#product_action').val() == 'Edit'){
                    $("#product_button").attr("disabled", false);
                    $("#product_button").attr("value", "Update");
                }else{
                    $("#product_button").attr("disabled", false);
                    $("#product_button").attr("value", "Submit");
                }

                $('#success-alert').addClass('bg-primary');                
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });

                $('.form-control').removeClass('is-invalid')
                $('#myForm')[0].reset();
                $('#category_id').select2({
                    placeholder: 'Select category'
                });
                $('#size_id').select2({
                    placeholder: 'Select Size'
                });
                $('#formModal').modal('hide');
                return loadEditPurchase();
                
            }
           
        }
    });
});

//sbmit puchase form
$('#myPurchaseForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')

    var id = $('#hidden_id').val();
    var action_url = "/admin/purchase-order/" + id;
    var type = "PUT";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Loading..");
            $('#loading-container').show();
        },
        success:function(data){
            var html = '';
            $('#loading-container').hide();
            $("#purchase_button").attr("disabled", false);
            $("#purchase_button").attr("value", "Update");
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                window.location.href = "/admin/purchase-order";
            }
           
        }
    });
});

$('#product_code').keyup(function(){ 
       
       if($('#product_action').val() == 'Edit'){
           $('#productCodeList').fadeOut();
       }else{
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

//create return product
$(document).on('click', '#create_return', function(){
    $('#returnModal').modal('show');
    $('#returnForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-return').text('Add New Return Product');
    $('#return_button').val('Submit');
    $('#return_action').val('Add');
    $('#loading-returnmodal').hide();
});


// store and update return product
$('#returnForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.returningproduct.store') }}";
    var type = "POST";

    if($('#return_action').val() == 'Edit'){
        var id = $('#return_hidden_id').val();
        action_url = "/admin/returningproduct/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#return_button").attr("disabled", true);
            $("#return_button").attr("value", "Loading..");
            $('#loading-returnmodal').show();
            $('#modal-body-return').hide();
        },
        success:function(data){
            
            $('#loading-returnmodal').hide();
            $('#modal-body-return').show();

            if($('#return_action').val() == 'Edit'){
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Update");
            }else{
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Submit");
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

                $('#returnForm')[0].reset();
                $('#product_id').select2({
                    placeholder: 'Select Product Code'
                });
                $('#status_id').select2({
                    placeholder: 'Select Status'
                });
                $('#returnModal').modal('hide');
                return loadEditPurchase();
                
            }
          
            
           
        }
    });
});

//edit return
$(document).on('click', '.editreturn', function(){
    $('#returnModal').modal('show');
    $('.modal-title-return').text('Edit Return Product');
    $('#returnForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    var id = $(this).attr('editreturn');

    $.ajax({
        url :"/admin/returningproduct/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#return_button").attr("disabled", true);
            $("#return_button").attr("value", "Loading..");
            $('#loading-returnmodal').show();
            $('#modal-body-return').hide();
        },
        success:function(data){
            $('#loading-returnmodal').hide();
            $('#modal-body-return').show();
            if($('#return_action').val() == 'Edit'){
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Update");
            }else{
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Submit");
            }
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'product_id'){
                        $("#product_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'status_id'){
                        $("#status_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                }
            })
            $('#return_hidden_id').val(id);
            $('#return_button').val('Update');
            $('#return_action').val('Edit');
        }
    })
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
                            return loadEditPurchase();
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



</script>
@endsection
