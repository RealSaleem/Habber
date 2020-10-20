<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ADD A USER


Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->middleware('auth');
Route::get('/',function() {
   return view('welcome');
})->middleware('auth')->name('welcome');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
   Route::get('language/{locale}', 'HomeController@setLanguage')->name('set_language');
   Route::resource('users','UserController');
   Route::post('user/activate/{id}','UserController@activateUser')->name('activate_user');
   Route::post('user/deactivate/{id}','UserController@deactivateUser')->name('deactivate_user');
   Route::resource('books','BooksController');
   Route::resource('business','BusinessController');
   Route::resource('bookmarks','BookmarksController');
   Route::resource('bookclubs','BookClubController');     
   Route::resource('genres','GenreController');
   Route::resource('address','AddressController');
   Route::resource('contactus','ContactController');
   Route::resource('user_requests','UserRequestController');
   Route::get('joinus','UserController@allJoinUsRequest')->name('joinus');
   Route::get('joinus/{id}','UserController@showJoinUsRequest');
   Route::delete('delete/joinus/{id}','UserController@destroyRequest');
   Route::put('joinus/{id}','UserController@updateRequest')->name('joinus.update');
   Route::resource('banners','BannerController');
   Route::post('banner/enable/{id}','BannerController@enableBanner')->name('enable_banner');
   Route::post('banner/disable/{id}','BannerController@disableBanner')->name('disable_banner');
   Route::post('banners-sortable', 'BannerController@sortBanners');
});



