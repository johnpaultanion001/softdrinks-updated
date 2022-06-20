<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">PALLETS</h3>
            </div>
            <div class="col text-right">
              <button type="button" id="create_pallet" class="text-uppercase create_pallet btn btn-primary btn-sm">Insert</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center table-flush datatable-pallets"  width="100%">
            <thead class="thead-white">
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold display">
                @foreach($pallets as $pallet)
                        <tr>
                            <td>
                                <button type="button" edit_pallet="{{  $pallet->id ?? '' }}"  class="edit_pallet text-uppercase btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                <button type="button" remove_pallet="{{  $pallet->id ?? '' }}" class="remove_pallet text-uppercase btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>
                                {{  $pallet->pallet->title ?? '' }}
                            </td>
                            <td>
                                {{  $pallet->type ?? '' }}
                            </td>
                            <td>
                                {{  $pallet->qty ?? '' }}
                            </td>
                            <td>
                                {{  number_format($pallet->unit_price , 2, '.', ',') }}
                            </td>
                            <td>
                                {{  number_format($pallet->amount , 2, '.', ',') }}
                            </td>
                            <td>
                                {{ $pallet->created_at->format('M j , Y h:i A') }}
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
    pageLength: 100,
    responsive: true,
    scrollY: 500,
    scrollCollapse: true,
  });

    $('.datatable-pallets:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    if($('#purchase_hidden_id').val() == ""){
        $('.edit_pallet').attr("disabled", false);
        $('#create_pallet').attr("disabled", false);
        $('#create_pallet').show();
        $('.edit_pallet').show();
    }else{
        $('.edit_pallet').hide();
        $('#create_pallet').attr("disabled", true);
        $('#create_pallet').hide();
        $('.edit_pallet').attr("disabled", true);
    }

    
});
</script>

