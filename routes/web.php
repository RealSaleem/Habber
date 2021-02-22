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
Route::post('login1','Auth\AuthController@login1');
Route::get('logout', 'Auth\LoginController@logout')->middleware('auth');
Route::get('payment/success','PaymentGatewayController@successPayment')->name('payment.success');
Route::get('payment/failure','PaymentGatewayController@failurePayment')->name('payment.failure');
Route::get('static_pages/{url}/{lang}','StaticPagesController@show')->name('static_pages.show');
Route::post('forgot_password','Auth\ForgotPasswordController@sendEmail')->name('forgot.sendemail');
Route::post('password/reset','Auth\ForgotPasswordController@updatePassword')->name('password.change');
Route::get('social_share','StaticPagesController@share')->name('social.share');
Route::get('/',function() {
   return view('welcome');
})->middleware('auth')->name('welcome');
Route::get('/','HomeController@index')->middleware('auth')->name('welcome');
// Route::get('/',function() {	
//    return view('welcome');	
// })->middleware('auth')->name('welcome');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
   
   Route::get('welcome','HomeController@index')->name('welcome');
   Route::get('language/{locale}', 'HomeController@setLanguage')->name('set_language');
   Route::resource('users','UserController');
   Route::post('user/activate/{id}','UserController@activateUser')->name('activate_user');
   Route::post('user/deactivate/{id}','UserController@deactivateUser')->name('deactivate_user');
   Route::resource('books','BooksController');
   Route::post('book/activate/{id}','BooksController@activateBook');
   Route::post('book/deactivate/{id}','BooksController@deactivateBook');
   Route::resource('business','BusinessController');
   Route::resource('bookmarks','BookmarksController');
   Route::post('bookmark/activate/{id}','BookmarksController@activateBookmark');
   Route::post('bookmark/deactivate/{id}','BookmarksController@deactivateBookmark');
   Route::post('bookmark/feature/{id}','BookmarksController@featureBookmark');
   Route::post('bookmark/notfeature/{id}','BookmarksController@notfeatureBookmark');
   Route::resource('bookclubs','BookClubController');   
   Route::post('bookclub/activate/{id}','BookClubController@activateBookClub');
   Route::post('bookclub/deactivate/{id}','BookClubController@deactivateBookClub');
   Route::post('bookclub/feature/{id}','BookClubController@featureBookClub');
   Route::post('bookclub/notfeature/{id}','BookClubController@notfeatureBookClub');  
   Route::resource('genres','GenreController');
   Route::resource('address','AddressController');
   Route::get('user/address/{userId}','AddressController@getUserAddressList')->name('user_address');
   Route::post('user/address/create/{userId}','AddressController@createUserAddress');
   Route::resource('contactus','ContactController');
   Route::resource('user_requests','UserRequestController');
   Route::get('joinus','UserController@allJoinUsRequest')->name('joinus');
   Route::get('joinus/{id}','UserController@showJoinUsRequest');
   Route::delete('delete/joinus/{id}','UserController@destroyRequest');
   Route::put('joinus/{id}','UserController@updateRequest')->name('joinus.update');
   Route::resource('banners','BannerController');
   Route::post('banner/enable/{id}','BannerController@enableBanner')->name('enable_banner');
   Route::post('banner/disable/{id}','BannerController@disableBanner')->name('disable_banner');
   Route::get('getlist/{type}','BannerController@getDropDownList');
   Route::post('banners-sortable', 'BannerController@sortBanners');
   Route::resource('languages','LanguageController');
   Route::resource('countries','CountryController');
   Route::post('country/activate/{id}','CountryController@activateCountry');
   Route::post('country/deactivate/{id}','CountryController@deactivateCountry');
   Route::get('country/city/{id}','CountryController@getCity')->name('country.cities');
   Route::resource('permissions','PermissionController');
   Route::resource('ads','AdController');
   Route::post('ad/enable/{id}','AdController@enableAd');
   Route::post('ad/disable/{id}','AdController@disableAd');
   Route::resource('roles','RoleController');
   Route::get('user/favourites/{userId}','FavouriteController@index')->name('user.favourites');
   Route::resource('favourites','FavouriteController');
   Route::resource('sitesetting','SiteSettingController');
   Route::resource('publisher','PublisherController');
   Route::resource('push_notifications','PushNotificationController');
   Route::get('push_notification','PushNotificationController@history')->name('push_notifications.history');
   Route::post('push_notifications','PushNotificationController@sendNotification');
   Route::get('payment/{id}','PaymentGatewayController@show');
   Route::post('payment/submit','PaymentGatewayController@submit')->name('payment.submit');
   Route::resource('orders','OrderController');
   Route::put('update1/{id}','OrderController@update1')->name('order.update1');
   Route::get('order/{orderId}','OrderController@showlist');
   Route::resource('reports','ReportController');
   Route::get('reports1','ReportController@show')->name('reports1.detail');
   Route::get('report1','ReportController@report');
   Route::resource('city','CityController');
   Route::post('city/activate/{id}','CityController@activateCity')->name('activate_city');
   Route::post('city/deactivate/{id}','CityController@deactivateCity')->name('deactivate_city');
   Route::post('orders/ready/{id}','OrderController@readyOrder');
   Route::post('orders/notready/{id}','OrderController@notreadyOrder');
   Route::get('user/order/{userId}','OrderController@getUserOrderList')->name('user_order');
   Route::resource('about_us','AboutUsController');
  Route::resource('static_pages','StaticPagesController');
  Route::resource('sizes','SizeController');
   Route::get('homes','HomeController@getData')->name('homes.getdata');
   Route::get('admin_change','UserController@changepassword')->name('admin.password');
   Route::post('admin_password','UserController@passwordUpdate')->name('admin.password.change');

   


   

});



