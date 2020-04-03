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

// API\ProductController@all = memanggil fungsi all di API/ProductCOntroller
Route::get('products', 'API\ProductController@all');

Route::post('checkout', 'API\CheckoutController@checkout');

Route::get('transactions/{id}', 'API\TransactionController@get');
