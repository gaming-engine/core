<?php

namespace GamingEngine\Core;

use GamingEngine\Core\Configuration\Application\ApplicationConfiguration;
use GamingEngine\Core\Configuration\Application\LaravelConfiguration;
use GamingEngine\Core\Framework\Database\Schema;
use GamingEngine\Core\Framework\Database\ValidatesSchema;
use GamingEngine\Core\Framework\Environment\Environment;
use GamingEngine\Core\Framework\Environment\EnvironmentFactory;
use GamingEngine\Core\Framework\Http\View\Components\LayoutComponent;
use GamingEngine\Core\Framework\Http\View\Components\LogoComponent;
use GamingEngine\Core\Framework\Http\View\Components\NotificationComponent;
use GamingEngine\Core\Framework\Module\CachedModuleCollection;
use GamingEngine\Core\Framework\Module\CoreModule;
use GamingEngine\Core\Framework\Module\CoreModuleCollection;
use GamingEngine\Core\Framework\Module\ModuleCollection;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('gaming-engine:core')
            ->hasConfigFile('gaming-engine-core')
            ->hasViews();

        Blade::component(LayoutComponent::class, 'layout', 'ge:c');
        Blade::component(LogoComponent::class, 'logo', 'ge:c');
        Blade::component(NotificationComponent::class, 'notifications', 'ge:c');

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
            __DIR__ . "/../dist/$environment/" => 'public/modules/framework/',
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
        ], 'gaming-engine:core-migrations');
    }

    private function publishSeeders()
    {
        $this->publishes([
            __DIR__ . '/../database/seeders/CoreDatabaseSeeder.stub' => database_path('seeders/CoreDatabaseSeeder.php'),
        ], 'gaming-engine:core-seeders');
    }

    public function publishLanguages()
    {
        $this->loadTranslationsFrom(
            __DIR__ . '/../resources/lang',
            'gaming-engine:core'
        );
    }

    public function registeringPackage()
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
            ValidatesSchema::class,
            fn () => new Schema()
        );

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
    }
}
