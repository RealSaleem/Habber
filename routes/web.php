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
Route::get('users/create',function(){
   return view('users/create');
});
Route::get('users/edit',function(){
    return view('users/edit');
 });
 Route::get('users/show',function(){
    return view('users/show');
 });
