<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase loadingSales" id="loadingSales">Sales</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_sales" id="create_sales" class="text-uppercase create_sales btn btn-sm btn-primary">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-sales display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">Actions</th> 
                <th scope="col">Product Code</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price Type / Discounted</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
            @foreach($orders as $key => $order)
                <tr data-entry-id="{{ $order->id ?? '' }}">
                    <td>
                        <button type="button" name="editorder" editorder="{{  $order->id ?? '' }}" class="text-uppercase editorder btn btn-info btn-sm">Edit</button>
                        <button type="button" name="removeorder" removeorder="{{  $order->id ?? '' }}" class="text-uppercase remove-order btn btn-danger btn-sm">Remove</button> 
                    </td>
                    <td>
                        {{  $order->product->product_code ?? '' }}
                    </td>
                    <td>
                        {{  $order->purchase_qty ?? '' }}
                    </td>
                    <td>
                             {{$order->pricetype->price_type  ?? ''}} / ({{ number_format($order->discounted ?? '' , 2, '.', ',') }})
                    </td>
                    <td>
                            {{ number_format($order->product->price ?? '' , 2, '.', ',') }}
                    </td>
                    <td>
                            {{ number_format($order->total ?? '' , 2, '.', ',') }}
                    </td>   
                </tr>
            @endforeach
        </tbody>
    
        </table>
    </div>
</div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 10,
  });

  $('.datatable-sales:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>
