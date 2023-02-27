<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthController;
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
        Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

        // Dahboard
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        Route::get('/dashboard', function () {
            return view('tenant.dashboard');
        })->name('dashboard');

        // UI
        Route::prefix('ui')->group(function () {

            // Form
            Route::prefix('form')->group(function () {
                Route::get('/components', function () {
                    return view('form-components');
                });
                Route::get('/input-groups', function () {
                    return view('form-input-groups');
                });
                Route::get('/layout', function () {
                    return view('form-layout');
                });
                Route::get('/validations', function () {
                    return view('form-validations');
                });
                Route::get('/wizards', function () {
                    return view('form-wizards');
                });
            });

            // Components
            Route::prefix('components')->group(function () {
                Route::get('/alerts', function () {
                    return view('components-alerts');
                });
                Route::get('/avatars', function () {
                    return view('components-avatars');
                });
                Route::get('/badges', function () {
                    return view('components-badges');
                });
                Route::get('/buttons', function () {
                    return view('components-buttons');
                });
                Route::get('/cards', function () {
                    return view('components-cards');
                });
                Route::get('/collapse', function () {
                    return view('components-collapse');
                });
                Route::get('/colors', function () {
                    return view('components-colors');
                });
                Route::get('/dropdowns', function () {
                    return view('components-dropdowns');
                });
                Route::get('/modal', function () {
                    return view('components-modal');
                });
                Route::get('/popovers-tooltips', function () {
                    return view('components-popovers-tooltips');
                });
                Route::get('/tables', function () {
                    return view('components-tables');
                });
                Route::get('/tabs', function () {
                    return view('components-tabs');
                });
                Route::get('/toasts', function () {
                    return view('components-toasts');
                });
            });

            // Extras
            Route::prefix('extras')->group(function () {
                Route::get('/carousel', function () {
                    return view('extras-carousel');
                });
                Route::get('/charts', function () {
                    return view('extras-charts');
                });
                Route::get('/editors', function () {
                    return view('extras-editors');
                });
                Route::get('/sortable', function () {
                    return view('extras-sortable');
                });
            });
        });

        // Applications
        Route::prefix('applications')->group(function () {
            Route::get('/chat', function () {
                return view('applications-chat');
            });
            Route::get('/media-library', function () {
                return view('applications-media-library');
            });
            Route::get('/point-of-sale', function () {
                return view('applications-point-of-sale');
            });
            Route::get('/to-do', function () {
                return view('applications-to-do');
            });
        });

        // Pages
        Route::prefix('pages')->group(function () {
            Route::prefix('blog')->group(function () {
                Route::get('/list', function () {
                    return view('blog-list');
                });
                Route::get('/list-card-rows', function () {
                    return view('blog-list-card-rows');
                });
                Route::get('/list-card-columns', function () {
                    return view('blog-list-card-columns');
                });
                Route::get('/add', function () {
                    return view('blog-add');
                });
            });
            Route::get('/pricing', function () {
                return view('pages-pricing');
            });
            Route::get('/faqs-layout-1', function () {
                return view('pages-faqs-layout-1');
            });
            Route::get('/faqs-layout-2', function () {
                return view('pages-faqs-layout-2');
            });
            Route::get('/invoice', function () {
                return view('pages-invoice');
            });
        });

        // Blank
        Route::get('/blank', function () {
            return view('blank');
        });
    });
});
