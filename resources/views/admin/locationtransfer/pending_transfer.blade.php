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
                                <button type="button" name="edit_product" product_id="{{  $location->product->id ?? '' }}"  pcode_desc="{{  $location->product->product_code ?? '' }} / {{  $location->product->description ?? '' }}" edit_product="{{  $location->id ?? '' }}"  class="edit_product text-uppercase btn btn-info btn-sm">Edit</button>
                                <button type="button" name="remove_product" remove_product="{{  $location->id ?? '' }}"  class="remove_product text-uppercase btn btn-danger btn-sm">Remove</button>
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
    $('.datatable-location_products').DataTable({
          bDestroy: true,
          responsive: true,
          scrollY: 500,
          scrollCollapse: true,
          buttons: [
              
          ],
    });
});
</script>

