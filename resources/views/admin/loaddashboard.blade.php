<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
           
        <!-- Card stats -->
        <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card card-dashboard card-stats">
            <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Products</h5>
                        <span class="h2 font-weight-bold mb-0">
                           @if($allproducts->count() > 0 ) 
                                {{ count($allproducts) ?? '' }}
                               
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
                            {{ number_format(count($productsmonthly) ?? '' , 2, '.', ',') }}
                        @else
                          0.00
                        @endif
                     </span>
                    <span class="text-nowrap">Since this month</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                    <span class="h2 font-weight-bold mb-0">
                      @if($allprofit->sum->total > 0 )
                            {{ number_format($allprofit->sum->total ?? '' , 2, '.', ',') }}
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
                            {{ number_format($salesmonthly->sum->total ?? '' , 2, '.', ',') }}
                      @else
                            0.00
                      @endif
                </span>
                <span class="text-nowrap">Since this month</span>
                </p>
            </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Profit</h5>
                    <span class="h2 font-weight-bold mb-0">
                      @if($allprofit->sum->profit > 0 ) 
                            {{ number_format($allprofit->sum->profit ?? '' , 2, '.', ',') }}
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
                            {{ number_format($profitmonthly->sum->profit ?? '' , 2, '.', ',') }}
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
                  <h5 class="mb-0 text-uppercase">Sales for today</h5>
                  <h3 class="mb-0"><large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($salestoday->sum->total , 2, '.', ',') }}</h3>

                </div>
                <div class="col text-right">
                  <a href="/admin/transactions" class="btn btn-sm btn-primary text-uppercase">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive" style="max-height: 280px">
              <!-- Projects table -->
              <table class="table align-items-center table-flush" >
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Sold To</th>
                    <th scope="col">Sold</th>
                    <th scope="col">Sales</th>
                    <th scope="col">Profit</th>
                   

                  </tr>
                </thead>
                <tbody>
                <tbody>
                @forelse($salestoday as $key => $sales)
                <tr data-entry-id="{{ $sales->id ?? '' }}">
                    <td>
                        {{  $sales->product->description ?? '' }}
                    </td>
                    <td>
                      {{  $sales->customer->customer_name ?? '' }}
                    </td>
                    <td>
                       {{  $sales->purchase_qty ?? '' }}
                    </td>
                    <td>
                       <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->total ?? '' , 2, '.', ',') }}
                    </td>
                    <td>
                       <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->profit ?? '' , 2, '.', ',') }}
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
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-uppercase">Newly Products</h3>
                </div>
                <div class="col text-right">
                  <a href="/admin/sales_inventory" class="btn btn-sm btn-primary text-uppercase">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Description</th>
                    <th scope="col">Selling Area Stock</th>
                    <th scope="col">Product price</th>
                    <th scope="col">Sold</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($newproduct as $key => $product)
                <tr data-entry-id="{{ $order->id ?? '' }}">
                    <td>
                        {{  $product->description ?? '' }}
                    </td>
                    <td>
                       {{  $product->location_products_stock() ?? '' }}
                    </td>
                    <td>
                       <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($product->price ?? '' , 2, '.', ',') }}
                    </td>
                   <td>
                        {{  $product->sold ?? '' }}
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
        <!-- Footer -->
        @section('footer')
            @include('../partials.footer')
        @endsection
      </div>
    </div>