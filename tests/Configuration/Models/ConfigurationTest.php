<?php

namespace GamingEngine\Core\Tests\Configuration\Models;

use GamingEngine\Core\Configuration\Entities\Configuration;
use GamingEngine\Core\Configuration\Enumerations\ConfigurationValueTypes;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationLockedException;
use GamingEngine\Core\Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public static function booleanDataProvider(): array
    {
        return [
            [0, false],
            ['0', false],
            ['false', false],
            [false, false],
            [1, true],
            ['1', true],
            ['true', true],
            [true, true],
            [null, null],
        ];
    }

    public static function integerDataProvider(): array
    {
        return [
            ['0', 0],
            [0, 0],
            [0.5, 0],
            ['a', 0],
            [null, null],
        ];
    }

    public static function numberDataProvider(): array
    {
        return [
            ['0', 0],
            ['0.5', 0.5],
            [0, 0],
            [0.5, 0.5],
            ['a', 0],
            [null, null],
        ];
    }

    public static function stringDataProvider(): array
    {
        return [
            ['a'],
            [null],
        ];
    }

    /**
     * @test
     */
    public function an_error_is_received_when_you_update_the_default_value_and_have_not_unlocked_the_configurations()
    {
        // Arrange
        $model = new Configuration();
        $this->expectException(ConfigurationLockedException::class);

        // Act
        $model->default_value = 'foo';

        // Assert
    }

    /**
     * @test
     */
    public function you_are_able_to_set_a_default_value_if_unlocked()
    {
        // Arrange
        $model = new Configuration();

        // Act
        Configuration::unlock(
            fn () => $model->value = 'foo'
        );

        // Assert
        $this->assertEquals(
            'foo',
            $model->value
        );
    }

    /**
     * @test
     * @dataProvider booleanDataProvider
     */
    public function automatically_converts_boolean_values($value, $expected)
    {
        // Arrange
        $model = Configuration::unlock(
            fn () => new Configuration([
                'type' => ConfigurationValueTypes::BOOLEAN,
                'default_value' => null,
            ])
        );

        // Act
        Configuration::unlock(
            fn () => $model->value = $value
        );

        // Assert
        $this->assertEquals(
            $expected,
            $model->value
        );
    }

    /**
     * @test
     * @dataProvider integerDataProvider
     */
    public function automatically_converts_integer_values($value, $expected)
    {
        // Arrange
        $model = Configuration::unlock(
            fn () => new Configuration([
                'type' => ConfigurationValueTypes::INTEGER,
                'default_value' => null,
            ])
        );

        // Act
        Configuration::unlock(
            fn () => $model->value = $value
        );

        // Assert
        $this->assertEquals(
            $expected,
            $model->value
        );
    }

    /**
     * @test
     * @dataProvider numberDataProvider
     */
    public function automatically_converts_floating_point_values($value, $expected)
    {
        // Arrange
        $model = Configuration::unlock(
            fn () => new Configuration([
                'type' => ConfigurationValueTypes::NUMBER,
                'default_value' => null,
            ])
        );

        // Act
        Configuration::unlock(
            fn () => $model->value = $value
        );

        // Assert
        $this->assertEquals(
            $expected,
            $model->value
        );
    }

    /**
     * @test
     * @dataProvider numberDataProvider
     */
    public function automatically_converts_string_values($value)
    {
        // Arrange
        $model = Configuration::unlock(
            fn () => new Configuration([
                'type' => ConfigurationValueTypes::STRING,
                'default_value' => null,
            ])
        );

        // Act
        Configuration::unlock(
            fn () => $model->value = $value
        );

        // Assert
        $this->assertEquals(
            $value,
            $model->value
        );
    }
}
