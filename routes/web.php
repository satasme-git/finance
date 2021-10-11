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

//web
//Collector
Route::resource('/web/view_asign_loans', 'App\Http\Controllers\CollectorController');
Route::get('/web/daily_collection', 'App\Http\Controllers\CollectorController@create');
Route::get('/autocomplete2-searchLoan','App\Http\Controllers\CollectorController@searchLoan');
Route::post('/admin/daily_collection', 'App\Http\Controllers\CollectorController@store');
Route::post('/loan_outstanding','App\Http\Controllers\CollectorController@loan_outstanding');
Route::get('/web/daily_collection_by_nic','App\Http\Controllers\CollectorController@daily_collection_by_nic');
Route::get('/autocomplete2-searchloanbycreditor','App\Http\Controllers\CollectorController@searchloanbycreditor');
Route::post('/serch_by_creditor_nic','App\Http\Controllers\CollectorController@serch_by_creditor_nic');
Route::get('/admin/dailycollectionbyloan_id/{id}', 'App\Http\Controllers\CollectorController@dailycollectionbyloan_id');




//reports
Route::get('/admin/view_daily_collection', 'App\Http\Controllers\CollectorController@view_daily_collections');
Route::get('/autocomplete2-searchCollector','App\Http\Controllers\CollectorController@searchCollector');
Route::post('/serch_by_collector_id','App\Http\Controllers\CollectorController@serch_by_collector_id');

Route::get('/admin/view_loan_outstanding','App\Http\Controllers\ReportController@view_loan_outstanding');
Route::get('/admin/outstanding_by_loan_id/{id}','App\Http\Controllers\ReportController@outstanding_by_loan_id');






