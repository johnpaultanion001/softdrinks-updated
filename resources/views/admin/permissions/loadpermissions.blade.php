
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0" id="titletable">Permissions</h3>
            </div>
            
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries">
            <thead class="thead-light">
                 <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                 </tr>
            </thead>
            <tbody>
              @forelse($permissions as $key => $permission)
                    <tr data-entry-id="{{ $permission->id ?? '' }}">
                     
                        <td>
                            {{  $permission->id ?? '' }}
                        </td>
                        <td>
                            {{  $permission->title?? '' }}
                        </td>
                        
                    </tr>
                @empty
                    <td>
                       No Data
                    </td>
                @endforelse
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


