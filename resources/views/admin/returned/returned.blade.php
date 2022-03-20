@extends('../layouts.admin')
@section('sub-title','Returned Products')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loadreturned">
     
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary">
                <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div id="loading-container" class="loading-container">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div>
                <div class="modal-body" id="view-returned">
                    
                </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-primary text-uppercase text-white" data-dismiss="modal">Close</button>
            </div>
        
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal" id="editModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header bg-primary">
                <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div id="loading-containeredit" class="loading-container">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div>
                <div class="modal-body" id="edit-returned">
                    
                </div>
            <input type="hidden" name="edit_hidden_id" id="edit_hidden_id" />
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-primary text-uppercase text-white" data-dismiss="modal">Close</button>
            </div>
        
        </div>
    </div>
</div>

<!-- create / edit return product  modal -->
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
                    <input type="hidden" name="purchase_order_number_id" id="purchase_order_number_id"/>
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" id="back-button" >back</button>
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
    return loadReturned();
});

function loadReturned(){
    $.ajax({
        url: "loadreturned", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadreturned").html(response);
        }	
    })
}

//back modal
$(document).on('click', '#back-button', function(){
    $('#formModal').modal('hide');
    $('#editModal').modal('show')
});

//view returned order modal
$(document).on('click', '.view', function(){
    $('#viewModal').modal('show');
    var id = $(this).attr('view');
    $('.modal-title').text('View Returned Order');
    $.ajax({
        url: "/admin/returned/"+id+"/viewreturn", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loading-container").show();
            $("#view-returned").hide();
        },
        success: function(response){
            $("#loading-container").hide();
            $("#view-returned").show();
            $("#view-returned").html(response);
        }
    })
});


function editmodal(){
    var id = $('#edit_hidden_id').val();
    $('#editModal').modal('show');
    $('.modal-title').text('Edit Returned Order');
    $.ajax({
        url: "/admin/returned/"+id+"/edit", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loading-containeredit").show();
            $("#edit-returned").hide();
        },
        success: function(response){
            $("#loading-containeredit").hide();
            $("#edit-returned").show();
            $("#edit-returned").html(response);
        }
    })
}

//edit returned order modal
$(document).on('click', '.edit', function(){
    var id = $(this).attr('edit');
    var purchaseid = $(this).attr('purchaseid');
    $('#edit_hidden_id').val(id);
    $('#purchase_order_number_id').val(purchaseid);
    $('#hidden_id').val(id);
    return editmodal();
    
});

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#editModal').modal('hide');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add Return Product');
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
    var action_url = "{{ route('admin.pendingreturnedproducts.storeedit') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "/admin/returned/pendingreturnedproducts/update/" + id;
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
                return editmodal();
                
            }
        }
    });
});

$(document).on('click', '.editproduct', function(){
    $('#formModal').modal('show');
    $('#editModal').modal('hide');
    $('.modal-title').text('Edit Product');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('editproduct');

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

$(document).on('click', '.removeproduct', function(){
  var id = $(this).attr('removeproduct');
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
                      url:"/admin/returned/pendingreturnedproducts/update/"+id,
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
                            return editmodal();
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


$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this item?',
      autoClose: 'cancel|10000',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/returned/"+id,
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
                            return loadReturned();
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
