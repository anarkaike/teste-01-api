<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'App\Http\Controllers\RegisterController@register');
Route::post('login', 'App\Http\Controllers\RegisterController@login');
Route::get('unauthorised', 'App\Http\Controllers\RegisterController@unauthorised')->name('unauthorised');

Route::middleware('auth:api')->group( function () {
    Route::get('users', 'App\Http\Controllers\UsersController@getAllUsers');
    Route::get('users/{id}', 'App\Http\Controllers\UsersController@getUser');
    Route::post('users', 'App\Http\Controllers\UsersController@createUser');
    Route::put('users/{id}', 'App\Http\Controllers\UsersController@updateUser');
    Route::delete('users/{id}','App\Http\Controllers\UsersController@deleteUser');

    Route::get('customers', 'App\Http\Controllers\CustomersController@getAllCustomers');
    Route::get('customers/{id}', 'App\Http\Controllers\CustomersController@getCustomer');
    Route::post('customers', 'App\Http\Controllers\CustomersController@createCustomer');
    Route::put('customers/{id}', 'App\Http\Controllers\CustomersController@updateCustomer');
    Route::delete('customers/{id}','App\Http\Controllers\CustomersController@deleteCustomer');

    Route::get('plans', 'App\Http\Controllers\PlansController@getAllPlans');
    Route::get('plans/{id}', 'App\Http\Controllers\PlansController@getPlan');
    Route::post('plans', 'App\Http\Controllers\PlansController@createPlan');
    Route::put('plans/{id}', 'App\Http\Controllers\PlansController@updatePlan');
    Route::delete('plans/{id}','App\Http\Controllers\PlansController@deletePlan');
});
