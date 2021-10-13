<?php

namespace GamingEngine\Core\Tests\Framework\Http\View\Composers;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\SiteConfiguration;
use GamingEngine\Core\Framework\Http\View\Composers\ConfigurationViewComposer;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\View\View;

class ConfigurationViewComposerTest extends TestCase
{
    /**
     * @test
     */
    public function configuration_view_composer_composes_with_configuration_values()
    {
        // Arrange
        /**
         * @var View $view
         */
        $view = $this->mock(View::class);
        $accountConfiguration = $this->app->get(AccountConfiguration::class);
        $siteConfiguration = $this->app->get(SiteConfiguration::class);
        $composer = new ConfigurationViewComposer($accountConfiguration, $siteConfiguration);

        $view->shouldReceive('with')
            ->withArgs([
                'accountConfiguration',
                $accountConfiguration,
            ]);

        $view->shouldReceive('with')
            ->withArgs([
                'siteConfiguration',
                $siteConfiguration,
            ]);

        // Act
        $composer->compose($view);

        // Assert
    }
}
