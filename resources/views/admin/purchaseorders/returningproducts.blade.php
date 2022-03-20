<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-returnproducts display" cellspacing="0" width="100%">
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
        @foreach($returnedproducts as $key => $product)
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
      
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
  </div>


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
  });

  $('.datatable-returnproducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>