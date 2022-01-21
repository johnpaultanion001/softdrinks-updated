@extends('../layouts.admin')
@section('sub-title','CUSTOMERS')
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
<div id="loadcustomers">
   
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
                    
                    <div id="modalbody" class="modalbody row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Customer Code: <span class="text-danger">*</span></label>
                                <input type="text" name="customer_code" id="customer_code" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-customer_code"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Customer Name: <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-customer_name"></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Contact Number: </label>
                                <input type="number" name="contact_number" id="contact_number" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-contact_number"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Current Balance: </label>
                                <input type="number" name="current_balance" id="current_balance" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-current_balance"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Area: </label>
                                <textarea  name="area" id="area" class="form-control "></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-area"></strong>
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
    
    return loadCustomers();
    
});



function loadCustomers(){
    $.ajax({
        url: "loadcustomers", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loadcustomers").hide();
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadcustomers").show();
            $("#loadcustomers").html(response);
        }	
    })
}

$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this customer?',
      autoClose: 'cancel|10000',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/customers/"+id,
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
                            return loadCustomers();
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
        url :"/admin/customers/"+id+"/edit",
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
    $('.modal-title').text('Add New Customer');
    $('#action_button').val('Submit');
    $('#action').val('Add');
    $('#form_result').html('');
    $('#loading-containermodal').hide();
    
});

$(document).on('click', '#account_receivables', function(){
    $('#accModal').modal('show');
    $('.modal-title-acc').text('Account Receivables');
});

$(document).on('click', '#print_acc', function(){
    var contents = $(".print_report").html();
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
});


$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.customers.store') }}";
    var type = "POST";

    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "customers/" + id;
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
                return loadCustomers();
                
            }
           
        }
    });
});

</script>
@endsection
