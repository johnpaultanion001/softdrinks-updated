
<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-location_stocks display" cellspacing="0" width="100%">
        <thead class="thead-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Location</th>
                <th scope="col">Stock</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
                @foreach($location_stocks as $stock)
                <tr data-entry-id="{{ $stock->id ?? '' }}">
                    <td>
                        {{$stock->id ?? '' }}
                    </td>
                    <td>
                        {{$stock->location->location_name ?? '' }}
                    </td>
                    <td>
                        {{$stock->stock ?? '' }}
                    </td>
                   
                </tr>
                @endforeach
        </tbody>
    </table>
</div>
    
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    $.extend(true, $.fn.dataTable.defaults, {
        pageLength: 10,
      
    });
    $('.datatable-location_stocks:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

</script>