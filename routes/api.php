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
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::get('apartments/search', 'ApartmentController@search');
Route::apiResource('apartments', 'ApartmentController');

Route::apiResource('categories', 'CategoryController');

Route::middleware('auth:api')->post('/rating', 'RatingController@store');

