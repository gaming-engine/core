<?php

namespace GamingEngine\Core;

use GamingEngine\Core\Commands\CoreCommand;
use GamingEngine\Core\Framework\Module\CachedModuleCollection;
use GamingEngine\Core\Framework\Module\CoreModule;
use GamingEngine\Core\Framework\Module\IModuleCollection;
use GamingEngine\Core\Framework\Module\ModuleCollection;
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
            ->name('gaming-engine:core')
            ->hasConfigFile('gaming-engine-core')
            ->hasViews()
            ->hasCommand(CoreCommand::class);

        $this->loadMigrationsFrom([
            'database/migrations',
        ]);

        $this->publishMigrations();
    }

    public function packageBooted()
    {
        app()->singleton(
            IModuleCollection::class,
            fn () => new CachedModuleCollection(
                new ModuleCollection()
            )
        );

        /**
         * @var Core
         */
        app(Core::class)->registerPackage(
            app(CoreModule::class)
        );
    }

    private function publishMigrations()
    {
        $path = $this->getMigrationsPath();
        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    private function getMigrationsPath()
    {
        return __DIR__ . '/../database/migrations/';
    }
}
