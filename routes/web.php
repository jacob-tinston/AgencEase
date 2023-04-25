<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Central\HomeController;
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

Route::middleware('central')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Auth
    Route::name('auth.')->group(function () {
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::post('/register', [RegisterController::class, 'store'])->name('register-user');

        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])->name('login-user');

        Route::middleware('auth')->group(function () {
            Route::get('/redirect-user/{globalUserId}/to-tenant/{tenant}', [AuthController::class, 'redirectUserToTenant'])->name('redirect-user-to-tenant');
            Route::get('/central-logout', [AuthController::class, 'centralLogout'])->name('central-logout');
        });
    });
});
