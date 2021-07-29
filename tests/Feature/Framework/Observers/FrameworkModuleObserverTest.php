<?php

namespace GamingEngine\Core\Tests\Feature\Framework\Observers;

use GamingEngine\Core\Framework\Models\FrameworkModule;
use GamingEngine\Core\Framework\Module\CachedModuleCollection;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class FrameworkModuleObserverTest extends TestCase
{
    /**
     * @test
     */
    public function when_a_new_module_is_added_the_cache_is_cleared()
    {
        // Arrange
        Cache::spy();
        Cache::shouldReceive('forget')
            ->with(CachedModuleCollection::CACHE_KEY)
            ->once();
        Cache::shouldReceive('rememberForever');

        // Act
        FrameworkModule::factory()->create();

        // Assert
    }

    /**
     * @test
     */
    public function when_a_module_is_updated_the_cache_is_cleared()
    {
        // Arrange
        $module = FrameworkModule::factory()->create();
        Cache::shouldReceive('forget')
            ->with(CachedModuleCollection::CACHE_KEY)
            ->once();
        Cache::shouldReceive('rememberForever');

        // Act
        $module->update([
            'module_name' => 'foo',
        ]);

        // Assert
    }

    /**
     * @test
     */
    public function when_a_module_is_deleted_the_cache_is_cleared()
    {
        // Arrange
        $module = FrameworkModule::factory()->create();
        Cache::shouldReceive('forget')
            ->with(CachedModuleCollection::CACHE_KEY)
            ->once();
        Cache::shouldReceive('rememberForever');

        // Act
        $module->delete();

        // Assert
    }

    /**
     * @test
     */
    public function when_a_module_is_force_deleted_the_cache_is_cleared()
    {
        // Arrange
        $module = FrameworkModule::factory()->create();
        Cache::shouldReceive('forget')
            ->with(CachedModuleCollection::CACHE_KEY)
            ->twice();
        Cache::shouldReceive('rememberForever');

        // Act
        $module->forceDelete();

        // Assert
    }
}
