<?php

namespace GamingEngine\Core\Account\Providers;

use GamingEngine\Core\Account\Repositories\EloquentUserRepository;
use GamingEngine\Core\Account\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUserRepository::class);
    }
}
