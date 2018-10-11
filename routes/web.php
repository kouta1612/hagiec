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

/** 管理者 */
Route::get('/admin', 'AdminController@index');
Route::get('/admin/users', 'AdminController@show_users');
Route::post('/admin/users/upload', 'AdminUserController@upload');
Route::post('/admin/users/download', 'AdminUserController@download');
Route::get('/admin/items', 'AdminController@show_items');
Route::post('/admin/items/upload', 'AdminItemsController@uploadCSV');
Route::post('/admin/items/download', 'AdminItemsController@downloadCSV');
Route::get('/admin/earning', 'AdminController@show_earnings');
Route::get('/admin/earning/csv', 'AdminEarningController@downloadCSV');
Route::get('/admin/earning/{id}', 'AdminEarningController@show_earning_detail');

/** 一般ユーザ */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::redirect('/', '/login', 301);
Route::get('/logout', 'ItemsController@logout');
Route::get('/top', 'ItemsController@top');
Route::post('/top', 'ItemsController@top');
Route::get('/detail/{item_id}', 'ItemsController@showDetail');
Route::get('/cart', 'ItemsController@showCart');
Route::post('/cart', 'ItemsController@cart');
Route::post('/ajax_cart', 'ItemsController@ajax_cart');
Route::delete('/destroy/{item_id}','ItemsController@destroy');
Route::get('/confirm', 'ItemsController@confirm');
Route::post('/select_address', 'ItemsController@select_address');
Route::get('/address', 'ItemsController@show_address_form');
Route::post('/address', 'ItemsController@post_address');
Route::post('/payment/{status}', 'ItemsController@payment');
Route::post('/done_payment', 'ItemsController@done_payment');
Route::get('/sample/mailable/preview', function() {
  return new App\Mail\SampleNotification();
});
Route::get('/sample/mailable/send', 'SampleController@SampleNotification');
