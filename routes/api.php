<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CurrencyCollection;
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

    Route::get('currencies', function() {
        return (new CurrencyCollection(App\Currency::all()));
    });
    // Banners
    Route::get('banners', 'BannerController@index');
    // Books
    Route::get('books', 'BookController@index');
    Route::get('books/arabic', 'BookController@arabicBooks');
    Route::get('books/english', 'BookController@englishBooks');
    Route::get('books/{isbn}', 'BookController@show');
    Route::get('related/books/{id}', 'BookController@relatedBooks');
    Route::any('books/search','BookController@searchBook')->name('search_book');
    Route::any('books/filter','BookController@filterBook')->name('filter_book');
    // Bookmarks
    Route::get('bookmarks', 'BookmarkController@index');
    Route::get('bookmarks/{id}', 'BookmarkController@show');
    // BookClubs
    Route::get('bookclubs', 'BookclubController@index');
    Route::get('bookclubs/{id}', 'BookclubController@show');
    // Languages
    Route::get('languages','LanguageController@index');
    // Ads
    Route::get('ads','AdController@index');
    // forgot Password
    Route::post('forgot-password', 'AuthController@forgotPassword');
    // contact us
    Route::post('contactus', 'AuthController@ContactUs');
    // join us
    Route::post('joinus', 'AuthController@createJoinUsRequest');

    Route::get('site-setting','SiteSettingController@index');


    Route::group(['middleware'=>'auth:api'], function() {
        // request book
        Route::post('request/book', 'UserRequestController@store');
        // favourites
        Route::post('favourites', 'FavouriteController@store');
        Route::get('favourites', 'FavouriteController@show');
        Route::delete('favourites', 'FavouriteController@destroy');
        // address
        Route::get('user/addresses', 'AddressController@showUserAddresses');
        Route::post('addresses', 'AddressController@store');
        Route::delete('addresses/{id}', 'AddressController@destroy');
        Route::get('addresses/{id}', 'AddressController@show');
        // users
        Route::put('user', 'UserController@update');
        Route::post('users/password', 'UserController@updatePassword');
            //static pages
        Route::get('static_page/link','StaticPageController@getLink');    
            //notification
            Route::post('fcm/{id}','UserController@fcm');

            
        Route::resource('cart','CartController');
        Route::resource('order','OrderController');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
