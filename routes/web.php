<?php

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

Route::group(['middleware' => 'prevent-back-history'], function() {
    Route::get('/', 'CommonController@showRoot')->middleware('guest')->name('/');

    Auth::routes(['verify' => true]);

    Route::get('/login', 'CommonController@showLogin')->middleware('guest')->name('login');

    Route::get('/register', 'CommonController@showRegister')->middleware('guest')->name('register');

    Route::get('/login/customer', 'CommonController@showLoginCustomer')->middleware('guest')->name('customers.login');

    Route::post('/login/customer', 'Auth\LoginController@loginCustomer')->middleware('guest')->name('customers.login');

    Route::get('/register/customer', 'CommonController@showRegisterCustomer')->middleware('guest')->name('customers.register');

    Route::post('/register/customer', 'Auth\RegisterController@registerCustomer')->middleware('guest')->name('customers.register');

    Route::get('/register/terms', 'CommonController@showTerms')->middleware('guest')->name('customers.terms');

    Route::get('/user/{username}', 'ProfileController@show')->where('username', '[A-Za-z0-9]+')->middleware('auth', 'verified')->name('user');

    Route::get('/user/{username}/edit', 'ProfileController@edit')->where('username', '[A-Za-z0-9]+')->middleware('auth', 'verified')->name('user.edit');

    Route::put('/user', 'ProfileController@updateGeneral')->middleware('auth', 'verified')->name('user.update.general');

    Route::put('/user/security', 'ProfileController@updateSecurityAndPrivacy')->middleware('auth', 'verified')->name('user.update.security');

    Route::put('/user/profile', 'ProfileController@updateProfile')->middleware('auth', 'verified')->name('user.update.profile');

    Route::put('/user/finance', 'ProfileController@updateFinance')->middleware('auth', 'verified')->name('user.update.finance');

    Route::get('/user', 'ProfileController@index')->middleware('auth', 'verified');

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::resource('albums', 'AlbumController')->middleware('auth', 'verified');

Route::post('/photos/store/{album_id}', 'PhotoController@store')->name('photos.store')->middleware('auth', 'verified');
Route::any('/photos/add/best', 'PhotoController@addBest')->name('photos.add.best')->middleware('auth', 'verified');
Route::get('/photos/best', 'PhotoController@getBestPhotos')->name('photos.best')->middleware('auth', 'verified');

Route::get('/download/{id}', 'PhotoController@download')->name('photo.download')->middleware('auth', 'verified');

Route::get('photos', 'PhotoController@purchasedPhotos')->name('photos.purchased')->middleware('auth', 'verified');
Route::post('/photos/update', 'PhotoController@update')->name('photos.update')->middleware('auth', 'verified');

Route::any('/search', 'SearchController@doSearch')->name('search')->middleware('auth', 'verified');
Route::get('/search/photographer', 'SearchController@showPhotographerSearch')->name('search.photographer')->middleware('auth', 'verified');
Route::post('/search/photographer', 'SearchController@doPhotographerSearch')->name('search.photographer')->middleware('auth', 'verified');

Route::get('/cart', 'CartController@show')->name('cart')->middleware('auth', 'verified');
Route::any('cart/addphoto', 'CartController@addPhoto')->name('cart.add.photo')->middleware('auth', 'verified');
Route::any('cart/removephoto/{detailId}', 'CartController@removePhoto')->name('cart.remove.photo')->middleware('auth', 'verified');
Route::any('cart/addalbum', 'CartController@addAlbum')->name('cart.add.album')->middleware('auth', 'verified');
Route::any('cart/emptycart/{cartId}', 'CartController@emptyCart')->name('cart.empty.cart')->middleware('auth', 'verified');

Route::delete('/photos/{album_id}/{photo_id}', 'PhotoController@destroy')->name('photos.delete')->middleware('auth', 'verified');

#Mercadopago
Route::post('/mpnotification', 'MercadoPagoController@webhook')->name('mp.webhook');
Route::get('/mpsuccess', 'MercadoPagoController@success')->middleware('auth', 'verified')->name('mp.success');
Route::get('/mpfailure', 'MercadoPagoController@failure')->middleware('auth', 'verified')->name('mp.failure');
