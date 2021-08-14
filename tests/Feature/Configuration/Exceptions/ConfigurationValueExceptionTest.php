<?php

namespace GamingEngine\Core\Tests\Feature\Configuration\Exceptions;

use GamingEngine\Core\Configuration\Exceptions\ConfigurationValueException;
use GamingEngine\Core\Configuration\Models\Configuration;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Str;

class ConfigurationValueExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function configuration_value_message_contains_the_key_and_the_value_trying_to_be_set()
    {
        // Arrange
        $configuration = Configuration::unlock(fn () => Configuration::factory()->make());

        // Act
        $exception = new ConfigurationValueException($configuration);

        // Assert
        $this->assertTrue(
            Str::contains($exception->getMessage(), $configuration->value)
        );

        $this->assertTrue(
            Str::contains($exception->getMessage(), $configuration->key)
        );
    }
}
