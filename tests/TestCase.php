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

    protected function getPackageProviders($app)
    {
        return [
            CoreServiceProvider::class,
            EventServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_core_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
