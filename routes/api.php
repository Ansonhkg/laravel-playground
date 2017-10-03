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

Route::get('/testing', function (Request $request) {
    return 'testing';

});


Route::prefix('user')->group(function(){

    // Fetch all users
    Route::get('/', 'Api\UserController@index');

    // Fetch a specific user
    Route::get('{id}', 'Api\UserController@show');
    
});