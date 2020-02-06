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
Route::post('/login', 'AuthHandler@login')->name('AuthHandler@login');
Route::post('/signup', 'AuthHandler@signUp')->name('AuthHandler@signUp');

Route::middleware(\App\Http\Kernel::API)->group(function(){
    Route::post('/items', 'ItemHandler@create')->name('ItemHandler@create');
    Route::put('/items/{itemId}', 'ItemHandler@update')->name('ItemHandler@update');
    Route::get('/items', 'ItemHandler@list')->name('ItemHandler@list');
    Route::get('/items/{itemId}', 'ItemHandler@show')->name('ItemHandler@show');

    Route::post('/files/upload', 'FileHandler@upload')->name('FileHandler@upload');

    Route::post('/roles', 'RoleHandler@create')->name('RoleHandler@create');
    Route::put('/roles/{roleId}', 'RoleHandler@update')->name('RoleHandler@update');
    Route::get('/roles', 'RoleHandler@list')->name('RoleHandler@list');
    Route::get('/roles/{roleId}', 'RoleHandler@show')->name('RoleHandler@show');

    Route::get('/logout', 'AuthHandler@logout')->name('AuthHandler@logout');
    Route::get('/refresh', 'AuthHandler@refresh')->name('AuthHandler@refresh');
    Route::get('/me', 'AuthHandler@me')->name('AuthHandler@me');
});
