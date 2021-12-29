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
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >ORDER #</label>
                                    <input type="text" name="id" id="id" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >DOC NO.</label>
                                    <input type="text" name="doc_no" id="doc_no" class="form-control" readonly/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Entry Date <span class="text-danger">*</span></label>
                                    <input type="date" name="entry_date" id="entry_date" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Customer Name<span class="text-danger">*</span></label>
                                    <input type="text" name="customer_name" id="customer_name" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Customer Area</label>
                                    <input type="text" name="customer_area" id="customer_area" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control" readonly></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Payment</label>
                                    <input type="text" name="payment" id="payment" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Total Sales Amt</label>
                                    <input type="text" name="tsa" id="tsa" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Sold Qty</label>
                                    <input type="text" name="sold_qty" id="sold_qty" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Discounted</label>
                                    <input type="text" name="discounted" id="discounted" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Total Return Amt</label>
                                    <input type="text" name="tra" id="tra" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Return QTY</label>
                                    <input type="text" name="return_qty" id="return_qty" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Cash <span class="text-danger">*</span></label>
                                    <input type="text" name="cash1" id="cash1" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Change</label>
                                    <input type="text" name="change1" id="change1" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Created At</label>
                                    <input type="text" name="created_date" id="created_date" class="form-control" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Created By</label>
                                    <input type="text" name="created_by" id="created_by" class="form-control" readonly/>
                                </div>
                            </div>
                           
                        
                    </div>

                    
                    
                </div>

                <div class="col-sm-12 row">
                    <div class="col-sm-6 mb-2">
                        <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Sales Records</h4>
                    </div>
                    <div class="col-sm-12" id="sales">

                    </div>

                </div>

                <div class="col-sm-12 row">
                    <div class="col-sm-6 mb-2">
                        <h4 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Returns Records</h4>
                    </div>
                    <div class="col-sm-12" id="returns">

                    </div>

                </div>

                
                <input type="hidden" name="si_hidden_id" id="si_hidden_id" />
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_si" id="action_si" class="text-uppercase btn btn-primary" value="UPDATE" />
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
    $(document).on('click', '.view', function(){
        $('#siModal').modal('show');
        $('.modal-title').text('VEIW SALES INVOICE');
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
                $('#loading-containermodal').hide();
                $('#si_content').show();
                $.each(data.result, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).val(value)
                    }
                })
                if(data.customer_name){
                    $('#customer_name').val(data.customer_name);
                }
                if(data.payment){
                    $('#payment').val(data.payment);
                }
                if(data.tsa){
                    $('#tsa').val(data.tsa);
                }
                if(data.sold_qty){
                    $('#sold_qty').val(data.sold_qty);
                }
                if(data.discounted){
                    $('#discounted').val(data.discounted);
                }
                if(data.tra){
                    $('#tra').val(data.tra);
                }
                if(data.return_qty){
                    $('#return_qty').val(data.return_qty);
                }
                if(data.cash1){
                    $('#cash1').val(data.cash1);
                }
                if(data.change1){
                    $('#change1').val(data.change1);
                }
                if(data.created_by){
                    $('#created_by').val(data.created_by);
                }
                if(data.created_date){
                    $('#created_date').val(data.created_date);
                }          
                sales();
                returns();
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
                                    $('#success-alert').addClass('bg-primary');
                                    $('#success-alert').html('<strong>' + data.success + '</strong>');
                                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-alert").slideUp(500);
                                    });
                                    sales();
                                    
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
                                    $('#success-alert').addClass('bg-primary');
                                    $('#success-alert').html('<strong>' + data.success + '</strong>');
                                    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                        $("#success-alert").slideUp(500);
                                    });
                                    returns();
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
