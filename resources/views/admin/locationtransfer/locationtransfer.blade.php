@extends('../layouts.admin')
@section('sub-title','LOCATION TRANSFER')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="col text-right">
            <button type="button" name="all_records" id="all_records" class="all_records btn btn-sm btn-default">All Records</button>
        </div>
        <form method="post" id="myForm" class="form-horizontal">
            @csrf
                <div class="row">
                  
                    <div class="col-sm-3">
                        <div class="form-group">
                            <small class="text-white">Entry Date<span class="text-white">*</span></small>
                            <input type="date" name="entry_date" id="entry_date" class="form-control" />
                            <span class="invalid-feedback text-dark" role="alert">
                                <strong id="error-entry_date"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-2">
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <small class="text-white">Reference</small>
                            <input type="text" name="reference" id="reference" class="form-control" />
                            <span class="invalid-feedback text-dark" role="alert">
                                <strong id="error-reference"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <small class="text-white">Reference Date</small>
                            <input type="date" name="reference_date" id="reference_date" class="form-control" />
                            <span class="invalid-feedback text-dark" role="alert">
                                <strong id="error-reference_date"></strong>
                            </span>
                        </div>
                    </div>
              
                  <div class="col-sm-5">
                        <div class="form-group">
                            <small class="text-white">Prepared By</small>
                            <input type="text" name="prepared_by" id="prepared_by" class="form-control" />
                            <span class="invalid-feedback text-dark" role="alert">
                                <strong id="error-prepared_by"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <small class="text-white">Remarks</small>
                            <input type="text" name="remarks" id="remarks" class="form-control"/>
                            <span class="invalid-feedback text-dark" role="alert">
                                <strong id="error-remarks"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                        <small class="text-white">Location From</small>
                            <select name="location_from" id="location_from" class="form-control select2">
                                <option value="" disabled selected>Filter By Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{$location->id}}"> {{$location->location_name}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback text-dark" role="alert">
                                <strong id="error-location_from"></strong>
                            </span>
                            
                        </div>
                    </div>
                    <div class="col-sm-2">
                   
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                        <small class="text-white">Location To</small>
                            <select name="location_to" id="location_to" class="form-control select2">
                                <option value="" disabled selected>Filter By Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{$location->id}}"> {{$location->location_name}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback text-dark" role="alert">
                                <strong id="error-location_to"></strong>
                            </span>
                            
                        </div>
                    </div>

                    <div class="col-sm-3 mx-auto p-2">
                        <input type="submit" name="action_button" id="action_button" class="text-white btn btn-default form-control" value="Submit"/>
                       
                    </div>
                    

                </div>

        </form>
    </div>
</div>
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-12">
        <div class="card">
            
            <div id="loadlocationfrom"></div>

            <div id="loading-locationfrom" class="loading-container" style="position: absolute; margin-left: 40%; z-index: 2;">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div> 
        <!-- table -->
            
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            
            <div id="loadlocationto"></div>

            <div id="loading-locationto" class="loading-container" style="position: absolute; margin-left: 40%; z-index: 2;">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div> 
        <!-- table -->
            
        </div>
    </div>

  </div>
</div>


<div class="modal all_records_modal" id="all_records_modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-all-records text-white text-uppercase font-weight-bold">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="modalbody" class="row print_report">
                  <div class="col text-center">
                        <h3 class="text-uppercase">All Location Transfer Records</h3>
                     <br>
                  </div>
                    <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush datatable-all-record-location display" cellspacing="0" width="100%">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Actions</th>
                            <th scope="col">LT No.</th>
                            <th scope="col">Entry Date</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Reference Date</th>
                            <th scope="col">Location From</th>
                            <th scope="col">Location To</th>
                            <th scope="col">Transfer Count</th>
                            <th scope="col">Prepared By</th>
                            <th scope="col">Created At</th>
                        </tr>
                        </thead>
                            <tbody class="text-uppercase font-weight-bold">
                            @foreach($locationtransfer as $key => $lt)
                                <tr data-entry-id="{{ $lt->id ?? '' }}">
                                    <td>
                                        <button type="button" name="remove" remove="{{  $lt->id ?? '' }}" id="{{  $lt->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                                    </td>
                                    <td>
                                        {{  $lt->id ?? '' }}
                                    </td>
                                    <td>
                                        {{  $lt->entry_date ?? '' }}
                                    </td>
                                    <td>
                                        {{  $lt->reference ?? '' }}
                                    </td>
                                    <td>
                                        {{  $lt->reference_date ?? '' }}
                                    </td>
                                    <td>
                                        {{  $lt->locationfrom->location_name ?? '' }}
                                    </td>
                                    <td>
                                        {{  $lt->locationto->location_name ?? '' }}
                                    </td>
                                    <td>
                                        {{  $lt->transfer_count ?? '' }}
                                    </td>
                                    <td>
                                        {{  $lt->prepared_by ?? '' }}
                                    </td>
                                    <td>
                                       
                                        {{ $lt->created_at->format('F d,Y h:i A') }}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                

            </div>
    
        </div>
    </div>
</div>

   <!-- Footer -->
@section('footer')
    @include('../partials.footer')
@endsection
@endsection

@section('script')
<script>
$(function () {

    $("#location_from").select2("trigger", "select", {
        data: { id: 1 }
    });

    $("#location_to").select2("trigger", "select", {
        data: { id: 2 }
    });

    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
        'columnDefs': [{ 'orderable': false, 'targets': 0 }],
    });

    $('.datatable-all-record-location:not(.ajaxTable)').DataTable({ buttons: dtButtons });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

$('select[name="location_from"]').on("change", function(event){
  var location_from = $('#location_from').val();
  if(location_from != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"location_transfer/" + location_from + "/from" ,
          method:"GET",
          dataType: "HTMl",
         
          beforeSend: function() {
            
            $('#loading-locationfrom').show();
          },
          success:function(data){
            $('#loading-locationfrom').hide();
            $("#loadlocationfrom").html(data);
          }
         });
        }
});

$('select[name="location_to"]').on("change", function(event){
  var location_to = $('#location_to').val();
  if(location_to != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"location_transfer/" + location_to + "/to" ,
          method:"GET",
          dataType: "HTMl",
         
          beforeSend: function() {
            
            $('#loading-locationto').show();
          },
          success:function(data){
            $('#loading-locationto').hide();
            $("#loadlocationto").html(data);
          }
         });
        }
});


$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.location_transfer.store') }}";
    var type = "POST";
    var location_from = $('#location_from').val();
    var location_to = $('#location_to').val();




    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
        },
        success:function(data){
            var html = '';
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Submit");
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $.alert({
                    title: 'Message Success',
                    content: data.success,
                    type: 'green',
                })
                $('.form-control').removeClass('is-invalid')

                $("#location_from").select2("trigger", "select", {
                    data: { id: location_from }
                });

                $("#location_to").select2("trigger", "select", {
                     data: { id: location_to }
                });
                $('#myForm')[0].reset();
            }
            if(data.nodata){
                $.alert({
                    title: 'Message Error',
                    content: data.nodata,
                    type: 'red',
                })
            }
           
        }
    });
    
});

$(document).on('click', '#all_records', function(){
    $('#all_records_modal').modal('show');
    $('.modal-title-all-records').text('All Records');
});


$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this record?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/location_transfer/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('.modal-title-all-records').text('Loading...');
                      },
                      success:function(data){
                          if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            location.reload();
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
