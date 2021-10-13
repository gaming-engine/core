<?php

namespace GamingEngine\Core\Tests\Framework\Environment;

use GamingEngine\Core\Framework\Environment\DevelopmentEnvironment;
use GamingEngine\Core\Framework\Environment\Environments;
use PHPUnit\Framework\TestCase;

class DevelopmentEnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function development_environment_name()
    {
        // Arrange
        $environment = new DevelopmentEnvironment();

        // Act

        // Assert
        $this->assertEquals(
            Environments::DEVELOPMENT,
            $environment->name()
        );
    }

    /**
     * @test
     */
    public function development_environment_disables_cache()
    {
        // Arrange
        $environment = new DevelopmentEnvironment();

        // Act

        // Assert
        $this->assertEquals(
            false,
            $environment->cache()
        );
    }

    /**
     * @test
     */
    public function development_environment_enables_debug_mode()
    {
        // Arrange
        $environment = new DevelopmentEnvironment();

        // Act

        // Assert
        $this->assertEquals(
            true,
            $environment->debug()
        );
    }
}
