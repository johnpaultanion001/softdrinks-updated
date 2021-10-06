<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Supplier: </label>
            <p>{{$returned->purchase_order->supplier->name}}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Date of purchase: </label>
            <p>{{$returned->purchase_order->created_at->format('l, j \\/ F / Y h:i:s A') }}</p>
            
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Purchase Order Number: </label>
            <p>{{$returned->purchase_order_number_id}}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Total Case Returning: </label>
            <p>{{ number_format($returned->total_case_return ?? '' , 0, ',', ',') }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Total Deposit: </label>
            <p><large class="text-success font-weight-bold mr-1">₱</large>{{ number_format($returned->total_deposit ?? '' , 0, ',', ',') }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Date Of Returned: </label>
            <p>{{$returned->created_at->format('l, j \\/ F / Y h:i:s A') }}</p>
        </div>
    </div>
</div>


<div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0 text-uppercase" id="titletable">List of Products Returned</h3>
        </div>
      
    </div>
    <div class="pending-product col mt-4">
        <div class="table-responsive">
            <table class="table align-items-center table-flush datatable-returnproducts">
                <thead class="thead-light">
                <tr>
                   
                    <th scope="col">Name</th>
                    <th scope="col">Case Returned</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deposit</th>
                    <th scope="col">Purchase Order Number</th>
                    <th scope="col">Note</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody class="text-uppercase font-weight-bold">
                    @foreach($returnedproducts as $key => $product)
                        <tr data-entry-id="{{ $product->id ?? '' }}">
                     
                        
                        <td>
                            {{  $product->name ?? '' }}
                        </td>
                        <td>
                            {{  $product->case ?? '' }}
                        </td>
                        <td>
                            {{  $product->status->code ?? '' }} - {{  $product->status->title ?? '' }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->deposit , 0, ',', ',') }}
                        </td>
                        <td>
                            {{  $product->purchase_order_number_id ?? '' }}
                        </td>
                        <td>
                            {{  $product->note ?? '' }}
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
   



