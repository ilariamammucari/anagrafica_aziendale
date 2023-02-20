<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Models\Company;

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

// public routes
Route::get('/companies', [CompanyController::class, 'index']);
Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

// protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    // Missing prefix!
    Route::as('company.')->controller(CompanyController::class)->group(function(){
        Route::post('/companies', 'store')->name('store');
        Route::get('/companies/{company}', 'show')->name('show');
        Route::patch('/companies/{company}', 'update')->name('update');
        Route::delete('/companies/{company}', 'destroy')->name('destroy');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
