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
    </div>
</div>

<div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-uppercase title-head" >LOCATION TRANSFER</h3> 
                            </div>
                            <div class="col text-right">
                                <button type="button" name="all_records" id="all_records" class="all_records btn btn-sm btn-default">All Records</button>
                            </div> 
                        
                        </div>
                    </div>
                    <div id="loading-containermodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div>
                    <div class="card-body" id="rg_card_body">
                        <form method="post" id="myForm" class="form-horizontal">
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Entry Date <span class="text-danger">*</span></label>
                                        <input type="date" name="entry_date" id="entry_date" class="form-control" />
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong id="error-entry_date"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-2"></div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Reference</label>
                                        <input type="text" name="reference" id="reference" class="form-control" />
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong id="error-reference"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Reference Date</label>
                                        <input type="date" name="reference_date" id="reference_date" class="form-control" />
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong id="error-reference_date"></strong>
                                        </span>
                                    </div>
                                </div>
                        
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Prepared By</label>
                                        <input type="text" name="prepared_by" id="prepared_by" class="form-control" />
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong id="error-prepared_by"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Remarks</label>
                                        <input type="text" name="remarks" id="remarks" class="form-control"/>
                                        <span class="invalid-feedback text-dark" role="alert">
                                            <strong id="error-remarks"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div id="pending_transfer"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div id="products"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-danger text-uppercase" >Cancel</button>
                                <input type="submit" name="purchase_button" id="purchase_button" class="text-uppercase btn btn-primary" value="Submit" />
                            </div>
                        
                        </form>
                    </div>
                    

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

<!-- Product -->
<form method="post" id="productForm" class="form-horizontal">
        @csrf
        <div class="modal" id="productModal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-default">
                        <p class="modal-title-product font-weight-bold text-uppercase text-white ">Modal Heading</p>
                        <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="loading-productmodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="modal-body-product" class="modal-body">
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Location From (STOCK)<span class="text-danger">*</span></label>
                                        <div id="location_from_dd">

                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Location To<span class="text-danger">*</span></label>
                                        <select name="location_to" id="location_to" class="form-control select2">
                                            @foreach ($locations as $location)
                                                <option value="{{$location->id}}"> {{$location->location_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-location_to"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >QTY<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="qty" id="qty">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-qty"></strong>
                                        </span>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="text" name="product_id" id="product_id" />
                    </div>

                    <div class="modal-footer bg-white">
                        <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                        <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Submit" />
                    </div>
            
                </div>
            </div>
        </div>
    </form>

   <!-- Footer -->
@section('footer')
    @include('../partials.footer')
@endsection
@endsection

@section('script')
<script>
$(function () {
    loadProducts();
    loadpending_transfer();
    
    $('#loading-containermodal').hide();

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


$(document).on('click', '.transfer', function(){
    $('#productForm')[0].reset();
    var product_id = $(this).attr('transfer');
    $('.modal-title-product').text('TRANSFER PRODUCT');
    $('#productModal').modal('show');
    
    $('.form-control').removeClass('is-invalid');
    $('#action').val('Add');
    $.ajax({
        url: "/admin/location_transfer/location/product", 
        type: "get",
        dataType: "HTMl",
        data:{product_id:product_id, _token: '{!! csrf_token() !!}',},
        beforeSend: function() {
            $('#modal-body-product').hide();
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#modal-body-product').show();
            $('#loading-productmodal').hide();
            $('#product_id').val(product_id);
            $("#location_from_dd").html(response);
        }	
    })
});

$('#productForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.locationtransfer.store_pending_transfer') }}";
    var type = "POST";

    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "/admin/location_transfer/location/pending_transfer/" + id;
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
            $('#modal-body-product').hide();
            $('#loading-productmodal').show();
        },
        success:function(data){
            $('#modal-body-product').show();
            $('#loading-productmodal').hide();
            if($('#action').val() == 'Edit'){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Update");
            }else{
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Submit");
            }
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.less_stock){
                $('#qty').addClass('is-invalid');
                $('#error-qty').text(data.less_stock);
            }
            if(data.success){
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#productForm')[0].reset();
                $('#productModal').modal('hide');
                loadProducts();
                loadpending_transfer();
                
            }
           
        }
    });
});


//products
function loadProducts(){
    $.ajax({
        url: "/admin/location_transfer/location/products", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-containermodal').show();
            $('#rg_card_body').hide();

        },
        success: function(response){
            $('#loading-containermodal').hide();
            $('#rg_card_body').show();
            $("#products").html(response);
        }	
    })
}

//pending_transfer
function loadpending_transfer(){
    $.ajax({
        url: "/admin/location_transfer/location/pending_transfer", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-containermodal').show();
            $('#rg_card_body').hide();

        },
        success: function(response){
            $('#loading-containermodal').hide();
            $('#rg_card_body').show();
            $("#pending_transfer").html(response);
        }	
    })
}






</script>
@endsection
