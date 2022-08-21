<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<div class="mt--6 card">
    <div class="card-header border-0">
        <div class="align-items-center">
            <div class="col-md-12">
                <small class="text-uppercase">Filter By: {{$title_filter}}</small> 
                <i id="filter_loading" class="fa fa-spinner fa-spin text-primary ml-2"></i>
            </div>
            <div class="col-md-12">
                    <button id="daily" name="daily" filter="daily" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
                    <button id="weekly" name="weekly" filter="weekly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Weekly</button>
                    <button id="monthly" name="monthly" filter="monthly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                    <button id="yearly" name="yearly" filter="yearly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                    <button id="all" name="all" filter="all" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">All</button>
                    <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
                    @can('manager_dashboard_access')
                    <button id="btn_show_profit_report" class="text-uppercase btn btn-sm btn-default mt-2">Profit Report</button>
                    @endcan
                    <button id="btn_inventory_report" class="text-uppercase btn btn-sm btn-default mt-2">Daily Inventory Report</button>
                    <button id="btn_ending_inventory_report" class="text-uppercase btn btn-sm btn-default mt-2">Ending Inventory Report</button>
            </div>
            <div class="col-md-12 mt-2">
                <div class="row">
                    <div class="col-md-3 mt-2 ">
                        <select name="filter_order#" id="filter_order#" filter="dd_orders#" class="select2 dd_filter">
                            <option value="">FILTER BY ORDER #</option>
                            @foreach($salesinvoices as $salesinvoice)
                                <option value="{{$salesinvoice->salesinvoice_id}}">{{$salesinvoice->salesinvoice_id}}/{{$salesinvoice->customer->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2 ">
                        <select name="filter_product" id="filter_product" filter="dd_products" class="select2 dd_filter">
                            <option value="">FILTER BY PRODUCT</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->description}}/{{$product->product_code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-2 ">
                        <select name="filter_deliver" id="filter_deliver" class="select2">
                            <option value="">FILTER BY ASSIGN DELIVER</option>
                            @foreach($delivers as $deliver)
                                <option value="{{$deliver->title}}">{{$deliver->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12 mt-2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-sm-12">
                        <h4 class="text-dark text-uppercase">Total Sales:</h4>
                            <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-primary">₱</div>
                            </div>

                                @php 
                                    $sales1 = $sales->sum->total + $deposits->sum->amount + $plus_over_payments;
                                    $total_sales = $sales1 - $returns->sum->amount - $sales_invioce_bal - $minus_over_payments;
                                @endphp
                                <input type="text" class="form-control" value="{{ number_format($total_sales , 2, '.', ',') }}" readonly>
                            </div>
                        </div>
                    </div>
                    @can('manager_dashboard_access')
                    <div class="col-md-4">
                        <div class="col-sm-12">
                        <h4 class="text-dark text-uppercase">Total Profit:</h4>
                            <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-primary">₱</div>
                            </div>
                                @php
                                    $profit1 = $sales->sum->profit - $sales->sum->discounted;
                                @endphp
                                <input type="text" class="form-control" value="{{ number_format($profit1 , 2, '.', ',') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-sm-12">
                        <h4 class="text-dark text-uppercase">Total Cost:</h4>
                            <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-primary">₱</div>
                            </div>
                                @php
                                    $capital = $sales->sum->total_amount_receipt - $sales->sum->profit;
                                @endphp
                                <input type="text" class="form-control" value="{{ number_format($capital , 2, '.', ',') }}" readonly>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="mb-2">
        <h5 class="mb-0 text-uppercase bg-primary text-white mb-2" style="border-radius: 5px; padding: 5px; width: 50%;">Sales Records</h5>
        <div class="table-responsive">
            <table class="table align-items-center table-bordered datatable-sales display" cellspacing="0" width="100%">
                <thead class="thead-white">
                    <tr>
                        <th scope="col">ORDER #</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Assign Deliver</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Description</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Product Size</th>
                        <th scope="col">Category</th>
                        <th scope="col">Qty Sold</th>
                        <th scope="col">Discounted</th>
                        <th scope="col">Total Sales</th>
                        @can('manager_dashboard_access')
                            <th scope="col">Total Cost</th>
                            <th scope="col">Profit</th>
                        @endcan
                        <th scope="col">Created By</th>
                        <th scope="col">Date/Time</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase font-weight-bold">
                    @foreach($sales as $sale)
                        <tr data-entry-id="{{ $sale->id ?? '' }}">
                        
                            <td>
                                {{  $sale->salesinvoice_id ?? ''}}
                            </td>
                            <td>
                                {{$sale->salesinvoice->customer->customer_name ?? ''}}
                            </td>
                            <td>
                                {{  $sale->salesinvoice->deliver->title ?? '' }}
                            </td>
                        
                            <td>
                                {{  $sale->product->product_code ?? '' }}
                            </td>
                            <td>
                                {{  $sale->product->description ?? '' }}
                            </td>
                            <td>
                                {{ number_format($sale->product_price ?? '' , 2, '.', ',') }}
                            </td>
                            <td>
                                {{  $sale->product->size->title ?? '' }} {{  $sale->product->size->size ?? '' }}
                            </td>
                            <td>
                                {{  $sale->product->category->name ?? '' }}
                            </td>
                            <td>
                                {{  $sale->purchase_qty ?? '' }}
                            </td>
                            <td>
                                ({{ number_format($sale->discounted ?? '' , 2, '.', ',') }})
                            </td> 
                            <td>
                                {{ number_format($sale->total ?? '' , 2, '.', ',') }}
                            </td>    
                            @can('manager_dashboard_access')
                                @php
                                    $capital1 = $sale->total_amount_receipt - $sale->profit;
                                    $profit = $sale->profit - $sale->discounted;
                                @endphp
                            <td>
                                {{ number_format($capital1 ?? '' , 2, '.', ',') }}
                            </td>
                            <td>
                                {{ number_format($profit ?? '' , 2, '.', ',') }}
                            </td>
                            @endcan
                            <td>
                                {{  $sale->salesinvoice->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $sale->created_at->format('M j , Y h:i A') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-white">
                    <tr>
                        <th scope="col">TOTAL:</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Unit Price</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Qty Sold</th>
                        <th scope="col">Discounted</th>
                        <th scope="col">Total Sales</th>
                        @can('manager_dashboard_access')
                            <th scope="col">Total Cost</th>
                            <th scope="col">Profit</th>
                        @endcan
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
        
        <div class="mb-2">
            <div class="col-md-4">
                <div class="col-sm-12">
                <h4 class="text-dark text-uppercase">Total Return Amount:</h4>
                    <div class="input-group ">
                    <div class="input-group-prepend">
                        <div class="input-group-text text-primary">₱</div>
                    </div>
                        <input type="text" class="form-control" value="{{ number_format($returns->sum->amount , 2, '.', ',') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <h5 class="mb-0 text-uppercase bg-primary text-white mb-2" style="border-radius: 5px; padding: 5px;  width: 50%;">Returns Records</h5>
            <div class="table-responsive">
                <table class="table align-items-center table-bordered datatable-returns display" cellspacing="0" width="100%">
                    <thead class="thead-white">
                        <tr>
                            <th scope="col">ORDER #</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Assign Deliver</th>
                            <th scope="col">Product Code</th>
                            <th scope="col">Description</th>
                            <th scope="col">Return QTY</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total Amount</th>

                            <th scope="col">Type Of Return</th>
                            <th scope="col">Status</th>
                            <th scope="col">Remarks</th>

                            <th scope="col">Created By</th>
                            <th scope="col">Date/Time</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase font-weight-bold">
                        @foreach($returns as $return)
                            <tr data-entry-id="{{ $return->id ?? '' }}">
                                <td>
                                    {{  $return->salesinvoice_id ?? '' }}
                                </td>
                                <td>
                                    {{$return->salesinvoice->customer->customer_name ?? ''}}
                                </td>
                                <td>
                                    {{  $return->salesinvoice->deliver->title ?? '' }}
                                </td>
                                <td>
                                    {{  $return->product->product_code ?? '' }}
                                </td>
                                <td>
                                    {{  $return->product->description ?? '' }} 
                                </td>
                                <td>
                                    {{  $return->return_qty ?? '' }} 
                                </td>
                                <td>
                                    {{ number_format($return->unit_price ?? '' , 2, '.', ',') }}
                                </td>
                                <td>
                                    {{ number_format($return->amount ?? '' , 2, '.', ',') }}
                                </td>
                                <td>
                                    {{  $return->type_of_return ?? '' }}
                                </td>
                                <td>
                                    @if($return->type_of_return == 'EMPTY')
                                        {{  $return->status->title ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    {{ $return->remarks ?? '' }}
                                </td>
                                <td>
                                    {{ $return->salesinvoice->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $return->created_at->format('M j , Y h:i A') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="thead-white">
                        <tr>
                            <th scope="col">TOTAL:</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Return QTY</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total Amount</th>

                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <div class="mb-2">
            <div class="col-md-4">
                <div class="col-sm-12">
                <h4 class="text-dark text-uppercase">Total Deposit Amount:</h4>
                    <div class="input-group ">
                    <div class="input-group-prepend">
                        <div class="input-group-text text-primary">₱</div>
                    </div>
                        <input type="text" class="form-control" value="{{ number_format($deposits->sum->amount , 2, '.', ',') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <h5 class="mb-0 text-uppercase bg-primary text-white mb-2" style="border-radius: 5px; padding: 5px;  width: 50%;">Deposit Records</h5>
            <div class="table-responsive">
                <table class="table align-items-center table-bordered datatable-deposits display" cellspacing="0" width="100%">
                    <thead class="thead-white">
                        <tr>
                            <th scope="col">ORDER #</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Assign Deliver</th>
                            <th scope="col">Product Code/Desc</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th> 
                            <th scope="col">Remarks</th> 
                            <th scope="col">Created By</th>
                            <th scope="col">Date/Time</th>
                        </tr>
                    </thead>
                    <tbody class="text-uppercase font-weight-bold">
                        @foreach($deposits as $deposit)
                            <tr data-entry-id="{{ $deposit->id ?? '' }}">
                                <td>
                                    {{  $deposit->salesinvoice_id ?? '' }}
                                </td>
                                <td>
                                    {{$deposit->salesinvoice->customer->customer_name ?? ''}}
                                </td>
                                <td>
                                    {{$deposit->salesinvoice->deliver->title ?? '' }}
                                </td>
                                <td>
                                 {{  $deposit->product->product_code ?? '' }}/{{  $deposit->product->description ?? '' }} 
                                </td>
                                <td>
                                    {{  $deposit->qty ?? '' }}
                                </td>
                                <td>
                                    {{  number_format($deposit->unit_price , 2, '.', ',') }}
                                </td>
                                <td>
                                    {{  number_format($deposit->amount , 2, '.', ',') }}
                                </td>
                                <td>
                                    {{ $deposit->status->title ?? '' }}
                                </td>
                                <td>
                                    {{ $deposit->remarks ?? '' }}
                                </td>
                                <td>
                                    {{ $deposit->salesinvoice->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $deposit->created_at->format('M j , Y h:i A') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="thead-white">
                        <tr>
                            <th scope="col">TOTAL:</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Qty</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Amount</th>
                            <th scope="col"></th> 
                            <th scope="col"></th> 
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

</div>


<div class="modal modal_profit_report" id="modal_profit_report" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-profit-report text-white text-uppercase font-weight-bold">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="modalbody" class="print_report">
                  <div class="col text-center" id="header_profit">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase font-wiegth-bold">Profit Report</h5>
                     <small>Filter By: {{$title_filter}} </small> 
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" id="table_profit_report" cellspacing="0" width="100%">
                      <thead class="thead-white text-uppercase font-weight-bold">
                        <tr>
                          
                          <th>Product Code</th>
                          <th>Description</th>
                          <th>QTY Sold</th>
                          <th>DISC</th>
                          <th>Profit</th>
                          <th>Total Sales</th>
                          <th>Total Cost</th>
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold">
                            @foreach($sales as $key => $sale)
                              <tr data-entry-id="{{ $sale->id ?? '' }}">
                                  <td>
                                      {{  $sale->product->product_code ?? '' }}
                                  </td>
                                  <td>
                                      {{  $sale->product->description ?? '' }}
                                  </td>
                                  <td>
                                      {{  $sale->purchase_qty ?? '' }}
                                  </td>
                                  <td>
                                      ({{ number_format($sale->discounted ?? '' , 2, '.', ',') }})
                                  </td>
                                    @php
                                        $capital11 = $sale->total_amount_receipt - $sale->profit;
                                        $profit1 = $sale->profit - $sale->discounted;
                                    @endphp
                                    <td>
                                      {{ number_format($profit1 ?? '' , 2, '.', ',') }}
                                    </td>
                                    <td>
                                      {{ number_format($sale->total ?? '' , 2, '.', ',') }}
                                    </td>    
                                    <td>
                                      {{ number_format($capital11 ?? '' , 2, '.', ',') }}
                                    </td>
                                    
                              </tr>
                          @endforeach
                                <tr>
                                    <td>
                                    
                                    </td>
                                    <td>
                                    
                                    </td>
                                    <td>
                                  
                                    </td>
                                    <td>
                                   
                                    </td>
                                    <td>
                                 
                                    </td>    
                                    <td>
                                
                                    </td>
                                    <td>
                                
                                    </td>
                                  
                                </tr>
                                <tr>
                                    <td>Total:</td>
                                    <td>
                                    
                                    </td>
                                    @php
                                        $total_capital = $sales->sum->total_amount_receipt - $sales->sum->profit;
                                        $total_profit = $sales->sum->profit - $sales->sum->discounted;
                                    @endphp
                                    <td>{{$sales->sum->purchase_qty}}</td>
                                    <td>{{$sales->sum->discounted}}</td>
                                    <td>{{ number_format($total_profit , 2, '.', ',') }} </td>
                                    <td>{{ number_format($sales->sum->total , 2, '.', ',') }}</td>
                                    <td>{{ number_format($total_capital , 2, '.', ',') }}</td>
                                    
                                    
                                </tr>
                      </tbody>
                    
                    </table>
                  </div>
                </div>
                 <!-- Modal footer -->
                <div class="bg-white m-2 text-right">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_excel_profit_report" class="text-uppercase btn btn-default">Excel Report</button>
                    <button type="button" id="btn_print_profit_report" class="text-uppercase btn btn-default">Print Report</button>
                </div>
            </div>
    
           
    
        </div>
    </div>
</div>

<div class="modal modal_inventory" id="modal_inventory" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="text-white text-uppercase font-weight-bold" id="title_inv_report">Inventory Report( {{$title_filter_daily}} )</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="modalbody" class="row">
                  <div class="col-sm-12 text-center" id="header_inventory">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase font-wiegth-bold">Inventory Report</h5>
                        <h4 id="date_inv"></h4> 
                     <br>
                  </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" >FILTER BY DATE: </label>
                            <input type="date"  id="filter_by_date_inv"  class="form-control" />
                        </div>
                    </div>
                  <div class="table-responsive">
                    <table class="table align-items-center table-bordered display" id="table_inventory_report" cellspacing="0" width="100%">
                      <thead class="thead-white text-uppercase font-weight-bold">
                        <tr>
                          
                          <th>Product Code</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Beginning Inventory</th>
                          <th>Sales Inventory</th>
                         
                          <th>Delivery for today</th>
                          <th>Ending Inventory</th>
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold" id="list_inventory_report">
                      </tbody>
                      <tfoot class="thead-white text-uppercase font-weight-bold">
                        <tr>
                          <th>TOTAL:</th>
                          <th></th>
                          <th></th>
                          <th>Beginning Inventory</th>
                          <th>Sales Inventory</th>
                          <th>Delivery for today</th>
                          <th>Ending Inventory</th>
                        </tr>
                      </tfoot>
                    </table>
                 </div>
                </div>
                <div class="bg-white m-2 text-right">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_sales_for_today" class="text-uppercase btn btn-success">Sales for today</button>
                    <button type="button" id="btn_excel_inventory_report" class="text-uppercase btn btn-default">Excel Report</button>
                    <button type="button" id="btn_print_inventory_report" class="text-uppercase btn btn-default">Print Report</button>
                </div>
            </div>

         
    
        </div>
    </div>
</div>

<div class="modal" id="modal_ending_inventory" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="text-white text-uppercase font-weight-bold" id="title_ending_inv_report">Ending Inventory Report( {{$title_filter_daily}} )</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="modalbody" class="row">
                  <div class="col-sm-12 text-center" id="header_ending_inventory">
                     <h3 class="text-uppercase">{{ trans('panel.site_title') }}</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase font-wiegth-bold">Ending Inventory Report</h5>
                     <h4 id="date_end_inv"></h4> 
                     <br>
                  </div>
                  <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" >FILTER BY DATE: </label>
                            <input type="date"  id="filter_by_date_end_inv"  class="form-control" />
                        </div>
                    </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display nowrap" id="table_ending_inventory_report" width="100%">
                      <thead class="thead-white text-uppercase font-weight-bold">
                        <tr>
                          <th>Product Code/Desc</th>
                          <th>Category</th>
                          <th>Full Goods</th>
                          <th>Full Emptys</th>
                          <th>Shell</th>
                          <th>Bottles</th>
                        </tr>
                      </thead>
                      <tbody class="text-uppercase font-weight-bold" id="list_ending_inventory_report">
                      </tbody>
                      <tfoot class="thead-white text-uppercase font-weight-bold">
                        <tr>
                          <th>TOTAL:</th>
                          <th>Stock</th>
                          <th>Full Goods</th>
                          <th>Full Emptys</th>
                          <th>Shell</th>
                          <th>Bottles</th>
                        </tr>
                      </tfoot>
                    </table>
                 </div>
                </div>
           
                <div class="bg-white m-2 text-right">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_excel_ending_inventory_report" class="text-uppercase btn btn-default">Excel Report</button>
                    <button type="button" id="btn_print_ending_inventory_report" class="text-uppercase btn btn-default">Print Report</button>
                </div>
            </div>

         
    
        </div>
    </div>
</div>

<script>
    
$(function () {
 
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
    $.extend(true, $.fn.dataTable.defaults, {
        pageLength: 100,
        responsive: true,
        scrollY: 500,
        scrollCollapse: true,
        
    });
    
    number_format = function (number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }

    var table_sales = $('.datatable-sales').DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            unit_price = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            qty_sold = api
                .column(8)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            discounted = api
                .column(9)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_sales = api
                .column(10)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_capital = api
                .column(11)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_profit = api
                .column(12)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);

            // Update footer
            $(api.column(5).footer()).html(number_format(unit_price, 2,'.', ','));
            $(api.column(8).footer()).html(number_format(qty_sold, 2,'.', ','));
            $(api.column(9).footer()).html(number_format(discounted, 2,'.', ','));
            $(api.column(10).footer()).html(number_format(total_sales, 2,'.', ','));
            $(api.column(11).footer()).html(number_format(total_capital, 2,'.', ','));
            $(api.column(12).footer()).html(number_format(total_profit, 2,'.', ','));
            
        },
    });


    var table_returns = $('.datatable-returns').DataTable({ 
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            return_qty = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            unit_price = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_amt = api
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
          

            // Update footer
            $(api.column(5).footer()).html(number_format(return_qty, 2,'.', ','));
            $(api.column(6).footer()).html(number_format(unit_price, 2,'.', ','));
            $(api.column(7).footer()).html(number_format(total_amt, 2,'.', ','));
           
            
        },
    });

    var table_deposits = $('.datatable-deposits').DataTable({ 
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[^\d.-]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
            
            qty = api
                .column(4)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            unit_price = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
            total_amt = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
            }, 0);
          

            // Update footer
            $(api.column(4).footer()).html(number_format(qty, 2,'.', ','));
            $(api.column(5).footer()).html(number_format(unit_price, 2,'.', ','));
            $(api.column(6).footer()).html(number_format(total_amt, 2,'.', ','));
           
            
        },
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $('#filter_loading').hide();
    $('.select2').select2();
    

    
    $('select[name="filter_deliver"]').on('change', function () {
        table_sales.columns(2).search( this.value ).draw();
        table_returns.columns(2).search( this.value ).draw();
        table_deposits.columns(2).search( this.value ).draw();
        
    });

    

    


});


</script>
