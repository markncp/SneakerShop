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

//Route for normal user
Route::group(['middleware' => ['auth']], function () {
    Route::get('/ home', 'HomeController@index');
    Route::resource('admin/product', 'Admin\ProductController');
    Route::resource('admin/product-type', 'Admin\ProductTypeController');
    Route::resource('admin/order', 'Admin\orderController');
    Route::resource('admin/payment', 'admin\paymentController');
    Route::post('admin/payment/update', 'Admin\paymentController@update');

    Route::resource('admin/users', 'Admin\usersController');
});
//Route for admin
Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => ['admin']], function(){
        Route::get('/dashboard', 'admin\AdminController@index');
    });
});

Route::resource('admin/users', 'Admin\usersController');

