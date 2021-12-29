<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">PENDING TRANSFER</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-location_products" cellspacing="0" width="100%">
            <thead class="thead-white">
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Product Code/Desc</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Location From</th>
                    <th scope="col">Location To</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
                @foreach($transfers as $location)
                        <tr data-entry-id="{{ $location->id ?? '' }}">
                            <td>
                                <button type="button" name="edit" edit="{{  $location->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                                <button type="button" name="remove" remove="{{  $location->id ?? '' }}"  class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                            </td>
                            <td>
                                {{  $location->product->product_code ?? '' }} / {{  $location->product->description ?? '' }}
                            </td>
                            <td>
                                {{  $location->qty ?? '' }}
                            </td>
                            <td>
                                {{  $location->locationfrom->location_name ?? '' }}
                            </td>
                            <td>
                                {{  $location->locationto->location_name ?? '' }}
                            </td>
                            <td>
                                {{ $location->created_at->format('M j , Y h:i A') }}
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

    $('.datatable-location_products:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});
</script>

