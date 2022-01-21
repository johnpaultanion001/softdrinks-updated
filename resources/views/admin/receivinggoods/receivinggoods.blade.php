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
                  <div class="col text-center">
                     <h3 class="text-uppercase">Jewel & Nickel Store</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase">Account Payables</h5>
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" cellspacing="0" width="100%">
                      <thead class="thead-white">
                        <tr>
                          <th>Supplier Code</th>
                          <th>Supplier Name</th>
                          <th>Address</th>
                          <th>Current Balance</th>
                        
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
                <button type="button"  id="print_acc" class="text-uppercase btn btn-default">Print Account Payables</button>

            </div>
    
        </div>
    </div>
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

$(document).on('click', '.edit_rg', function(){
   var id = $(this).attr('edit_rg');
   window.location.href = '/admin/receiving_goods/'+id+'/edit';
});


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

$(document).on('click', '#account_payable', function(){
    $('#payableModal').modal('show');
    $('.modal-title-acc').text('Account Payables');
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


</script>
@endsection
