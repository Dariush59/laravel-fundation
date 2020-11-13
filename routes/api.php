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
    Route::resource('companies', CompanyController::class);
    Route::get('companies/{company}/clients', 'App\Http\Controllers\Api\Companies\CompanyController@clients');
    Route::post('companies/{company}', 'App\Http\Controllers\Api\Companies\CompanyController@attach');
    Route::post('register', [PassportAuthController::class, 'register'])->name('auth.register');
});
