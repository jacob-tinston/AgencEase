<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Tenant\ProfileController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Features\UserImpersonation;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware('tenant')->group(function () {
    // Authentication routes

    Route::get('/impersonate/{token}', function ($token) {
        return UserImpersonation::makeResponse($token);
    })->name('impersonate');
    
    Route::middleware('auth')->group(function () {
        // Auth
        Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

        // Dashboard
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        Route::get('/dashboard', function () {
            return view('tenant.dashboard');
        })->name('dashboard');

        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::post('/profile/update-profile', [ProfileController::class, 'update'])->name('update-profile');
        Route::post('/profile/update-organization-profile', [ProfileController::class, 'updateOrganization'])->name('update-organization-profile');
        Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
        Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
    });
});
