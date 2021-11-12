<span id="form_result"></span>          
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="row">
        <div class="col">
           
            <h3 class="text-uppercase font-weight-bold text-primary mb-0">{{$order->product->description}} - {{$order->product->product_code}}</h3>
            <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($order->product->price , 2, '.', ',') }}</span> <small>/ {{$order->product->category->name}}</small>


        </div>
        <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="fas fa-wine-bottle"></i>
            </div>
        </div>
        </div>
       
        <p class="mt-3 mb-0 text-sm">
            <div class="row text-dark text-justify font-weight-light">
                <div class="col-6">
                    <span class=" text-uppercase">Size: 
                        <span class="text-success font-weight-bold">{{$order->product->size->title}} {{$order->product->size->size}}</span>
                    </span> 
                </div>
                <div class="col-6">
                        <span class= "text-uppercase">Stock/{{$order->product->category->name}}:
                        @if($order->product->stock < 1)
                            <span class="text-warning text-uppercase">0</span>
                            @else
                            <span class="text-success font-weight-bold">{{$order->product->stock}}</span> 
                        @endif
                    </span>
                </div>
                <div class="col-6">
                    <span class="text-uppercase">Expiration: <span class="text-success font-weight-bold"> {{$order->product->expiration}}</span> </span>
                </div>
                <div class="col-6">
                    <span class="text-uppercase">Sold: <span class="text-success font-weight-bold"> {{$order->product->sold}}</span></span>
                </div>
                <div class="col-12">
                    <span class="text-uppercase">Supplier: <span class="text-success font-weight-bold"> {{$order->product->receiving_good->supplier->name}}</span></span>
                </div>
                <br>
                <div class="col-6">
                    <span class="text-uppercase">Total Amount: <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($order->total , 2, '.', ',') }}</span></span>
                </div>
                <div class="col-6">
                    <span class="text-uppercase">Discounted: <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($order->discounted , 2, '.', ',') }}</span></span>
                </div>
            </div>
        </p>
    </div>
</div>
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="form-group">
            <label class="control-label text-success" >Select Price Type: </label>
            <select name="select_pricetype_edit" id="select_pricetype_edit" class="form-control select2" required>
                @foreach ($pricetypes as $pricetype)
                <option value="{{$pricetype->id}}"> {{$pricetype->price_type}} / Discount: {{$pricetype->discount}}</option>
                @endforeach
            </select>
            <input type="hidden" name="pricetype_id" id="pricetype_id" value="{{$order->pricetype_id}}" />

        </div>
        <div class="form-group">
            <label class="control-label text-success" >QTY:<span class="text-danger">*</span></label> 
            <input type="number" name="purchase_qty_edit" id="purchase_qty_edit" value="{{$order->purchase_qty}}" class="form-control"/>
            <span class="invalid-feedback" role="alert">
                <strong id="error-purchase_qty_edit"></strong>
            </span>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

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

        var pricetype = $('#pricetype_id').val();

        $("#select_pricetype_edit").select2("trigger", "select", {
            data: { id: pricetype }
        });

    });
</script>