<?php

namespace GamingEngine\Core;

use GamingEngine\Core\Commands\CoreCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('gaming-engine::core')
            ->hasConfigFile('gaming-engine-core')
            ->hasViews()
            ->hasCommand(CoreCommand::class);

        $this->loadMigrationsFrom([
            'database/migrations',
        ]);
    }
}
