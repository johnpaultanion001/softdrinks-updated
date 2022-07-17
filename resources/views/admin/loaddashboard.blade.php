<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
           
        <!-- Card stats -->
        @can('manager_dashboard_access')
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
                        @if($alltotal_sales > 0 )
                              {{ number_format($alltotal_sales ?? '' , 2, '.', ',') }}
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
                        @if($mtotal_sales > 0 ) 
                              {{ number_format($mtotal_sales ?? '' , 2, '.', ',') }}
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
        @endcan
    </div>
    </div>
</div>


<div class="container-fluid mt--6">
  <div class="row">
    
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              
                <h5 class="mb-0 text-uppercase">Sales for today</h5>
                <h3 class="mb-0"><large class="text-success font-weight-bold mr-1">₱</large> 
                @php 
                  $sales1 = $sales->sum->total + $deposits->sum->amount;
                  $total_sales = $sales1 - $returns->sum->amount - $sales_invioce_bal;

                @endphp
                {{ number_format($total_sales , 2, '.', ',') }}
                </h3>
             
            </div>
            <div class="col text-right">
              @can('transaction_access')
                <a href="/admin/transactions" class="btn btn-sm btn-primary text-uppercase">See all</a>
              @endcan
            </div>
          </div>
        </div>
        <div class="table-responsive" style="max-height: 380px">
          <table class="table align-items-center table-flush display" cellspacing="0" width="100%">
            <thead class="thead-light">
              <tr>
                <th scope="col">Product Code/Desc</th>
                <th scope="col">Customer</th>
                <th scope="col">Sold</th>
                <th scope="col">Sales</th>
                @can('manager_dashboard_access')
                  <th scope="col">Profit</th>
                @endcan

              </tr>
            </thead>
            <tbody>
              @foreach($sales as $sale)
              <tr data-entry-id="{{ $sale->id ?? '' }}">
                  <td>
                    {{  $sale->product->product_code ?? '' }}/{{  $sale->product->description ?? '' }}
                  </td>
                  <td>
                    {{  $sale->customer->customer_name ?? '' }}
                  </td>
                  <td>
                    {{  $sale->purchase_qty ?? '' }}
                  </td>
                  <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->total ?? '' , 2, '.', ',') }}
                  </td>
                  @can('manager_dashboard_access')
                  <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->profit ?? '' , 2, '.', ',') }}
                  </td>
                  @endcan
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Return Table -->
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
            
              <h5 class="mb-0 text-uppercase">Return for today</h5>
              <h3 class="mb-0"><large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($returns->sum->amount , 2, '.', ',') }}</h3>
            </div>
            <div class="col text-right">
              @can('transaction_access')
                <a href="/admin/transactions" class="btn btn-sm btn-primary text-uppercase">See all</a>
              @endcan
            </div>
          </div>
        </div>
        <div class="table-responsive" style="max-height: 380px">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" >
            <thead class="thead-light">
              <tr>
                <th scope="col">Product Code/Desc</th>
                <th scope="col">Customer</th>
                <th scope="col">Rerturn QTY</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach($returns as $return)
              <tr data-entry-id="{{ $return->id ?? '' }}">
                  <td>
                    {{  $return->product->product_code ?? '' }}/{{  $return->product->description ?? '' }}
                  </td>
                  <td>
                    {{$return->salesinvoice->customer->customer_name ?? ''}}
                  </td>
                  <td>
                    {{  $return->return_qty ?? '' }}
                  </td>
                  <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($return->amount ?? '' , 2, '.', ',') }}
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Deposit Table -->
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
            
              <h5 class="mb-0 text-uppercase">Deposit for today</h5>
              <h3 class="mb-0"><large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($deposits->sum->amount , 2, '.', ',') }}</h3>
            </div>
            <div class="col text-right">
              @can('transaction_access')
                <a href="/admin/transactions" class="btn btn-sm btn-primary text-uppercase">See all</a>
              @endcan
            </div>
          </div>
        </div>
        <div class="table-responsive" style="max-height: 380px">
          <!-- Projects table -->
          <table class="table align-items-center table-flush" >
            <thead class="thead-light">
              <tr>
                <th scope="col">Product Code/Desc</th>
                <th scope="col">Customer</th>
                <th scope="col">Deposit QTY</th>
                <th scope="col">Status</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody>
              @foreach($deposits as $deposit)
              <tr>
                  <td>
                    {{  $deposit->product->product_code ?? '' }}/{{  $deposit->product->description ?? '' }}
                  </td>
                  <td>
                    {{$deposit->salesinvoice->customer->customer_name ?? ''}}
                  </td>
                  <td>
                    {{  $deposit->qty ?? '' }}
                  </td>
                  <td>
                    {{  $deposit->status->title ?? '' }}
                  </td>
                  <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($deposit->amount ?? '' , 2, '.', ',') }}
                  </td>
              </tr>
              @endforeach
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

<script>
 

</script>