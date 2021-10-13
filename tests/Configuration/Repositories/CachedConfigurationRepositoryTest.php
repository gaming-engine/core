<?php

namespace GamingEngine\Core\Tests\Configuration\Repositories;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\Repositories\CachedConfigurationRepository;
use GamingEngine\Core\Configuration\Repositories\ConfigurationRepository;
use GamingEngine\Core\Configuration\SiteConfiguration;
use GamingEngine\Core\Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class CachedConfigurationRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function cached_configuration_delegates_account_retrieval_to_the_wrapped_object()
    {
        // Arrange
        $configuration = new AccountConfiguration(collect());
        $wrapped = $this->mock(ConfigurationRepository::class);

        $repository = new CachedConfigurationRepository($wrapped);

        $wrapped->shouldReceive('account')
            ->andReturn($configuration);

        // Act
        $response = $repository->account();

        // Assert
        $this->assertEquals($configuration, $response);
    }

    /**
     * @test
     */
    public function cached_configuration_reads_account_from_the_cache_if_available()
    {
        // Arrange
        $configuration = new AccountConfiguration(collect());
        $wrapped = $this->mock(ConfigurationRepository::class);

        Cache::shouldReceive('rememberForever')
            ->andReturn($configuration);

        $repository = new CachedConfigurationRepository($wrapped);

        // Act
        $repository->account();

        // Assert
        $wrapped->shouldNotHaveReceived('account');
    }

    /**
     * @test
     */
    public function cached_configuration_delegates_site_retrieval_to_the_wrapped_object()
    {
        // Arrange
        $configuration = new SiteConfiguration(collect());
        $wrapped = $this->mock(ConfigurationRepository::class);

        $repository = new CachedConfigurationRepository($wrapped);

        $wrapped->shouldReceive('site')
            ->andReturn($configuration);

        // Act
        $response = $repository->site();

        // Assert
        $this->assertEquals($configuration, $response);
    }

    /**
     * @test
     */
    public function cached_configuration_reads_site_from_the_cache_if_available()
    {
        // Arrange
        $configuration = new SiteConfiguration(collect());
        $wrapped = $this->mock(ConfigurationRepository::class);

        Cache::shouldReceive('rememberForever')
            ->andReturn($configuration);

        $repository = new CachedConfigurationRepository($wrapped);

        // Act
        $repository->site();

        // Assert
        $wrapped->shouldNotHaveReceived('site');
    }
}
