<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('loaddashboard', 'DashboardController@loaddashboard')->name('loaddashboard');

    // Categories
    Route::resource('categories', 'CategoryController');
    // Ordering
    Route::get('ordering', 'OrderingController@getproducts')->name('getproducts');
    Route::get('loadproduct',  'OrderingController@loadproduct');
    Route::get('loadcart',  'OrderingController@loadcart');
    Route::get('cartsbutton',  'OrderingController@cartsbutton');
    Route::get('ordering/{customer}/customer', 'OrderingController@selectcustomer')->name('ordering.selectcustomer');
    Route::get('ordering/{pricetype}/pricetype', 'OrderingController@selectpricetype')->name('ordering.selectpricetype');



    // search product
    Route::get('search','OrderingController@search')->name('search');
    // check out cart
    Route::get('checkout','OrderingController@checkout')->name('checkout');
    Route::post('checkout-order', 'OrderingController@checkout_order')->name('ordering.checkout_order');
   


    //transactions
    Route::get('transactions', 'TransactionController@index')->name('transactions.index');
    Route::get('transactions_load', 'TransactionController@load')->name('transactions.loadsales');
    route::get('transactions_filter', 'TransactionController@filter')->name('transactions.filter');
    //sales remove
    Route::delete('transactions/{sales}', 'TransactionController@destroy_sales')->name('transactions.destroy_sales');


    //order
    Route::delete('orders/{order}', 'OrderController@destroy')->name('order.destroy');
    Route::get('orders/{order}', 'OrderController@show')->name('order.show');
    Route::post('orders/{order}', 'OrderController@update')->name('order.update');

    //graph
    route::get('graph', 'GraphController@index')->name('graph');
    route::get('graph-daily', 'GraphController@daily')->name('graph.daily');
    route::get('graph-monthly', 'GraphController@monthly')->name('graph.monthly');
    route::get('graph-yearly', 'GraphController@yearly')->name('graph.yearly');

    //permission
    route::get('permissions', 'PermissionsController@index')->name('permissions');
    route::get('loadpermissions', 'PermissionsController@load')->name('permissions.load');

    //roles
    Route::resource('roles', 'RolesController');
    route::get('loadroles', 'RolesController@load')->name('roles.load');

    //users
    Route::resource('users', 'UsersController');
    route::get('loadusers', 'UsersController@load')->name('users.load');
    route::get('user/{user}', 'UsersController@usershow')->name('user.usershow');
    route::put('user/{user}', 'UsersController@userupdate')->name('user.userupdate');


    //status returned
    Route::resource('status-return', 'StatusReturnController');
    route::get('loadstatus', 'StatusReturnController@load')->name('status-return.load');

    //suppliers
    Route::resource('suppliers', 'SupplierController');
    route::get('loadsuppliers', 'SupplierController@load')->name('supplier.load');

    
    //sizes
    Route::resource('sizes', 'SizeController');
    route::get('loadsizes', 'SizeController@load')->name('size.load');

     //UCS
     route::get('ucs', 'UCSController@index')->name('ucs.index');
     route::get('loaducs', 'UCSController@load')->name('ucs.load');
     route::put('ucs/backtozero', 'UCSController@backtozero')->name('ucs.backtozero');
     route::get('ucs/allucs', 'UCSController@allucs')->name('ucs.allucs');
     route::get('ucs_filter', 'UCSController@filter')->name('ucs.filter');


    //Categories
    Route::resource('categories', 'CategoryController');
    route::get('loadcategories', 'CategoryController@load')->name('categories.load');

    //Customers
    Route::resource('customers', 'CustomerController');
    route::get('loadcustomers', 'CustomerController@load')->name('customers.load');

    //price type
    Route::resource('price_type', 'PriceTypeController');
    route::get('loadprice_type', 'PriceTypeController@load')->name('price_type.load');


    //Location
    Route::resource('locations', 'LocationController');
    route::get('loadlocations', 'LocationController@load')->name('locations.load');

    //Location Transfer
    Route::resource('location_transfer', 'LocationTransferController');
    route::get('loadllocation_transfer', 'LocationTransferController@load')->name('locationtransfer.load');
    // route::get('location_transfer/{location}/from', 'LocationTransferController@locationfrom')->name('locationtransfer.locationfrom');
    // route::get('location_transfer/{location}/to', 'LocationTransferController@locationto')->name('locationtransfer.locationto');
    route::get('location_transfer/location/products', 'LocationTransferController@products')->name('locationtransfer.products');
    route::get('location_transfer/location/pending_transfer', 'LocationTransferController@pending_transfer')->name('locationtransfer.pending_transfer');
    route::get('location_transfer/location/product', 'LocationTransferController@product')->name('locationtransfer.product');
    //PendingTransfer
    route::post('location_transfer/location/pending_transfer', 'LocationTransferController@store_pending_transfer')->name('locationtransfer.store_pending_transfer');
    route::put('location_transfer/location/pending_transfer/{pending_transfer}', 'LocationTransferController@update_pending_transfer')->name('locationtransfer.update_pending_transfer');
    route::get('location_transfer/location/pending_transfer/{pending_transfer}/edit', 'LocationTransferController@edit_pending_transfer')->name('locationtransfer.edit_pending_transfer');
    

    //Sales Return
    Route::resource('salesReturn', 'SalesReturnController');

    //Sales Invoice
    Route::resource('salesInvoice', 'SalesInvoiceController');
    Route::post('salesInvoice-sales/storeandcheckout','SalesInvoiceController@storeandcheckout')->name('salesInvoice.storeandcheckout');
    Route::get('salesInvoice-sales','SalesInvoiceController@sales')->name('salesInvoice.sales');
    Route::get('salesInvoice-return','SalesInvoiceController@return')->name('salesInvoice.return');
    Route::get('salesInvoice-allreturn','SalesInvoiceController@allreturn')->name('salesInvoice.allreturn');
    Route::get('salesInvoice-productlist','SalesInvoiceController@productlist')->name('salesInvoice.productlist');
    Route::get('salesInvoice-receipt','SalesInvoiceController@receipt')->name('salesInvoice.receipt');
    Route::get('salesInvoice-alltotal','SalesInvoiceController@alltotal')->name('salesInvoice.alltotal');
    Route::get('salesInvoice-change','SalesInvoiceController@change')->name('salesInvoice.change');
    Route::get('salesInvoice-sales_receipt/{sales_receipt}', 'SalesInvoiceController@sales_receipt')->name('salesInvoice.sales_receipt');
    Route::delete('salesInvoice-void/{salesInvoice}','SalesInvoiceController@void')->name('salesInvoice.void');
    Route::post('addtocart/{sales_inventory}',  'SalesInvoiceController@addtocart')->name('salesInvoice.addtocart');
    // Sales invoice all records
    Route::get('salesInvoice/salesInvoice/allrecords','SalesInvoiceController@allrecords')->name('salesInvoice.allrecords');
    Route::get('salesInvoice/salesInvoice/records','SalesInvoiceController@records')->name('salesInvoice.records');
    route::get('salesInvoice/{sales_records}/sales_records', 'SalesInvoiceController@sales_records')->name('salesInvoice.sales_records');
    route::get('salesInvoice/{return_records}/return_records', 'SalesInvoiceController@return_records')->name('salesInvoice.return_records');
    route::get('salesInvoice_filter', 'SalesInvoiceController@filter')->name('salesInvoice.filter');

    //Sales Inventory
    Route::resource('sales_inventory', 'SalesInventoryController');
    route::get('load_products', 'SalesInventoryController@load')->name('sales_inventory.load');
    Route::post('autocomplete/','SalesInventoryController@autocomplete')->name('sales_inventory.autocomplete');
    Route::post('autocomplete/result','SalesInventoryController@autocompleteresult')->name('sales_inventory.autocompleteresult');
    route::get('size_status', 'SalesInventoryController@size_status')->name('sales_inventory.size_status');
    route::get('sales_inventory/{sales_inventory}/edit_view', 'SalesInventoryController@edit_view')->name('sales_inventory.edit_view');
    route::get('sales_inventory/{sales_inventory}/stock_history', 'SalesInventoryController@stock_history')->name('sales_inventory.stock_history');
    route::get('sales_inventory/{sales_inventory}/sales_history', 'SalesInventoryController@sales_history')->name('sales_inventory.sales_history');
    route::get('sales_inventory/{sales_inventory}/location_stocks', 'SalesInventoryController@location_stocks')->name('sales_inventory.location_stocks');
    
    route::put('sales_inventory/{sales_inventory}/update_ev', 'SalesInventoryController@update_ev')->name('sales_inventory.update_ev');

    //Empty Bottles Inventory
    Route::get('empty_bottles_inventory', 'EmptyBottlesInventoryController@index')->name('empty_bottles_inventory.index');
    
    //Receiving Goods
    route::resource('receiving_goods', 'ReceivingGoodController');
    route::get('loadreceivinggoods', 'ReceivingGoodController@load')->name('receiving_goods.load');
    route::get('pending_product', 'ReceivingGoodController@pending_product')->name('receiving_goods.product');
    route::get('total_product', 'ReceivingGoodController@total')->name('receiving_goods.total');
    route::get('reuse', 'ReceivingGoodController@reuse')->name('receiving_goods.reuse');
    route::get('receiving_goods_filter', 'ReceivingGoodController@filter')->name('receiving_goods.filter');

    //Payables
    route::get('supplier_payable', 'PayableReceivingGoodController@supplier_payable')->name('payable.supplier_payable');
    route::get('validation_payable', 'PayableReceivingGoodController@validation_payable')->name('payable.validation_payable');

    

    //Recieve Return
    route::get('recieve_return', 'ReceivingGoodController@recieve_return')->name('receiving_goods.recieve_return');
    Route::resource('recieve_return', 'RecieveReturnController');

    
    
    
});
