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
Route::group(['namespace' => 'Api' , 'prefix' => 'v1'], function() {
    Route::post('/register','AuthController@register');
    Route::post('/login','AuthController@login');
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::group(['middleware'=>'auth:api'], function() {
        Route::post('request/book', 'UserRequestController@store');
        Route::get('books', 'BookController@index');
        Route::get('books/{isbn}', 'BookController@show');
        Route::get('related/books/{id}', 'BookController@relatedBooks');
        Route::get('bookmarks', 'BookmarkController@index');
        Route::get('bookmarks/{id}', 'BookmarkController@show');
        Route::get('bookclubs', 'BookclubController@index');
        Route::get('bookclubs/{id}', 'BookclubController@index');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
