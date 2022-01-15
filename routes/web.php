<?php

use Illuminate\Support\Facades\Auth;
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



Route::get('/', 'HomeController@home');
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login_post', 'Auth\LoginController@login_post')->name('login_post');

// Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/beranda', 'Admin\AdminController@dashboard');

    //ganti password
    Route::get('/ganti_password', 'Admin\AdminController@ganti_password');
    Route::post('cek_password', 'Admin\AdminController@cek_password');
    Route::post('ganti_password_user', 'Admin\AdminController@ganti_password_user');

    // users
    Route::resource('/users', 'UserController');
    Route::post('simpan_users', 'UserController@simpan_users');
    Route::post('update_users', 'UserController@update_users');
    Route::get('get_all_users', 'UserController@get_all_users');
    Route::get('/delete_user/{id}', 'UserController@delete');
    Route::get('/get_user_by_id/{id}', 'UserController@get_user_by_id');
    Route::get('/users/edit/{id}', 'UserController@edit');

    // category
    Route::resource('/category', 'CategoryController');
    Route::post('/simpan_category', 'CategoryController@submit_category');
    Route::get('/get_all_category', 'CategoryController@get_all_category');
    Route::get('/delete_category/{id}', 'CategoryController@delete');
    Route::get('/get_category/{id}', 'CategoryController@view');

    //produk
    Route::resource('product', 'ProductController');
    Route::get('all_product', 'ProductController@datatable_product');

 

    Route::get('/logout', 'Auth\LoginController@logout');
});
