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
    public function values_are_automatically_hydrated()
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
    public function values_are_tested_for_type_safety()
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
    public function cannot_be_assigned_a_value_that_is_not_on_the_object()
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
}

class SampleConfiguration extends BaseConfiguration
{
    public int $test;

    public static function type(): string
    {
        return 'testing';
    }
}
