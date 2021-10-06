<hr>
<div class="row">
      
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Product Count:</label>
                        <input type="text"  class="form-control" readonly value="{{$products->count()}}"/>
                </div>
        </div>

        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Total Overall Cost:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{ number_format($products->sum('total_amount_purchase') ?? '' , 2, '.', ',') }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Total Overall Profit:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{ number_format($products->sum('total_profit') ?? '' , 2, '.', ',') }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Total Overall Sales:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{ number_format($products->sum('total_price') ?? '' , 2, '.', ',') }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Created By:</label>
                        <input type="text"  class="form-control" readonly value="{{ Auth::user()->name }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Vat Amount:</label>
                        <input type="text"  class="form-control" readonly value="₱ 0"/>
                </div>
        </div>
</div>
