<?php

namespace GamingEngine\Core\Account\Providers;

use GamingEngine\Core\Account\Http\View\Components\AuthLayoutComponent;
use GamingEngine\Core\Account\Http\View\Components\LoginComponent;
use GamingEngine\Core\Account\Repositories\EloquentUserRepository;
use GamingEngine\Core\Account\Repositories\UserRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            UserRepository::class,
            EloquentUserRepository::class
        );

        Blade::component(LoginComponent::class, 'login', 'ge:c:a');
        Blade::component(AuthLayoutComponent::class, 'layout', 'ge:c:a');
    }
}
