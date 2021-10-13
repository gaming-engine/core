<?php

namespace GamingEngine\Core\Tests\Configuration\Application;

use GamingEngine\Core\Configuration\Application\LaravelConfiguration;
use GamingEngine\Core\Framework\Environment\Environments;
use GamingEngine\Core\Tests\TestCase;
use InvalidArgumentException;

class LaravelConfigurationTest extends TestCase
{
    public static function validEnvironments(): array
    {
        return collect(Environments::available())
            ->transform(fn (string $environment) => [
                $environment,
            ])->toArray();
    }

    /**
     * @test
     */
    public function ensures_it_defaults_missing_environment_configurations_to_production()
    {
        // Arrange

        // Act
        $configuration = new LaravelConfiguration([]);

        // Assert
        $this->assertEquals(
            Environments::PRODUCTION,
            $configuration->environment()
        );
    }

    /**
     * @test
     * @dataProvider validEnvironments
     */
    public function ensures_it_will_read_the_environment_configuration(string $environment)
    {
        // Arrange

        // Act
        $configuration = new LaravelConfiguration([
            'env' => $environment,
        ]);

        // Assert
        $this->assertEquals(
            $environment,
            $configuration->environment()
        );
    }

    /**
     * @test
     */
    public function ensures_that_you_receive_an_exception_with_an_invalid_environment_name()
    {
        // Arrange
        $this->expectException(InvalidArgumentException::class);

        // Act
        new LaravelConfiguration([
            'env' => 'invalid',
        ]);

        // Assert
    }
}
