<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\InviteController;
use App\Http\Controllers\Tenant\ProfileController;
use App\Http\Controllers\Tenant\UserController;
use App\Http\Controllers\Tenant\NotificationsController;
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
    Route::get('/invitation/accept/{token}', [InviteController::class, 'show'])->name('accept-invitation');
    Route::post('/invitation/accept/{token}', [InviteController::class, 'store'])->name('create-user');

    Route::middleware('auth')->group(function () {
        // Auth
        Route::name('auth.')->group(function () {
            Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
        });

        // Dashboard
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });
        Route::get('/dashboard', function () {
            // auth()->user()->notify(new \App\Notifications\Test());
            return view('tenant.dashboard');
        })->name('dashboard');

        // Settings
        Route::prefix('settings')->group(function () {
            // Notifications
            Route::name('notifications.')->group(function () {
                Route::get('/notifications/broadcast', [NotificationsController::class, 'broadcast'])->name('broadcast');
                Route::get('/notifications/clear-all', [NotificationsController::class, 'clearAll'])->name('clear-all');
            });

            // Profile
            Route::name('profile.')->group(function () {
                Route::get('/profile', [ProfileController::class, 'show'])->name('manage');
                Route::post('/profile/update-profile', [ProfileController::class, 'update'])->name('update');
                Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('manage-password');
                Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');

                Route::group(['middleware' => ['can:manage organization']], function () {
                    Route::post('/profile/update-organization-profile', [ProfileController::class, 'updateOrganization'])->name('update-organization');
                });
            });

            // Users
            Route::name('users.')->group(function () {
                Route::group(['middleware' => ['can:manage users']], function () {
                    Route::get('/users', [UserController::class, 'show'])->name('manage');
                    Route::get('/users/invite', [InviteController::class, 'show'])->name('create');
                    Route::post('/users/invite', [InviteController::class, 'create'])->name('invite');
                    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit');
                    Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('delete');
                });
            });
        });
    });
});
