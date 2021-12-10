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
                        <label class="control-label text-uppercase" >Overall Product Cost:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{ number_format($products->sum('total_cost') ?? '' , 2, '.', ',') }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Return Count:</label>
                        <input type="text"  class="form-control" readonly value="{{$returns->count()}}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Overall Return Amount:</label>
                        <input type="text"  class="form-control" readonly value="( ₱ {{ number_format($returns->sum('amount') ?? '' , 2, '.', ',') }} )"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Payment:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{ number_format($payment ?? '' , 2, '.', ',') }}"/>
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
