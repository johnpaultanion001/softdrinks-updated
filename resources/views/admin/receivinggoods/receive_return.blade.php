<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush datatable-returnproducts display" cellspacing="0" width="100%">
    <thead class="thead-white">
        <tr>
        <th scope="col">Actions</th>
        <th scope="col">ID</th>
        <th scope="col">RG ID</th>
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
        @foreach($returns as $key => $product)
            <tr data-entry-id="{{ $product->id ?? '' }}">
                <td>
                    <button type="button" name="editreturn" editreturn="{{  $product->id ?? '' }}"  class="editreturn text-uppercase btn btn-info btn-sm">Edit</button>
                    <button type="button" name="removereturn" removereturn="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="removereturn text-uppercase btn btn-danger btn-sm">Remove</button>
                </td>
                <td>
                    {{  $product->id ?? '' }}
                </td>
                <td>
                    {{  $product->receiving_good_id ?? '' }}
                </td>
                <td>
                    @if($product->product_id == 0)
                        NO BRAND
                    @else
                        {{  $product->product->description ?? '' }}
                    @endif
                    
                </td>
                <td>
                    {{  $product->return_qty ?? '' }}
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
                    {{ $product->created_at->format('F d,Y h:i A') }}
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
    pageLength: 10,
  });

  $('.datatable-returnproducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    if($('#purchase_hidden_id').val() == ""){
        $('.editreturn').attr("disabled", false);
        $('.editreturn').show();
        $('#create_return').attr("disabled", false);
        $('#create_return').show();
    }else{
        $('.editreturn').attr("disabled", true);
        $('.editreturn').hide();
        $('#create_return').attr("disabled", true);
        $('#create_return').hide();
    }
    
    
});
</script>