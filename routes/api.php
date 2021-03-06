<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});

Route::match(['get','post'],'add','CategoryController@add');
Route::get('allData','CategoryController@allData');

Route::any('show/{id}','CategoryController@show');
Route::any('update','CategoryController@update');
Route::any('delete/{id}','CategoryController@delete');