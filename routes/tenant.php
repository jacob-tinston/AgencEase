<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\InviteController;
use App\Http\Controllers\Tenant\CRMController;
use App\Http\Controllers\Tenant\NotificationsController;
use App\Http\Controllers\Tenant\ProfileController;
use App\Http\Controllers\Tenant\UserController;
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
            return view('tenant.dashboard');
        })->name('dashboard');

        // Settings
        Route::prefix('settings')->group(function () {
            // Notifications
            Route::group([
                'prefix' => '/notifications',
                'as' => 'notifications.',
            ], function () {
                Route::get('/broadcast', [NotificationsController::class, 'broadcast'])->name('broadcast');
                Route::get('/clear-all', [NotificationsController::class, 'clearAll'])->name('clear-all');
            });

            // Profile
            Route::group([
                'prefix' => '/profile',
                'as' => 'profile.',
            ], function () {
                Route::get('/', [ProfileController::class, 'show'])->name('manage');
                Route::post('/update-profile', [ProfileController::class, 'update'])->name('update');
                Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('manage-password');
                Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');

                Route::middleware(['can:manage organization'])->group(function () {
                    Route::post('/update-organization-profile', [ProfileController::class, 'updateOrganization'])->name('update-organization');
                    Route::post('/update-customizer', [ProfileController::class, 'updateCustomizer'])->name('update-customizer');
                });
            });

            // Users
            Route::group([
                'middleware' => ['can:manage users'],
                'prefix' => '/users',
                'as' => 'users.',
            ], function () {
                Route::get('/', [UserController::class, 'show'])->name('manage');
                Route::get('/invite', [InviteController::class, 'show'])->name('create');
                Route::post('/invite', [InviteController::class, 'create'])->name('invite');
                Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
                Route::get('/{id}/delete', [UserController::class, 'destroy'])->name('delete');
            });
        });

        // CRM
        Route::group([
            'middleware' => ['can:manage clients'],
            'prefix' => '/clients',
            'as' => 'clients.',
        ], function () {
            Route::get('/', [CRMController::class, 'show'])->name('manage');
            Route::get('/create', [CRMController::class, 'show'])->name('create');
        });
    });
});
