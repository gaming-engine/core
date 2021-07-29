<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Module;

use GamingEngine\Core\Framework\Module\CachedModuleCollection;
use GamingEngine\Core\Framework\Module\IModuleCollection;
use GamingEngine\Core\Framework\Module\Module;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class CachedModuleCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function when_constructed_it_will_not_auto_hydrate_if_nothing_is_present()
    {
        // Arrange
        $moduleCollection = $this->spy(IModuleCollection::class);
        Cache::shouldReceive('get')
            ->once()
            ->andReturn([]);
        Cache::shouldReceive('rememberForever');

        // Act
        new CachedModuleCollection($moduleCollection);

        // Assert
        $moduleCollection->shouldNotHaveReceived('addModules');
    }

    /**
     * @test
     */
    public function when_constructed_it_will_not_auto_hydrate_if_no_cache_is_initialized()
    {
        // Arrange
        $moduleCollection = $this->spy(IModuleCollection::class);
        Cache::shouldReceive('get')
            ->once()
            ->andReturn(null);

        // Act
        new CachedModuleCollection($moduleCollection);

        // Assert
        $moduleCollection->shouldNotHaveReceived('addModules');
    }

    /**
     * @test
     */
    public function when_constructed_it_will_auto_hydrate_when_provided_with_data()
    {
        // Arrange
        $cache = [
            $this->mock(Module::class),
        ];

        $moduleCollection = $this->spy(IModuleCollection::class);
        Cache::shouldReceive('get')
            ->once()
            ->andReturn($cache);
        Cache::shouldReceive('rememberForever');

        // Act
        new CachedModuleCollection($moduleCollection);

        // Assert
        $moduleCollection->shouldHaveReceived('addModules', [
            $cache,
        ]);
    }

    /**
     * @test
     */
    public function will_keep_track_of_multiple_modules_being_added_and_cache_the_data()
    {
        // Arrange
        $moduleCollection = $this->spy(IModuleCollection::class);
        $moduleCollection->shouldReceive('addModules')
            ->andReturn(1);
        Cache::shouldReceive('rememberForever', 'get');
        $collection = new CachedModuleCollection($moduleCollection);

        // Act
        $collection->addModules([
            $this->mock(Module::class),
        ]);

        // Assert
    }

    /**
     * @test
     */
    public function will_automatically_cache_the_module_list_when_it_is_dirty()
    {
        // Arrange
        $mock = $this->mock(Module::class);
        $moduleCollection = $this->mock(IModuleCollection::class);
        $moduleCollection->shouldReceive('addModule')
            ->andReturn(true);
        $moduleCollection->shouldReceive('all')
            ->andReturn([$mock]);

        Cache::shouldReceive('get');
        Cache::shouldReceive('rememberForever')
            ->withAnyArgs();

        $moduleCollection->shouldIgnoreMissing();

        $cached = new CachedModuleCollection($moduleCollection);

        // Act
        $cached->addModule($mock);

        // Assert
    }

    /**
     * @test
     */
    public function will_not_automatically_cache_the_module_list_when_it_is_not_dirty()
    {
        // Arrange
        $cache = Cache::spy()
            ->shouldAllowMockingProtectedMethods();

        $cache->shouldReceive('get')
            ->andReturn(null);

        $mock = $this->mock(Module::class);
        $moduleCollection = $this->mock(IModuleCollection::class);
        $moduleCollection->shouldReceive('addModule')
            ->andReturn(false);
        $moduleCollection->shouldNotReceive('all');

        $moduleCollection->shouldIgnoreMissing();

        $cached = new CachedModuleCollection($moduleCollection);

        // Act
        $cached->addModule($mock);

        // Assert
        Cache::shouldNotHaveReceived('rememberForever');
    }

    /**
     * @test
     */
    public function is_able_to_determine_if_it_has_a_module()
    {
        // Arrange
        $moduleCollection = $this->spy(IModuleCollection::class);
        $moduleCollection->shouldReceive('hasModule')
            ->andReturn(true);

        $collection = new CachedModuleCollection($moduleCollection);

        // Act
        $response = $collection->hasModule($this->mock(Module::class));

        // Assert
        $this->assertTrue($response);
    }

    /**
     * @test
     */
    public function is_able_to_determine_if_it_does_not_have_a_module()
    {
        // Arrange
        $moduleCollection = $this->spy(IModuleCollection::class);
        $moduleCollection->shouldReceive('hasModule')
            ->andReturn(false);

        $collection = new CachedModuleCollection($moduleCollection);

        // Act
        $response = $collection->hasModule($this->mock(Module::class));

        // Assert
        $this->assertFalse($response);
    }

    /**
     * @test
     */
    public function is_able_to_retrieve_the_list_of_modules_included()
    {
        // Arrange
        $data = [
            $this->mock(Module::class),
        ];
        $moduleCollection = $this->spy(IModuleCollection::class);
        $moduleCollection->shouldReceive('all')
            ->andReturn($data);
        $collection = new CachedModuleCollection($moduleCollection);

        // Act
        $response = $collection->all();

        // Assert
        $this->assertEquals($data, $response);
    }
}
