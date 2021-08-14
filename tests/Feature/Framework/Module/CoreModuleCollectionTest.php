<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Module;

use GamingEngine\Core\Framework\Module\CoreModuleCollection;
use GamingEngine\Core\Framework\Module\Module;
use GamingEngine\Core\Tests\TestCase;

class CoreModuleCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function when_constructed_it_will_not_hydrate_if_nothing_is_provided()
    {
        // Arrange

        // Act
        $moduleCollection = new CoreModuleCollection();

        // Assert
        $this->assertCount(0, $moduleCollection->all());
    }

    /**
     * @test
     */
    public function when_constructed_it_will_hydrate_if_data_is_provided()
    {
        // Arrange
        $mock = $this->mock(Module::class);

        $mock->shouldReceive('name')
            ->andReturn('foo');

        $data = [
            $mock,
        ];

        // Act
        $moduleCollection = new CoreModuleCollection($data);

        // Assert
        $this->assertCount(1, $moduleCollection->all());
        $this->assertEquals($data, $moduleCollection->all());
    }

    /**
     * @test
     */
    public function ensures_you_are_able_to_add_new_modules()
    {
        // Arrange
        $moduleCollection = new CoreModuleCollection();
        $first = $this->mock(Module::class);
        $first->shouldReceive('name')
            ->andReturn('foo');
        $second = $this->mock(Module::class);
        $second->shouldReceive('name')
            ->andReturn('bar');

        // Act
        $total = $moduleCollection->addModules([
            $first,
            $second,
        ]);

        // Assert
        $this->assertEquals(2, $total);
        $this->assertCount(2, $moduleCollection->all());
    }

    /**
     * @test
     */
    public function ensures_that_duplicate_modules_are_not_able_to_be_added()
    {
        // Arrange
        $moduleCollection = new CoreModuleCollection();
        $first = $this->mock(Module::class);
        $first->shouldReceive('name')
            ->andReturn('foo');

        // Act
        $total = $moduleCollection->addModules([
            $first,
            $first,
        ]);

        // Assert
        $this->assertEquals(1, $total);
        $this->assertCount(1, $moduleCollection->all());
    }

    /**
     * @test
     */
    public function ensures_that_you_are_able_to_add_a_module()
    {
        // Arrange
        $moduleCollection = new CoreModuleCollection();
        $mock = $this->mock(Module::class);

        // Act
        $response = $moduleCollection->addModule($mock);

        // Assert
        $this->assertTrue($response);
        $this->assertCount(1, $moduleCollection->all());
    }

    /**
     * @test
     */
    public function ensures_that_you_are_not_able_to_re_add_the_module()
    {
        // Arrange
        $mock = $this->mock(Module::class);
        $moduleCollection = new CoreModuleCollection([
            $mock,
        ]);

        // Act
        $response = $moduleCollection->addModule($mock);

        // Assert
        $this->assertFalse($response);
        $this->assertCount(1, $moduleCollection->all());
    }

    /**
     * @test
     */
    public function properly_determines_if_the_module_exists()
    {
        // Arrange
        $mock = $this->mock(Module::class);
        $moduleCollection = new CoreModuleCollection([
            $mock,
        ]);

        // Act
        $response = $moduleCollection->hasModule($mock);

        // Assert
        $this->assertTrue($response);
    }

    /**
     * @test
     */
    public function properly_determines_that_a_module_does_not_exist()
    {
        // Arrange
        $mock = $this->mock(Module::class);
        $moduleCollection = new CoreModuleCollection();

        // Act
        $response = $moduleCollection->hasModule($mock);

        // Assert
        $this->assertFalse($response);
    }
}
