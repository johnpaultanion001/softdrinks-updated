<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col-md-12">
                <small class="text-uppercase">Filter By: {{$title_filter}}</small> 
                <i id="filter_loading" class="fa fa-spinner fa-spin text-primary ml-2"></i>
            </div>
            <div class="col-md-12">
                    <button id="daily" name="daily" filter="daily" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
                    <button id="monthly" name="monthly" filter="monthly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                    <button id="yearly" name="yearly" filter="yearly" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                    <button id="all" name="all" filter="all" class="filter text-uppercase btn btn-sm btn-primary mt-2 ">All</button>
                    <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
                    <button id="btn_show_profit_report" class="text-uppercase btn btn-sm btn-default mt-2">Profit Report</button>
            </div>
            <div class="col-md-12 mt-2">
                <div class="row">
                    <div class="col-md-3">
                        <select name="filter_order#" id="filter_order#" filter="dd_orders#" class="select2 dd_filter">
                            <option value="">FILTER BY ORDER #</option>
                            @foreach($salesinvoices as $salesinvoice)
                                <option value="{{$salesinvoice->salesinvoice_id}}">{{$salesinvoice->salesinvoice_id}}/{{$salesinvoice->customer->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="filter_product" id="filter_product" filter="dd_products" class="select2 dd_filter">
                            <option value="">FILTER BY PRODUCT</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->description}}/{{$product->product_code}}</option>
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
                                <input type="text" class="form-control" value="{{ number_format($sales->sum->total , 2, '.', ',') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-sm-12">
                        <h4 class="text-dark text-uppercase">Total Profit:</h4>
                            <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text text-primary">₱</div>
                            </div>
                                <input type="text" class="form-control" value="{{ number_format($sales->sum->profit , 2, '.', ',') }}" readonly>
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
                                <input type="text" class="form-control" value="{{ number_format($sales->sum->total_cost , 2, '.', ',') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="col-sm-6 mb-2">
            <h5 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Sales Records</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush datatable-sales display" cellspacing="0" width="100%">
                <thead class="thead-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ORDER #/Customer</th>
                        <th scope="col">Product ID</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Description</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Product Size</th>
                        <th scope="col">Category</th>
                        <th scope="col">Qty Sold</th>
                        <th scope="col">Discounted</th>
                        <th scope="col">Total Sales</th>
                        <th scope="col">Total Cost</th>
                        <th scope="col">Profit</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase font-weight-bold">
                    @foreach($sales as $sale)
                        <tr data-entry-id="{{ $sale->id ?? '' }}">
                            <td>
                                {{  $sale->id ?? '' }}
                            </td>
                            <td>
                                {{  $sale->salesinvoice_id ?? ''}}<large class="text-success font-weight-bold">/</large>{{$sale->salesinvoice->customer->customer_name ?? ''}}
                            </td>
                            <td>
                                {{  $sale->product->id ?? '' }}
                            </td>
                            <td>
                                {{  $sale->product->product_code ?? '' }}
                            </td>
                            <td>
                                {{  $sale->product->description ?? '' }}
                            </td>
                            <td>
                                <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->product_price ?? '' , 2, ',', ',') }}
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
                                <large class="text-success font-weight-bold mr-1">₱</large> ({{ number_format($sale->discounted ?? '' , 2, '.', ',') }})
                            </td> 

                            <td>
                                <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->total ?? '' , 2, '.', ',') }}
                            </td>    
                            <td>
                                <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->total_cost ?? '' , 2, '.', ',') }}
                            </td>
                            <td>
                                <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->profit ?? '' , 2, '.', ',') }}
                            </td>
                            <td>
                                {{  $sale->salesinvoice->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $sale->created_at->format('F d,Y h:i A') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="col-sm-6 mb-2">
            <h5 class="mb-0 text-uppercase bg-primary text-white" style="border-radius: 5px; padding: 5px;">Returns Records</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush datatable-sales display" cellspacing="0" width="100%">
                <thead class="thead-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ORDER #/Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Return QTY</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Discounted</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase font-weight-bold">
                    @foreach($returns as $return)
                        <tr data-entry-id="{{ $return->id ?? '' }}">
                            <td>
                                {{  $return->id ?? '' }}
                            </td>
                            <td>
                                {{  $return->salesinvoice_id ?? '' }}<large class="text-success font-weight-bold">/</large>{{$return->salesinvoice->customer->customer_name ?? ''}}
                            </td>
                            <td>
                                {{  $return->product->product_code ?? '' }}
                            </td>
                            <td>
                                {{  $return->return_qty ?? '' }} 
                            </td>
                            <td>
                                <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($return->unit_price ?? '' , 2, '.', ',') }}
                            </td>
                            <td>
                                <large class="text-success font-weight-bold mr-1">₱</large> ({{ number_format($return->discounted ?? '' , 2, '.', ',') }})
                            </td>
                            <td>
                                <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($return->amount ?? '' , 2, '.', ',') }}
                            </td>
                            <td>
                                {{ $return->salesinvoice->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $return->created_at->format('F d,Y h:i A') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
              
                <div id="modalbody" class="row print_report">
                  <div class="col text-center">
                     <h3 class="text-uppercase">Jewel & Nickel Store</h3>
                     <p>Binangonan, <br> Rizal <br> 652-48-36</p>
                     <h5 class="text-uppercase font-wiegth-bold">Profit Report</h5>
                     <small>Filter By: {{$title_filter}} </small> 
                     <br>
                  </div>
                  <div class="table-responsive">
          
                    <table class="table align-items-center table-bordered display" cellspacing="0" width="100%">
                      <thead class="thead-white text-uppercase font-weight-bold">
                        <tr>
                          
                          <th>Product Code</th>
                          <th>Description</th>
                          <th>Quantity Sold</th>
                          <th>Total Sales</th>
                          <th>Total Cost</th>
                          <th>Profit</th>
                        
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
                                        ₱ {{ number_format($sale->total ?? '' , 2, '.', ',') }}
                                    </td>    
                                    <td>
                                        ₱ {{ number_format($sale->total_cost ?? '' , 2, '.', ',') }}
                                    </td>
                                    <td>
                                        ₱ {{ number_format($sale->profit ?? '' , 2, '.', ',') }}
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
                                </tr>
                      </tbody>
                      <tfoot class="text-uppercase font-weight-bold">
                                    <tr>
                                    <td>Total:</td>
                                    <td></td>
                                    <td>{{$sales->sum->purchase_qty}}</td>
                                   
                                    
                                    <td>₱ {{ number_format($sales->sum->total , 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($sales->sum->total_cost , 2, '.', ',') }}</td>
                                    <td>₱ {{ number_format($sales->sum->profit , 2, '.', ',') }} </td>
                                    
                                    </tr>
                                </tfoot>
                    </table>
                 </div>
                </div>
                
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                <button type="button" name="btn_print_profit_report" id="btn_print_profit_report" class="text-uppercase btn_print_profit_report btn btn-default">Print Profit Report</button>

            </div>
    
        </div>
    </div>
</div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
  });

  $('.datatable-sales:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    $('#filter_loading').hide();
    $('.select2').select2();
    
});
</script>
