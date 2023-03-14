<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::middleware('central')->group(function () {
    Route::get('/', function () {
        return view('central.homepage');
    })->name('home');

    // Auth
    Route::name('auth.')->group(function () {
        Route::get('/register', [RegisterController::class, 'show'])->name('register');
        Route::post('/register', [RegisterController::class, 'store'])->name('register-user');

        Route::get('/login', [AuthController::class, 'show'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])->name('login-user');

        Route::middleware('auth')->group(function () {
            Route::get('/redirect-user/{globalUserId}/to-tenant/{tenant}', [AuthController::class, 'redirectUserToTenant'])->name('redirect-user-to-tenant');
            Route::get('/central-logout', [AuthController::class, 'centralLogout'])->name('central-logout');
        });
    });
});
