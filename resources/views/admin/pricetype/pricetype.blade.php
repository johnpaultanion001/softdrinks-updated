@extends('../layouts.admin')
@section('sub-title','Price Type')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>
<div id="loadpricetype">
   
</div>

@section('footer')
    @include('../partials.footer')
@endsection



<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title text-white text-uppercase font-weight-bold">Modal Heading</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                    
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="loading-containermodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    
                    <div id="modalbody" class="modalbody row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Price Type: </label>
                                <input type="text" name="price_type" id="price_type" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-price_type"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Discount: </label>
                                <input type="text" name="discount" id="discount" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-discount"></strong>
                                </span>
                            </div>
                        </div>
                       
                        
                    </div>
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Save" />
                </div>
        
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>

$(function () {
    
    return loadPriceType();
    
});



function loadPriceType(){
    $.ajax({
        url: "loadprice_type", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loadpricetype").hide();
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadpricetype").show();
            $("#loadpricetype").html(response);
        }	
    })
}

$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this Price Type?',
      autoClose: 'cancel|10000',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/price_type/"+id,
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
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            return loadPriceType();
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

$(document).on('click', '.edit', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('Edit Customer');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/price_type/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $('.modalbody').hide();
            
        },
        success:function(data){
            $('#loading-containermodal').hide();
            $('.modalbody').show();
            if($('#action').val() == 'Edit'){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Update");
            }else{
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Submit");
            }
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                }
            })
            $('#hidden_id').val(id);
            $('#action_button').val('Update');
            $('#action').val('Edit');
        }
    })
});

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Price Type');
    $('#action_button').val('Submit');
    $('#action').val('Add');
    $('#form_result').html('');
    $('#loading-containermodal').hide();
    
});

$(document).on('click', '#account_receivables', function(){
    $('#accModal').modal('show');
    $('.modal-title-acc').text('Account Receivables');
    
});


$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.price_type.store') }}";
    var type = "POST";

    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "price_type/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $('#modalbody').hide();
        },
        success:function(data){
            var html = '';
            $('#loading-containermodal').hide();
            $('#modalbody').show();
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if($('#action').val() == 'Edit'){
                        $("#action_button").attr("disabled", false);
                        $("#action_button").attr("value", "Update");
                    }else{
                        $("#action_button").attr("disabled", false);
                        $("#action_button").attr("value", "Submit");
                    }
                  
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                if($('#action').val() == 'Edit'){
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Update");
                }else{
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Submit");
                }
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#myForm')[0].reset();
                $('#formModal').modal('hide');
                return loadPriceType();
                
            }
           
        }
    });
});

</script>
@endsection
