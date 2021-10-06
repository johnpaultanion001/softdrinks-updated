@extends('../layouts.admin')
@section('sub-title','UCS')
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
<div id="loaducs">
   
</div>


<div class="modal modal_all_ucs" id="modal_all_ucs" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-ucs-report text-white text-uppercase font-weight-bold">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">  
                <div id="loading-allucs-container" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div>
               <div id="all_ucs"></div>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>
    
        </div>
    </div>
</div>

@section('footer')
    @include('../partials.footer')
@endsection


@endsection

@section('script')
<script>

$(function () {
    return loadUCS();
});



function loadUCS(){
    $.ajax({
        url: "loaducs", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loaducs").hide();
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loaducs").show();
            $("#loaducs").html(response);
        }	
    })
}

function loadALLUCS(){
    $.ajax({
        url: "ucs/allucs", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#all_ucs").hide();
            $('#loading-allucs-container').show();
        },
        success: function(response){
            $('#loading-allucs-container').hide();
            $("#all_ucs").show();
            $("#all_ucs").html(response);
        }	
    })
}


$(document).on('click', '#back_to_zero', function(){
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to Back to Zero?',
      type: 'green',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/ucs/backtozero",
                      method:'PUT',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $("#loaducs").hide();
                        $('#loading-container').show();
                      },
                      success:function(data){
                            if(data.nodata){
                                $('#success-alert').addClass('bg-danger');
                                $('#success-alert').html('<strong>' + data.nodata + '</strong>');
                                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                    $("#success-alert").slideUp(500);
                                });
                                return loadUCS();
                            }
                          if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            return loadUCS();
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

$(document).on('click', '#all_ucs_report', function(){
    $('#modal_all_ucs').modal('show');
    $('.modal-title-ucs-report').text('UCS Report');
    return loadALLUCS();
});

</script>
@endsection
