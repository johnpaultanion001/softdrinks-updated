
<div class="col-md-12">
    <div class="row">
        <div class="col-md-4 bg-primary mt-2 mr-1" style="border-radius: 5px;">
            
            <div id="receiptreport" class="d-print-inline-flex receiptreport p4 bg-white mt-2" style="border-radius: 5px;">
                     
                        <div class="col">
                            <h4 class="text-center card-title text-uppercase text-dark mb-0">Jewel & Nickel <br> Store </h4>
                            <h5 class="text-center card-title text-muted mb-0">J.P Extension Libis Binangonan , Rizal <br>
                            Fernando L. Arada - Prop. <br>
                            Tel. No. 986-2433 Cel No. 0923-6738-296 </h5>
                            <br>
                            <div class="col text-right"><h6 class="card-title text-uppercase text-muted mb-0">Date: {{$date}} </h6></div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <small class="text-muted mt-3 ml-1">Sold To:</small>
                                    <div class="col-sm-8">
                                        <small id="customer_name"></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <small class="text-muted mt-3 ml-1">Address:</small>
                                    <div class="col-sm-8">
                                           <small id="area"></small>
                                           <small id="current_balance"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="receipt-body mt--3 p-2" id="receipt-body">
                            <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Articles</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @forelse($receipts as $key => $receipt)
                                                <tr>
                                                    <td>{{$receipt->purchase_qty}}</td>
                                                    <td>{{$receipt->inventory->category->name}}</td>
                                                    <td>{{$receipt->inventory->short_description}}</td>
                                                    <td>₱ {{ number_format($receipt->inventory->price ?? '' , 2, '.', ',') }}</td>
                                                    <td>₱ {{ number_format($receipt->total_amount_receipt ?? '' , 2, '.', ',') }}</td>
                                                    
                                                </tr>
                                            @empty
                                            <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>No Data Available</td>
                                                    <td></td>
                                                    <td></td>
                                            </tr>
                                            @endforelse
                                            <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Sub Total:</td>
                                                <td>₱ {{ number_format($orders->sum->total_amount_receipt ?? '' , 2, '.', ',') }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Discounted:</td>
                                                <td>₱ {{ number_format($orders->sum->discounted ?? '' , 2, '.', ',') }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Total:</td>
                                                <td>  ₱ <span id="rtotal">{{ number_format($orders->sum->total ?? '' , 2, '.', ',') }}</span></td>
                                            </tr>
                                        </tfoot>
                            </table>
                        </div>
                        <div class="col">
                            <div class="row mt-2 p-2">
                                <div class="col-4">
                                    <h3 class="text-center card-title text-uppercase text-danger mb-0">{{$orderid}}</h3>
                                </div>
                                <div class="col-8">
                                    <small>Recieved the above goods in good order and condition</small>      
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row mt-2 p-2 ">
                                <div class="col-6">
                                    <small>Dealer Of:</small>     
                                </div>
                                <div class="col-6">
                                    <small>By:___________________</small>      
                                </div>
                                <div class="col-12">
                                 <small>Coke Products/San Miguel Beer Products And Rice</small>     
                                </div>
                            </div>
                        </div>

                      
                      
                   
            </div>
            <div class="p-4 bg-white mt-2" style="border-radius: 20px;">
                <div class="row">
                    <div class="col-6">
                        <p class="font-weight-bold text-uppercase">SubTotal: </p>
                    </div>
                    <div class="col-6">
                    <large class="text-success font-weight-bold mr-1">₱</large><span id="subtotal" class="h2 font-weight-bold mb-0">{{ number_format($orders->sum->total_amount_receipt ?? '' , 2, '.', ',') }}</span>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold text-uppercase">Discount: </p>
                    </div>
                    <div class="col-6">
                    <large class="text-success font-weight-bold mr-1">₱</large><span id="discount" class="h2 font-weight-bold mb-0">{{ number_format($orders->sum->discounted ?? '' , 2, '.', ',') }}</span>
                    </div>
                    <div class="col-6">
                        <p class="font-weight-bold text-uppercase">Total: </p>
                    </div>
                    <div class="col-6">
                    <large class="text-success font-weight-bold mr-1">₱</large><span id="total" class="h2 font-weight-bold mb-0">{{ number_format($orders->sum->total ?? '' , 2, '.', ',') }}</span>
                    </div>
                </div>
            </div>
            <div class="col mb-2 mt-2">      
                   
                <div class="form-group">
                    <small class="text-white">Select A Customer</small>
                    <select name="select_customer" id="select_customer" class="form-control select2" required>
                        <option value="" disabled selected>Filter By Customer</option>
                        @foreach ($customers as $customer)
                        <option value="{{$customer->id}}"> {{$customer->customer_code}} / {{$customer->customer_name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="print" name="print" class="text-uppercase print btn text-white btn-default">Print Reciept</button>
                <input type="submit" name="checkoutaction_button" id="checkoutaction_button" class="text-uppercase btn btn-white" value="Check Out"/>
               
            </div>
           
          
       </div>
       
       <div class="col-md-7 mx-auto mt-2 overflow-auto bg-default" style="max-height: 1100px; border-radius: 5px;">
               
                @forelse($orders as $order)
                    <div class="card col-12 mt-2" style="border-bottom: 1px solid #111">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{$order->inventory->long_description}} </h5>
                                    <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($order->total ?? '' , 2, '.', ',') }} </span>
                                </div>
                                <div class="col-auto">
                                
                                        <button type="button" id="edit" name="edit" edit="{{  $order->id ?? '' }}" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i></button>
                                        <button type="button"  id="delete"  name="delete" delete="{{  $order->id ?? '' }}" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                
                                
                                </div> 
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap font-weight-bold ">Size: <span class="text-success mr-2 font-weight-bold" >{{$order->inventory->size->title}} {{$order->inventory->size->size}}</span></span>
                                <span class="text-nowrap font-weight-bold ">Price: <span class="text-success mr-2 font-weight-bold" >₱ {{ number_format($order->inventory->price ?? '' , 2, '.', ',') }}</span></span>
                                
                                <span class="text-nowrap font-weight-bold ">QTY: <span class="text-success mr-2 font-weight-bold" >{{$order->purchase_qty}}</span></span>
                                <span class="text-nowrap font-weight-bold ">Price Type / Discount: <span class="text-success mr-2 font-weight-bold" >{{$order->pricetype->id}} / ₱ {{ number_format($order->pricetype->discount ?? '' , 2, '.', ',') }}</span></span>
                                <span class="text-nowrap font-weight-bold ">Date: <span class="text-success mr-2 font-weight-bold" > {{ $order->created_at->format('F d,Y h:i A') }}</span></span>
                            </p>
                        
                        </div>
                    </div>  
                @empty
                   <input type="text" name="nodata" id="nodata" value="No Data" readonly  class="nodata bg-default text-white form-control border-0"/>        
                @endforelse

        </div>

    </div>

</div>


<script>
$(document).ready(function () {

  $('#current_balance').hide();
  $('.select2').select2()

  $('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
      if ($(this).hasClass('active')) {
        shouldExpand = true
      }
    })
    if (shouldExpand) {
      $(this).addClass('active')
    }
  })

})


//select customer
$('select[name="select_customer"]').on("change", function(event){
  var customer = $('#select_customer').val();
  if(customer != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"ordering/" +customer+ "/customer",
          method:"GET",
          dataType:"json",
          success:function(data){
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).text(value)
                }
            })
            var cb = $('#current_balance').text();
            if(cb > 1){
               
                $('#success-alert').addClass('bg-warning');
                $('#success-alert').html('<strong> This customer have a current balance: ₱' + cb + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
            }
            
          }
         });
        }
});


</script>
