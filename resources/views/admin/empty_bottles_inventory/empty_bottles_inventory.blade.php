@extends('../layouts.admin')
@section('sub-title','Empty Bottles Invenetories')
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

<!-- Page content -->
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Empty Bottles Invenetories</h3>
            </div>
         
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-emptybottles display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Remarks</th>
                <th>Product</th>
                <th>QTY</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($emptybottles as $bottle)
                    <tr data-entry-id="{{ $bottle->id ?? '' }}">
                        <td>
                              @foreach($bottle->sales_returns as $return)
                                <div class="bg-info text-white" style="border-radius: 5px; padding: 5px;">
                                  {{$return->salesinvoice->customer->customer_name ?? ''}} <br>
                                  QTY: + {{$return->return_qty ?? ''}} <br>
                                  Status: {{$return->status->title ?? ''}} <br> 
                                  {{$return->remarks ?? ''}}
                                </div> <br>
                              @endforeach
                              @foreach($bottle->recieve_returns as $return)
                                <div class="bg-warning text-white" style="border-radius: 5px; padding: 5px;">
                                  {{$return->receiving_good->supplier->name ?? ''}} <br>
                                  QTY: - {{$return->return_qty ?? ''}} <br>
                                  Status: {{$return->status->title ?? ''}} <br> 
                                  {{$return->remarks ?? ''}}
                                </div> <br>
                              @endforeach
                        </td>
                        <td>
                            @if($bottle->product_id == 0)
                                No Brand
                            @else
                                {{  $bottle->product->product_code ?? '' }}
                            @endif
                            
                        </td>
                        <td>
                            {{$bottle->qty ?? ''}}
                        </td>
                        <td>
                            {{ $bottle->created_at->format('F d,Y h:i A') }}
                        </td>
                     
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
  </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
        pageLength: 100,
        'columnDefs': [{ 'orderable': false, 'targets': 0 }],
        });

        $('.datatable-emptybottles:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    
    });
</script>
@endsection
