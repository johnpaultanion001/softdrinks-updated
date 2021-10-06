<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">All Carts</h3>
               <!-- <button id="checkout" name="checkout" class="btn btn-sm btn-primary mt-2">Check Out</button> -->
            </div>
          
            <div class="col text-right">
           
            <div class="col">
                <h3 class="mb-0">Total : <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($orders->sum->total , 2, ',', '.') }}</h3>
            </div>
                

                

            </div>
        </div>
    </div>
    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
            <th scope="col">Actions</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Size</th>
            <th scope="col">Purchase Qty</th>
            <th scope="col">Total</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $key => $order)
                <tr data-entry-id="{{ $order->id ?? '' }}">
                    <td>
                        <button type="button" name="edit" edit="{{  $order->id ?? '' }}" class="edit btn btn-info btn-sm">Edit</button>
                        <button type="button" name="delete" delete="{{  $order->id ?? '' }}" id="{{  $order->id ?? '' }}" class="delete btn btn-danger btn-sm">Delete</button>
                    </td>
                    <td>
                        {{  $order->inventory->name ?? '' }}
                    </td>
                <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->inventory->price ?? '' , 2, ',', '.') }}
                    </td>
                    <td>
                        {{  $order->inventory->size ?? '' }}
                    </td>
                    <td>
                        {{  $order->purchase_qty ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->total ?? '' ?? '' , 2, ',', '.') }}
                    </td>    
                    <td>
                        {{ $order->created_at->format('l, j \\/ F / Y h:i:s A') }}
                        
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
