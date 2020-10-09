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
})->middleware('auth');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
   Route::resource('users','UserController');
   Route::post('user/activate/{id}','UserController@activateUser')->name('activate_user');
   Route::post('user/deactivate/{id}','UserController@deactivateUser')->name('deactivate_user');
});
// ADD A BOOK
Route::resource('books','BooksController');
Route::resource('business','BusinessController');
Route::resource('bookmarks','BookmarksController');
Route::resource('bookclub','BookClubController');
Route::resource('genre','GenreController');


