<?php

namespace GamingEngine\Core\Account\Providers;

use GamingEngine\Core\Framework\Http\Middleware\InstallationStatusMiddleware;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('api/v1/')
                ->name('api.v1.')
                ->group(__DIR__ . '/../Routes/api.php');

            Route::middleware('web')
                ->middleware(InstallationStatusMiddleware::class)
                ->group(__DIR__ . '/../Routes/web.php');
        });
    }
}
