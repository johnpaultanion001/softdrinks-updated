<div class="row">
    @forelse($inventories as $inventory)
        <div class="col-xl-6 col-md-6">
                <div name="view" id="view" view="{{  $inventory->id ?? '' }}" class="card card-stats card-product text-left">
                <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                        <div class="col">
                            <h3 class="text-uppercase font-weight-bold text-primary mb-0">{{\Illuminate\Support\Str::limit($inventory->long_description,100)}}</h3>
                            <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($inventory->price , 2, '.', ',') }}</span> <small>/ {{$inventory->category->name}}</small>
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
                                        <span class="text-success font-weight-bold">{{$inventory->size->title}} {{$inventory->size->size}}</span>
                                    </span> 
                                </div>
                                <div class="col-6">
                                     <span class= "text-uppercase">Stock/{{$inventory->category->name}}:
                                        @if($inventory->stock < 1)
                                            <span class="text-warning text-uppercase">0</span>
                                            @else
                                           <span class="text-success font-weight-bold">{{$inventory->stock}}</span> 
                                        @endif
                                    </span>
                                </div>
                                <div class="col-6">
                                    <span class="text-uppercase">Expiration: <span class="text-success font-weight-bold"> {{$inventory->expiration}}</span> </span>
                                </div>
                                <div class="col-6">
                                    <span class="text-uppercase">Sold: <span class="text-success font-weight-bold"> {{$inventory->sold}}</span></span>
                                </div>
                                <div class="col-6">
                                    <span class="text-uppercase">Supplier: <span class="text-success font-weight-bold"> {{$inventory->purchase_order->supplier->name}}</span></span>
                                </div>
                                <div class="col-6">
                                    <span class="text-uppercase">Orders: <span class="text-success font-weight-bold"> {{$inventory->orders}}</span></span>
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
           
        </div>
    @empty
    <div class="col text-center">
      
             <h1 class="text-dark">Not Found</h1>
      
    </div>
    
    @endforelse

    


</div>





