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
<input type="hidden" id="ucs" value="all">
<div id="loaducs">
   
</div>

<!-- modal for Filter -->
<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">Filter Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
               <div class="form-group">
                    <label class="control-label" >From: </label>
                    <input type="date" name="fbd_from_date" id="fbd_from_date"  class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label" >To: </label>
                    <input type="date"  name="fbd_to_date" id="fbd_to_date"  class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
        </div>
        <div class="col text-right">
          <button id="filter_by_date" name="filter_by_date" filter="fbd"  type="button" class="btn btn-default filter">Submit</button>
        </div>
            
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

function allucs(){
    $.ajax({
        url: "ucs/allucs", 
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
$(document).on('click', '#all_ucs_report', function(){
    var btn = $('#ucs').val();
    if(btn == 'all'){
        $('#ucs').val('ucs');
        allucs();
    }else{
        $('#ucs').val('all');
        loadUCS();
    }
});

//Filter
$(document).on('click', '.filter', function(){
var filter = $(this).attr('filter');
var from = $('#fbd_from_date').val();
var to = $('#fbd_to_date').val();
var status = $('#ucs').val();

    $.ajax({
        url: "/admin/ucs_filter", 
        type: "get",
        data: {filter:filter,from:from,to:to,status:status, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {
            $('#filter_loading').show();
        },
        success: function(response){
            $('#filter_loading').hide();
            $("#loaducs").html(response);
        }	
    })
});

</script>
@endsection
