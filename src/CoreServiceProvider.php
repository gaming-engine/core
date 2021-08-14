<?php

namespace GamingEngine\Core;

use GamingEngine\Core\Configuration\Application\ApplicationConfiguration;
use GamingEngine\Core\Configuration\Application\LaravelConfiguration;
use GamingEngine\Core\Framework\Database\DatabaseSchema;
use GamingEngine\Core\Framework\Database\Schema;
use GamingEngine\Core\Framework\Environment\Environment;
use GamingEngine\Core\Framework\Environment\EnvironmentFactory;
use GamingEngine\Core\Framework\Http\View\Components\LogoComponent;
use GamingEngine\Core\Framework\Http\View\Composers\ConfigurationViewComposer;
use GamingEngine\Core\Framework\Module\CachedModuleCollection;
use GamingEngine\Core\Framework\Module\CoreModule;
use GamingEngine\Core\Framework\Module\CoreModuleCollection;
use GamingEngine\Core\Framework\Module\ModuleCollection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
            function () {
                /**
                 * @var EnvironmentFactory $factory
                 */
                $factory = app(EnvironmentFactory::class);

                return $factory->build();
            }
        );

        $this->app->singleton(
            DatabaseSchema::class,
            fn () => new Schema()
        );

        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('gaming-engine:core')
            ->hasConfigFile('gaming-engine-core')
            ->hasViews();

        Blade::component('ge:c-logo', LogoComponent::class);

        $this->loadMigrationsFrom([
            'database/migrations',
        ]);

        $this->publishAssets();
        $this->publishMigrations();
        $this->publishSeeders();
        $this->publishLanguages();
    }

    private function publishAssets(): void
    {
        $environment = $this->environment();

        $this->publishes([
            __DIR__ . "/../dist/$environment/public/js/" => 'public/js/framework/',
            __DIR__ . "/../dist/$environment/public/css/" => 'public/css/framework/',
            __DIR__ . '/../resources/images' => 'public/images/framework/',
        ], 'gaming-engine:core-resources');
    }

    private function environment(): string
    {
        /**
         * @var Environment
         */
        return $this->app->get(Environment::class)
            ->name();
    }

    private function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    private function publishSeeders()
    {
        $this->publishes([
            __DIR__ . '/../database/seeders/CoreDatabaseSeeder.php' => database_path('seeders/CoreDatabaseSeeder.php'),
        ], 'gaming-engine:core-seeders');
    }

    public function publishLanguages()
    {
        $this->loadTranslationsFrom(
            __DIR__ . '/../resources/lang',
            'gaming-engine'
        );
    }

    public function packageRegistered()
    {
        $this->app->singleton(
            ModuleCollection::class,
            fn () => new CachedModuleCollection(
                new CoreModuleCollection()
            )
        );
    }

    public function packageBooted()
    {
        /**
         * @var $core Core
         */
        $core = app(Core::class);

        $core->registerPackage(app(CoreModule::class));

        if ($core->installed()) {
            View::composer('*', ConfigurationViewComposer::class);
        }
    }
}
