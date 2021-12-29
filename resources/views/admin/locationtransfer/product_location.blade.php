<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">PRODUCTS</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-products" cellspacing="0" width="100%">
            <thead class="thead-white">
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Code/Desc</th>
                    <th scope="col">Overall Stock</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
                @foreach($products as $key => $product)
                        <tr data-entry-id="{{ $product->id ?? '' }}">
                            <td>
                                <button type="button" name="transfer" transfer="{{  $product->id ?? '' }}"  class="transfer text-uppercase btn btn-info btn-sm">TRANSFER</button>
                            </td>
                            <td>
                                {{ $product->id }}
                            </td>
                            <td>
                                {{  $product->product_code ?? '' }} / {{  $product->description ?? '' }}
                            </td>
                            <td>
                                <div style="max-height: 100px; overflow: auto;">
                                    @foreach($product->location_products as $lp)
                                        {{$lp->location->location_name ?? ''}} ({{$lp->stock ?? ''}}) <br>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                {{ $product->created_at->format('M j , Y h:i A') }}
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
    pageLength: 25,
  });

    $('.datatable-products:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>

