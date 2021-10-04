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


Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('Admin.Dashboard');
});

//login
Route::post('/login_validate', 'App\Http\Controllers\LoginController@loginValidate');

//user management
Route::get('/admin/adduser', 'App\Http\Controllers\UserController@create');
Route::resource('/admin/create_user', 'App\Http\Controllers\UserController');
Route::resource('/admin/view_user', 'App\Http\Controllers\UserController');
Route::get('/get_user_by_id/{id}','App\Http\Controllers\UserController@getUserById');
Route::get('/admin/update_user/{id}', 'App\Http\Controllers\UserController@edit');
Route::post('/admin/edit_user/{id}', 'App\Http\Controllers\UserController@update');
Route::get('/admin/deleteuser/{id}', 'App\Http\Controllers\UserController@destroy');


