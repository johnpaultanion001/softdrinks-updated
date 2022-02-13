<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
           
        <!-- Card stats -->
        <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-dashboard card-stats">
            <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Products</h5>
                        <span class="h2 font-weight-bold mb-0">
                           @if($allproducts->count() > 0 ) 
                                {{ number_format(count($allproducts) ?? '' , 0, ',', '.') }}
                           @else
                               0
                           @endif
                        </span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-basket"></i>
                        </div>
                    </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                       @if($productsmonthly->count() > 0 ) 
                            {{ number_format(count($productsmonthly) ?? '' , 0, ',', '.') }}
                        @else
                          0.00
                        @endif
                     </span>
                    <span class="text-nowrap">Since this month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Out of stock</h5>
                    <span class="h2 font-weight-bold mb-0">
                      @if($outofstock->count() > 0 ) 
                            {{ number_format(count($outofstock) ?? '' , 0, ',', '.') }}
                      @else
                            0.00
                      @endif  
                    </span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                       <h2 class="text-white font-weight-bold mt-2">0</h2>
                    </div>
                </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                     @if($outofstockmonthly->count() > 0 ) 
                            {{ number_format(count($outofstockmonthly) ?? '' , 0, ',', '.') }}
                     @else
                            0.00
                      @endif  
                </span>
                <span class="text-nowrap">Since this month</span>
                </p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                    <span class="h2 font-weight-bold mb-0">
                      @if($allprofit->sum->total > 0 )
                            {{ number_format($allprofit->sum->total ?? '' , 0, ',', '.') }}
                      @else
                            0.00
                      @endif  
                    </span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                    <i class="ni ni-money-coins"></i>
                    </div>
                </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                      @if($salesmonthly->sum->total > 0 ) 
                            {{ number_format($salesmonthly->sum->total ?? '' , 0, ',', '.') }}
                      @else
                            0.00
                      @endif
                </span>
                <span class="text-nowrap">Since this month</span>
                </p>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Profit</h5>
                    <span class="h2 font-weight-bold mb-0">
                      @if($allprofit->sum->profit > 0 ) 
                            {{ number_format($allprofit->sum->profit ?? '' , 0, ',', '.') }}
                      @else
                            0.00
                      @endif
                    </span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                      <h2 class="text-white font-weight-bold mt-2">₱</h2>
                    </div>
                </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                      @if($profitmonthly->sum->profit > 0 ) 
                            {{ number_format($profitmonthly->sum->profit ?? '' , 0, ',', '.') }}
                      @else
                            0.00
                      @endif</span>
                <span class="text-nowrap">Since this month</span>
                </p>
            </div>
            </div>
        </div>
        
       
        </div>
    </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-uppercase">Newly Products</h3>
                </div>
                <div class="col text-right">
                  <a href="/admin/inventories" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Product name</th>
                    <th scope="col">Product stock</th>
                    <th scope="col">Product price</th>
                    <th scope="col">Sold</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($newproduct as $key => $product)
                <tr data-entry-id="{{ $order->id ?? '' }}">
                    <td>
                        {{  $product->name ?? '' }}
                    </td>
                    <td>
                       {{  $product->stock ?? '' }}
                    </td>
                    <td>
                       <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($product->price ?? '' , 0, ',', '.') }}
                    </td>
                   <td>
                        {{  $product->sales ?? '' }}
                    </td>
                </tr>
                @empty
                    <td>
                        No Data
                    </td>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="mb-0 text-uppercase">Sales for today</h5>
                  <h3 class="mb-0"><large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($salestoday->sum->total , 0, ',', '.') }}</h3>

                </div>
                <div class="col text-right">
                  <a href="/admin/sales" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive" style="max-height: 280px">
              <!-- Projects table -->
              <table class="table align-items-center table-flush" >
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Sold</th>
                    <th scope="col">Sales</th>
                    <th scope="col">Profit</th>
                    <th scope="col">User</th>

                  </tr>
                </thead>
                <tbody>
                <tbody>
                @forelse($salestoday as $key => $sales)
                <tr data-entry-id="{{ $sales->id ?? '' }}">
                    <td>
                        {{  $sales->inventory->name ?? '' }}
                    </td>
                    <td>
                       {{  $sales->purchase_qty ?? '' }}
                    </td>
                    <td>
                       <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->total ?? '' , 0, ',', '.') }}
                    </td>
                    <td>
                       <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->profit ?? '' , 0, ',', '.') }}
                    </td>
                    <td>
                       {{  $sales->user->name ?? '' }}
                    </td>
                </tr>
                @empty
                    <td>
                        No Data
                    </td>
                @endforelse
                </tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Footer -->
        @section('footer')
            @include('../partials.footer')
        @endsection
      </div>
    </div>