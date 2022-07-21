@extends('../layouts.admin')
@section('sub-title','ALL RECORDS SALES INVOICE')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="load_record">
    
</div>
<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>

@section('footer')
    @include('../partials.footer')
@endsection


<!-- View Sales Invoice -->
<form method="post" id="siForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="siModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="loading-containermodal" class="loading-container">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div>
            <div class="modal-content" id="si_content">
                <div class="modal-header bg-primary">
                    <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >ORDER #</label>
                                    <input type="text" name="id" id="id" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >DOC NO.</label>
                                    <input type="text" name="doc_no" id="doc_no" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Entry Date <span class="text-danger">*</span></label>
                                    <input type="date" name="entry_date" id="entry_date" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="control-label text-uppercase" >Assign Deliver</label>
                                <select name="deliver_id" id="deliver_id" class="form-control select2">
                                    <option value="" disabled selected>Select Customer</option>
                                    @foreach ($deliveries as $deliver)
                                        <option value="{{$deliver->id}}">{{$deliver->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label text-uppercase" >Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control select2" disabled>
                                    <option value="" disabled selected>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->customer_code}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-12 mt-2 row">
                                <div class="col-sm-6 mb-2">
                                    <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Sales</h4>
                                </div>
                                <div class="col-sm-12" id="sales">

                                </div>

                            </div>

                            <div class="col-sm-12 mt-2 row">
                                <div class="col-sm-6 mb-2">
                                    <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Returns</h4>
                                </div>
                                <div class="col-sm-12" id="returns">

                                </div>

                            </div>

                            <div class="col-sm-12 mt-2 row">
                                <div class="col-sm-6 mb-2">
                                    <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Pallets</h4>
                                </div>
                                <div class="col-sm-12" id="pallets">

                                </div>

                            </div>
                            
                            <div class="col-sm-12 mt-2 row">
                                <div class="col-sm-6 mb-2">
                                    <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Deposits</h4>
                                </div>
                                <div class="col-sm-12" id="deposits">

                                </div>

                            </div>

                            <div class="col-sm-12 mt-3 p-2 bg-default">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="text-white text-uppercase">Sub Total:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="sub_total"  id="sub_total" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="text-white text-uppercase">Total Discount:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="total_discount"  id="total_discount" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="text-white text-uppercase">Total Sales AMT:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="total_sales_amount"  id="total_sales_amount" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="text-white text-uppercase">Total Return AMT:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="total_return_amount"  id="total_return_amount" class="form-control" readonly/>
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
                                        <h5 class="text-white text-uppercase">Cash:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="number" name="cash"  id="cash" class="form-control"/>
                                            <span class="invalid-feedback text-dark" role="alert">
                                                <strong id="error-cash"></strong>
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
                                    <div class="col-sm">
                                        <h5 class="text-white text-uppercase">Payment:</h5>
                                        <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">₱</div>
                                        </div>
                                            <input type="text" name="payment"  id="payment" class="form-control" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                           
                           
                        
                    </div>

                    
                    
                </div>

               

                
                <input type="hidden" name="si_hidden_id" id="si_hidden_id" />
               
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-primary" value="Update" />
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- modal for Receipt -->
<form method="post" id="frm_sales_receipt" class="form-horizontal ">
    @csrf
    <div class="modal" id="modal_sales_receipt" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title-sales-receipt font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="loading-sales-receipt" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="sales_receipt">
                    
                    </div>
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_sales_receipt" id="action_sales_receipt" class="text-uppercase btn btn-default" value="Print Receipt" />
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                </div>
        
            </div>
        </div>
    </div>
</form>

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

<div class="modal accModal" id="accModal" data-keyboard="false" data-backdrop="static">
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
                  <div class="col text-center" id="header_account">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase">Account Receivables</h5>
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" id="table_account_report" cellspacing="0" width="100%">
                      <thead class="thead-white">
                        <tr>
                          
                          <th>Customer Code</th>
                          <th>Customer Name</th>
                          <th>Area</th>
                          <th>Current Balance</th>
                          <th>Updated At</th>
                        
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold">
                         @foreach($account_receivables as $customer)
                              <tr data-entry-id="{{ $customer->id ?? '' }}">
                                  <td>
                                      {{  $customer->customer_code ?? '' }}
                                  </td>
                                  <td>
                                      {{  $customer->customer_name ?? '' }}
                                  </td>
                                  <td>
                                      {{ $customer->area ?? '' }}
                                  </td>
                                
                                  <td>
                                    {{  number_format($customer->current_balance , 2, ',', ',') }}
                                  </td>
                                  <td>
                                    {{ $customer->updated_at->format('M j , Y h:i A') }}
                                  </td>
                              </tr>
                          @endforeach
                          <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                
                                <td>
                                  Total Current Balance:
                                </td>
                                <td>
                                  {{  number_format($account_receivables->sum->current_balance , 2, '.', ',') }}
                                </td>
                                <td>
                                </td>
                              </tr>
                      </tbody>
                    </table>
                 </div>
                </div>
                
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                <button type="button" id="btn_excel_account_report" class="text-uppercase btn btn-default">Excel Report</button>
                <button type="button" id="btn_print_account_report" class="text-uppercase btn btn-default">Print Report</button>
            </div>
    
        </div>
    </div>
</div>

<div id="success-order" class="success-order col-4 alert text-white fade hide fixed-bottom" style="margin-left: 65%; z-index: 9999;" role="alert">
    
</div>

@endsection

@section('script')
<script type="text/javascript">

    $(function () {
        $('#loading-containermodal').hide();
        return loadRecords();
        
    });

    function loadRecords(){
        $.ajax({
            url: "/admin/salesInvoice/salesInvoice/records", 
            type: "get",
            dataType: "HTMl",
            beforeSend: function() {
                $("#load_record").hide();
                $('#loading-container').show();
            },
            success: function(response){
                $('#loading-container').hide();
                $("#load_record").show();
                $("#load_record").html(response);
            }	
        })
    }
    //Filter
    $(document).on('click', '.filter', function(){
        var filter = $(this).attr('filter');
        var from = $('#fbd_from_date').val();
        var to = $('#fbd_to_date').val();

            $.ajax({
                url: "receiving_goods_filter", 
                type: "get",
                data: {filter:filter,from:from,to:to, _token: '{!! csrf_token() !!}'},
                dataType: "HTMl",
                beforeSend: function() {
                    $('#filter_loading').show();
                },
                success: function(response){
                    $('#filter_loading').hide();
                    $("#loadpurchaseorder").html(response);
                }	
        })
    });

    
    /// Receipt
    //frm_sales_receipt
    $(document).on('click', '.sales_receipt', function(){
        $('#modal_sales_receipt').modal('show');
        $('.modal-title-sales-receipt').text('Print Receipt');
        var id = $(this).attr('sales_receipt');

        $.ajax({
            url :"/admin/salesInvoice-sales_receipt/"+id,
            type: "get",
            dataType: "HTMl",
            beforeSend:function(){
                $("#action_sales_receipt").attr("disabled", true);
                $("#action_sales_receipt").attr("value", "Loading..");
                $('#loading-sales-receipt').show();
                $('#sales_receipt').hide();
                
            },
            success:function(response){
                $('#sales_receipt').show();
                $("#action_sales_receipt").attr("disabled", false);
                $("#action_sales_receipt").attr("value", "Print Receipt");
                $('#loading-sales-receipt').hide();
                $("#sales_receipt").html(response);
            }
        })
    }); 


    $('#frm_sales_receipt').on('submit', function(event){
        event.preventDefault();
        $('#receipt-body-sales').removeClass('receipt-body');
            var contents = $("#receiptreportsales").html();
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
            $('#receipt-body-sales').addClass('receipt-body');
    });

    // view
    function sales(){
        var id = $('#si_hidden_id').val();

        $.ajax({
            url: "/admin/salesInvoice/"+id+"/sales_records", 
            type: "get",
            dataType: "HTMl",
            beforeSend: function() {
            
            },
            success: function(response){
                $("#sales").html(response);
            }	
        })
    }
    function returns(){
        var id = $('#si_hidden_id').val();

        $.ajax({
            url: "/admin/salesInvoice/"+id+"/return_records", 
            type: "get",
            dataType: "HTMl",
            beforeSend: function() {
            
            },
            success: function(response){
                $("#returns").html(response);
            }	
        })
    }
    function pallets(){
        var id = $('#si_hidden_id').val();

        $.ajax({
            url: "/admin/salesInvoice/"+id+"/pallets_records", 
            type: "get",
            dataType: "HTMl",
            beforeSend: function() {
            
            },
            success: function(response){
                $("#pallets").html(response);
            }	
        })
    }

    function deposits(){
        var id = $('#si_hidden_id').val();

        $.ajax({
            url: "/admin/salesInvoice/"+id+"/deposits_records", 
            type: "get",
            dataType: "HTMl",
            beforeSend: function() {
            
            },
            success: function(response){
                $("#deposits").html(response);
            }	
        })
    }
   

    $(document).on('click', '.view', function(){
        $('#siModal').modal('show');
        $('.modal-title').text('VEIW/EDIT SALES INVOICE');
        $('#siForm')[0].reset();

        var id = $(this).attr('view');
        $('#si_hidden_id').val(id);
        $.ajax({
            url :"/admin/salesInvoice/"+id+"/edit",
            dataType:"json",
            beforeSend:function(){
                $('#loading-containermodal').show();
                $('#si_content').hide();
            },
            success:function(data){
                
                $('#id').val(data.order_number);
                $('#doc_no').val(data.doc_no);
                $('#entry_date').val(data.entry_date);
                $('#remarks').val(data.remarks);
                $("#deliver_id").select2("trigger", "select", {
                    data: { id: data.deliver_id }
                });
                $("#customer_id").select2("trigger", "select", {
                    data: { id: data.customer_id }
                });
                $('#sub_total').val(data.sub_total);
                $('#total_discount').val(data.total_discount);
                $('#total_sales_amount').val(data.total_sales_amount);
                $('#total_return_amount').val(data.total_return_amount);

                $('#prev_bal').val(data.balance);
                $('#new_bal').val(data.balance);
                $('#cash').val(data.cash);
                $('#change').val(data.change);
                $('#payment').val(data.payment);

                sales();
                returns();
                pallets();
                deposits();
                $('#loading-containermodal').hide();
                $('#si_content').show();
            }
        })
    });
    
    //Filter
    $(document).on('click', '.filter', function(){
        var filter = $(this).attr('filter');
        var from = $('#fbd_from_date').val();
        var to = $('#fbd_to_date').val();

            $.ajax({
                url: "/admin/salesInvoice_filter", 
                type: "get",
                data: {filter:filter,from:from,to:to, _token: '{!! csrf_token() !!}'},
                dataType: "HTMl",
                beforeSend: function() {
                    $('#filter_loading').show();
                },
                success: function(response){
                    $('#filter_loading').hide();
                    $("#load_record").html(response);
                }	
            })
    });

    $(document).on('click', '#btn_sales_invoice', function(){
        window.location.href = '/admin/salesInvoice';
    });

    //remove sales
    $(document).on('click', '.remove_sales', function(){
        var id = $(this).attr('remove_sales');
     

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
                            url:"/admin/transactions/"+id,
                            method:'DELETE',
                            data: {_token: '{!! csrf_token() !!}'},
                            dataType:"json",
                            beforeSend:function(){
                               
                            },
                            success:function(data){
                                if(data.success){
                                    $('#success-order').addClass('bg-primary');
                                    $('#success-order').html('<strong>' + data.success + '</strong>');
                                    $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-order").slideUp(500);
                                    });
                                    sales();
                                    loadRecords();
                                    
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
    $(document).on('click', '.remove_return', function(){
        var id          = $(this).attr('remove_return');
        var is_purchase = $(this).attr('is_purchase');
      
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
                            url:"/admin/salesReturn/"+id,
                            method:'DELETE',
                            data: {
                                is_purchase:is_purchase, _token: '{!! csrf_token() !!}',
                            },
                            dataType:"json",
                            beforeSend:function(){
                               
                            },
                            success:function(data){
                                
                                if(data.success){
                                    $('#success-order').addClass('bg-primary');
                                    $('#success-order').html('<strong>' + data.success + '</strong>');
                                    $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-order").slideUp(500);
                                    });
                                    returns();
                                    loadRecords();
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
                            url:"/admin/salesInvoice/"+id+"/void",
                            method:'DELETE',
                            data: {
                               _token: '{!! csrf_token() !!}',
                            },
                            dataType:"json",
                            beforeSend:function(){
                                $('.void').text('Loading..');
                                $('.void').attr('disabled', true);
                            },
                            success:function(data){
                                if(data.success){
                                    $('.void').text('VOID');
                                    $('.void').attr('disabled', false);
                                    loadRecords();
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

    // account receivables
    $(document).on('click', '#account_receivables', function(){
        $('#accModal').modal('show');
        $('.modal-title-acc').text('Account Receivables');

        var title = $('.modal-title-acc').text();
        var header = $('#header_account').html();
        $('#table_account_report').DataTable({
            bDestroy: true,
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
    $(document).on('click', '#btn_print_account_report', function(){
        $('#table_account_report').DataTable().buttons(0,1).trigger()
    });

    $(document).on('click', '#btn_excel_account_report', function(){
        $('#table_account_report').DataTable().buttons(0,0).trigger()
    });

    //Update 
    $('#siForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var id = $('#si_hidden_id').val();
        var action_url = "/admin/salesInvoice/" + id;
        var type = "PUT";
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
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Update");

                if(data.errors){
                    $.each(data.errors, function(key,value){
                        if(key == $('#'+key).attr('id')){
                            $('#'+key).addClass('is-invalid')
                            $('#error-'+key).text(value)
                            window.location.href = '#'+key;
                        }
                    })
                }
            
                if(data.success){
                    $('#change').val(data.change);
                    $('#payment').val(data.payment);
                    $('#success-order').addClass('bg-primary');
                    $('#success-order').html('<strong>' + data.success + '</strong>');
                    $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                        $("#success-order").slideUp(500);
                    });
                    loadRecords();
                }
        }
        });
    
    });

    $(document).on('click', '.remove_pallet', function(){
        var id = $(this).attr('remove_pallet');
        var is_purchase = $(this).attr('is_purchase');
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
                        url:"/admin/sales_pallets/spallet/"+ id,
                        method:'DELETE',
                        data: {is_purchase:is_purchase, _token: '{!! csrf_token() !!}'},
                        dataType:"json",
                        beforeSend:function(){
                            
                        },
                        success:function(data){
                            if(data.success){
                                    $('#success-order').addClass('bg-primary');
                                    $('#success-order').html('<strong>' + data.success + '</strong>');
                                    $("#success-order").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-order").slideUp(500);
                                    });
                                    pallets();
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

    $(document).on('click', '.remove_deposit', function(){
    var id = $(this).attr('remove_deposit');

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
                      url:"/admin/deposits/"+ id,
                      method:'DELETE',
                      data: {_token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        
                      },
                      success:function(data){
                          if(data.success){
                                $('#success-order').addClass('bg-primary');
                                $('#success-order').html('<strong>' + data.success + '</strong>' );
                                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                                    $("#success-order").slideUp(500);
                                });
                                deposits();
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
