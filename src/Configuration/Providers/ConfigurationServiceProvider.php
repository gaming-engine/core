<?php

namespace GamingEngine\Core\Configuration\Providers;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\Repositories\CachedConfigurationRepository;
use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Core\Configuration\Repositories\DatabaseConfigurationRepository;
use GamingEngine\Core\Configuration\SiteConfiguration;
use GamingEngine\Core\Framework\Http\View\Composers\ConfigurationViewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    public function register()
    {
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

    public function boot()
    {
        View::composer('*', ConfigurationViewComposer::class);
    }
}
