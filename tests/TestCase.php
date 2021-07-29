<?php

namespace GamingEngine\Core\Tests;

use GamingEngine\Core\CoreServiceProvider;
use GamingEngine\Core\EventServiceProvider;
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
                    ->replace('\\Models\\', '\\')
                . 'Factory'
        );
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        collect([
            __DIR__.'/../database/migrations/2021_07_11_000000_create_framework_migrations_table.php',
            __DIR__.'/../database/migrations/2021_07_11_000000_create_framework_modules_table.php',
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
        ];
    }
}
