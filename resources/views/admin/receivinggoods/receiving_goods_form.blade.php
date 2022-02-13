@extends('../layouts.admin')
@section('sub-title','RECEIVING GOODS')
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
                                <h3 class="mb-0 text-uppercase title-head" >RECEIVING GOODS</h3> 
                            </div>
                            <div class="col text-right">
                                <button type="button" name="all_records_btn" id="all_records_btn" class="all_records_btn text-uppercase btn btn-sm btn-primary">All Records</button>
                            </div> 
                        
                        </div>
                    </div>
                    <div id="loading-containermodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div>
                    <div class="card-body" id="rg_card_body">
                        <form method="post" id="purchaseorderForm" class="form-horizontal ">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label class="control-label text-uppercase" >Supplier<span class="text-danger">*</span> </label></div>
                                            <div class="col text-right">
                                                <a class="btn btn-sm btn-white text-uppercase" href="/admin/suppliers">New Supplier?</a>
                                            </div>
                                        </div>
                                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                                            <option value="" disabled selected>SELECT SUPPLIER</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">Supplier Code: {{$supplier->id}} - {{$supplier->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-supplier_id"></strong>
                                        </span>
                                        <input id="supplier_id_hidden" type="hidden" value="{{$receiving_good->supplier_id ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col"><label class="control-label text-uppercase" >Location<span class="text-danger">*</span></label></div>
                                            <div class="col text-right">
                                                <a class="btn btn-sm btn-white text-uppercase" href="/admin/locations">New Location?</a>
                                            </div>
                                        </div>
                                        <select name="location_id" id="location_id" class="form-control select2">
                                            <option value="" disabled selected>SELECT LOCATION</option>
                                            @foreach ($locations as $location)
                                                <option value="{{$location->id}}">Location Code: {{$location->id}} - {{$location->location_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-location_id"></strong>
                                        </span>
                                        <input id="location_id_hidden" type="hidden" value="{{$receiving_good->location_id ?? ''}}">
                                        <input id="cash_hidden" type="hidden" value="{{$receiving_good->cash1 ?? ''}}">
                                    
                                    </div>
                                </div>    
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >DOC NO.</label>
                                        <input type="text" name="doc_no" id="doc_no" class="form-control" value="{{$receiving_good->doc_no ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-doc_no"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Entry Date<span class="text-danger">*</span></label>
                                        <input type="date" name="entry_date" id="entry_date" class="form-control"  value="{{$receiving_good->entry_date ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-entry_date"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >PO NO.</label>
                                        <input type="text" name="po_no" id="po_no" class="form-control" value="{{$receiving_good->po_no ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-po_no"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >PO Date.</label>
                                        <input type="date" name="po_date" id="po_date" class="form-control" value="{{$receiving_good->po_date ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-po_date"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Name of a Driver<span class="text-danger">*</span></label>
                                        <input type="text" name="name_of_a_driver" id="name_of_a_driver" class="form-control" value="{{$receiving_good->name_of_a_driver ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-name_of_a_driver"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Plate Number<span class="text-danger">*</span> </label>
                                        <input type="text" name="plate_number" id="plate_number" class="form-control" value="{{$receiving_good->plate_number ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-plate_number"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Trade Discount:</label>
                                        <input type="text" name="trade_discount" id="trade_discount" class="form-control" value="{{$receiving_good->trade_discount ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-trade_discount"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Terms Discount: </label>
                                        <input type="text" name="terms_discount" id="terms_discount" class="form-control" value="{{$receiving_good->terms_discount ?? ''}}"/>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-terms_discount"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Remarks: </label>
                                        <textarea name="remarks" id="remarks" autocomplete="on" class="form-control">{{$receiving_good->remarks ?? ''}}</textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-remarks"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Reference: </label>
                                        <textarea name="reference" id="reference" autocomplete="on" class="form-control">{{$receiving_good->reference ?? ''}}</textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-reference"></strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div id="sales_inventory"></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="card">
                                                <div id="return-product"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-xl-12">
                                    <div id="alltotal"></div>
                                </div>
                            </div>
                            <input type="hidden" name="purchase_action" id="purchase_action" value="Compute" />
                            <input type="hidden" name="purchase_hidden_id" id="purchase_hidden_id" value="{{$receiving_good->id ?? ''}}" />

                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-danger text-uppercase" >Cancel</button>
                                <input type="submit" name="purchase_button" id="purchase_button" class="text-uppercase btn btn-primary" value="Compute" />
                            </div>
                        
                        </form>
                    </div>
                    

                </div>
            </div>

        </div>
    </div>

    <!-- Create Product Order Modal -->
    <form method="post" id="productForm" class="form-horizontal">
        @csrf
        <div class="modal" id="productModal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-default">
                        <p class="modal-title-product font-weight-bold text-uppercase text-white ">Modal Heading</p>
                        <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="loading-productmodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="modal-body-product" class="modal-body">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" >Product Code<span class="text-danger">*</span> </label>
                                    <input type="text" name="product_code"  id="product_code" class="form-control" autocomplete="off" style="text-transform: uppercase;"/>
                                            <div id="productCodeList">

                                            </div>
                                        
                                        
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-product_code"></strong>
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" >Description<span class="text-danger">*</span> </label>
                                    <input type="text" name="description" id="description" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-description"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><label class="control-label text-uppercase" >Category<span class="text-danger">*</span> </label></div>
                                        <div class="col text-right">
                                            <a class="btn btn-sm btn-white text-uppercase" href="/admin/categories">New Category?</a>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}"> {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-category_id"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="control-label text-uppercase" >Size<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col text-right">
                                            <a class="btn btn-sm btn-white text-uppercase" href="/admin/sizes">New Size?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input rb_status" type="radio" id="rb_softdrinks" name="rb_status" value="SOFTDRINKS">
                                                <label class="form-check-label" for="rb_softdrinks">SOFTDRINKS</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input rb_status" type="radio" id="rb_water_juices" name="rb_status" value="WATER/JUICES">
                                                <label class="form-check-label" for="rb_water_juices">WATER/JUICES</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input rb_status" type="radio" id="rb_no_ucs" name="rb_status" value="NO-UCS">
                                                <label class="form-check-label" for="rb_no_ucs">NO UCS</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <select name="size_id" id="size_id" class="form-control select2">
                                        <option value="" disabled selected>Select Size</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{$size->id}}"> {{$size->title}} {{$size->size}}  - UCS:{{$size->ucs}} </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-size_id"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" >Expiration </label>
                                    <input type="date" name="expiration" id="expiration" class="form-control" />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-expiration"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" >QTY<span class="text-danger">*</span> </label>
                                    <input type="number" name="qty" id="qty" step="any" class="form-control" />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-qty"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" >Unit Cost<span class="text-danger">*</span></label>
                                    <input type="number" name="unit_cost" id="unit_cost" class="form-control" step="any" />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-unit_cost"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" >Regular Discount<span class="text-danger">*</span></label>
                                    <input type="number" name="regular_discount" id="regular_discount" class="form-control" step="any"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-regular_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" >Hauling Discount<span class="text-danger">*</span></label>
                                    <input type="number" name="hauling_discount" id="hauling_discount" class="form-control" step="any"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-hauling_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" >Product Remarks </label>
                                    <textarea name="product_remarks" id="product_remarks" class="form-control"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-product_remarks"></strong>
                                    </span>
                                </div>
                            </div>
                                    
                        </div>
                        <input type="hidden" name="product_action" id="product_action" value="Add" />
                        <input type="hidden" name="product_hidden_id" id="product_hidden_id" />
                    </div>

                    <div class="modal-footer bg-white">
                        <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                        <input type="submit" name="product_button" id="product_button" class="text-uppercase btn btn-default" value="Submit" />
                    </div>
            
                </div>
            </div>
        </div>
    </form>

    <!-- Create Return Product -->
    <form method="post" id="returnForm" class="form-horizontal">
        @csrf
        <div class="modal" id="returnModal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <p class="modal-title-return font-weight-bold text-uppercase text-white ">Modal Heading</p>
                        <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="loading-returnmodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="modal-body-return" class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label text-uppercase" >Type Of Return<span class="text-danger">*</span></label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type_of_return" type="radio" id="empty" name="type_of_return" value="EMPTY" checked>
                                        <label class="form-check-label" for="empty">EMPTY</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input type_of_return" type="radio" id="bad_order" name="type_of_return" value="BAD_ORDER">
                                        <label class="form-check-label" for="bad_order">BAD ORDER</label>
                                    </div>
                                    <br>
                                    <br>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PRODUCT CODE/DESC (STOCK):<span class="text-danger">*</span> </label>
                                    <select name="product_id" id="product_id" class="form-control select2">
                                        <option value="" disabled selected>Select Product</option>
                                        @foreach ($product_code as $return)
                                            <option value="{{$return->product_id}}" class="text-uppercase">
                                               {{$return->product->product_code ?? ''}}/{{$return->product->description ?? ''}} ({{$return->qty ?? ''}})
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-product_id"></strong>
                                    </span>
                                
                                </div>
                            </div>
                            <div class="col-sm-6" id="status_container">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><label class="control-label text-uppercase" >Status:<span class="text-danger">*</span> </label></div>
                                        <div class="col text-right">
                                            <a class="btn btn-sm btn-white text-uppercase" href="/admin/status-return">New Status?</a>
                                        </div>
                                    </div>
                                    <select name="status_id" id="status_id" class="form-control select2">
                                        @foreach ($status as $sp)
                                            <option value="{{$sp->id}}" class="text-uppercase"> {{$sp->code}} - {{$sp->title}}  </option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-status_id"></strong>
                                    </span>
                                </div>
                            </div>

                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Unit Price:<span class="text-danger">*</span></label>
                                    <input type="number" name="unit_price" id="unit_price" class="form-control" step="any" />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-unit_price"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Return QTY:<span class="text-danger">*</span> </label>
                                    <input type="number" name="return_qty" id="return_qty" step="any" class="form-control" />
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-return_qty"></strong>
                                    </span>
                                </div>
                            </div>
                        
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks: </label>
                                    <textarea name="remarks" id="remarks_return" class="form-control"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-remarks"></strong>
                                    </span>
                                </div>
                            </div>
                                
                        </div>
                        <input type="hidden" name="return_action" id="return_action" value="Add" />
                        <input type="hidden" name="return_hidden_id" id="return_hidden_id" />
                        <input type="hidden" name="existing_purchase" id="existing_purchase" value="no" />
                    </div>

                    <div class="modal-footer bg-white">
                        <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                        <input type="submit" name="return_button" id="return_button" class="text-uppercase btn btn-default" value="Submit" />
                    </div>
            
                </div>
            </div>
        </div>
    </form>

    <!-- List Of Recieving good by supplier Id -->
    <div class="modal" id="receivingGoodListModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="font-weight-bold text-uppercase text-white ">Select data you want to reuse</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div id="loading-list" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div>
                <div id="modal-body-receivingGoodList" class="modal-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush display" cellspacing="0" width="100%">
                            <thead class="thead-white">
                                <tr>
                                    <th scope="col">Actions</th>
                                    <th scope="col">RG ID</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Returns</th>
                                </tr>
                            </thead>
                            <tbody class="text-uppercase font-weight-bold" id="receivingGoodList">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" name="supplier_id_receiving_good" id="supplier_id_receiving_good"/>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
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
<script type="text/javascript">
var status = null;
var supplier = $('#supplier_id_hidden').val();
var location1 = $('#location_id_hidden').val();
var cash = $('#cash_hidden').val();

$(function () {
    $('#loading-containermodal').hide();
    $("#supplier_id").select2("trigger", "select", {
            data: { id: supplier }
    });
    $("#location_id").select2("trigger", "select", {
            data: { id: location1 }
    });
    
    rgForm();
    $('#cash1').val(cash);
    
    
});


function rgForm(){
   
    alltotal();
    loadPendingProduct();
    loadReturnProduct();
   
}


//alltotal 
function alltotal(){
    
    var rg_id = $('#purchase_hidden_id').val();

    $.ajax({
        url: "/admin/total_product", 
        type: "get",
        dataType: "HTMl",
        data: {rg_id:rg_id, _token: '{!! csrf_token() !!}'},
        beforeSend: function() {
            $('#loading-containermodal').show();
            $('#rg_card_body').hide();
        },
        success: function(response){
            $('#loading-containermodal').hide();
            $('#rg_card_body').show();
            $("#alltotal").html(response);
            
        }	
    })
}
//pending product
function loadPendingProduct(){
    var rg_id = $('#purchase_hidden_id').val();

    $.ajax({
        url: "/admin/pending_product", 
        type: "get",
        data: {rg_id:rg_id, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-containermodal').show();
            $('#rg_card_body').hide();

        },
        success: function(response){
            $('#loading-containermodal').hide();
            $('#rg_card_body').show();
            $('#purchase_action').val('Compute');
            $("#purchase_button").attr("disabled", false);
            $("#purchase_button").attr("value", "Compute");
            $("#sales_inventory").html(response);
        }	
    })
}

//Return Products
function loadReturnProduct(){
    var rg_id = $('#purchase_hidden_id').val();
    $.ajax({
        url: "/admin/recieve_return", 
        type: "get",
        data: {rg_id:rg_id, _token: '{!! csrf_token() !!}'},
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-containermodal').show();
            $('#rg_card_body').hide();
        },
        success: function(response){
            $('#loading-containermodal').hide();
            $('#rg_card_body').show();
            $('#purchase_action').val('Compute');
            $("#purchase_button").attr("disabled", false);
            $("#purchase_button").attr("value", "Compute");
            $("#return-product").html(response);
        }	
    })
}

$(document).on('click', '#all_records_btn', function(){
    window.location.href = '/admin/receiving_goods';
});


//create product
$(document).on('click', '#create_product', function(){
    $('#productModal').modal('show');
    $('#productForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-product').text('Add Product');
    $('#product_button').val('Submit');
    $('#category_id').select2({
        placeholder: 'Select Category'
    })
    $('#size_id').select2({
        placeholder: 'Select Size'
    })
    $('#product_action').val('Add');
    $('#loading-productmodal').hide();
});

//create return product
$(document).on('click', '#create_return', function(){
    $('#returnModal').modal('show');
    $('#returnForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-return').text('Insert Return');
    $('#return_button').val('Submit');
    $('#return_action').val('Add');
    $('#loading-returnmodal').hide();
    $('#product_id').attr('disabled', false);
    empty_dd();
});

//edit product
$(document).on('click', '.edit', function(){
    $('#productModal').modal('show');
    $('.modal-title-product').text('Edit Product');
    $('#productForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('#productCodeList').fadeOut();
    var id = $(this).attr('edit');
    status = "clear";
    rg_status();

    $.ajax({
        url :"/admin/sales_inventory/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading..");
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            if($('#product_action').val() == 'Edit'){
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Update");
            }else{
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Submit");
            }
            
            
            
                $.each(data.result, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).val(value)
                        if(key == 'category_id'){
                            $("#category_id").select2("trigger", "select", {
                                data: { id: value }
                            });
                        }
                        if(key == 'size_id'){
                            $("#size_id").select2("trigger", "select", {
                                data: { id: value }
                            });
                        }
                    }
            })
            $('#product_hidden_id').val(id);
            $('#product_button').val('Update');
            $('#product_action').val('Edit');
        }
    })
});

// store and update product
$('#productForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.sales_inventory.store') }}";
    var type = "POST";
    

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "/admin/sales_inventory/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading..");
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            if($('#product_action').val() == 'Edit'){
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Update");
            }else{
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Submit");
            }

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#category_id').select2({
                    placeholder: 'Select Category'
                });
                $('#size_id').select2({
                    placeholder: 'Select Size'
                });
                $('#productModal').modal('hide');
                alltotal();
                loadPendingProduct();
                supplier_prev_bal();
            }
          
            
           
        }
    });
});


// store and update return product
$('#returnForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.recieve_return.store') }}";
    var type = "POST";

    if($('#return_action').val() == 'Edit'){
        var id = $('#return_hidden_id').val();
        action_url = "/admin/recieve_return/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#return_button").attr("disabled", true);
            $("#return_button").attr("value", "Loading..");
            $('#loading-returnmodal').show();
            $('#modal-body-return').hide();
        },
        success:function(data){
            
            $('#loading-returnmodal').hide();
            $('#modal-body-return').show();

            if($('#return_action').val() == 'Edit'){
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Update");
            }else{
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Submit");
            }

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')

                $('#returnForm')[0].reset();
                
                $('#returnModal').modal('hide');
                rgForm();
                supplier_prev_bal();
            }
        }
    });
})

//edit return
$(document).on('click', '.editreturn', function(){
    $('#returnModal').modal('show');
    $('.modal-title-return').text('Edit Return Product');
    $('#returnForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    var id = $(this).attr('editreturn');

    $.ajax({
        url :"/admin/recieve_return/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#return_button").attr("disabled", true);
            $("#return_button").attr("value", "Loading..");
            $('#loading-returnmodal').show();
            $('#modal-body-return').hide();
        },
        success:function(data){
            $('#loading-returnmodal').hide();
            $('#modal-body-return').show();
            if($('#return_action').val() == 'Edit'){
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Update");
            }else{
                $("#return_button").attr("disabled", false);
                $("#return_button").attr("value", "Submit");
            }
           
                   
            if(data.type_of_return == 'BAD_ORDER'){
                $('#status_container').hide();
                
            }else{
                $('#status_container').show();
            }
            $("input[name=type_of_return]").val([data.type_of_return]);

            var products = '<option value="" disabled selected>'+data.product+'</option>';
            $('#product_id').empty().append(products);
            $("#status_id").select2("trigger", "select", {
                        data: { id: data.status }
                    });
            $('#unit_price').val(data.unit_price);
            $('#return_qty').val(data.return_qty);
            $('#remarks_return').val(data.remarks);

            $('#return_hidden_id').val(id);
            $('#return_button').val('Update');
            $('#return_action').val('Edit');
            $('#product_id').attr('disabled', true);


            
        }
    })
});

//remove return
$(document).on('click', '.removereturn', function(){
  var id = $(this).attr('removereturn');
  var rg_id = $('#purchase_hidden_id').val();
  
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this data?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/recieve_return/"+id,
                      method:'DELETE',
                      data: {rg_id:rg_id, _token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        $('#loading-containermodal').show();
                        $("#return-product").hide();
                      },
                      success:function(data){
                          if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            loadPendingProduct();
                            loadReturnProduct();
                            alltotal();
                            $('#loading-containermodal').hide();
                            $("#return-product").show();
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });

});

//remove product
$(document).on('click', '.remove', function(){
    var id = $(this).attr('remove');
    var rg_id = $('#purchase_hidden_id').val();
    
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this product?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/sales_inventory/"+id,
                      method:'DELETE',
                      data: {rg_id:rg_id, _token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        $('#loading-productmodal').show();
                        $('#modal-body-product').hide();
                      },
                      success:function(data){
                          if(data.success){
                            $('#loading-productmodal').hide();
                            $('#modal-body-product').show();
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            rgForm();
                            
                            
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });
});

//remove all product
$(document).on('click', '#remove_all_products', function(){
  
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove all pending products in this table ?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/sales_inventory/remove/remove_all",
                      method:'DELETE',
                      dataType:"json",
                      data: {_token: '{!! csrf_token() !!}'},
                      beforeSend:function(){
                        $("#purchase_button").attr("disabled", true);
                        $("#purchase_button").attr("value", "Loading..");
                        $("#remove_all_products").attr("disabled", true);
                      },
                      success:function(data){
                          if(data.success){
                            $("#purchase_button").attr("disabled", false);
                            $("#purchase_button").attr("value", "Submit");
                            $("#remove_all_products").attr("disabled", false);

                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            rgForm();
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });
});

//remove all product
$(document).on('click', '#remove_all_returns', function(){
  
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove all pending returns in this table ?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/recieve_return/remove/remove_all",
                      method:'DELETE',
                      dataType:"json",
                      data: {_token: '{!! csrf_token() !!}'},
                      beforeSend:function(){
                        $("#purchase_button").attr("disabled", true);
                        $("#purchase_button").attr("value", "Loading..");
                        $("#remove_all_returns").attr("disabled", true);
                      },
                      success:function(data){
                          if(data.success){
                            $("#purchase_button").attr("disabled", false);
                            $("#purchase_button").attr("value", "Submit");
                            $("#remove_all_returns").attr("disabled", false);

                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            rgForm();
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
              keys: ['enter', 'shift'],
          }
      }
  });
});


//autocomplete
$('#product_code').keyup(function(){ 
       
    if($('#product_action').val() == 'Edit'){
        $('#productCodeList').fadeOut();
    }else{
    var query = $(this).val();
    if(query != '')
    {
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('admin.sales_inventory.autocomplete') }}",
        method:"POST",
        data:{query:query, _token:_token},
        success:function(data){
            if (data == undefined){
                $('#productCodeList').fadeOut();
            }
            $('#productCodeList').fadeIn();  
            $('#productCodeList').html(data);
            }
        });
    }
    if(query == ''){
        $('#productCodeList').fadeOut();
        }
    
    }
});

$(document).on('click', 'li', function(){  
    var query = $(this).text();
    if(query != '')
    {
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('admin.sales_inventory.autocompleteresult') }}",
        method:"POST",
        dataType:"json",
        data:{query:query, _token:_token},
        success:function(data){

        $.each(data.result, function(key,value){
            if(key == $('#'+key).attr('id')){
                $('#'+key).val(value)
            }
            if(key == 'category_id'){
                    $("#category_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
                if(key == 'size_id'){
                    $("#size_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
        })
        $('#productCodeList').fadeOut(); 
        }
        });
    }
});  


//size status
$(document).on('click', '.rb_status', function(){
    status = $(this).val();
    rg_status();
});

function rg_status(){
    status = status;

    $.ajax({
      url: "/admin/size_status", 
      type: "get",
      dataType: "json",
      data:{status:status, _token: '{!! csrf_token() !!}',},
        beforeSend: function() {
            
        },
        success: function(data){
            var status = '';
            status += '<option value="" disabled selected>Select Size</option>';
            $.each(data.result, function(key,value){
            status += '<option value="'+value.id+'">'+value.size+' UCS:'+ value.ucs+'</option>';
            });
            $('#size_id').empty().append(status);
        }	
    });
}


// SUPPLIER PREV BAL
function supplier_prev_bal(){
    var supplier = $('#supplier_id').val();
    $.ajax({
            url:"/admin/receiving_goods/supplier/get_supplier_id",
            method:"get",
            dataType: "json",
            data: {
                supplier:supplier, _token: '{!! csrf_token() !!}'
            },
            beforeSend:function(){

            },
            success:function(data){
                if(data.supplier_prev != null){
                    $('#prev_bal').val(data.supplier_prev);
                }
            }
        });

}

// REUSE DATA
$('select[name="supplier_id"]').on("change", function(event){
    var supplier = $('#supplier_id').val();
    //Reuse
    if($('#purchase_action').val() != 'Edit'){
        $.ajax({
            url:"/admin/receiving_goods/supplier/get_supplier_id",
            method:"get",
            dataType: "json",
            data: {
                supplier:supplier, _token: '{!! csrf_token() !!}'
            },
            beforeSend:function(){

            },
            success:function(data){
                if(data.receiving_goods != null){
                    $('#reuse-alert').addClass('bg-green show');
                    $("#reuse-alert").fadeTo(10000, 500).slideUp(500, function(){
                        $("#reuse-alert").slideUp(500);
                    });
                    $('#supplier_id_receiving_good').val(supplier)
                }
            }
        });
    }
    supplier_prev_bal();
    

});

$(document).on('click', '#btn_reuse', function(){
    var supplier = $('#supplier_id_receiving_good').val();
    $('#receivingGoodListModal').modal('show');

    $.ajax({
        url:"/admin/receiving_goods/supplier/list_receiving_goods",
        method:"get",
        dataType: "json",
        data: {
            supplier:supplier, _token: '{!! csrf_token() !!}'
        },
        beforeSend:function(){
            $('#modal-body-receivingGoodList').hide();
            $('#loading-list').show();
        },
        success:function(data){
            var list = '';
            $.each(data.list, function(key,value){
                list += '<tr>';
                    list += '<td>';
                        list += '<button select="'+value.id+'" type="button" class="select_reuse text-uppercase btn btn-warning">Select</button>';
                    list += '</td>';
                    list += '<td>';
                        list += value.id;
                    list += '</td>';
                    list += '<td>';
                        list += value.supplier;
                    list += '</td>';
                    list += '<td>';
                          list += '<div style="max-height: 250px; overflow: auto;">';
                            list +=    '<div class="bg-info text-white h4" style="border-radius: 5px; padding: 5px;">'
                                        $.each(value.products, function(key,value){
                                            list += 'Product Code:'+ value.product_code + '<br>';
                                            list += 'Desc:'+ value.description + '<br>';
                                            list += 'QTY:'+ value.qty + '<br> <br> ';
                                        });
                            list +=  '</div> <br>'
                          list += '</div>'
                    list += '</td>';
                    list += '<td>';
                          list += '<div style="max-height: 250px; overflow: auto;">';
                            list +=    '<div class="bg-primary text-white h4" style="border-radius: 5px; padding: 5px;">'
                                        $.each(value.returns, function(key,value){
                                            list += 'Product Code:'+ value.product_code + '<br>';
                                            list += 'Description:'+ value.description + '<br>';
                                            list += 'QTY:'+ value.qty + '<br> <br>';

                                        });
                            list +=  '</div> <br>'
                          list += '</div>'
                    list += '</td>';
                list += '</tr>';
            });
            $('#receivingGoodList').empty().append(list);
            $('#modal-body-receivingGoodList').show();
            $('#loading-list').hide();
        }
    });
   
});

$(document).on('click', '.select_reuse', function(){
    var id = $(this).attr('select');
    $.ajax({
        url :"/admin/receiving_goods/supplier/reuse/" + id,
        dataType:"json",
        beforeSend:function(){
            $('.select_reuse').text('Loading..');
            $('.select_reuse').attr('disabled', true);
        },
        success:function(data){
          if(data.success){
            $('.select_reuse').text('Select');
            $('.select_reuse').attr('disabled', false);

            $('#success-alert').addClass('bg-primary');
            $('#success-alert').html('<strong>' + data.success + '</strong>');
            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                $("#success-alert").slideUp(500);
            });
            $('#receivingGoodListModal').modal('hide');
            $.each(data.result, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).val(value)
                    }
                    if(key == 'location_id'){
                        $("#location_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                   
            });
            rgForm();
            supplier_prev_bal();
          }
        }
    })
});

//store and update purchase order
$('#purchaseorderForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.receiving_goods.compute') }}";
    var type = "GET";

    if($('#purchase_action').val() == 'Edit'){
        var id = $('#purchase_hidden_id').val();
        action_url = "/admin/receiving_goods/" + id;
        type = "PUT";
    }
    if($('#purchase_action').val() == 'Add'){
        action_url = "{{ route('admin.receiving_goods.store') }}";
        type = "POST";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Loading..");
        },
        success:function(data){
            if($('#purchase_action').val() == 'Edit'){
                $("#purchase_button").attr("disabled", false);
                $("#purchase_button").attr("value", "Update");
            }else if($('#purchase_action').val() == 'Compute'){
                $("#purchase_button").attr("disabled", false);
                $("#purchase_button").attr("value", "Compute");
            }else{
                $("#purchase_button").attr("disabled", false);
                $("#purchase_button").attr("value", "Submit");
            }

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                        window.location.href = '#'+key;
                    }
                    if(key == 'payables'){
                        $('#new_bal').addClass('is-invalid')
                        $('#error-new_bal').text(value)

                        $.confirm({
                            title: 'Confirmation',
                            content: value,
                            type: 'red',
                            buttons: {
                                confirm: {
                                    text: 'confirm',
                                    btnClass: 'btn-blue',
                                    keys: ['enter', 'shift'],
                                    action: function(){
                                        $('input[name="payables"]').prop('checked', true);
                                    }
                                },
                            }
                        });
                    }
                })
            }
            if(data.nodata){
                $.alert({
                    title: 'Error Message',
                    content: data.nodata,
                    type: 'red',
                });
            }
            if(data.submit){
                $('#purchase_action').val(data.submit);
                $("#purchase_button").attr("disabled", false);
                $("#purchase_button").attr("value", "Submit");
                $('#change').val(data.change);
                $('#new_bal').val(data.new_bal);
            }
            if(data.success){
                payables();
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#purchaseorderForm')[0].reset();
                $('#supplier_id').select2({
                    placeholder: 'Select supplier'
                });
                rgForm();
                
            }  
        }
    });
});

// Bad Order DD
function bad_order_dd(){
    $.ajax({
      url: "/admin/receiving_goods/bad_order/bad_order_dd", 
      type: "get",
      dataType: "json",
        beforeSend: function() {
            
        },
        success: function(data){
            var bad_orders = '';
            bad_orders += '<option value="" disabled selected>Select Product</option>';
            $.each(data.bad_orders, function(key,value){
                bad_orders += '<option value="'+value.id+'">'+value.product_code+'/'+value.description+' ('+value.stock+')</option>';
            });
            $('#product_id').empty().append(bad_orders);
        }	
    });
}

// Empty
function empty_dd(){
    $.ajax({
      url: "/admin/receiving_goods/empty/empty_dd", 
      type: "get",
      dataType: "json",
        beforeSend: function() {
            
        },
        success: function(data){
            var empties = '';
            empties += '<option value="" disabled selected>Select Product</option>';
            $.each(data.empties, function(key,value){
                empties += '<option value="'+value.id+'">'+value.product_code+'/'+value.description+' ('+value.stock+')</option>';
            });
            $('#product_id').empty().append(empties);
        }	
    });
}


//Type of return
$('input[name="type_of_return"]').on("change", function(event){
    var tor = $(this).val();
    if(tor == 'BAD_ORDER'){
        $('#status_container').hide();
        $('#unit_price').val(null);
        bad_order_dd();
    }else{
        $('#status_container').show();
        $('#unit_price').val(null);
        empty_dd();
    }
});

//return amt automatic
$('select[name="product_id"]').on("change", function(event){
    var product_id = $(this).val();
    var tor = $('input[name="type_of_return"]:checked').val();
    var _token = $('input[name="_token"]').val();
    
    if($('#return_action').val() == 'Add'){
            $.ajax({
                url: "/admin/recieve_return/product/return_amount", 
                type: "get",
                dataType:"json",
                data: {
                    product_id:product_id,tor:tor,_token: '{!! csrf_token() !!}',
                },
                beforeSend: function() {
                    $("#return_button").attr("disabled", true);
                    $("#return_button").attr("value", "Loading..");
                },
                success: function(data){
                    $("#return_button").attr("disabled", false);
                    $("#return_button").attr("value", "Submit");
                    if(data.unit_price){
                        $('#unit_price').val(data.unit_price)
                    }
                }	
            });
    }
   
      
});


//accounte payables
function payables(){
    if($('input[name="payables"]').is(':checked'))
    {
        var supplier = $('#supplier_id').val();
        var new_bal = $('#new_bal').val();
        $.ajax({
            url: "/admin/receiving_goods/payables/payables", 
            type: "get",
            dataType: "json",
            data: { supplier:supplier, new_bal:new_bal, _token: '{!! csrf_token() !!}'},
            success: function(data){
                if(data.success){
                        $.alert({
                            title: 'Success Message',
                            content: data.success,
                            type: 'green',
                        })
                    }
                
            }	
        })
    
    }
}

</script>
@endsection
