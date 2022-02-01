<div class="col-xl-12 pt-2 bg-default">
        <div class="row">
                <div class="col-xl-12">
                        <div class="row">
                                <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">Overall Product Cost:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="text"  class="form-control" style="font-weight: bold;" readonly value="{{ number_format($products->sum('total_cost') ?? '' , 2, '.', ',') }}"/>

                                        </div>
                                </div>
                                <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">Overall Return Amount:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="text"  class="form-control" style="font-weight: bold;" readonly value="( {{ number_format($returns->sum('amount') ?? '' , 2, '.', ',') }} )"/>
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                        <h4 class="text-white text-uppercase">PAYMENT:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="text"  class="form-control" name="payment" id="payment" style="font-weight: bold;" readonly value="{{ number_format($payment ?? '' , 2, '.', ',') }}"/>
                                                
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">OVERALL PRODUCT QTY:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">QTY</div>
                                                </div>
                                                <input type="text"  class="form-control" style="font-weight: bold;" readonly value="{{$products->sum('qty')}}"/>
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">OVERALL RETURN QTY:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">QTY</div>
                                                </div>
                                                <input type="text"  class="form-control" style="font-weight: bold;" readonly value="{{$returns->sum('return_qty')}}"/>
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                        <h5 class="text-white text-uppercase">VAT AMOUNT:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="text"  class="form-control" style="font-weight: bold;" readonly value="0"/>
                                                
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
<div class="col-xl-12 pt-2 bg-primary">
        <div class="row">
                <div class="col-xl-12">
                        <div class="row">
                                <div class="col-sm-3">
                                        <h4 class="text-white text-uppercase">PREV BAL:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="text"  class="form-control" name="prev_bal" id="prev_bal" style="font-weight: bold;" readonly value="0.00"/>
 
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <h4 class="text-white text-uppercase">NEW BAL:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="text"  class="form-control" name="new_bal" id="new_bal" style="font-weight: bold;" readonly value="0.00"/>
                                                <span class="invalid-feedback text-dark" role="alert">
                                                        <strong id="error-new_bal"></strong>
                                                </span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="payables" name="payables">
                                                <label class="form-check-label text-white" for="payables">PAYABLE</label>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <h4 class="text-white text-uppercase">CASH:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="number"  class="form-control" name="cash1" id="cash1" style="font-weight: bold;" step="any" value=""/>
                                                <span class="invalid-feedback text-dark" role="alert">
                                                        <strong id="error-cash1"></strong>
                                                </span>
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                        <h4 class="text-white text-uppercase">CHANGE:</h2>
                                        <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                        <div class="input-group-text">₱</div>
                                                </div>
                                                <input type="text"  class="form-control" name="change" id="change" style="font-weight: bold;" readonly value="0.00"/>
                                        </div>
                                </div>
                                
                        </div>
                </div>
        </div>
</div>

<script>
$('#cash1').on('keyup',function(){
    $('#purchase_action').val('Compute');
    $("#purchase_button").attr("disabled", false);
    $("#purchase_button").attr("value", "Compute");
})

$('#cash1').on('change',function(){
    $('#purchase_action').val('Compute');
    $("#purchase_button").attr("disabled", false);
    $("#purchase_button").attr("value", "Compute");
})
</script>