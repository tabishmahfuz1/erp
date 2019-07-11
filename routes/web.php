<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('item')->group(function () {
    Route::get('/view_items', 'ItemController@viewItems')->name('view_items');
	Route::get('/new_item', 'ItemController@newItem')->name('new_item');
	Route::get('/edit_item/{item_id?}', 'ItemController@editItem')->name('edit_item');
	Route::post('/save_item', 'ItemController@saveItem')->name('save_item');
	Route::get('get_item/{item_id?}', 'ItemController@getItem')->name('get_item');
});

Route::prefix('customer')->group(function(){
	Route::get('/new_customer', 'CustomerController@newCustomer')->name('new_customer');
	Route::get('/view_customers', 'CustomerController@viewCustomers')->name('view_customers');
	Route::get('/edit_customer/{customer_id?}', 'CustomerController@editCustomer')->name('edit_customer');
	Route::post('/save_customer', 'CustomerController@saveCustomer')->name('save_customer');
});

Route::prefix('order')->group(function(){
	Route::get('/new_sales_order', 'SalesOrderController@newSalesOrder')->name('new_sales_order');
	Route::get('/view_sales_orders', 'SalesOrderController@viewSalesOrders')->name('view_sales_orders');
	Route::get('/edit_sales_order/{order_id?}', 'SalesOrderController@editOrder')->name('edit_sales_order');
	Route::post('/save_sales_order', 'SalesOrderController@saveOrder')->name('save_sales_order');
	Route::post('add_so_item', 'SalesOrderController@addSoItem')->name('add_so_item');
});

