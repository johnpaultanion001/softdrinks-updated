

<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0 text-uppercase" id="titletable">Products</h3>
          </div>
        
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-inventries display" cellspacing="0" width="100%">
          <thead class="thead-white">
            <tr>
              <th scope="col">Actions</th>
              <th scope="col">Receiving Goods ID</th>
              <th scope="col">Product ID</th>
              <th scope="col">Product Code</th>
              <th scope="col">Long Description</th>
              <th scope="col">Short Description</th>

              <th scope="col">Size</th>
              <th scope="col">Category</th>
              <th scope="col">Expiration</th>

              <th scope="col">QTY</th>

              <th scope="col">Unit Cost</th>
              <th scope="col">Unit Profit</th>
              <th scope="col">Unit Sales</th>
              <th scope="col">Total Cost</th>
              <th scope="col">Total Profit</th>
              <th scope="col">Total Sales</th>
              <th scope="col">Remarks</th>
              <th scope="col">User</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody class="text-uppercase font-weight-bold">
            @foreach($products as $key => $order)
                  <tr data-entry-id="{{ $order->id ?? '' }}">
                    
                    <td>
                        <button type="button" name="edit" edit="{{  $order->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                        <button type="button" name="remove" remove="{{  $order->id ?? '' }}" id="{{  $order->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                    </td>
                    <td>
                      {{  $order->purchase_order_number_id ?? '' }}
                    </td>
                    <td>
                        {{  $order->product_id ?? '' }}
                    </td>
                    <td>
                        {{  $order->product_code ?? '' }}
                    </td>
                    <td>
                        {{  $order->long_description ?? '' }}
                    </td>
                    <td>
                        {{  $order->short_description ?? '' }}
                    </td>
                    <td>
                        {{  $order->size->title ?? '' }} {{  $order->size->size ?? '' }}
                    </td>
                    <td>
                        {{  $order->category->name ?? '' }}
                    </td>

                    <td>
                        {{  $order->expiration ?? '' }}
                    </td>
                    <td>
                        {{  $order->qty ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->purchase_amount , 2, '.', ',') }}
          
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->profit , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($order->price , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($order->total_amount_purchase , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->total_profit , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->total_price , 2, '.', ',') }}

                    </td>
                    <td>
                        {{  $order->product_remarks ?? '' }}
                    </td>
                    <td>
                        {{  $order->purchase_order->user->name ?? '' }}
                    </td>
                    <td>
                        {{ $order->created_at->format('l, j \\/ F / Y h:i:s A') }}
                    </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  

</div>

<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Updated Products</h3>
            </div>
          
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries display" cellspacing="0" width="100%">
          <thead class="thead-white">
            <tr>
              <th scope="col">Actions</th>
              <th scope="col">Receiving Goods ID</th>
              <th scope="col">Product ID</th>
              <th scope="col">Product Code</th>
              <th scope="col">Long Description</th>
              <th scope="col">Short Description</th>

              <th scope="col">Size</th>
              <th scope="col">Category</th>
              <th scope="col">Expiration</th>

              <th scope="col">Added QTY</th>

              <th scope="col">Unit Cost</th>
              <th scope="col">Unit Profit</th>
              <th scope="col">Unit Sales</th>
              <th scope="col">Total Cost</th>
              <th scope="col">Total Profit</th>
              <th scope="col">Total Sales</th>
              <th scope="col">Remarks</th>
              <th scope="col">User</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody class="text-uppercase font-weight-bold">
            @foreach($updatedproduct as $key => $order)
                  <tr data-entry-id="{{ $order->id ?? '' }}">
                    
                    <td>
                        <button type="button" name="edit" edit="{{  $order->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                        <button type="button" name="remove" remove="{{  $order->id ?? '' }}" id="{{  $order->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                    </td>
                    <td>
                      {{  $order->purchase_order_number_id ?? '' }}
                    </td>
                    <td>
                        {{  $order->product_id ?? '' }}
                    </td>
                    <td>
                        {{  $order->product_code ?? '' }}
                    </td>
                    <td>
                        {{  $order->long_description ?? '' }}
                    </td>
                    <td>
                        {{  $order->short_description ?? '' }}
                    </td>
                    <td>
                        {{  $order->size->title ?? '' }} {{  $order->size->size ?? '' }}
                    </td>
                    <td>
                        {{  $order->category->name ?? '' }}
                    </td>

                    <td>
                        {{  $order->expiration ?? '' }}
                    </td>
                    <td>
                        {{  $order->qty ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->purchase_amount , 2, '.', ',') }}
          
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->profit , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($order->price , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($order->total_amount_purchase , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->total_profit , 2, '.', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->total_price , 2, '.', ',') }}

                    </td>
                    <td>
                        {{  $order->product_remarks ?? '' }}
                    </td>
                    <td>
                        {{  $order->purchase_order->user->name ?? '' }}
                    </td>
                    <td>
                        {{ $order->created_at->format('l, j \\/ F / Y h:i:s A') }}
                    </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Returned Products</h3>
            </div>
            <div class="col text-right">
                <button type="button" name="create_return" id="create_return" class="text-uppercase btn btn-sm btn-primary">New Return</button>
            </div>
          
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries display" cellspacing="0" width="100%">
          <thead class="thead-white">
            <tr>
              <th scope="col">Actions</th>
              <th scope="col">ID</th>
              <th scope="col">Receiving Goods ID</th>
              <th scope="col">Product Code</th>
              <th scope="col">Returned Qty</th>
              <th scope="col">Unit Price</th>
              <th scope="col">Amount</th>
              <th scope="col">Status</th>

              <th scope="col">Remarks</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody class="text-uppercase font-weight-bold">
            @foreach($returnproduct as $key => $product)
            <tr data-entry-id="{{ $product->id ?? '' }}">
                <td>
                    <button type="button" name="editreturn" editreturn="{{  $product->id ?? '' }}"  class="editreturn text-uppercase btn btn-info btn-sm">Edit</button>
                    <button type="button" name="removereturn" removereturn="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="removereturn text-uppercase btn btn-danger btn-sm">Remove</button>
                </td>
                
                <td>
                    {{  $product->id ?? '' }}
                </td>
                <td>
                    {{  $product->purchase_order_number_id ?? '' }}
                </td>
                <td>
                    {{  $product->inventory->product_code ?? '' }} - {{  $product->inventory->short_description ?? '' }}
                </td>
                <td>
                    {{  $product->qty ?? '' }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->unit_price , 2, '.', ',') }}
                </td>
                <td>
                    <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->amount , 2, '.', ',') }}
                </td>
                <td>
                    {{  $product->status->code ?? '' }} - {{  $product->status->title ?? '' }}
                </td>
              
                
                <td>
                    {{  $product->remarks ?? '' }}
                </td>
                <td>
                    {{ $product->created_at->format('l, j \\/ F / Y h:i:s A') }}
                </td>
            </tr>
              @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
</div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-inventries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>