@extends('../layouts.admin')
@section('sub-title','RECEIVING GOODS')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loadpurchaseorder">
    <div id="loading-container" class="loading-container">
        <div class="loading"></div>
        <div id="loading-text">loading</div>
    </div>
</div>

@section('footer')
    @include('../partials.footer')
@endsection



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


<div class="modal payableModal" id="payableModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-acc text-white text-uppercase font-weight-bold">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="modalbody" class="row print_report">
                  <div class="col text-center" id="header_payable">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase">Account Payables</h5>
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" id="table_payable_report" cellspacing="0" width="100%">
                      <thead class="thead-white">
                        <tr>
                          <th>Supplier Code</th>
                          <th>Supplier Name</th>
                          <th>Address</th>
                          <th>Current Balance</th>
                          <th>Updated At</th>
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold">
                        @foreach($account_payables as $key => $supplier)
                              <tr>
                                  <td>
                                      {{  $supplier->id ?? '' }}
                                  </td>
                                  <td>
                                      {{  $supplier->name ?? '' }}
                                  </td>
                                  <td>
                                      {{ $supplier->address ?? '' }}
                                  </td>
                                
                                  <td>
                                    {{  number_format($supplier->current_balance , 2, ',', ',') }}
                                  </td>
                                  <td>
                                    {{ $supplier->updated_at->format('M j , Y h:i A') }}
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
                <button type="button" id="btn_excel_payable_report" class="text-uppercase btn btn-default">Excel Report</button>
                <button type="button" id="btn_print_payable_report" class="text-uppercase btn btn-default">Print Report</button>
            </div>
    
        </div>
    </div>
</div>

<form method="post" id="rgFormUpdate" class="form-horizontal ">
    @csrf
    <div class="modal" id="rgModalUpdate" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="modal-title font-weight-bold text-uppercase text-white ">Receiving Goods Update</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                            <div class="col-sm-6">
                                <label class="control-label text-uppercase" >Supplier<span class="text-danger">*</span></label>
                                <select name="supplier_id" id="supplier_id" class="form-control select2">
                                    <option value="" disabled selected>Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-supplier_id"></strong>
                                </span>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label text-uppercase" >Location<span class="text-danger">*</span></label>
                                <select name="location_id" id="location_id" class="form-control select2">
                                    <option value="" disabled selected>Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{$location->id}}">{{$location->location_name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-location_id"></strong>
                                </span>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Doc No.</label>
                                    <input type="text" name="doc_no" id="doc_no" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Entry Date<span class="text-danger">*</span></label>
                                    <input type="date" name="entry_date" id="entry_date" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-entry_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Po No.</label>
                                    <input type="text" name="po_no" id="po_no" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Po Date.</label>
                                    <input type="date" name="po_date" id="po_date" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Name Of A Driver<span class="text-danger">*</span></label>
                                    <input type="text" name="name_of_a_driver" id="name_of_a_driver" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-name_of_a_driver"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Plate Number<span class="text-danger">*</span></label>
                                    <input type="text" name="plate_number" id="plate_number" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-plate_number"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Trade Discount</label>
                                    <input type="text" name="trade_discount" id="trade_discount" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-trade_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Terms Discount</label>
                                    <input type="text" name="terms_discount" id="terms_discount" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-terms_discount"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Reference</label>
                                    <textarea name="reference" id="reference" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2 row">
                                <div class="col-sm-12" id="sales_products">

                                </div>
                            </div>

                            <div class="col-sm-12 mt-2 row">
                               
                                <div class="col-sm-12" id="returns_products">

                                </div>

                            </div>
                            <div class="col-sm-12 mt-2 row">
                               
                               <div class="col-sm-12" id="pallets_table">

                               </div>

                           </div>

                            <div class="col-sm-12 mt-3 p-2 bg-default">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">Total Product Cost:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="total_product_cost"  id="total_product_cost" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">Total Return Amount:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="total_return_amount"  id="total_return_amount" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">Payment:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="payment"  id="payment" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">Total Product QTY:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">QTY</div>
                                        </div>
                                            <input type="text" name="total_product_qty"  id="total_product_qty" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">Total Return QTY:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">QTY</div>
                                        </div>
                                            <input type="text" name="total_return_qty"  id="total_return_qty" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">VAT AMOUNT:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="vat_amount"  id="vat_amount" class="form-control" readonly value="0"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 p-2 bg-primary">
                                <div class="row">
                                    <div class="col-sm">
                                        <h5 class="text-white text-uppercase">Prev Bal:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="prev_bal"  id="prev_bal" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <h5 class="text-white text-uppercase">New Bal:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="new_bal"  id="new_bal" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <h5 class="text-white text-uppercase">Cash:<span class="text-white">*</span></h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="number" name="cash1"  id="cash1" class="form-control" step="any"/>
                                            <span class="invalid-feedback text-dark" role="alert">
                                                <strong id="error-cash1"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <h5 class="text-white text-uppercase">Change:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="change"  id="change" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

               

                
                <input type="hidden" name="rg_hidden_id" id="rg_hidden_id" />
               
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="Update" />
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal" id="delivery_report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="text-white text-uppercase font-weight-bold" id="title_delivery_report">Delivery Report( <span class="filter_delivery">{{$title_filter_daily}}</span> )</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
              
                <div class="row">
                  <div class="col text-center" id="header_delivery">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase font-wiegth-bold">Delivery Report</h5>
                     <h4 class="filter_delivery">{{$title_filter_daily}}</h4> 
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" id="table_delivery_report" cellspacing="0" width="100%">
                      <thead class="thead-white text-uppercase font-weight-bold">
                        <tr>
                          <th>Supplier</th>
                          <th>Product Code/Desc</th>
                          <th>Category</th>
                          <th>Total Deliver</th>
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold" id="list_delivery_report">
                           
                        
                      </tbody>
                     
                    </table>
                  </div>
                </div>
                <!-- Modal footer -->
                <div class="bg-white m-2 text-right">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_excel_delivery_report" class="text-uppercase btn btn-default">Excel Report</button>
                    <button type="button" id="btn_print_delivery_report" class="text-uppercase btn btn-default">Print Report</button>
                </div>
            </div>
    
             

         
    
        </div>
    </div>
</div>

<div id="success-order" class="success-order col-4 alert text-white fade hide fixed-bottom" style="margin-left: 65%; z-index: 9999;" role="alert">
    
</div>

@endsection

@section('script')
<script type="text/javascript">
var status = null;

$(function () {
    return loadPurchaseOrder();
});




function loadPurchaseOrder(){
    $.ajax({
        url: "loadreceivinggoods", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadpurchaseorder").html(response);
            
        }	
    })
}

// back button
$(document).on('click', '#back-button', function(){
    $('#productModal').modal('hide');
    $('#returnModal').modal('hide');
    purchaseModal();
});



$(document).on('click', '#create_record', function(){
   window.location.href = '/admin/receiving_goods/create';
});

var rg_id = null;
// View
$(document).on('click', '.edit_rg', function(){
   rg_id = $(this).attr('edit_rg');
   $('#rgFormUpdate')[0].reset();

    $.ajax({
        url :"/admin/receiving_goods/"+rg_id+"/edit",
        dataType:"json",
        beforeSend:function(){
           
        },
        success:function(data){
            $("#supplier_id").select2("trigger", "select", {
                    data: { id: data.supplier_id }
            });
            $("#location_id").select2("trigger", "select", {
                    data: { id: data.location_id }
            });
            $('#doc_no').val(data.doc_no);
            $('#entry_date').val(data.entry_date);
            $('#po_no').val(data.po_no);
            $('#po_date').val(data.po_date);
            $('#name_of_a_driver').val(data.name_of_a_driver);
            $('#plate_number').val(data.plate_number);
            $('#trade_discount').val(data.trade_discount);
            $('#terms_discount').val(data.terms_discount);
            $('#remarks').val(data.remarks);
            $('#reference').val(data.reference);
            loadProducts();
            loadReturnProduct();
            pallets_table();
            $('#total_product_cost').val(data.total_product_cost);
            $('#total_return_amount').val(data.total_return_amount);
            $('#payment').val(data.payment);
            $('#total_product_qty').val(data.total_product_qty);
            $('#total_return_qty').val(data.total_return_qty);
            $('#prev_bal').val(data.balance);
            $('#new_bal').val(data.balance);
            $('#cash1').val(data.cash1);
            $('#change').val(data.change);
            $('#rgModalUpdate').modal('show');
        }
    })
});

//update rg
$('#rgFormUpdate').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "/admin/receiving_goods/" + rg_id;
    var type = "PUT";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
            $("#action_button").attr("disabled", false);

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                        window.location.href = '#'+key;
                    }
                })
            }
            if(data.error_stock){
                $.alert({
                    title: 'Error Message',
                    content: data.error_stock,
                    type: 'red',
                })
            }
            if(data.success){
                $('#total_product_cost').val(data.total_product_cost);
                $('#total_return_amount').val(data.total_return_amount);
                $('#payment').val(data.payment);
                $('#total_product_qty').val(data.total_product_qty);
                $('#total_return_qty').val(data.total_return_qty);
                $('#change').val(data.change);
                $('#success-order').addClass('bg-success');
                $('#success-order').html('<strong>' + data.success + '</strong>');
                $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-order").slideUp(500);
                });
            }  
        }
    });
});

function loadProducts(){
    var rgs_id = rg_id;

    $.ajax({
        url: "/admin/pending_product", 
        type: "get",
        data: {rg_id:rgs_id, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function(){
            $('#action_button').attr('disabled', true);
            
        },
        success: function(response){
            $('#action_button').attr('disabled', false);
            $("#sales_products").html(response);
        }	
    })
}

function loadReturnProduct(){
    var rgs_id = rg_id;
    $.ajax({
        url: "/admin/recieve_return", 
        type: "get",
        data: {rg_id:rgs_id, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {
            $('#action_button').attr('disabled', true);
        },
        success: function(response){
            $('#action_button').attr('disabled', false);
            $("#returns_products").html(response);
        }	
    })
}

function pallets_table(){
    var rgs_id = rg_id;
    $.ajax({
        url: "/admin/receiving/rpallets_table", 
        type: "get",
        data: {rg_id:rgs_id, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {

        },
        success: function(response){
            $("#pallets_table").html(response);
        }	
    })
}

//remove product
$(document).on('click', '.remove', function(){
    var id = $(this).attr('remove');
    var rgs_id = rg_id;
    
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this product?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/sales_inventory/"+id,
                      method:'DELETE',
                      data: {rg_id:rgs_id, _token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        $('.remove').attr('disabled', true);
                      },
                      success:function(data){
                        $('.remove').attr('disabled', false);
                            if(data.error_stock){
                                $.alert({
                                    title: 'Error Message',
                                    content: data.error_stock,
                                    type: 'red',
                                })
                            }
                            if(data.success){
                            $('#success-order').addClass('bg-success');
                            $('#success-order').html('<strong>' + data.success + '</strong>');
                            $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-order").slideUp(500);
                            });
                            loadProducts();
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

//remove return
$(document).on('click', '.removereturn', function(){
  var id = $(this).attr('removereturn');
  var rgs_id = rg_id;
  
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this data?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/recieve_return/"+id,
                      method:'DELETE',
                      data: {rg_id:rgs_id, _token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        $('.removereturn').attr('disabled', true);
                      },
                      success:function(data){
                          if(data.success){
                            $('.removereturn').attr('disabled', false);
                            $('#success-order').addClass('bg-success');
                            $('#success-order').html('<strong>' + data.success + '</strong>');
                            $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-order").slideUp(500);
                            });
                            loadReturnProduct()
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

$(document).on('click', '.remove_pallet', function(){
    var id = $(this).attr('remove_pallet');
    var rgs_id = rg_id;
    $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this data?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/receiving/rpallet/"+ id,
                      method:'DELETE',
                      data: {rg_id:rgs_id,_token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        
                      },
                      success:function(data){
                          if(data.success){
                                $('#success-alert').addClass('bg-primary');
                                $('#success-alert').html('<strong>' + data.success + '</strong>');
                                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                    $("#success-alert").slideUp(500);
                                });
                                pallets_table();
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

var filter = 'all';
var from = null;
var to = null;

//Filter
$(document).on('click', '.filter', function(){
  var filter1 = $(this).attr('filter');
  var from1 = $('#fbd_from_date').val();
  var to1 = $('#fbd_to_date').val();
    $.ajax({
        url: "receiving_goods_filter", 
        type: "get",
        data: {filter:filter1,from:from1,to:to1, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {
            $('#filter_loading').show();
        },
        success: function(response){
            $('#filter_loading').hide();
            filter = filter1;
            from = from1;
            to = to1;
            $("#loadpurchaseorder").html(response);
        }	
    })
});

// ACCOUNT PAYABLE
$(document).on('click', '#account_payable', function(){
    $('#payableModal').modal('show');
    $('.modal-title-acc').text('Account Payables');

    var title = $('.modal-title-acc').text();
    var header = $('#header_payable').html();
    $('#table_payable_report').DataTable({
        bDestroy: true,
        bDestroy: true,
        responsive: true,
        scrollY: 500,
        scrollCollapse: true,
        buttons: [
            { 
                extend: 'excel',
                className: 'd-none',
                title: title,
                exportOptions: {
                    columns: ':visible'
                }
            },
            { 
                extend: 'print',
                title:  '<center>' + header + '</center>',
                className: 'd-none',
                
            }
        ],
    });
});

$(document).on('click', '#btn_print_payable_report', function(){
    $('#table_payable_report').DataTable().buttons(0,1).trigger()
});

$(document).on('click', '#btn_excel_payable_report', function(){
    $('#table_payable_report').DataTable().buttons(0,0).trigger()
});


//void
$(document).on('click', '.void', function(){
        var id          = $(this).attr('void');
        $.confirm({
            title: 'Confirmation',
            content: 'You really want to void this transaction?',
            type: 'red',
            buttons: {
                confirm: {
                    text: 'confirm',
                    btnClass: 'btn-blue',
                    keys: ['enter', 'shift'],
                    action: function(){
                        return $.ajax({
                            url:"/admin/receiving_goods/"+id+"/void",
                            method:'DELETE',
                            data: {
                               _token: '{!! csrf_token() !!}',
                            },
                            dataType:"json",
                            beforeSend:function(){
                                $('.void').attr('disabled', true);
                            },
                            success:function(data){
                                $('.void').attr('disabled', false);
                                if(data.error_stock){
                                    $.alert({
                                        title: 'Error Message',
                                        content: data.error_stock,
                                        type: 'red',
                                    })
                                }
                                if(data.success){
                                    loadPurchaseOrder();
                                    $('#success-order').addClass('bg-primary');
                                    $('#success-order').html('<strong>' + data.success + '</strong>');
                                    $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-order").slideUp(500);
                                    });
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

var table = $('#example').DataTable(); 

$(document).on('click', '#btn_delivery_report', function(){
    $('#table_delivery_report').DataTable().destroy();
    
    delivery_filter = filter;
    delivery_from   = from;
    delivery_to     = to;
    $.ajax({
        url: "/admin/receiving_goods/delivery_report/delivery_report", 
        type: "get",
        data: {filter:delivery_filter,from:delivery_from ,to:delivery_to, _token: '{!! csrf_token() !!}'},
        dataType: "json",
        beforeSend: function() {
            $('#btn_delivery_report').attr('disabled', true);
        },
        success: function(data){
            $('#btn_delivery_report').attr('disabled', false);
            
            var list = '';
            $.each(data.data, function(key,value){
                list += '<tr>';
                    list += '<td>';
                        list += value.supplier;
                    list += '</td>';
                    list += '<td>';
                        list += value.product;
                    list += '</td>';
                    list += '<td>';
                        list += value.category;
                    list += '</td>';
                    list += '<td>';
                        list += value.total_delivery;
                    list += '</td>';
                list += '</tr>';
            });
            
            $('#list_delivery_report').empty().append(list);
            $('#delivery_report').modal('show');
            $('.filter_delivery').text(data.title_filter)
            table_delivery_report();

        }	
    })
});

function table_delivery_report(){
    var title = $('#title_delivery_report').text();
    var header = $('#header_delivery').html();
    $('#table_delivery_report').DataTable({
        bDestroy: true,
        responsive: true,
        scrollY: 500,
        scrollCollapse: true,
        buttons: [
            { 
                extend: 'excel',
                className: 'd-none',
                title: title,
                exportOptions: {
                    columns: ':visible'
                }
            },
            { 
                extend: 'print',
                title:  '<center>' + header + '</center>',
                className: 'd-none',
                
            }
        ],
    });
}

$(document).on('click', '#btn_print_delivery_report', function(){
    $('#table_delivery_report').DataTable().buttons(0,1).trigger()
});

$(document).on('click', '#btn_excel_delivery_report', function(){
    $('#table_delivery_report').DataTable().buttons(0,0).trigger()
});
</script>
@endsection
