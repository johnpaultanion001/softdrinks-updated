@extends('../layouts.admin')
@section('sub-title','LOCATION TRANSFER')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')

<div class="header bg-primary pb-6">
    <div class="container-fluid">
    </div>
</div>

<div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0 text-uppercase title-head" >LOCATION TRANSFER - ALL RECORDS</h3> 
                            </div>
                            <div class="col text-right">
                                <button type="button" id="location_transfer" class="btn btn-sm btn-default text-uppercase">LOCATION TRANSFER</button>
                            </div> 
                        
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="mb-0 text-uppercase">ALL RECORDS</h3>
                                        </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush datatable_location_transfer" cellspacing="0" width="100%">
                                    <thead class="thead-white">
                                        <tr>
                                            <th scope="col">LT ID.</th>
                                            <th scope="col">Entry Date</th>
                                            <th scope="col">Reference</th>
                                            <th scope="col">Reference Date</th>
                                            <th scope="col">Prepared By</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Transfers Details</th>
                                            <th scope="col">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase font-weight-bold">
                                        @foreach($records as $record)
                                                <tr data-entry-id="{{ $record->id ?? '' }}">
                                                    <td>
                                                        {{  $record->id ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{  $record->entry_date ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{  $record->reference ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{  $record->reference_date ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{  $record->user->name ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{  $record->remarks ?? '' }}
                                                    </td>
                                                    <td>
                                                        <div style="max-height: 200px; overflow: auto; padding: 2px;">
                                                            @foreach($record->transfers as $transfer)
                                                                PRODUCT CODE/DESC: {{$transfer->product->product_code ?? ''}} / {{$transfer->product->description ?? ''}} <br>
                                                                LOCATION FROM: {{$transfer->locationfrom->location_name ?? ''}}<br>
                                                                LOCATION FROM: {{$transfer->locationto->location_name ?? ''}}<br>
                                                                QTY: {{$transfer->qty ?? ''}}<br>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $record->created_at->format('M j , Y h:i A') }}
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>

        </div>
    </div>

<!-- Footer -->
@section('footer')
    @include('../partials.footer')
@endsection
@endsection

@section('script')
<script>
$(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    $.extend(true, $.fn.dataTable.defaults, {
    pageLength: 100,
        'columnDefs': [{ 'orderable': false, 'targets': 0 }],
    });
    
    $('.datatable_location_transfer:not(.ajaxTable)').DataTable({ buttons: dtButtons });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

$(document).on('click', '#location_transfer', function(){
    window.location.href = '/admin/location_transfer';
});

</script>
@endsection
