<?php

namespace GamingEngine\Core\Framework\Providers;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\Repositories\CachedConfigurationRepository;
use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Core\Configuration\Repositories\DatabaseConfigurationRepository;
use GamingEngine\Core\Configuration\SiteConfiguration;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->singleton(
            ConfigurationRepository::class,
            fn () => new CachedConfigurationRepository(
                new DatabaseConfigurationRepository()
            )
        );

        $this->app->singleton(
            SiteConfiguration::class,
            function () {
                /**
                 * @var ConfigurationRepository
                 */
                return app(ConfigurationRepository::class)
                    ->site();
            }
        );

        $this->app->singleton(
            AccountConfiguration::class,
            function () {
                /**
                 * @var ConfigurationRepository
                 */
                return app(ConfigurationRepository::class)
                    ->account();
            }
        );
    }
}
