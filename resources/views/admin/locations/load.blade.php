
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
              <h3 class="mb-0 text-uppercase" id="titletable">Location List</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Location</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                <th>Actions</th>
                <th>Location Code</th>
                <th>Location Name</th>
                <th>Remarks</th>
                <th>Created At</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($locations as $key => $location)
                    <tr data-entry-id="{{ $location->id ?? '' }}">
                        <td>
                            <button type="button" name="edit" edit="{{  $location->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                            @if($location->id == 1)
                            
                            @elseif($location->id == 2)

                            @elseif($location->id == 3)

                            @else
                              <button type="button" name="remove" remove="{{  $location->id ?? '' }}" id="{{  $location->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            @endif
                           
                        </td>
                        <td>
                            {{  $location->id ?? '' }}
                        </td>
                        <td>
                            {{  $location->location_name ?? '' }}
                        </td>
                        <td>
                            {{  $location->remarks ?? '' }}
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
    </div>
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
  </div>
</div>
