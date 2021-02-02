<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CityCollection;
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
    Route::post('guest_user','UserController@guest_user');
    Route::get('countries', function() {
        return (new CountryCollection(App\Country::with('cities')->get()));
    });

    Route::get('cities', function() {
        return (new CityCollection(App\City::with('countries')->get()));
    });

    Route::get('currencies', function() {
        return (new CurrencyCollection(App\Currency::all()));
    });
    // Banners
    Route::get('banners/{language}', 'BannerController@banner');
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
    Route::post('forgot_password', 'AuthController@sendEmail');
    Route::post('update_password','AuthController@updatePassword');
    // contact us
    Route::post('contactus', 'AuthController@ContactUs');
    //static page
    Route::get('static_page/link','StaticPageController@getLink');
    // join us
    Route::post('joinus', 'AuthController@createJoinUsRequest');

    Route::get('site-setting','SiteSettingController@index');
    //genre
    Route::get('genre', 'GenreController@index');
    Route::group(['middleware'=>'multiple'], function(){
    Route::post('request/book', 'UserRequestController@store');
    });

 // request book
    Route::group(['middleware'=>'auth:api'], function() {
        Route::get('/profile','UserController@profile');
    
        // request book

        // favourites
        Route::post('favourites', 'FavouriteController@store');
        Route::get('favourites', 'FavouriteController@show');
        Route::delete('favourites', 'FavouriteController@destroy');
        // address
        Route::get('user/addresses', 'AddressController@showUserAddresses');
        Route::post('addresses', 'AddressController@store');
        Route::delete('addresses/{id}', 'AddressController@destroy');
        Route::get('addresses/{id}', 'AddressController@show');
        Route::put('addresses/{id}', 'AddressController@update');
        // users
        Route::post('user', 'UserController@update');
        Route::post('users/password', 'UserController@updatePassword');
            //static pages
            
            //notification
            Route::post('fcm/{id}','UserController@fcm');


        Route::resource('cart','CartController');
        Route::resource('order','OrderController');
        Route::resource('invoice','InvoiceController');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
