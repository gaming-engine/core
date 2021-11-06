<?php

namespace GamingEngine\Core\Tests\Configuration;

use GamingEngine\Core\Configuration\BaseConfiguration;
use GamingEngine\Core\Configuration\Entities\Configuration;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationPropertyException;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationValueException;
use GamingEngine\Core\Tests\TestCase;

class BaseConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function base_configuration_values_are_automatically_hydrated()
    {
        // Arrange

        // Act
        $result = new SampleConfiguration(
            collect([
                new Configuration([
                    'key' => 'test',
                    'category' => 'sample',
                    'value' => 10,
                ]),
            ])
        );

        // Assert
        /** @noinspection PhpTypedPropertyMightBeUninitializedInspection */
        $this->assertEquals(
            10,
            $result->test
        );
    }

    /**
     * @test
     */
    public function base_configuration_values_are_tested_for_type_safety()
    {
        // Arrange
        $this->expectException(ConfigurationValueException::class);

        // Act
        new SampleConfiguration(
            collect([
                new Configuration([
                    'key' => 'test',
                    'category' => 'sample',
                    'value' => 'asdf',
                ]),
            ])
        );

        // Assert
    }

    /**
     * @test
     */
    public function base_configuration_cannot_be_assigned_a_value_that_is_not_on_the_object()
    {
        // Arrange
        $this->expectException(ConfigurationPropertyException::class);

        // Act
        new SampleConfiguration(
            collect([
                new Configuration([
                    'key' => 'foot',
                    'category' => 'sample',
                    'value' => 'asdf',
                ]),
            ])
        );

        // Assert
    }

    /**
     * @test
     */
    public function base_configuration_is_able_to_be_overridden()
    {
        // Arrange
        $base = new SampleConfiguration(
            collect([
                new Configuration([
                    'key' => 'test',
                    'category' => 'sample',
                    'value' => 10,
                ]),
                new Configuration([
                    'key' => 'foo',
                    'category' => 'sample',
                    'value' => 'hello',
                ]),
            ])
        );

        // Act
        $subject = SampleConfiguration::fromConfiguration($base, [
            'foo' => 'bye',
        ]);

        // Assert
        $this->assertEquals(
            'bye',
            $subject->foo
        );

        $this->assertEquals(
            10,
            $subject->test,
        );
    }
}

class SampleConfiguration extends BaseConfiguration
{
    public int $test;

    public string $foo;

    public static function type(): string
    {
        return 'testing';
    }
}
