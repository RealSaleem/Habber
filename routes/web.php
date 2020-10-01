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

Route::get('/',function() {
   return view('welcome');
});
Route::resource('users','UserController');
// Route::get('/users','UserController@index');
// Route::get('/users/create','UserController@create');
// Route::post('/users','UserController@Store');
// Route::get('users/edit{id}','UserController@edit');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
