<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
        <div class="col-md-12">
        <small class="mb-0 text-uppercase font-weight-bold modal-title" id="title-sales"> </small> <small>Filter By: {{$title_filter}} </small> 
        <i class="fa fa-spinner fa-spin text-primary button-loading ml-2"></i>
            
        </div>
        
            <div class="col-12">
                <div class="row">
                    <div class="col-md-9">
                        <div class="col-12">
                            <div class="row">
                                
                                    <button id="daily" name="daily" class="text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
                                    <button id="monthly" name="monthly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                                    <button id="yearly" name="yearly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                                    <button id="all" name="all" class="text-uppercase btn btn-sm btn-primary mt-2 ">All</button>
                                    <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
                                    <button id="btn_show_profit_report" class="text-uppercase btn btn-sm btn-default mt-2">Profit Report</button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                    
                    <span class="mb-0 font-weight-bold">Total Sales: <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->sum->total , 2, '.', ',') }} </span>
                    <br>
                    <span class="mb-0 font-weight-bold">Total Profit: <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->sum->profit , 2, '.', ',') }} </span>
                    <br>
                    <span class="mb-0 font-weight-bold">Total Cost: <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->sum->total_cost , 2, '.', ',') }} </span>
                    </div>
                </div>
            </div>
         
        </div>
    </div>
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-sales display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
          
            <th scope="col">Order Number</th>
            <th scope="col">Product Code</th>
            <th scope="col">Description</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Size</th>
            <th scope="col">Category</th>
            <th scope="col">Quantity Sold</th>
            <th scope="col">Sold To</th>
            <th scope="col">Discounted</th>
            <th scope="col">Total Sales</th>
            <th scope="col">Total Cost</th>
            <th scope="col">Profit</th>
            <th scope="col">Created By</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
            @foreach($sales as $key => $sale)
                <tr data-entry-id="{{ $sale->id ?? '' }}">
                    <td>
                        {{  $sale->order_number ?? '' }}
                    </td>
                    <td>
                        {{  $sale->inventory->product_code ?? '' }}
                    </td>
                    <td>
                        {{  $sale->inventory->long_description ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->inventory->price ?? '' , 2, ',', ',') }}
                    </td>
                    <td>
                        {{  $sale->inventory->size->title ?? '' }} {{  $sale->inventory->size->size ?? '' }}
                    </td>
                    <td>
                        {{  $sale->inventory->category->name ?? '' }}
                    </td>
                    <td>
                        {{  $sale->purchase_qty ?? '' }}
                    </td>
                    <td>
                        {{  $sale->ordersales->customer->customer_name ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->discounted ?? '' , 2, '.', ',') }}
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
                        {{  $sale->user->name ?? '' }}
                    </td>
                    <td>
                        {{ $sale->created_at->format('F d,Y h:i A') }}
                        
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
                                      {{  $sale->inventory->product_code ?? '' }}
                                  </td>
                                  <td>
                                      {{  $sale->inventory->long_description ?? '' }}
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

    
});
</script>
