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
                <th>Actions</th>
                <th>Product</th>
                <th>QTY</th>
                <th>Created At</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($emptybottles as $bottle)
                    <tr data-entry-id="{{ $bottle->id ?? '' }}">
                        <td>
                            <button type="button" details="{{  $bottle->id ?? '' }}" class="details text-uppercase btn btn-info btn-sm">Details</button>
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
                        <td>
                            {{ $bottle->updated_at->format('F d,Y h:i A') }}
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

<div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered ">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title text-white text-uppercase font-weight-bold">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

                
            <!-- Modal body -->
            <div class="modal-body">
                <div id="loading-containermodal" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div> 
                
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Save" />
            </div>
    
        </div>
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
