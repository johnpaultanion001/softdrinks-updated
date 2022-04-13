@extends('../layouts.admin')
@section('sub-title','EMPTY BOTTLES INVENTORIES')
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
<div class="card mt--6">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">EMPTY BOTTLES INVENTORIES</h3>
            </div>
         
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-emptybottles display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Remarks</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>QTY</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($emptybottles as $bottle)
                    <tr data-entry-id="{{ $bottle->id ?? '' }}">
                        <td>
                              <div style="max-height: 250px; overflow: auto;">
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
                              </div>
                              
                              
                        </td>
                        <td>
                          {{  $bottle->product->product_code ?? '' }}
                            
                        </td>
                        <td>
                          {{  $bottle->product->description ?? '' }}
                        </td>
                        <td>
                            {{$bottle->qty ?? ''}}
                        </td>
                        <td>
                            {{ $bottle->updated_at->format('M j , Y h:i A') }}
                            
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
@endsection

@section('script')
<script>
    $(function () {
      $('.datatable-emptybottles').DataTable({
          bDestroy: true,
          responsive: true,
          scrollY: 500,
          scrollCollapse: true,
          buttons: [
              
          ],
      });
    
    });
</script>
@endsection
