@extends('../layouts.admin')
@section('sub-title','Sizes')
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
<div id="loadsizes">
   
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

                         
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div id="loading-containermodal" class="loading-container">
                                <div class="loading"></div>
                                <div id="loading-text">loading</div>
                            </div> 
                           
                            <div id="modalbody" class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Title: </label>
                                        <input type="text" name="title" id="title" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-title"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label class="control-label text-uppercase" >UCS PER Category: </label></div>
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
                                        <label class="control-label text-uppercase" >Size: <span class="text-danger">*</span></label>
                                        <input type="text" name="size" id="size" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-size"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >UCS: <span class="text-danger">*</span></label>
                                        <input type="number" name="ucs" id="ucs" step="any" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-ucs"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Status: <span class="text-danger">*</span></label>
                                        <select name="status" id="status" class="form-control select2">
                                            <option value="SOFTDRINKS">SOFTDRINKS</option>
                                            <option value="WATER/JUICES">WATER/JUICES</option>
                                            <option value="NO-UCS">NO-UCS</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-status"></strong>
                                        </span>
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Remarks:</label>
                                        <textarea name="note" id="note" class="form-control "></textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-note"></strong>
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
    
    return loadSize();
    
});



function loadSize(){
    $.ajax({
        url: "loadsizes", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loadsizes").hide();
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadsizes").show();
            $("#loadsizes").html(response);
        }	
    })
}

$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this size?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/sizes/"+id,
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
                            return loadSize();
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
    $('.modal-title').text('Edit Size');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/sizes/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $('#modalbody').hide();
            
        },
        success:function(data){
            $('#loading-containermodal').hide();
            $('#modalbody').show();
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
                    if(key == 'category_id'){
                        $("#category_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'status'){
                        $("#status").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
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
    $('.modal-title').text('Add New Size');
    $('#category_id').select2({
        placeholder: 'Select Category'
    })
    $('#action_button').val('Submit');
    $('#action').val('Add');
    $('#form_result').html('');
    $('#loading-containermodal').hide();
    
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.sizes.store') }}";
    var type = "POST";

    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "sizes/" + id;
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
                $('#category_id').select2({
                    placeholder: 'Select Category'
                });
                $('#formModal').modal('hide');
                return loadSize();
                
            }
           
        }
    });
});

$('select[name="status"]').on("change", function(event){
    if($(this).val() == 'NO-UCS'){
        $('#ucs').val(null);
        $('#ucs').attr('disabled', true);
    }else{
        $('#ucs').attr('disabled', false);
    }
   
});

</script>
@endsection
