<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Environment;

use GamingEngine\Core\Framework\Environment\Environments;
use GamingEngine\Core\Framework\Environment\ProductionEnvironment;
use PHPUnit\Framework\TestCase;

class ProductionEnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function development_environment_name()
    {
        // Arrange
        $environment = new ProductionEnvironment();

        // Act

        // Assert
        $this->assertEquals(
            Environments::PRODUCTION,
            $environment->name()
        );
    }

    /**
     * @test
     */
    public function production_environment_enables_cache()
    {
        // Arrange
        $environment = new ProductionEnvironment();

        // Act

        // Assert
        $this->assertEquals(
            true,
            $environment->cache()
        );
    }

    /**
     * @test
     */
    public function development_environment_disables_debug_mode()
    {
        // Arrange
        $environment = new ProductionEnvironment();

        // Act

        // Assert
        $this->assertEquals(
            false,
            $environment->debug()
        );
    }
}
