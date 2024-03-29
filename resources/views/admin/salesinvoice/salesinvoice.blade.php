@extends('../layouts.admin')
@section('sub-title','SALES INVOICE')
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


<div class="card mt--6">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase title-head" >SALES INVOICE</h3> 
            </div>
            <div class="col text-right">
                <button type="button" name="all_records_btn" id="all_records_btn" class="all_records_btn text-uppercase btn btn-sm btn-primary">All Records</button>
            </div> 
        
        </div>
    </div>

    <div class="card-body">
        <form method="post" id="myForm" class="form-horizontal">
        @csrf
        <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                    <h5 class="text-uppercase">Doc No:</h5>
                    <input type="text" name="doc_no" id="doc_no" class="form-control" />
                    <span class="invalid-feedback " role="alert">
                        <strong id="error-doc_no"></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <h5 class="text-uppercase">Entry Date<span class="text-danger">*</span></h5>
                    <input type="date" name="entry_date" id="entry_date" class="form-control" />
                    <span class="invalid-feedback " role="alert">
                        <strong id="error-entry_date"></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h5 class="text-uppercase">Remarks</h5>
                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                    <span class="invalid-feedback " role="alert">
                        <strong id="error-remarks"></strong>
                    </span>
                </div>
            </div>
            
            

            <div class="col-sm-6">
                <div class="form-group">
                    <h5 class="text-uppercase">Assign Deliver:<span class="text-danger">*</span></h5>
                    <select name="deliver_id" id="deliver_id" class="form-control select2">
                        <option value="">Select Deliver</option>
                        @foreach ($deliveries as $deliver)
                            <option value="{{$deliver->id}}">{{$deliver->title}}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback " role="alert">
                        <strong id="error-deliver_id"></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <h5 class="text-uppercase">Customer:<span class="text-danger">*</span></h5>
                    <select name="customer_id" id="customer_id" class="form-control select2">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->customer_code}}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback " role="alert">
                        <strong id="error-customer_id"></strong>
                    </span>
                    <input type="hidden" name="customer_name" id="customer_name" readonly/>
                    <input type="hidden" name="area" id="area" readonly/>
                </div>
            </div>
            
                    


            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div id="loadsales"></div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div id="loadreturn"></div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div id="pallets_table"></div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div id="deposits_table"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                
                    <div id="alltotal">

                    </div>
                
            </div>
        </div>
        
            <div class="modal" id="receiptModal" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-lg modal-dialog-centered ">
                    <div class="modal-content">
                
                        <!-- Modal Header -->
                        <div class="modal-header bg-primary">
                            <p class="modal-title-receipt font-weight-bold text-uppercase text-white ">Modal Heading</p>
                            <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                        </div>
                
                        <!-- Modal body -->
                        <div class="modal-body">
                                <div id="receiptreport" class="d-print-inline-flex receiptreport p4 bg-white mt-2" style="border-radius: 5px;">
                                <div class="col">
                                    <h4 class="text-center card-title text-uppercase text-dark mb-0">{{ trans('panel.site_title') }}</h4>
                                    <h5 class="text-center card-title text-muted mb-0">J.P Extension Libis Binangonan , Rizal <br>
                                    Fernando L. Arada - Prop. <br>
                                    Tel. No. 986-2433 Cel No. 0923-6738-296 </h5>
                                    <br>
                                    <div class="col-md-12">
                                        <div class="col text-left"><h6 class="card-title text-uppercase text-danger mb-0" id="doc_number_receipt"> </h6></div>
                                        <div class="col text-right"><h6 class="card-title text-uppercase text-muted mb-0">Date:  {{ $date ?? '' }} </h6></div>
                                    </div>
                                   

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <small class="text-muted mt-3 ml-1">Sold To:</small><br>
                                            <small id="sold_to_receipt"></small>
                                        </div>
                                        <div class="col-sm-6">
                                            <small class="text-muted mt-3 ml-1">Assign Deliver:</small><br>
                                                <small id="assign_to_receipt"></small>
                                        </div>
                                        <div class="col-sm-12">
                                            <small class="text-muted mt-3 ml-1 address">Area:</small> <br>
                                            <small id="area_receipt"></small>
                                        </div>
                                    </div>
                                </div>
                                <div id="receiptcontent">
                                
                                </div>
                            </div>
                            <!-- <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" /> -->
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer bg-white">
                            <input type="button" name="print_button" id="print_button" class="btn btn-primary text-uppercase" value="Print & Save"/>
                            <button type="button" id="btn_receipt" class="btn btn-primary text-uppercase">Print</button>
                            <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                </div>
            </div>
            <input type="hidden" name="action_salesinvoice" id="action_salesinvoice" value="compute"/>

            <div class="card-footer text-right">
                <button type="button" class="btn btn-danger text-uppercase" >Cancel</button>
                <input type="submit" name="action_button" id="action_button" class="btn btn-primary text-uppercase" value="Compute" />
            </div>
        </form>
    </div>
</div>

<!-- product list modal -->
<div class="modal " id="productlistModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-productlist font-weight-bold text-uppercase text-white">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
           
                <div class="table-responsive">
                    <div class="row m-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <small>Filter By Catogory</small>
                                <select name="category_filter" id="category_filter" class="form-control select2">
                                    <option value="">Filter Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <small>Filter By Supplier</small>
                                <select name="supplier_filter" id="supplier_filter" class="form-control select2">
                                    <option value="">Filter Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->name}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <small>Filter By Size</small>
                                <select name="size_filter" id="size_filter" class="form-control select2">
                                    <option value="">Filter Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{$size->title}} {{$size->size}}"> {{$size->title}} {{$size->size}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table align-items-center table-bordered display" id="datatable-productlist" cellspacing="0" width="100%">
                        <thead class="thead-white">
                            <tr>
                                <th scope="col">Actions</th> 
                                <th scope="col">Product Code/Desc</th>
                                <th scope="col">Size</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Category</th>
                                <th scope="col">Expiration</th>
                                <th scope="col">Selling Area Stock</th>
                                <th scope="col">Orders</th>
                                <th scope="col">Sold</th>

                            </tr>
                        </thead>
                        <tbody class="text-uppercase font-weight-bold" id="list_product_list">
                            
                        </tbody>
                    </table>
                </div>
            
            

            <div class="modal-footer bg-white">
                
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>

            

        </div>
    </div>
</div>

<!-- addtocart form cart -->
<form method="post" id="orderForm" class="form-horizontal ">
    @csrf
    <div class="modal fade" id="orderModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title-order font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="loading-productmodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="modalbody-edit">
                    </div>
                    
                    <div id="modalbody-view">
                    </div>

                    <input type="hidden" name="salesinvoice_id" id="salesinvoice_id" value="{{$salesinvoice_id}}"/>
                    <input type="hidden" name="order_action" id="order_action" value="Add" />
                    <input type="hidden" name="order_hidden_id" id="order_hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_button_order" id="action_button_order" class="text-uppercase btn btn-default" value="Submit" />
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                </div>
        
            </div>
        </div>
    </div>
</form>

<!-- modal for return add and edit -->
<form method="post" id="frm_return_cu" class="form-horizontal ">
    @csrf
    <div class="modal fade" id="modal_return_cu" tabindex="-1" role="dialog"  data-keyboard="false" data-backdrop="static" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title modal_return_cu_title text-white" >Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div id="loading-containermodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    
                    <div id="modalbody" class="modalbody row">
                        <div class="col-sm-12">
                            <label class="control-label text-uppercase" >Type Of Return<span class="text-danger">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input type_of_return" type="radio" id="empty" name="type_of_return" value="EMPTY" checked>
                                <label class="form-check-label" for="empty">EMPTY</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input type_of_return" type="radio" id="full" name="type_of_return" value="FULL">
                                <label class="form-check-label" for="full">FULL</label>
                            </div>
                            <br>
                            <br>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label text-uppercase" >Product Code/Desc:<span class="text-danger">*</span></label>
                                <select name="product_id" id="product_id" class="form-control select2">
                                    <option value="">Select Product</option>
                                    @foreach ($product_codes as $product_code)
                                        <option value="{{$product_code->id}}">{{$product_code->product_code}} / {{$product_code->description}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_id"></strong>
                                </span>
                                
                            </div>
                        </div>
                        
                        <div class="col-sm-6" id="status_container">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Status:<span class="text-danger">*</span> </label> 
                                <select name="status_id" id="status_id" class="form-control select2">
                                    @foreach ($status as $sp)
                                        <option value="{{$sp->id}}" class="text-uppercase">{{$sp->title}}  </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-status_id"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Unit Price:<span class="text-danger">*</span> </label>
                                <input type="number" name="unit_price" id="unit_price" step="any" class="unit_price form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-unit_price"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Return QTY:<span class="text-danger">*</span> </label>
                                <input type="number" name="return_qty" id="return_qty" class="return_qty form-control" step="any"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-return_qty"></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Remarks: </label>
                                <textarea name="remarks_return" id="remarks_return" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-remarks_return"></strong>
                                </span>
                            </div>
                        </div>

                    
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="return_action" id="return_action" value="Add" />
                <input type="hidden" name="return_hidden_id" id="return_hidden_id" />
                <input type="hidden" name="salesinvoice_id_return" id="salesinvoice_id_return" value="{{$salesinvoice_id}}"/>
                <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal">Close</button>
                <input type="submit" name="btn_submit_return" id="btn_submit_return" class="text-uppercase btn btn-default" value="Submit" />
            </div>
            </div>
        </div>
    </div>
</form>

<!-- modal for View Sales -->
<div class="modal" id="viewsalesModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <p class="modal-title-viewsales font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <div id="viewsales">
                    
                    </div>
               
                <!-- <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" /> -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- PALLETS FORM -->
<form method="post" id="palletForm" class="form-horizontal">
        @csrf
    <div class="modal" id="palletModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="modal-title-pallet font-weight-bold text-uppercase text-white">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Title:<span class="text-danger">*</span></label>
                                <select name="pallet" id="pallet" class="form-control select2">
                                    <option value="1">BIG PALLET</option>
                                    <option value="2">SMALL PALLET</option>
                                    <option value="3">RC PALLET</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Type:<span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control select2">
                                    <option value="BUY">BUY</option>
                                    <option value="RETURN">RETURN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >QTY:<span class="text-danger">*</span></label>
                                <input type="number" name="pallet_qty" id="pallet_qty" class="form-control" step="any" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-pallet_qty"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Unit Price:<span class="text-danger">*</span></label>
                                <input type="number" name="pallet_unit_price" id="pallet_unit_price" class="form-control" step="any" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-pallet_unit_price"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <input type="hidden" name="action_pallet" id="action_pallet" value="SALES" />
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                    <input type="submit" name="pallet_button" id="pallet_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>

<!-- DEPOSIT FORM -->
<form method="post" id="depositForm" class="form-horizontal">
        @csrf
    <div class="modal" id="depositModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="font-weight-bold text-uppercase text-white">Deposit</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                            <label class="control-label text-uppercase" >Product Code/Stocks:<span class="text-danger">*</span></label>
                                <select name="product_deposit" id="product_deposit" class="form-control select2">
                                    <option value="">Select Product</option>
                                    @foreach ($product_deposits as $product_code)
                                        <option value="{{$product_code->product->id}}">
                                            {{$product_code->product->product_code}} / 
                                            Empties({{$product_code->empties_qty()}})
                                            Shells({{$product_code->shells_qty()}})
                                            Bottles({{$product_code->bottles_qty()}})
                                            
                                        </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_deposit"></strong>
                                </span>
                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Status:<span class="text-danger">*</span> </label> 
                                <select name="status_deposit" id="status_deposit" class="form-control select2">
                                    @foreach ($status as $sp)
                                        <option value="{{$sp->id}}" class="text-uppercase">{{$sp->title}}  </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-status_deposit"></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >QTY:<span class="text-danger">*</span> </label>
                                <input type="number" name="qty_deposit" id="qty_deposit" class="form-control" step="any"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-qty_deposit"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Unit Price:<span class="text-danger">*</span> </label>
                                <input type="number" name="unit_price_deposit" id="unit_price_deposit" step="any" class="form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-unit_price_deposit"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Remarks:</label>
                                <input type="text" name="remarks_deposit" id="remarks_deposit" class="form-control"/>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">CLOSE</button>
                    <input type="submit" id="deposit_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>

<div id="success-order" class="success-order col-4 alert text-white fade hide fixed-bottom" style="margin-left: 65%; z-index: 9999;" role="alert">
    
</div>


<div id="success-checkout" class="success-order col-4 alert text-white fade hide fixed-bottom" style="margin-left: 65%; z-index: 9999;" role="alert">

</div>

    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
@endsection

@section('script')
<script>

$(function () {
    return loadSales() , loadReturn() ,pallets_table(), deposits_table() , loadAllTotal();
    
});

function loadSales(){
    $.ajax({
        url: "salesInvoice-sales", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $(".loadingSales").text('Loading Sales...');
        },
        success: function(response){
            $(".loadingSales").text('Sales');
            $('#action_salesinvoice').val('compute');
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Compute");
            $("#loadsales").html(response);
        }	
    })
}

function loadReturn(){
    $.ajax({
        url: "salesInvoice-return", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $(".loadingReturn").text('Loading Return...');
        },
        success: function(response){
            $(".loadingReturn").text('Return');
            $('#action_salesinvoice').val('compute');
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Compute");
            $("#loadreturn").html(response);
        }	
    })
}

function pallets_table(){
    $.ajax({
        url: "/admin/sales_pallets/spallets_table", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {

        },
        success: function(response){
            $("#pallets_table").html(response);
        }	
    })
}

function deposits_table(){
    $.ajax({
        url: "salesInvoice-deposits", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {

        },
        success: function(response){
            $("#deposits_table").html(response);
        }	
    })
}

function loadAllTotal(){
    $.ajax({
        url: "salesInvoice-alltotal", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $(".title-head").text('Loading...');
        },
        success: function(response){
            $(".title-head").text('SALES INVOICE');
            $("#alltotal").html(response);
            customer();
        }	
    })
}

//accounte receivables
function receivables(){
    if($('input[name="receivables"]').is(':checked'))
    {
        var customer = $('#customer_id').val();
            var new_bal = $('#new_bal').val();
            $.ajax({
                url: "salesInvoice-receivables", 
                type: "get",
                dataType: "json",
                data: { customer:customer, new_bal:new_bal, _token: '{!! csrf_token() !!}'},
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

//show return modal

function loadProductList(){
    $.ajax({
        url: "/admin/salesInvoice-productlist", 
        type: "get",
        data: {_token: '{!! csrf_token() !!}'},
        dataType: "json",
        beforeSend: function() {
            $('.modal-title-productlist').text('Loading Product...');
        },
        success: function(data){
            $('.modal-title-productlist').text('Choose a Product');
            var list = '';
            $.each(data.data, function(key,value){
                list += '<tr>';
                    list += '<td>';
                        list += '<button type="button" id="order" name="order" order="'+value.product_id+'" class="text-uppercase order btn btn-info btn-sm">Order</button>';
                    list += '</td>';
                    list += '<td>';
                        list += value.product;
                    list += '</td>';
                    list += '<td>';
                        list += value.size;
                    list += '</td>';
                    list += '<td>';
                        list += value.supplier;
                    list += '</td>';
                    list += '<td>';
                        list += value.category;
                    list += '</td>';
                    list += '<td>';
                        list += value.expiration;
                    list += '</td>';
                    list += '<td>';
                        list += value.selling_area_stock;
                    list += '</td>';
                    list += '<td>';
                        list += value.orders;
                    list += '</td>';
                    list += '<td>';
                        list += value.sold;
                    list += '</td>';
                    
                list += '</tr>';
            });
            $('#list_product_list').empty().append(list);
            $('#datatable-productlist').DataTable({
                bDestroy: true,
                responsive: true,
                scrollY: 400,
                scrollCollapse: true,
                buttons: [
                
                ],
            });
        }	
    })
}

$('select[name="category_filter"]').on('change', function () {
    $('#datatable-productlist').DataTable().columns(4).search( this.value ).draw();
});
$('select[name="supplier_filter"]').on('change', function () {
    $('#datatable-productlist').DataTable().columns(3).search( this.value ).draw();
});
$('select[name="size_filter"]').on('change', function () {
    $('#datatable-productlist').DataTable().columns(2).search( this.value ).draw();
});

$(document).on('click', '#create_sales', function(){
    $('#productlistModal').modal('show');
    loadProductList();

});


$(document).on('click', '#all_records_btn', function(){
    window.location.href = '/admin/salesInvoice/salesInvoice/allrecords';
});



//modal for return
$(document).on('click', '#create_return', function(){
    $('#modal_return_cu').modal('show');
    $('.modal_return_cu_title').text('INSERT RETURN');
    $('#frm_return_cu')[0].reset();
    $('.form-control').removeClass('is-invalid')

   
    $('#btn_submit_return').val('Submit');
    $('#return_action').val('Add');
    $('#loading-containermodal').hide();
    $('#status_container').show();
});

//Store Return
$('#frm_return_cu').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.salesReturn.store') }}";
    var type = "POST";

    if($('#return_action').val() == 'Edit'){
        var id = $('#return_hidden_id').val();
        action_url = "salesReturn/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#btn_submit_return").attr("disabled", true);
            $("#btn_submit_return").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $('#modalbody').hide();
        },
        success:function(data){
            $('#loading-containermodal').hide();
            $('#modalbody').show();

            if($('#return_action').val() == 'Edit'){
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Update");
            }else{
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Submit");
            }

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                    if(key == 'product_id'){
                        $('#error-product_id').text('Invalid Product')
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
              
                $('#modal_return_cu').modal('hide');
                return loadReturn() , loadAllTotal();
                
            }
           
        }
    });
});

function parseCurrency( num ) {
    return parseFloat( num.replace( /,/g, '') );
}
let formatNumber = Intl.NumberFormat('en-US', {
    style: "currency",
    currency: "PHP",
});

//show print modal
function printmodal(){
    $('#receiptModal').modal('show');
    $.ajax({
        url: "salesInvoice-receipt", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-receipt').text('Loading Receipt...');
            $("#print_button").attr("disabled", true);
            $("#print_button").attr("value", "Loading..");
            $("#receiptcontent").hide();
        },
        success: function(response){
            var new_bal = "";
            var change = "";
            if($('input[name="receivables"]').is(':checked')){
                new_bal = $('#new_bal').val();
                var prev_bal = parseCurrency($('#current_balance').val());
                var change1 = parseCurrency($('#change').val());;
                    change = change1 - prev_bal;
                    if(change < 0 ){
                        change = 0;
                    }
            }else{
                new_bal = $('#current_balance').val();
                change = $('#change').val();
            }

            $('.modal-title-receipt').text('Print Receipt');
            $("#print_button").attr("disabled", false);
            $('#print_button').val('Print & Save');
            
            $("#receiptcontent").show();
            $("#receiptcontent").html(response);
            $('#total_bal').html('₱ '+ $('#current_balance').val() + '<br> ₱  ' + new_bal)
            $('#changereceipt').text(formatNumber.format(change));
            $('#over_payment_reciept').text('₱ '+$('#over_payment').val())
        }	
    })
}


$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')

    var action_url = "{{ route('admin.salesInvoice.compute') }}";
    var type = "GET";

    if($('#action_salesinvoice').val() == 'submit'){
        var action_url = "{{ route('admin.salesInvoice.store') }}";
        var type = "POST";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
        },
        success:function(data){
            if($('#action_salesinvoice').val() == 'submit'){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Submit");
            }else{
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Compute");
            }

            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                        window.location.href = '#'+key;
                    }
                    if(key == 'receivables'){
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
                                        $('input[name="receivables"]').prop('checked', true);
                                        $('input[name="over_payment_checkbox"]').prop('checked', false);
                                    }
                                },
                            }
                        });
                    }
                 
                })
            }
            if(data.maxstock){
                $.alert({
                    title: 'Error Message',
                    content: data.maxstock,
                    type: 'red',
                })  
            }
            if(data.submit){
                $('#action_salesinvoice').val(data.submit);
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Submit");
                $('#change').val(data.change);
                $('#new_bal').val(data.new_bal);
                $('#over_payment').val(data.over_payment);
            }
            if(data.print){
                
                printmodal();
                
            }
           
           
        }
    });
   
   
});

$(document).on('click', '#btn_receipt', function(){
        $('#receipt-body').removeClass('receipt-body');
        var contents = $("#receiptreport").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Title</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="/assets/css/argon.css" rel="stylesheet" type="text/css" />');
        // frameDoc.document.write('<style>size: A4 portrait;</style>');
        var source = 'bootstrap.min.js';
        var script = document.createElement('script');
        script.setAttribute('type', 'text/javascript');
        script.setAttribute('src', source);
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
        }, 500);
        $('#receipt-body').addClass('receipt-body');
});

$(document).on('click', '#print_button', function(){
    $('.form-control').removeClass('is-invalid')
    var doc_no = $('#doc_no').val();
    var entry_date = $('#entry_date').val();
    var remarks = $('#remarks').val();
    var customer_id = $('#customer_id').val();
    var deliver_id = $('#deliver_id').val();
    var prev_bal = $('#current_balance').val();
    var new_bal = $('#new_bal').val();
    var cash = $('#cash').val();
    var receivables1 = '';
    var isOverPayment = '';
    var over_payment = $('#over_payment').val();

    if($('input[name="receivables"]').is(':checked')){
        receivables1 = 1;
    }else{
        receivables1 = 0;
    }
    if($('input[name="over_payment_checkbox"]').is(':checked')){
        isOverPayment = 1;
    }else{
        isOverPayment = 0;
    }
   
    var action_url = "{{ route('admin.salesInvoice.storeandcheckout') }}";
    var type = "GET";
    $.ajax({
        url: action_url,
        method:type,
        data:{
              over_payment:over_payment,
              isOverPayment:isOverPayment,
              receivables:receivables1,
              new_bal:new_bal,
              doc_no:doc_no, 
              entry_date:entry_date, 
              remarks:remarks, 
              customer_id:customer_id, 
              deliver_id:deliver_id,
              prev_bal:prev_bal, 
              cash:cash, 
              _token:'{!! csrf_token() !!}'},
        dataType:"json",
        beforeSend:function(){
            $("#print_button").attr("disabled", true);
            $("#print_button").attr("value", "Printing & Saving..");
        },
        success:function(data){
            $("#print_button").attr("disabled", false);
            $("#print_button").attr("value", "Print & Save");
            
            if(data.success){
                $("#btn_receipt").click();

                $('#success-checkout').addClass('bg-primary');
                $('#success-checkout').html('Click <a href="/admin/transactions" class="btn-white btn btn-sm">HERE</a> To view your trasaction' );
                $("#success-checkout").fadeTo(10000, 500).slideUp(500, function(){
                    $("#success-checkout").slideUp(500);
                });
                $('#receiptModal').modal('hide');
                $('.form-control').removeClass('is-invalid');
                
                loadSales() , loadReturn(), pallets_table() ,deposits_table(), loadAllTotal() , receivables();;
            }
           
        }
    });
});

$(document).on('click', '.editreturn', function(){
    $('#allrecordsreturnModal').modal('hide');
    $('#modal_return_cu').modal('show');
    $('.modal_return_cu_title').text('EDIT RETURN');

    
    $('#frm_return_cu')[0].reset();
    $('.form-control').removeClass('is-invalid')

    var id = $(this).attr('editreturn');

    $.ajax({
        url :"/admin/salesReturn/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#btn_submit_return").attr("disabled", true);
            $("#btn_submit_return").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $('#modalbody').hide();
            
        },
        success:function(data){
            $('#loading-containermodal').hide();
            $('#modalbody').show();
            if($('#return_action').val() == 'Edit'){
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Update");
            }else{
                $("#btn_submit_return").attr("disabled", false);
                $("#btn_submit_return").attr("value", "Submit");
            }
            
            $.each(data.result, function(key,value){
                if(key == 'return_qty'){
                    $("#return_qty").val(value)
                }
                if(key == 'unit_price'){
                    $("#unit_price").val(value)
                }
                if(key == 'product_id'){
                    $("#product_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
                if(key == 'status_id'){
                    $("#status_id").select2("trigger", "select", {
                        data: { id: value }
                    });
                }
              
                if(key == 'type_of_return'){
                    if(value == 'FULL'){
                        $('#status_container').hide();
                    }else{
                        $('#status_container').show();
                    }
                    $("input[name=type_of_return]").val([value]);
                }
                if(key == 'remarks'){
                    $('#remarks_return').val(value)
                }
            })
            
            $('#return_hidden_id').val(id);
            $('#btn_submit_return').val('Update');
            $('#return_action').val('Edit');
        }
    })
});

$(document).on('click', '.removereturn', function(){
  var id = $(this).attr('removereturn');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this Record?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/salesReturn/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $("#action_button").attr("disabled", true);
                        $("#action_button").attr("value", "Loading...");
                      },
                      success:function(data){
                        $("#action_button").attr("disabled", false);
                        $("#action_button").attr("value", "Submit");
                        if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            return loadReturn() , loadAllRecordReturn() , loadAllTotal();;
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

//return amt automatic
$('select[name="product_id"]').on("change", function(event){
    var product_id = $(this).val();
    var tor = $('input[name="type_of_return"]:checked').val();
    var _token = $('input[name="_token"]').val();
    
    if($('#return_action').val() == 'Add'){
            $.ajax({
                url: "/admin/salesReturn/product/return_amount", 
                type: "get",
                dataType:"json",
                data: {
                product_id:product_id,tor:tor,_token: '{!! csrf_token() !!}',
                },
                beforeSend: function() {
                    $("#btn_submit_return").attr("disabled", true);
                    $("#btn_submit_return").attr("value", "Loading..");
                },
                success: function(data){
                    $("#btn_submit_return").attr("disabled", false);
                    $("#btn_submit_return").attr("value", "Submit");
                    if(data.unit_price){
                        $('#unit_price').val(data.unit_price)
                    }
                }	
            });
    }
   
      
});

//Type of return
$('input[name="type_of_return"]').on("change", function(event){
    var tor = $(this).val();
    $('#product_id').trigger('change'); 
    if(tor == 'FULL'){
        $('#status_container').hide();
        $('#unit_price').val(null);
    }else{
        $('#status_container').show();
        $('#unit_price').val(null);
    }
});

//view order
$(document).on('click', '#order', function(){
    $('#orderModal').modal('show');
    $('#modalbody-edit').hide();
    $('#loading-productmodal').hide();
    $('#orderForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    var id = $(this).attr('order');
    $.ajax({
        url: "/admin/sales_inventory/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button_order").attr("disabled", true);
            $("#action_button_order").attr("value", "Loading..");
            $('.modal-title-order').text('Loading Order...');

            $('#modalbody-view').hide();
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#loading-productmodal').hide();
            $('#modalbody-view').show();
            
            $("#action_button_order").attr("disabled", false);
            $("#action_button_order").attr("value", "Order");
            $('.modal-title-order').text('View Order');
            $('#order_hidden_id').val(id)
            $('#order_action').val('Add');
           
            $("#modalbody-view").html(response);
            $('#purchase_qty').focus();
        }
    })
});

//addtocart 
$('#orderForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var id = $('#order_hidden_id').val();
    var action_url = "/admin/addtocart/" + id;
    var type = "POST";
    if($('#order_action').val() == 'Edit'){
        id = $('#order_hidden_id').val();
        action_url = "/admin/orders/" + id;
        type = "POST";
    }
    
    $.ajax({
        url: action_url,
        method:type,
        dataType:"json",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $("#action_button_order").attr("disabled", true);
            $("#action_button_order").attr("value", "Loading..");
            $('.modal-title-order').text('Loading Order...');
        },
        success:function(data){
            $("#action_button_order").attr("disabled", false);
            $("#action_button_order").attr("value", "Order");
            $('.modal-title-order').text('View Order');
            if(data.errors){
               $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.nostock){
                $('#purchase_qty').addClass('is-invalid')
                $('#error-purchase_qty').text(data.nostock)
                $('#purchase_qty_edit').addClass('is-invalid')
                $('#error-purchase_qty_edit').text(data.nostock)
            }
            if(data.expiration){
                $('#purchase_qty').addClass('is-invalid')
                $('#error-purchase_qty').text(data.expiration)
                $('#purchase_qty_edit').addClass('is-invalid')
                $('#error-purchase_qty_edit').text(data.expiration)
            }
            if(data.expirationtoday){
                $('#purchase_qty').addClass('is-invalid')
                $('#error-purchase_qty').text(data.expirationtoday)
                $('#purchase_qty_edit').addClass('is-invalid')
                $('#error-purchase_qty_edit').text(data.expirationtoday)
            }
            if(data.maxstock){
                $('#purchase_qty').addClass('is-invalid')
                $('#error-purchase_qty').text(data.maxstock) 
                $('#purchase_qty_edit').addClass('is-invalid')
                $('#error-purchase_qty_edit').text(data.maxstock) 
            }
            
            if(data.success){
                $('#orderModal').modal('hide');

                $('.form-control').removeClass('is-invalid');

                $('#success-order').addClass('bg-primary');
                $('#success-order').html('<strong>' + data.success + '</strong>' );
                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                    $("#success-order").slideUp(500);
                });
                loadSales();
                loadAllTotal();
            }
            
        }
    });
});

//edit modal
$(document).on('click', '.editorder', function(){
    $('#orderModal').modal('show');
    $('#modalbody-view').hide();
    $('#loading-productmodal').hide();
    $('#orderForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    var id = $(this).attr('editorder');
    
    $.ajax({
        url: "/admin/orders/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button_order").attr("disabled", true);
            $("#action_button_order").attr("value", "Loading..");
            $('.modal-title-order').text('Loading Order...');

            $('#modalbody-edit').hide();           
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#loading-productmodal').hide();
            $('#modalbody-edit').show();

            $("#action_button_order").attr("disabled", false);
            $("#action_button_order").attr("value", "Update");
            $('.modal-title-order').text('Update Order');

            $('#order_hidden_id').val(id);
            $('#order_action').val('Edit');
            $("#modalbody-edit").html(response);
           
        }
    })
});

//remove
$(document).on('click', '.remove-order', function(){
    var id = $(this).attr('removeorder');
    $.confirm({
        title: 'Confirmation',
        content: 'You really want to remove this order?',
        type: 'red',
        buttons: {
            confirm: {
                text: 'confirm',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                    return $.ajax({
                        url:"/admin/orders/"+id,
                        method:'DELETE',
                        data: {
                            _token: '{!! csrf_token() !!}',
                        },
                        dataType:"json",
                        beforeSend:function(){
                            $("#action_button").attr("disabled", true);
                            $("#action_button").attr("value", "Loading...");
                        },
                        success:function(data){
                            if(data.success){
                                $("#action_button").attr("disabled", false);
                                $("#action_button").attr("value", "Submit");

                                $('#success-alert').addClass('bg-primary');
                                $('#success-alert').html('<strong>' + data.success + '</strong>');
                                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                    $("#success-alert").slideUp(500);
                                });
                                return loadProductList() , loadSales() , loadAllTotal();
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


//select customer
function customer(){
    var customer = $('#customer_id').val();
    $.ajax({
    url:"ordering/" +customer+ "/customer",
    method:"GET",
    dataType:"json",
        success:function(data){
            $('#sold_to_receipt').text(data.name)
            $('#area_receipt').text(data.area)
            $('#current_balance').val(data.balance)
            $('#over_payment').val(data.over_payment)
            $('#doc_number_receipt').text($("#doc_no").val());
        }
    });
}

$('select[name="customer_id"]').on("change", function(event){
 
    customer();
    $('#action_salesinvoice').val('compute');
    $("#action_button").attr("disabled", false);
    $("#action_button").attr("value", "Compute");

});

$('select[name="deliver_id"]').on("change", function(event){
    $('#assign_to_receipt').text($("#deliver_id option:selected").text());
});


// load all records for returned
function loadAllRecordReturn(){
    $.ajax({
        url: "salesInvoice-allreturn", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-allrecordsreturn').text('Loading Records...');
         
        },
        success: function(response){
            $('.modal-title-allrecordsreturn').text('All Returned Records');
            $("#allrecordsreturn").html(response);
        }	
    })
}

/// All Records Return
$(document).on('click', '#all_record_return', function(){
    $('#allrecordsreturnModal').modal('show');
    return loadAllRecordReturn();
});


//View Sales
$(document).on('click', '.viewsales', function(){
    var id = $(this).attr('viewsales');
    $('#viewsalesModal').modal('show');
    $.ajax({
        url: "salesInvoice/" + id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.modal-title-viewsales').text('Loading Sales...');
         
        },
        success: function(response){
            $('.modal-title-viewsales').text('All Sales');
            $("#viewsales").html(response);
        }	
    })
});


// Pallets
$(document).on('click', '#create_pallet', function(){
    $('#palletModal').modal('show');
    $('#palletForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-pallet').text('Insert Pallet');
    $('#pallet_button').val('Submit');
    $('#pallet_action').val('Add');
    $('#pallet').trigger('change'); 
    $('#type').trigger('change'); 
});

$('select[name="pallet"]').on("change", function(event){
    $pallet = $("#pallet").val();
    $.ajax({
        url :"/admin/receiving/rpallet/"+$pallet+"/unit_price",
        dataType:"json",
        beforeSend:function(){
            $('#pallet_button').attr('disabled', true);
        },
        success:function(data){
           if(data.unit_price){
                $('#pallet_button').attr('disabled', false);
                $('#pallet_unit_price').val(data.unit_price);
           }
        }
    })
});

$('#palletForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.receiving.store_rpallet') }}";
    var type = "POST";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $('#pallet_button').attr('disabled', true);
        },
        success:function(data){
            $('#pallet_button').attr('disabled', false);
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.max_stock){
                $('#pallet_qty').addClass('is-invalid');
                $('#error-pallet_qty').text(data.max_stock);
            }
            if(data.success){
                $('#palletModal').modal('hide');

                $('.form-control').removeClass('is-invalid');

                $('#success-order').addClass('bg-primary');
                $('#success-order').html('<strong>' + data.success + '</strong>' );
                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                    $("#success-order").slideUp(500);
                });
                pallets_table();
                loadAllTotal();
            }
        }
    });
});

$(document).on('click', '.edit_pallet', function(){
    $('#palletModal').modal('show');
    $('.modal-title-pallet').text('Edit Pallet');
    $('#palletForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    var id = $(this).attr('edit_pallet');
    var action_pallet = "SALES";

    $.ajax({
        url :"/admin/receiving/rpallet/"+id+"/edit",
        dataType:"json",
        data: {action_pallet:action_pallet,_token: '{!! csrf_token() !!}'},
        beforeSend:function(){
            $('#pallet_button').attr('disabled', true);
        },
        success:function(data){
            $('#pallet_button').attr('disabled', false);
            $.each(data.data, function(key,value){
                    if(key == 'pallet_id'){
                        $('#pallet').val(value);
                        $('#pallet').trigger('change'); 
                    }
                    if(key == 'type'){
                        $('#type').val(value);
                        $('#type').trigger('change'); 
                    }
                    if(key == 'qty'){
                        $('#pallet_qty').val(value);
                    }
                    if(key == 'unit_price'){
                        $('#pallet_unit_price').val(value);
                    }
            })
        }
    })
});

$(document).on('click', '.remove_pallet', function(){
    var id = $(this).attr('remove_pallet');

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
                      url:"/admin/sales_pallets/spallet/"+ id,
                      method:'DELETE',
                      data: {_token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        
                      },
                      success:function(data){
                          if(data.success){
                                $('#success-order').addClass('bg-primary');
                                $('#success-order').html('<strong>' + data.success + '</strong>' );
                                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                                    $("#success-order").slideUp(500);
                                });
                                pallets_table();
                                loadAllTotal();
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


//DEPOSIT

// Pallets
$(document).on('click', '#create_deposit', function(){
    $('#depositModal').modal('show');
    $('#depositForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
});

$('#depositForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.deposits.store') }}";
    var type = "POST";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $('#deposit_button').attr('disabled', true);
        },
        success:function(data){
            $('#deposit_button').attr('disabled', false);
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.max_stock){
                $('#qty_deposit').addClass('is-invalid');
                $('#error-qty_deposit').text(data.max_stock);
            }
            if(data.success){
                $('#depositModal').modal('hide');

                $('.form-control').removeClass('is-invalid');

                $('#success-order').addClass('bg-primary');
                $('#success-order').html('<strong>' + data.success + '</strong>' );
                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                    $("#success-order").slideUp(500);
                });
                deposits_table();
                loadAllTotal();
            }
        }
    });
});

$(document).on('click', '.edit_deposit', function(){
    $('#depositModal').modal('show');
    $('#depositForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    var id = $(this).attr('edit_deposit');

    $.ajax({
        url :"/admin/deposits/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $('#deposit_button').attr('disabled', true);
        },
        success:function(data){
            $('#deposit_button').attr('disabled', false);
            $.each(data.data, function(key,value){
                    if(key == 'product_id'){
                        $('#product_deposit').val(value);
                        $('#product_deposit').trigger('change'); 
                    }
                    if(key == 'status_id'){
                        $('#status_deposit').val(value);
                        $('#status_deposit').trigger('change'); 
                    }
                    if(key == 'qty'){
                        $('#qty_deposit').val(value);
                    }
                    if(key == 'unit_price'){
                        $('#unit_price_deposit').val(value);
                    }
                    if(key == 'remarks'){
                        $('#remarks_deposit').val(value);
                    }
            })
        }
    })
});

$(document).on('click', '.remove_deposit', function(){
    var id = $(this).attr('remove_deposit');

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
                      url:"/admin/deposits/"+ id,
                      method:'DELETE',
                      data: {_token: '{!! csrf_token() !!}'},
                      dataType:"json",
                      beforeSend:function(){
                        
                      },
                      success:function(data){
                          if(data.success){
                                $('#success-order').addClass('bg-primary');
                                $('#success-order').html('<strong>' + data.success + '</strong>' );
                                $("#success-order").fadeTo(10000, 500).slideUp(500, function(){
                                    $("#success-order").slideUp(500);
                                });
                                deposits_table();
                                loadAllTotal();
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

// OVer payment check box
$(document).on('click', '#over_payment_checkbox', function(){
    $('#action_salesinvoice').val('compute');
    $("#action_button").attr("disabled", false);
    $("#action_button").attr("value", "Compute");
});

// OVer payment check box
$(document).on('click', '#receivables', function(){
    $('#action_salesinvoice').val('compute');
    $("#action_button").attr("disabled", false);
    $("#action_button").attr("value", "Compute");
});



</script>
@endsection
