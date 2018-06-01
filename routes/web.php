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

Auth::routes();
Route::redirect('/', '/login', 301);
Route::get('/logout', 'ItemsController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/top', 'ItemsController@top');
Route::get('/detail/{id}', 'ItemsController@detail');
// Route::post('/create/{user_id}/{item_id}', 'ProductsController@create');
// Route::post('/update/{user_id}/{item_id}/{quantity}', 'ProductsController@update');
Route::post('/cart', 'ItemsController@cart');
// Route::get('/cart/{user_id}', 'ItemsController@showCart');
Route::get('/cart/{user_id}', 'ItemsController@showCart');
Route::get('/confirm', 'ItemsController@confirm');
Route::get('/done_payment', 'ItemsController@done_payment');
