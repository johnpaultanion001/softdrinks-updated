<div class="col-xl-12 pt-2 bg-default">
    <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-sm-4">
                        <small class="text-white">Sub Total:</small>
                        <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">₱</div>
                        </div>
                        <input type="text" class="form-control" name="subtotal" id="subtotal" value="{{ number_format($orders->sum->total_amount_receipt ?? '' , 2, '.', ',') }}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <small class="text-white">Total Discount:</small>
                        <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">₱</div>
                        </div>
                        <input type="text" name="total_discount" id="total_discount" class="form-control" value="{{ number_format($orders->sum->discounted ?? '' , 2, '.', ',') }}" readonly/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <small class="text-white">Total Inv Amt:</small>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">₱</div>
                            </div>
                            <input type="text" name="total_inv_amt" id="total_inv_amt" class="form-control" value="{{ number_format($orders->sum->total ?? '' , 2, '.', ',') }}" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-xl-6">
            <div class="row">
                <div class="col-sm-4">
                
                </div>
                <div class="col-sm-4">
                    
                </div>
                <div class="col-sm-4">
                        <small class="text-white">Total Return:</small>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">₱</div>
                            </div>
                            <input type="text" name="total_return" id="total_return" class="form-control" value="{{ number_format($returned->sum->amount ?? '' , 2, '.', ',') }}" readonly/>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        
<div class="col-xl-12 pt-2 bg-primary">
    <div class="row">
        <div class="col-sm-2">
                <small class="text-white">Prev Bal:</small>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₱</div>
                    </div>
                    <input type="text" name="current_balance" id="current_balance" class="form-control" value="0.00" readonly/>
                </div>
        </div>
        <div class="col-sm-2">
                <small class="text-white">New Bal:</small>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₱</div>
                    </div>
                    <input type="text" name="new_bal" id="new_bal" class="form-control" value="{{ number_format($total_amount ?? '' , 2, '.', ',') }}" readonly/>

                </div>
        </div>
        
        <div class="col-sm-2">
                <small class="text-white">Cash:</small> 
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₱</div>
                    </div>
                    <input type="number" step="any" name="cash" id="cash" class="form-control" />
                    <span class="invalid-feedback text-dark" role="alert">
                        <strong id="error-cash"></strong>
                    </span>
                </div>
                <div id="sukli">
                   <span class="text-white  font-weight-bold">Change:  <span id="change" class="text-success  font-weight-bold"> 0.00</span></span>
                </div>
        </div>
        <div class="col-sm-2">
            <small class="text-white">Payment:</small>
            <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">₱</div>
            </div>
            <input type="text" name="total_amount" id="total_amount" class="form-control" value="{{ number_format($total_amount ?? '' , 2, '.', ',') }}" readonly/>
            </div>
        </div>
     

        
        <div class="col-sm-3 mt-4 mb-1">
            <div class="row p-2">
                <div class="col-sm-6">
                
                <input type="submit" name="action_button" id="action_button" class="btn btn-success form-control" value="Submit" />
                </div>
                <div class="col-sm-6">
                <input type="button" name="cancel_button" id="cancel_button" class="btn btn-danger form-control" value="Cancel"/>
                </div>
            </div>
        </div>
            
    </div>
</div>

<script>

$(function () {
    
    $('#sukli').hide();
    
});

$('#cash').on('keyup',function(){
$value=$(this).val();

    $.ajax({
        type : 'GET',
        url : '{{URL::to('/admin/salesInvoice-change')}}',
        data:{'changee':$value},
        dataType:"json",
        success:function(data){
            if(data.success){
                $('#sukli').show();
                $('#change').text(data.success);
            }
        }
    });
})
</script>