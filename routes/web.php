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
Route::get('/detail/{id}', 'ItemsController@showDetail');
Route::post('/detail', 'ItemsController@detail');
Route::get('/cart/{user_id}', 'ItemsController@showCart');
Route::post('/cart', 'ItemsController@cart');
Route::delete('/destroy/{item_id}','ItemsController@destroy');
Route::get('/confirm', 'ItemsController@confirm');
Route::get('/done_payment', 'ItemsController@done_payment');
