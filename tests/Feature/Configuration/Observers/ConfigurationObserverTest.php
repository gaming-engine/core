<?php

namespace GamingEngine\Core\Tests\Feature\Configuration\Observers;

use GamingEngine\Core\Configuration\Entities\Configuration;
use GamingEngine\Core\Configuration\Repositories\CachedConfigurationRepository;
use GamingEngine\Core\Tests\TestCase;
use GamingEngine\StringTools\StringHelper;
use Illuminate\Support\Facades\Cache;

class ConfigurationObserverTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Configuration::leaveUnlocked();
    }

    /**
     * @test
     */
    public function when_a_new_configuration_is_added_the_cache_is_cleared()
    {
        // Arrange
        $stringHelper = $this->mock(StringHelper::class);
        $stringHelper->shouldReceive('template')
            ->andReturn(CachedConfigurationRepository::CACHE_KEY);
        Cache::spy();
        Cache::shouldReceive('forget')
            ->with(CachedConfigurationRepository::CACHE_KEY)
            ->once();
        Cache::shouldReceive('rememberForever');

        // Act
        Configuration::factory()->create([
            'category' => 'foo',
        ]);

        // Assert
    }

    /**
     * @test
     */
    public function when_a_configuration_is_updated_the_cache_is_cleared()
    {
        // Arrange
        $module = Configuration::factory()->create([
            'category' => 'bar',
        ]);

        $stringHelper = $this->mock(StringHelper::class);
        $stringHelper->shouldReceive('template')
            ->andReturn(CachedConfigurationRepository::CACHE_KEY);

        Cache::shouldReceive('forget')
            ->with(CachedConfigurationRepository::CACHE_KEY)
            ->once();
        Cache::shouldReceive('rememberForever');

        // Act
        $module->update([
            'type' => 'foo',
        ]);

        // Assert
    }

    /**
     * @test
     */
    public function when_a_configuration_is_deleted_the_cache_is_cleared()
    {
        // Arrange
        $module = Configuration::factory()->create();
        $stringHelper = $this->mock(StringHelper::class);
        $stringHelper->shouldReceive('template')
            ->andReturn(CachedConfigurationRepository::CACHE_KEY);
        Cache::shouldReceive('forget')
            ->with(CachedConfigurationRepository::CACHE_KEY)
            ->once();
        Cache::shouldReceive('rememberForever');

        // Act
        $module->delete();

        // Assert
    }

    /**
     * @test
     */
    public function when_a_configuration_is_force_deleted_the_cache_is_cleared()
    {
        // Arrange
        $module = Configuration::factory()->create();

        $stringHelper = $this->mock(StringHelper::class);
        $stringHelper->shouldReceive('template')
            ->andReturn(CachedConfigurationRepository::CACHE_KEY);

        Cache::shouldReceive('forget')
            ->with(CachedConfigurationRepository::CACHE_KEY)
            ->twice();
        Cache::shouldReceive('rememberForever');

        // Act
        $module->forceDelete();

        // Assert
    }
}
