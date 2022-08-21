<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    // return what you want
});
Route::get('/migrate-fresh', function() {
    $exitCode = Artisan::call('migrate:fresh --seed');
    // return what you want
});

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
    Route::get('transactions/inventory_report', 'TransactionController@inventory_report')->name('transactions.inventory_report');
    Route::get('transactions/inventory_report_date', 'TransactionController@inventory_report_date')->name('transactions.inventory_report_date');

    Route::get('transactions/assign_deliver_report', 'TransactionController@assign_deliver_report')->name('transactions.assign_deliver_report');
    Route::get('transactions/ending_inventory_report', 'TransactionController@ending_inventory_report')->name('transactions.ending_inventory_report');
    Route::get('transactions/ending_inventory_report_date', 'TransactionController@ending_inventory_report_date')->name('transactions.ending_inventory_report_date');

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
    route::get('sample_graph', 'GraphController@sample_graph')->name('sample_graph');

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
    route::get('location_transfer', 'LocationTransferController@index')->name('location_transfer.index');
    route::post('location_transfer', 'LocationTransferController@store')->name('location_transfer.store');
    route::get('location_transfer/records', 'LocationTransferController@records')->name('location_transfer.records');
    
    route::get('location_transfer/location/products', 'LocationTransferController@products')->name('locationtransfer.products');
    route::get('location_transfer/location/pending_transfer', 'LocationTransferController@pending_transfer')->name('locationtransfer.pending_transfer');
    route::get('location_transfer/location/product', 'LocationTransferController@product')->name('locationtransfer.product');
    //PendingTransfer
    route::post('location_transfer/location/pending_transfer', 'LocationTransferController@store_pending_transfer')->name('locationtransfer.store_pending_transfer');
    route::put('location_transfer/location/pending_transfer/{pending_transfer}', 'LocationTransferController@update_pending_transfer')->name('locationtransfer.update_pending_transfer');
    route::delete('location_transfer/location/pending_transfer/{pending_transfer}', 'LocationTransferController@destroy_pending_transfer')->name('locationtransfer.destroy_pending_transfer');
    route::get('location_transfer/location/pending_transfer/{pending_transfer}/edit', 'LocationTransferController@edit_pending_transfer')->name('locationtransfer.edit_pending_transfer');
    

    //Sales Return
    Route::resource('salesReturn', 'SalesReturnController');
    route::get('salesReturn/product/return_amount', 'SalesReturnController@return_amount')->name('salesReturn.return_amount');
    

    //Sales Invoice
    Route::resource('salesInvoice', 'SalesInvoiceController');
    Route::get('salesInvoice-sales/storeandcheckout','SalesInvoiceController@storeandcheckout')->name('salesInvoice.storeandcheckout');
    Route::get('salesInvoice-sales','SalesInvoiceController@sales')->name('salesInvoice.sales');
    Route::get('salesInvoice-return','SalesInvoiceController@return')->name('salesInvoice.return');
    Route::get('salesInvoice-deposits','SalesInvoiceController@deposits')->name('salesInvoice.deposits');
    Route::get('salesInvoice-allreturn','SalesInvoiceController@allreturn')->name('salesInvoice.allreturn');
    Route::get('salesInvoice-productlist','SalesInvoiceController@productlist')->name('salesInvoice.productlist');
    Route::get('salesInvoice-receipt','SalesInvoiceController@receipt')->name('salesInvoice.receipt');
    Route::get('salesInvoice-alltotal','SalesInvoiceController@alltotal')->name('salesInvoice.alltotal');
    Route::get('salesInvoice-sales_receipt/{sales_receipt}', 'SalesInvoiceController@sales_receipt')->name('salesInvoice.sales_receipt');
    Route::post('addtocart/{sales_inventory}',  'SalesInvoiceController@addtocart')->name('salesInvoice.addtocart');
    route::get('salesInvoice-compute', 'SalesInvoiceController@compute')->name('salesInvoice.compute');
    
    route::get('salesInvoice-receivables', 'SalesInvoiceController@receivables')->name('salesInvoice.receivables');

    Route::delete('salesInvoice/{salesInvoice}/void','SalesInvoiceController@void')->name('salesInvoice.void');

    
    // Sales invoice all records
    Route::get('salesInvoice/salesInvoice/allrecords','SalesInvoiceController@allrecords')->name('salesInvoice.allrecords');
    Route::get('salesInvoice/salesInvoice/records','SalesInvoiceController@records')->name('salesInvoice.records');
    route::get('salesInvoice/{sales_records}/sales_records', 'SalesInvoiceController@sales_records')->name('salesInvoice.sales_records');
    route::get('salesInvoice/{return_records}/return_records', 'SalesInvoiceController@return_records')->name('salesInvoice.return_records');
    route::get('salesInvoice/{pallet}/pallets_records', 'SalesInvoiceController@pallets_records')->name('salesInvoice.pallets_records');
    route::get('salesInvoice/{deposit}/deposits_records', 'SalesInvoiceController@deposits_records')->name('salesInvoice.deposits_records');
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
    Route::delete('sales_inventory/remove/remove_all', 'SalesInventoryController@remove_all')->name('sales_inventory.remove_all');

    //Empty Bottles Inventory
    Route::get('empty_bottles_inventory', 'EmptyBottlesInventoryController@index')->name('empty_bottles_inventory.index');
    
    //Receiving Goods
    route::resource('receiving_goods', 'ReceivingGoodController');
    route::get('loadreceivinggoods', 'ReceivingGoodController@load')->name('receiving_goods.load');
    route::get('pending_product', 'ReceivingGoodController@pending_product')->name('receiving_goods.product');
    route::get('total_product', 'ReceivingGoodController@total')->name('receiving_goods.total');
    route::get('receiving_goods_filter', 'ReceivingGoodController@filter')->name('receiving_goods.filter');
    route::get('receiving_goods/bad_order/bad_order_dd', 'ReceivingGoodController@bad_order_dd')->name('receiving_goods.bad_order_dd');
    route::get('receiving_goods/empty/empty_dd', 'ReceivingGoodController@empty_dd')->name('receiving_goods.empty_dd');
    route::get('receiving_goods/compute/compute', 'ReceivingGoodController@compute')->name('receiving_goods.compute');
    route::get('receiving_goods/payables/payables', 'ReceivingGoodController@payables')->name('receiving_goods.payables');
    Route::delete('receiving_goods/{receiving_good}/void','ReceivingGoodController@void')->name('receiving_goods.void');
    route::get('receiving_goods/delivery_report/delivery_report', 'ReceivingGoodController@delivery_report')->name('receiving_goods.delivery_report');

    // Reuse Data 
    route::get('receiving_goods/supplier/get_supplier_id', 'ReceivingGoodController@get_supplier_id')->name('receiving_goods.get_supplier_id');
    route::get('receiving_goods/supplier/list_receiving_goods', 'ReceivingGoodController@list_receiving_goods')->name('receiving_goods.list_receiving_goods');
    route::get('receiving_goods/supplier/reuse/{receiving_good}', 'ReceivingGoodController@select_reuse')->name('receiving_goods.select_reuse');

    //Recieve Return
    route::get('recieve_return', 'ReceivingGoodController@recieve_return')->name('receiving_goods.recieve_return');

    Route::delete('recieve_return/remove/remove_all', 'RecieveReturnController@remove_all')->name('recieve_return.remove_all');
    route::get('recieve_return/product/return_amount', 'RecieveReturnController@return_amount')->name('recieve_return.return_amount');
    Route::resource('recieve_return', 'RecieveReturnController');

     //Assing Deliver
     route::resource('assign_deliver', 'AssignDeliverController');

     // PALLETS
     route::get('receiving/rpallets_table', 'PalletController@rpallets_table')->name('receiving.rpallets_table');
     route::get('receiving/rpallet/{pallet}/unit_price', 'PalletController@unit_price')->name('receiving.unit_price');
     route::post('receiving/rpallet', 'PalletController@store_rpallet')->name('receiving.store_rpallet');
     route::get('receiving/rpallet/{pallet}/edit', 'PalletController@edit_rpallet')->name('receiving.edit_rpallet');
     route::delete('receiving/rpallet/{pallet}', 'PalletController@destroy_rpallet')->name('receiving.destroy_rpallet');
    
     route::get('pallets/{pallet}', 'PalletController@pallet')->name('pallets.pallet');
     route::get('pallets/{pallet}/stock_history', 'PalletController@stock_history')->name('pallets.stock_history');
     route::put('pallets/{pallet}', 'PalletController@update_pallets')->name('pallets.update_pallets');
    
     route::get('sales_pallets/spallets_table', 'PalletController@spallets_table')->name('sales_pallets.spallets_table');
     route::delete('sales_pallets/spallet/{pallet}', 'PalletController@destroy_spallet')->name('sales_pallets.destroy_spallet');
    
     // DEPOSITS
     route::resource('deposits', 'DepositController');
});
