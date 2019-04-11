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

// Route Product
Route::apiResource('/products','ProductController');

// Route Review
Route::group(['prefix' => 'products'], function(){
	Route::apiResource('{product}/reviews','ReviewController');
});

// Route Login
Route::post('auth', 'UserController@auth');

// Route User index
Route::group(['middleware' => 'auth:api'], function(){
 	Route::resource('user', 'UserController@index');
});
