<?php

namespace GamingEngine\Core\Framework\Providers;

use GamingEngine\Core\Framework\Http\Controllers\HomeController;
use GamingEngine\Core\Framework\Http\Controllers\InstallationRequiredController;
use GamingEngine\Core\Framework\Http\Middleware\InstallationStatusMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware(InstallationStatusMiddleware::class)
            ->group(function () {
                Route::get('/', HomeController::class)
                    ->name('home');
            });

        Route::get('/installation', InstallationRequiredController::class)
            ->name('installation-required');
    }
}
