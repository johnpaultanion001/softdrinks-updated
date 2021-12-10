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
   


    //sales
    Route::get('sales', 'SalesController@index')->name('sales.index');
    Route::get('loadsales', 'SalesController@loadsales')->name('sales.loadsales');
    Route::get('sales-daily', 'SalesController@daily')->name('sales.daily');
    Route::get('sales-monthly', 'SalesController@monthly')->name('sales.monthly');
    Route::get('sales-yearly', 'SalesController@yearly')->name('sales.yearly');
    Route::post('salesfilter', 'SalesController@filter')->name('sales.filter');
    Route::post('/daterange/fetch_data', 'SalesController@fetch_data')->name('daterange.fetch_data');
    Route::get('sales/{sale}', 'SalesController@receipt')->name('sales.receipt');

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


    
   

    //return Products
    // Route::resource('returned', 'ReturnedController');
    // route::get('loadreturningproduct', 'ReturnedController@loadreturningproduct')->name('loadreturningproduct');
   
    // route::get('returned/{returned}/loadreturnedproduct', 'ReturnedController@loadreturnedproduct')->name('purchase-order.loadreturnedproduct');
    // route::get('loadreturned', 'ReturnedController@loadreturned')->name('purchase-order.loadreturned');
    // route::get('returned/{returned}/viewreturn', 'ReturnedController@viewreturn')->name('returned.viewreturn');

    
    // Route::resource('returned/pendingreturnedproducts', 'PendingReturnedProductController');
    // route::post('returned/pendingreturnedproducts/update', 'PendingReturnedProductController@storeedit')->name('pendingreturnedproducts.storeedit');
    // route::put('returned/pendingreturnedproducts/update/{pendingreturnedproduct}', 'PendingReturnedProductController@updateedit')->name('pendingreturnedproducts.updateedit');
    // route::delete('returned/pendingreturnedproducts/update/{pendingreturnedproduct}', 'PendingReturnedProductController@destroyedit')->name('pendingreturnedproducts.destroyedit');

    // Route::get('loadreturningproduct', 'PendingReturnedProductController@loadreturningproduct')->name('loadreturningproduct');
    // Route::resource('returningproduct', 'PendingReturnedProductController');

    //status returned
    Route::resource('status-return', 'StatusReturnController');
    route::get('loadstatus', 'StatusReturnController@load')->name('status-return.load');


    // Route::resource('purchase-order/pending-product', 'SalesInventory');
    // route::get('loadpendingproduct', 'SalesInventory@load')->name('pending-prooduct.load');
    // //autocomplte
    // Route::post('autocomplete/','SalesInventory@autocomplete')->name('pending-product.autocomplete');
    // Route::post('autocomplete/result','SalesInventory@autocompleteresult')->name('pending-product.autocompleteresult');

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
    route::get('location_transfer/{location}/from', 'LocationTransferController@locationfrom')->name('locationtransfer.locationfrom');
    route::get('location_transfer/{location}/to', 'LocationTransferController@locationto')->name('locationtransfer.locationto');

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
    Route::get('salesInvoice-allrecords','SalesInvoiceController@allrecords')->name('salesInvoice.allrecords');
    Route::get('salesInvoice-sales_receipt/{sales_receipt}', 'SalesInvoiceController@sales_receipt')->name('salesInvoice.sales_receipt');
    Route::delete('salesInvoice-void/{salesInvoice}','SalesInvoiceController@void')->name('salesInvoice.void');
    Route::post('addtocart/{sales_inventory}',  'SalesInvoiceController@addtocart')->name('salesInvoice.addtocart');

    //Sales Inventory
    Route::resource('sales_inventory', 'SalesInventoryController');
    route::get('load_products', 'SalesInventoryController@load')->name('sales_inventory.load');
    Route::post('autocomplete/','SalesInventoryController@autocomplete')->name('sales_inventory.autocomplete');
    Route::post('autocomplete/result','SalesInventoryController@autocompleteresult')->name('sales_inventory.autocompleteresult');
    route::get('size_status', 'SalesInventoryController@size_status')->name('sales_inventory.size_status');
    route::get('sales_inventory/{sales_inventory}/edit_view', 'SalesInventoryController@edit_view')->name('sales_inventory.edit_view');
    route::get('sales_inventory/{sales_inventory}/stock_history', 'SalesInventoryController@stock_history')->name('sales_inventory.stock_history');
    route::get('sales_inventory/{sales_inventory}/sales_history', 'SalesInventoryController@sales_history')->name('sales_inventory.sales_history');
    route::put('sales_inventory/{sales_inventory}/update_ev', 'SalesInventoryController@update_ev')->name('sales_inventory.update_ev');

    //Empty Bottles Inventory
    Route::get('empty_bottles_inventory', 'EmptyBottlesInventoryController@index')->name('empty_bottles_inventory.index');
    
    //Receiving Goods
    route::resource('receiving_goods', 'ReceivingGoodController');
    route::get('loadreceivinggoods', 'ReceivingGoodController@load')->name('receiving_goods.load');
    route::get('pending_product', 'ReceivingGoodController@pending_product')->name('receiving_goods.product');
    route::get('total_product', 'ReceivingGoodController@total')->name('receiving_goods.total');
    route::get('reuse', 'ReceivingGoodController@reuse')->name('receiving_goods.reuse');

    //Recieve Return
    route::get('recieve_return', 'ReceivingGoodController@recieve_return')->name('receiving_goods.recieve_return');
    Route::resource('recieve_return', 'RecieveReturnController');

    
    
    
});
