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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('details', 'UserController@details');
    Route::get('siswa', 'SiswaController@index');
    Route::post('siswa', 'SiswaController@create');
    Route::put('siswa/{id}', 'SiswaController@update');
    Route::delete('siswa/{id}', 'SiswaController@delete');
    Route::post('siswa/search', 'SiswaController@search');
    Route::post('siswa/sort', 'SiswaController@sort');
    Route::post('siswa/filter', 'SiswaController@filter');
});