<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\InviteController;
use App\Http\Controllers\Tenant\ClientController;
use App\Http\Controllers\Tenant\ChatController;
use App\Http\Controllers\Tenant\ContactController;
use App\Http\Controllers\Tenant\DashboardController;
use App\Http\Controllers\Tenant\NotificationsController;
use App\Http\Controllers\Tenant\TenantController;
use App\Http\Controllers\Tenant\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/impersonate/{token}', [AuthController::class, 'impersonate'])->name('impersonate');
    Route::get('/invitation/accept/{token}', [UserController::class, 'create'])->name('accept-invitation');
    Route::post('/invitation/accept/{token}', [UserController::class, 'store'])->name('create-user');

    Route::middleware('auth')->group(function () {
        // Auth
        Route::name('auth.')->group(function () {
            Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
        });

        // Dashboard
        Route::permanentRedirect('/', '/dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Notifications
        Route::group([
            'prefix' => '/notifications',
            'as' => 'notifications.',
        ], function () {
            Route::get('/clear/{id?}', [NotificationsController::class, 'destroy'])->name('destroy');
        });

        // Settings
        Route::prefix('settings')->group(function () {
            // Profile
            Route::group([
                'prefix' => '/profile',
                'as' => 'profile.',
            ], function () {
                Route::get('/', [UserController::class, 'edit'])->name('edit');
                Route::post('/update', [UserController::class, 'update'])->name('update');
                Route::get('/change-password', [UserController::class, 'editPassword'])->name('edit-password');
                Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
            });

            // Organization
            Route::group([
                'middleware' => ['can:manage organization'],
                'prefix' => '/organization',
                'as' => 'organization.',
            ], function () {
                Route::post('/update', [TenantController::class, 'update'])->name('update');
                Route::post('/update-customizer', [TenantController::class, 'updateCustomizer'])->name('update-customizer');
            });

            // Users
            Route::group([
                'middleware' => ['can:manage users'],
                'prefix' => '/users',
                'as' => 'users.',
            ], function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/search', [UserController::class, 'search'])->name('search');

                Route::group([
                    'prefix' => '/{id}',
                ], function () {
                    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
                    Route::get('/delete', [UserController::class, 'destroy'])->name('delete');
                    Route::get('/pagination', [UserController::class, 'perPage'])->name('per-page');
                });

                Route::group([
                    'prefix' => '/invite',
                    'as' => 'invite.',
                ], function () {
                    Route::get('/', [InviteController::class, 'create'])->name('create');
                    Route::post('/store', [InviteController::class, 'store'])->name('store');
                });
            });
        });

        // CRM
        Route::group([
            'middleware' => ['can:view clients'],
            'prefix' => '/clients',
        ], function () {
            Route::group([
                'as' => 'clients.',
            ], function () {
                Route::get('/', [ClientController::class, 'index'])->name('index');

                Route::middleware(['can:manage clients'])->group(function () {
                    Route::get('/create', [ClientController::class, 'create'])->name('create');
                    Route::post('/store', [ClientController::class, 'store'])->name('store');
                    Route::get('/search', [ClientController::class, 'search'])->name('search');

                    Route::group([
                        'prefix' => '/{id}',
                    ], function () {
                        Route::get('/edit', [ClientController::class, 'edit'])->name('edit');
                        Route::post('/edit', [ClientController::class, 'update'])->name('update');
                        Route::get('/delete', [ClientController::class, 'destroy'])->name('delete');
                    });
                });
            });

            Route::group([
                'middleware' => ['can:manage clients'],
                'prefix' => '/{client_id}/contacts',
                'as' => 'contacts.',
            ], function () {
                Route::post('/store', [ContactController::class, 'store'])->name('store');
                Route::post('/attach', [ClientController::class, 'attachContacts'])->name('attach');

                Route::group([
                    'prefix' => '/{id}',
                ], function () {
                    Route::get('/edit', [ContactController::class, 'edit'])->name('edit');
                    Route::post('/update', [ContactController::class, 'update'])->name('update');
                    Route::get('/remove', [ClientController::class, 'detachContact'])->name('detach');
                });
            });
        });

        // Chat
        Route::group([
            'prefix' => '/chat',
            'as' => 'chat.',
        ], function () {
            Route::get('/', [ChatController::class, 'index'])->name('index');

            Route::group([
                'prefix' => '/{id}',
            ], function () {
                Route::get('/', [ChatController::class, 'show'])->name('show');
                Route::post('/send', [ChatController::class, 'store'])->name('store');
            });
        });
    });
});
