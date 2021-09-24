<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

//login
Route::post('user/login', 'API\UserController@login');
//view user
Route::get('user/{id}', 'API\UserController@view');
//delete user
Route::delete('user/{id}', 'API\UserController@delete');
//register
Route::post('user', 'API\UserController@create');
//product
Route::get('product', 'API\ProductController@index');
//Order
Route::get('order', 'API\OrderController@index');
//สินค้าขายดี
Route::get('product/toppro', 'API\ProductController@toppro');
//update user
Route::put('user/{id}', 'API\UserController@update');
Route::post('user/{id}', 'API\UserController@update');//fake update
//view product
Route::get('proview/{id}', 'API\ProductController@viewdetail');
//view sizeproduct
Route::get('viewsize/{name}', 'API\ProductController@viewsize');
Route::get('viewview/{id}', 'API\ProductController@viewview');
//Report
Route::get('report/monthlySale/{id}', 'API\ReportController@monthlySale');
Route::get('report/topFiveProduct/{id}', 'API\ReportController@topFiveProduct');
//view cart
Route::get('cart/{id}', 'API\CartController@index');
//cart delete
Route::delete('cart/{id}', 'API\CartController@delete');
//spinnerband
Route::get('band', 'API\BrandController@index');
//add cart
Route::post('cart', 'API\CartController@addcart');
//add order
Route::post('order', 'API\OrderController@create');
Route::post('AddOrderNull/{id}', 'API\OrderController@AddOrderNull');
Route::post('AddOrderDetail', 'API\OrderDetailController@AddOrderDetail');
Route::get('SelectIDOrder', 'API\OrderController@SelectIDOrder');
Route::put('updatestatus/{id}', 'API\OrderController@updatestatus');
Route::post('payment', 'API\PaymentController@payment');
//Route::put('upstatus1/{id}', 'API\OrderController@upstatus1');

Route::put('updatestok/{id}', 'API\ProductController@updatestok');


