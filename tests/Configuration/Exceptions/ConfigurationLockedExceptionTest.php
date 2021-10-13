<?php

namespace GamingEngine\Core\Tests\Configuration\Exceptions;

use GamingEngine\Core\Configuration\Entities\Configuration;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationLockedException;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Str;

class ConfigurationLockedExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function configuration_locked_message_contains_the_key_and_the_value_trying_to_be_set()
    {
        // Arrange
        $configuration = Configuration::unlock(fn () => Configuration::factory()->make());

        // Act
        $exception = new ConfigurationLockedException($configuration, 'foo');

        // Assert
        $this->assertTrue(
            Str::contains($exception->getMessage(), 'foo')
        );

        $this->assertTrue(
            Str::contains($exception->getMessage(), $configuration->key)
        );
    }
}
