<?php

namespace GamingEngine\Core\Tests\Feature\Configuration\Exceptions;

use GamingEngine\Core\Configuration\Exceptions\ConfigurationPropertyException;
use GamingEngine\Core\Configuration\Models\Configuration;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Str;

class ConfigurationPropertyExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function configuration_property_message_contains_the_key_and_the_value_trying_to_be_set()
    {
        // Arrange
        $configuration = Configuration::unlock(fn () => Configuration::factory()->make());

        // Act
        $exception = new ConfigurationPropertyException($configuration);

        // Assert
        $this->assertTrue(
            Str::contains($exception->getMessage(), $configuration->category)
        );

        $this->assertTrue(
            Str::contains($exception->getMessage(), $configuration->key)
        );
    }
}
