<?php

namespace GamingEngine\Core;

use GamingEngine\Core\Listeners\Migrations\LogPackageMigration;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MigrationEnded::class => [
            LogPackageMigration::class,
        ]
    ];
}
