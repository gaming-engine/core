<?php

namespace GamingEngine\Core\Tests;

use GamingEngine\Core\Account\Providers\UserServiceProvider;
use GamingEngine\Core\Configuration\Providers\ConfigurationServiceProvider;
use GamingEngine\Core\CoreServiceProvider;
use GamingEngine\Core\Database\Seeders\AccountConfigurationKeySeeder;
use GamingEngine\Core\Database\Seeders\SiteConfigurationKeySeeder;
use GamingEngine\Core\Framework\Providers\EventServiceProvider;
use GamingEngine\Core\Framework\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => Str::of($modelName)
                    ->replace(
                        'GamingEngine\\Core\\',
                        'GamingEngine\\Core\\Database\\Factories\\'
                    )
                    ->replace('\\Entities\\', '\\')
                . 'Factory'
        );

        (new AccountConfigurationKeySeeder())->run();
        (new SiteConfigurationKeySeeder())->run();
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        collect([
            __DIR__ . '/../database/migrations/2021_07_11_000000_create_framework_migrations_table.php',
            __DIR__ . '/../database/migrations/2021_07_11_000000_create_framework_modules_table.php',
            __DIR__ . '/../database/migrations/2021_08_01_000000_create_configurations_table.php',
        ])->each(function (string $path) {
            $migration = include $path;
            $migration->up();
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
            EventServiceProvider::class,
            RouteServiceProvider::class,
            ConfigurationServiceProvider::class,
            UserServiceProvider::class,
        ];
    }
}
