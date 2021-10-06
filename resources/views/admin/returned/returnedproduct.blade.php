@extends('../layouts.admin')
@section('sub-title','Purchase Orders - Return')
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
                    <h3 class="mb-0 text-uppercase" >Purchase Order - Return</h3>
                    </div>
                </div>
                </div>

                <div class="card-body">
                    <form method="post" id="myReturnedForm" class="form-horizontal">
                        @csrf
                      
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >DOC NO.</label>
                                    <input type="text" name="doc_no" id="doc_no" class="form-control" value="{{$returned->doc_no}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-doc_no"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Entry Date:</label>
                                    <input type="date" name="entry_date" id="entry_date" class="form-control" value="{{$returned->entry_date}}" readonly />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-entry_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO NO.</label> 
                                    <input type="text" name="po_no" id="po_no" class="form-control"  value="{{$returned->po_no}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_no"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO Date.</label>
                                    <input type="date" name="po_date" id="po_date" class="form-control"  value="{{$returned->po_date}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_date"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Supplier Code/Name:</label>
                                    <input type="text" name="po_date" id="po_date" class="form-control"  value="{{$returned->supplier->id}}/{{$returned->supplier->name}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Location Code/Name:</label>
                                    <input type="text" name="po_date" id="po_date" class="form-control"  value="{{$returned->location->id}}/{{$returned->location->location_name}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Name of a Driver:</label>
                                    <input type="text" name="name_of_a_driver" id="name_of_a_driver" class="form-control" value="{{$returned->name_of_a_driver}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-name_of_a_driver"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Plate Number: </label>
                                    <input type="text" name="plate_number" id="plate_number" class="form-control" value="{{$returned->plate_number}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-plate_number"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Trade Discount:</label>
                                    <input type="text" name="trade_discount" id="trade_discount" class="form-control" value="{{$returned->trade_discount}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-trade_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Terms Discount: </label>
                                    <input type="text" name="terms_discount" id="terms_discount" class="form-control" value="{{$returned->terms_discount}}" readonly/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-terms_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks: </label>
                                    <textarea name="remarks" id="remarks" class="form-control" readonly>{{$returned->remarks}}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-remarks"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Reference: </label>
                                    <textarea name="reference" id="reference" class="form-control" readonly>{{$returned->reference}}</textarea>
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
                                                <input type="text"  class="form-control" readonly value="{{$returned->total_orders}}"/>
                                        </div>
                                </div>

                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Total Purchased:</label>
                                                <input type="text"  class="form-control" readonly value="₱ {{  number_format($returned->total_purchased_order , 0, ',', ',') }}"/>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Total Profit:</label>
                                                <input type="text"  class="form-control" readonly value="₱ {{  number_format($returned->total_profit , 0, ',', ',') }}"/>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Total Price:</label>
                                                <input type="text"  class="form-control" readonly value="₱ {{  number_format($returned->total_price , 0, ',', ',') }}"/>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label text-uppercase" >Created By:</label>
                                                <input type="text"  class="form-control" readonly value="{{ $returned->user->name }}"/>
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
                            <button type="button" name="create_record" id="create_record" class="create_record text-uppercase btn btn-sm btn-primary">New Return Product</button>
                        </div>
                        <div id="loadreturnproduct">
                            <div id="loading-container" class="loading-container">
                                <div class="loading"></div>
                                <div id="loading-text">loading</div>
                            </div>
                        </div>

                     
                       
                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{$returned->purchase_order_number}}" />
                        <input type="hidden" name="hidden_total_deposit" id="hidden_total_deposit" value="{{$returnedproducts->sum('deposit')}}" />
                        <input type="hidden" name="hidden_total_case" id="hidden_total_case" value="{{$returnedproducts->sum('case')}}" />
                        <div class="form-group text-right">
                            <a href="{{ route("admin.purchase-order.index") }}" class="btn-secondary btn">Back</a>
                            <button class="btn btn-primary" name="purchase_button" id="purchase_button" type="submit">Return</button>
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
        <div class="modal-dialog modal-lg modal-dialog-centered ">
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Name: </label>
                                <input type="text" name="name" id="name" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-name"></strong>
                                </span>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Case: </label>
                                <input type="number" name="case" id="case" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-case"></strong>
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
                                <label class="control-label text-uppercase" >Deposit: </label>
                                <input type="number" name="deposit" id="deposit" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-deposit"></strong>
                                </span>
                            </div>
                        </div>
                    
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Note / Optional: </label>
                                <textarea name="note" id="note" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-note"></strong>
                                </span>
                            </div>
                        </div>
                            
                    </div>
                    <input type="hidden" name="product_action" id="product_action" value="Add" />
                    <input type="hidden" name="product_hidden_id" id="product_hidden_id" />
                    <input type="hidden" name="purchase_order_number_id" id="purchase_order_number_id" value="{{$returned->purchase_order_number}}" />

                    

                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
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
    return loadPendingReturnProduct();
});


function loadPendingReturnProduct(){
    var id = $('#hidden_id').val();
    $.ajax({
        url: "/admin/returned/"+id+"/loadreturnedproduct", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadreturnproduct").html(response);
        }	
    })
}

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Return Product');
    $("#status_id").select2({
        placeholder: 'Select Status'
    });
    
    $('#product_button').val('Submit');
    $('#product_action').val('Add');
    $('#form_result').html('');
    $('#loading-productmodal').hide();
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.pendingreturnedproducts.store') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "/admin/returned/pendingreturnedproducts/" + id;
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
                $.alert({
                    title: 'Success Message',
                    content: data.success,
                    type: 'green',
                });
                $('.form-control').removeClass('is-invalid')
                $('#myForm')[0].reset();
                $('#status_id').select2({
                    placeholder: 'Select Status'
                });
                $('#formModal').modal('hide');
                location.reload();
                
            }
        }
    });
});

$(document).on('click', '.edit', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('Edit Product');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/returned/pendingreturnedproducts/"+id+"/edit",
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
                    if(key == 'status_id'){
                        $("#status_id").select2("trigger", "select", {
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
      autoClose: 'cancel|10000',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/returned/pendingreturnedproducts/"+id,
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
                            location.reload();
                            $('#titletable').text('RETURNING PRODUCTS');
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


//returned product
$('#myReturnedForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.returned.store') }}";
    var type = "POST";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Returning..");
            $('#loading-container').show();
        },
        success:function(data){
            var html = '';
            $('#loading-container').hide();
            $("#purchase_button").attr("disabled", false);
            $("#purchase_button").attr("value", "Returned");
            if(data.nodata){
                $.alert({
                    title: 'Error Message',
                    content: data.nodata,
                    type: 'red',
                });
            }
            if(data.success){
                $.confirm({
                    title: 'Success Message',
                    content: data.success,
                    type: 'green',
                    buttons: {
                        confirm: {
                            text: 'Ok',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function(){
                                window.location.href = "/admin/purchase-order";
                            }
                        },
                        
                    }
                });

            }
           
        }
    });
});
</script>
@endsection
