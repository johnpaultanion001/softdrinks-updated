@extends('../layouts.admin')
@section('sub-title','ROLES')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="load">
        <div id="loading-container" class="loading-container">
            <div class="loading"></div>
            <div id="loading-text">loading</div>
        </div>
</div>

<!-- role form modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body" id="form">
                    
            </div>
        </div>
    </div>
</div>


@endsection


@section('script')
<script>
$(function () {
    
    return loadRole();
});

function loadRole(){
    $.ajax({
        url: "loadroles", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#load").html(response);
        }	
    })
}

//delete role
$(document).on('click', '.delete', function(){
    var id = $(this).attr('delete');
    $.confirm({
        title: 'Confirmation',
        content: 'You really want to remove this role?',
        autoClose: 'cancel|10000',
        type: 'red',
        buttons: {
            confirm: {
                text: 'confirm',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                    return $.ajax({
                        url:"/admin/roles/"+id,
                        method:'DELETE',
                        data: {
                            _token: '{!! csrf_token() !!}',
                        },
                        dataType:"json",
                        beforeSend:function(){
                            $("#titletable").html("Loading...");
                         
                            
                        },
                        success:function(data){
                            if(data.success){
                               return loadRole();
                               
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
//view Role
$(document).on('click', '.view', function(){
    $('#modalForm').modal('show');
    $('.modal-title').text('Role Information');
    var id = $(this).attr('view');
    $.ajax({
        url: "roles/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
           $(".modal-title").html("Loading...");
        },
        success: function(response){
            $('.modal-title').text('Role Information');
            $("#form").html(response);
        }	
    })
});

</script>
@endsection