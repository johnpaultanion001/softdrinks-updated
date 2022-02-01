<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-sm-12">
                                    <h4 class="text-dark">Total Softdrinks UCS:</h4>
                                    <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <div class="input-group-text text-primary">UCS</div>
                                    </div>
                                        <input type="text" class="form-control" value="{{ number_format($ucs_softdrinks ?? '' , 2, '.', ',') }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-sm-12">
                                    <h4 class="text-dark">Total Water/Juice UCS:</h4>
                                    <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <div class="input-group-text text-primary">UCS</div>
                                    </div>
                                        <input type="text" class="form-control" value="{{ number_format($ucs_wj ?? '' , 2, '.', ',') }}" readonly>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush datatable-all_ucs display" cellspacing="0" width="100%">
                <thead class="thead-white">
                    <tr>
                        <th>Receiving Good ID / Supplier</th>
                        <th>Product ID</th>
                        <th>Product Code</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Product Size / UCS</th>
                        <th>QTY</th>
                        <th>UCS Total</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody class="text-uppercase font-weight-bold">
                @foreach($allucs as $ucs)
                    <tr data-entry-id="{{ $ucs->id ?? '' }}">
                        <td>
                          {{  $ucs->receiving_good_id ?? '' }} - {{  $ucs->receiving_good->supplier->name ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->product->product_id ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->product->product_code ?? '' }}
                        </td>
                        
                        <td>
                            {{  $ucs->product->description ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->product->category->name ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->product->size->title ?? '' }}  {{  $ucs->product->size->size ?? '' }} / {{ number_format($ucs->product->size->ucs ?? '' , 2, '.', ',') }} 
                        </td>
                        <td>
                            {{  $ucs->qty ?? '' }}
                        </td>
                        <td>
                            {{ number_format( $ucs->ucs ?? '' , 2, '.', ',') }} 
                        </td>
                        <td>
                            {{ $ucs->created_at->format('F d,Y h:i A') }}
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
        pageLength: 100,
        'columnDefs': [{ 'orderable': false, 'targets': 0 }],
    });

    $('.datatable-all_ucs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });
</script>