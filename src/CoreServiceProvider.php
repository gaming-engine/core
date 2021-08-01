<?php

namespace GamingEngine\Core;

use GamingEngine\Core\Commands\CoreCommand;
use GamingEngine\Core\Framework\Configuration\Application\ApplicationConfiguration;
use GamingEngine\Core\Framework\Configuration\Application\LaravelConfiguration;
use GamingEngine\Core\Framework\Configuration\Site\SiteConfiguration;
use GamingEngine\Core\Framework\Environment\Environment;
use GamingEngine\Core\Framework\Environment\EnvironmentFactory;
use GamingEngine\Core\Framework\Http\View\Components\LogoComponent;
use GamingEngine\Core\Framework\Http\View\Composers\ConfigurationViewComposer;
use GamingEngine\Core\Framework\Module\CachedModuleCollection;
use GamingEngine\Core\Framework\Module\CoreModule;
use GamingEngine\Core\Framework\Module\CoreModuleCollection;
use GamingEngine\Core\Framework\Module\ModuleCollection;
use GamingEngine\Core\Framework\Repositories\Configuration\DatabaseSiteConfiguration;
use GamingEngine\Core\Framework\Repositories\Configuration\SiteConfigurationRepository;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $this->app->singleton(
            ApplicationConfiguration::class,
            fn () => new LaravelConfiguration(config('app'))
        );

        $this->app->singleton(
            Environment::class,
            fn () => app(EnvironmentFactory::class)->build()
        );

        $this->app->singleton(
            SiteConfigurationRepository::class,
            fn () => new DatabaseSiteConfiguration()
        );

        $this->app->singleton(
            SiteConfiguration::class,
            fn () => app(SiteConfigurationRepository::class)->build()
        );

        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('gaming-engine:core')
            ->hasConfigFile('gaming-engine-core')
            ->hasViews()
            ->hasCommand(CoreCommand::class)
            ->hasViewComposer('*', ConfigurationViewComposer::class);

        Blade::component('ge:c-logo', LogoComponent::class);

        $this->loadMigrationsFrom([
            'database/migrations',
        ]);

        $this->publishAssets();
        $this->publishMigrations();
    }

    public function packageBooted()
    {
        $this->app->singleton(
            ModuleCollection::class,
            fn () => new CachedModuleCollection(
                new CoreModuleCollection()
            )
        );

        /**
         * @var Core
         */
        app(Core::class)->registerPackage(
            app(CoreModule::class)
        );
    }

    private function publishAssets(): void
    {
        $environment = $this->environment();

        $this->publishes([
            __DIR__ . "/../dist/$environment/public/js/" => 'public/js/',
            __DIR__ . "/../dist/$environment/public/css/" => 'public/css/',
        ], 'resources');
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

    private function environment(): string
    {
        /**
         * @var Environment
         */
        return $this->app->get(Environment::class)
            ->name();
    }
}
