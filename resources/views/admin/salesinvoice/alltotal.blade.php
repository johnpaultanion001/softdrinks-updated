<div class="col-xl-12 pt-2 bg-default">
    <div class="row">
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="text-white text-uppercase">Sub Total:</h5>
                        <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">₱</div>
                        </div>
                        <input type="text" class="form-control" name="subtotal" id="subtotal" value="{{ number_format($orders->sum->total_amount_receipt ?? '' , 2, '.', ',') }}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <h5 class="text-white text-uppercase">Total Discount:</h5>
                        <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">₱</div>
                        </div>
                        <input type="text" name="total_discount"  id="total_discount" class="form-control" value="({{ number_format($orders->sum->discounted ?? '' , 2, '.', ',') }})" readonly/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <h5 class="text-white text-uppercase">Total Sales Amt:</h5>
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
                        <h5 class="text-white text-uppercase">Total Returns Amt:</h5>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">₱</div>
                            </div>
                            <input type="text" name="total_return" id="total_return" class="form-control" value="({{ number_format($returned->sum->amount ?? '' , 2, '.', ',') }})" readonly/>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        
<div class="col-xl-12 pt-2 bg-primary">
    <div class="row">
        <div class="col-sm-2">
                <h5 class="text-white text-uppercase">Prev Bal:</h5>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₱</div>
                    </div>
                    <input type="text" name="current_balance" id="current_balance" class="form-control" value="0.00" readonly/>
                </div>
        </div>
        <div class="col-sm-2">
                <h5 class="text-white text-uppercase">New Bal:</h5>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₱</div>
                    </div>
                    <input type="text" name="new_bal" id="new_bal" class="form-control" value="" readonly/>
                    
                    <span class="invalid-feedback text-dark" role="alert">
                        <strong id="error-new_bal"></strong>
                    </span>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="receivables" name="receivables">
                    <label class="form-check-label text-white" for="receivables">RECEIVABLE</label>
                </div>
        </div>
        
        <div class="col-sm-2">
                <h4 class="text-white text-uppercase">Cash:</h4>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₱</div>
                    </div>
                    <input type="number" step="any" name="cash" id="cash" class="form-control" />
                    <span class="invalid-feedback text-dark" role="alert">
                        <strong id="error-cash"></strong>
                    </span>
                </div>
        </div>
        <div class="col-sm-2">
            <h4 class="text-white text-uppercase">Change:</h4>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">₱</div>
                </div>
                <input type="text" name="change" id="change" class="form-control" value="" readonly/>
            </div>
        </div>
        <div class="col-sm-2">
            <h4 class="text-white text-uppercase">Payment:</h4>

            <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">₱</div>
            </div>
                <input type="text" name="payment" id="payment" class="form-control" value="{{ number_format($total_amount ?? '' , 2, '.', ',') }}" readonly/>
            </div>
        </div>
    </div>
</div>

<script>
$('#cash').on('keyup',function(){
    $('#action_salesinvoice').val('compute');
    $("#action_button").attr("disabled", false);
    $("#action_button").attr("value", "Compute");
})

$('#cash').on('change',function(){
    $('#action_salesinvoice').val('compute');
    $("#action_button").attr("disabled", false);
    $("#action_button").attr("value", "Compute");
})

</script>