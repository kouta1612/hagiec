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
// Route::get('/logout', 'ProductsController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/top', 'ProductsController@top');
Route::get('/detail/{id}', 'ProductsController@detail');
Route::get('/cart', 'ProductsController@cart');
Route::get('/confirm', 'ProductsController@confirm');
Route::get('/done_payment', 'ProductsController@done_payment');
