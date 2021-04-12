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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'movies'], function(){
Route::post('/', 'ApiController@createMovie');
Route::put('/{id}', 'ApiController@updateMovie');
Route::delete('/{id}', 'ApiController@deleteMovie');
Route::get('/', 'ApiController@getAllMovies');
Route::get('/{id}', 'ApiController@getMovie');
});
