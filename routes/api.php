<?php

use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/items', 'ItemHandler@create')->name('ItemHandler@create');
Route::put('/items/{itemId}', 'ItemHandler@update')->name('ItemHandler@update');
Route::get('/items', 'ItemHandler@list')->name('ItemHandler@list');
Route::get('/items/{itemId}', 'ItemHandler@show')->name('ItemHandler@show');
