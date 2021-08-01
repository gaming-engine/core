<?php

namespace GamingEngine\Core\Framework\Providers;

use GamingEngine\Core\Framework\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::get('/', HomeController::class)
            ->name('home');
    }
}
