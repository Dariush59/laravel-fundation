<?php

use App\Http\Controllers\Api\Auth\PassportAuthController;
use App\Http\Controllers\Api\Companies\CompanyController;
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

Route::post('login', [PassportAuthController::class, 'login'])->name('auth.login');

// AdminView
Route::middleware('auth:api')->group(function () {
    Route::apiResource('companies', CompanyController::class);
    Route::get('companies/{company}/clients', 'App\Http\Controllers\Api\Companies\CompanyController@clients')->name('companies.client');
    Route::post('companies/{company}', 'App\Http\Controllers\Api\Companies\CompanyController@attach')->name('companies.attach');
    Route::post('register', [PassportAuthController::class, 'register'])->name('auth.register');
});
