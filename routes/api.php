<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CountryCollection;
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
    Route::get('countries', function() {
        return (new CountryCollection(App\Country::all()));
    });
    Route::get('languages','LanguageController@index');
    Route::get('ads','AdController@index');
    Route::post('forgot-password', 'AuthController@forgotPassword');
    Route::post('contactus', 'AuthController@ContactUs');
    Route::post('joinus', 'AuthController@createJoinUsRequest');
    Route::group(['middleware'=>'auth:api'], function() {
        Route::post('request/book', 'UserRequestController@store');
        Route::get('books', 'BookController@index');
        Route::get('books/arabic', 'BookController@arabicBooks');
        Route::get('books/english', 'BookController@englishBooks');
        Route::get('books/{isbn}', 'BookController@show');
        Route::get('related/books/{id}', 'BookController@relatedBooks');
        Route::any('books/search','BookController@searchBook')->name('search_book');
        Route::any('books/filter','BookController@filterBook')->name('filter_book');
        Route::get('bookmarks', 'BookmarkController@index');
        Route::get('bookmarks/{id}', 'BookmarkController@show');
        Route::get('bookclubs', 'BookclubController@index');
        Route::get('bookclubs/{id}', 'BookclubController@show');
        Route::post('favourites', 'FavouriteController@store');
        Route::get('favourites', 'FavouriteController@show');
        Route::delete('favourites/{id}', 'FavouriteController@destroy');
        Route::get('user/addresses', 'AddressController@showUserAddresses');
        Route::post('addresses', 'AddressController@store');
        Route::delete('addresses/{id}', 'AddressController@destroy');
        Route::get('addresses/{id}', 'AddressController@show');
        Route::put('users/{id}', 'UserController@update');
        Route::post('users/password', 'UserController@updatePassword');
        Route::get('banners', 'BannerController@index');
       
       
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
