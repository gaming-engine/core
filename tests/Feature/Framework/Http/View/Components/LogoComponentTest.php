<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Http\View\Components;

use GamingEngine\Core\Configuration\SiteConfiguration;
use GamingEngine\Core\Framework\Http\View\Components\LogoComponent;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LogoComponentTest extends TestCase
{
    /**
     * @test
     */
    public function logo_component_renders_an_image()
    {
        // Arrange
        $configuration = $this->mock(SiteConfiguration::class);

        $configuration->logoUrl = Str::random();
        $configuration->name = Str::random();

        $component = new LogoComponent($configuration);

        // Act
        /**
         * @var View $response
         */
        $response = $component->render();

        // Assert
        $this->assertTrue(
            Str::contains($response->toHtml(), $configuration->logoUrl)
        );

        $this->assertTrue(
            Str::contains($response->toHtml(), $configuration->name)
        );
    }
}
