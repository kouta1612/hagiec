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
Route::get('/admin/user', 'AdminController@show_user');
Route::post('/admin/user/download', 'AdminUserController@downloadCSV');
Route::get('/admin/user/{id}', 'AdminUserController@show');
Route::post('/admin/user/{id}', 'AdminUserController@edit');
Route::delete('/admin/user/{id}/delete', 'AdminUserController@destroy');
Route::get('/admin/item', 'AdminController@show_item');
Route::post('/admin/item/upload', 'AdminItemsController@uploadCSV');
Route::post('/admin/item/download', 'AdminItemsController@downloadCSV');
Route::get('/admin/earning', 'AdminController@show_earning');
Route::get('/admin/earning/csv', 'AdminEarningController@downloadCSV');
Route::get('/admin/earning/{id}', 'AdminEarningController@show_earning_detail');
Route::get('/admin/user/{id}/delete', function() {
  return 'hello';
});

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
