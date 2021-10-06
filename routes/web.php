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
Route::get('/logout', 'App\Http\Controllers\LoginController@userlogout');
Route::get('/admin/update_profile/{id}', 'App\Http\Controllers\LoginController@profile');

//user management
Route::get('/admin/adduser', 'App\Http\Controllers\UserController@create');
Route::resource('/admin/create_user', 'App\Http\Controllers\UserController');
Route::resource('/admin/view_user', 'App\Http\Controllers\UserController');
Route::get('/get_user_by_id/{id}','App\Http\Controllers\UserController@getUserById');
Route::get('/admin/update_user/{id}', 'App\Http\Controllers\UserController@edit');
Route::post('/admin/edit_user/{id}', 'App\Http\Controllers\UserController@update');
Route::get('/admin/deleteuser/{id}', 'App\Http\Controllers\UserController@destroy');
Route::post('/check_uname','App\Http\Controllers\UserController@check_uname');

//Creditor management
Route::get('/admin/addcreditor', 'App\Http\Controllers\CreditorController@create');
Route::post('/admin/addcreditor', 'App\Http\Controllers\CreditorController@store');
Route::get('/autocomplete2-searchcom','App\Http\Controllers\CreditorController@searchcom');
Route::post('/check_nic','App\Http\Controllers\CreditorController@check_nic');
Route::resource('/admin/view_creditor', 'App\Http\Controllers\CreditorController');
Route::get('/get_creditor_by_id/{id}','App\Http\Controllers\CreditorController@getCreditorById');
Route::get('/admin/update_creditor/{id}', 'App\Http\Controllers\CreditorController@edit');
Route::post('/admin/edit_creditor/{id}', 'App\Http\Controllers\CreditorController@update');
Route::get('/admin/deletecreditor/{id}', 'App\Http\Controllers\CreditorController@destroy');

//Loan management
Route::get('/admin/createloan', 'App\Http\Controllers\LoanController@create');
Route::get('/autocomplete2-searchCreditor','App\Http\Controllers\LoanController@searchcreditor');
Route::post('/admin/addloan', 'App\Http\Controllers\LoanController@store');
Route::post('/loan_term','App\Http\Controllers\LoanController@loan_term');
Route::resource('/admin/view_loan', 'App\Http\Controllers\LoanController');
Route::get('/get_loan_by_id/{id}','App\Http\Controllers\LoanController@getLoanById');
Route::get('/admin/update_loan/{id}', 'App\Http\Controllers\LoanController@edit');
Route::post('/admin/edit_loan/{id}', 'App\Http\Controllers\LoanController@update');
Route::get('/admin/deleteloan/{id}', 'App\Http\Controllers\LoanController@destroy');



