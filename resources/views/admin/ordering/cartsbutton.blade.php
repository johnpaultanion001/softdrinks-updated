<button type="button" id="btn_return" name="btn_return" class="btn btn-white text-primary"> <i class="ni ni-bullet-list-67 mr-2"></i>Return</button>

<button type="button" id="checkout" name="checkout" class="btn btn-white text-primary"> <i class="ni ni-basket"></i> Orders <span class="text-nowrap text-success font-weight-bold">
    ( 
    @if($orders->count() > 0 ) 
        {{ number_format(count($orders) ?? '' , 0, ',', '.') }}
    @else
        0
    @endif
    )
    </span>
</button>