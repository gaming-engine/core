<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Environment;

use GamingEngine\Core\Framework\Configuration\Application\ApplicationConfiguration;
use GamingEngine\Core\Framework\Environment\DevelopmentEnvironment;
use GamingEngine\Core\Framework\Environment\EnvironmentFactory;
use GamingEngine\Core\Framework\Environment\Environments;
use GamingEngine\Core\Framework\Environment\ProductionEnvironment;
use GamingEngine\Core\Tests\TestCase;

class EnvironmentFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function environment_factory_defaults_to_production_mode()
    {
        // Arrange
        $configuration = $this->mock(ApplicationConfiguration::class);
        $configuration->shouldReceive('environment')
            ->andReturn('');
        $builder = new EnvironmentFactory($configuration);

        // Act
        $result = $builder->build();

        // Assert
        $this->assertInstanceOf(
            ProductionEnvironment::class,
            $result
        );
    }

    /**
     * @test
     */
    public function environment_factory_maps_development_to_the_development_environment()
    {
        // Arrange
        $configuration = $this->mock(ApplicationConfiguration::class);
        $configuration->shouldReceive('environment')
            ->andReturn(Environments::DEVELOPMENT);
        $builder = new EnvironmentFactory($configuration);

        // Act
        $result = $builder->build();

        // Assert
        $this->assertInstanceOf(
            DevelopmentEnvironment::class,
            $result
        );
    }

    /**
     * @test
     */
    public function environment_factory_maps_testing_to_the_development_environment()
    {
        // Arrange
        $configuration = $this->mock(ApplicationConfiguration::class);
        $configuration->shouldReceive('environment')
            ->andReturn(Environments::TESTING);
        $builder = new EnvironmentFactory($configuration);

        // Act
        $result = $builder->build();

        // Assert
        $this->assertInstanceOf(
            DevelopmentEnvironment::class,
            $result
        );
    }

    /**
     * @test
     */
    public function environment_factory_maps_staging_to_the_production_environment()
    {
        // Arrange
        $configuration = $this->mock(ApplicationConfiguration::class);
        $configuration->shouldReceive('environment')
            ->andReturn(Environments::STAGING);
        $builder = new EnvironmentFactory($configuration);

        // Act
        $result = $builder->build();

        // Assert
        $this->assertInstanceOf(
            ProductionEnvironment::class,
            $result
        );
    }

    /**
     * @test
     */
    public function environment_factory_maps_production_to_the_production_environment()
    {
        // Arrange
        $configuration = $this->mock(ApplicationConfiguration::class);
        $configuration->shouldReceive('environment')
            ->andReturn(Environments::PRODUCTION);
        $builder = new EnvironmentFactory($configuration);

        // Act
        $result = $builder->build();

        // Assert
        $this->assertInstanceOf(
            ProductionEnvironment::class,
            $result
        );
    }
}
