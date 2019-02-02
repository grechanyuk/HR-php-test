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

Route::get('/', function () {
    return view('welcome');
});

//Front Controllers
Route::group(['namespace' => 'Front'], function() {
    Route::get('/', 'HomeController@index');
});

//Admin controllers
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::resource('orders', 'OrderController')->only(['index', 'edit', 'update']);
    Route::resource('products', 'ProductsController')->only(['index']);
    Route::put('products/{product}/editField', 'ProductsController@editField')->name('products.editField');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
