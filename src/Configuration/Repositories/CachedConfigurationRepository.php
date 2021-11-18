<?php

namespace GamingEngine\Core\Configuration\Repositories;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\BaseConfiguration;
use GamingEngine\Core\Configuration\SiteConfiguration;
use GamingEngine\StringTools\StringHelper;
use Illuminate\Support\Facades\Cache;

class CachedConfigurationRepository implements ConfigurationRepository
{
    const CACHE_KEY = 'gaming-engine::configuration::{category}';
    private ConfigurationRepository $configurationRepository;

    public function __construct(ConfigurationRepository $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    public function account(): AccountConfiguration
    {
        return $this->cache(
            AccountConfiguration::type(),
            fn () => $this->configurationRepository->account()
        );
    }

    private function cache(string $category, callable $values)
    {
        return Cache::rememberForever(
            $this->cacheKey($category),
            $values
        );
    }

    private function cacheKey(string $category): string
    {
        return StringHelper::template(
            self::CACHE_KEY,
            [
                'category' => $category,
            ]
        );
    }

    public function site(): SiteConfiguration
    {
        return $this->cache(
            SiteConfiguration::type(),
            fn () => $this->configurationRepository->site()
        );
    }

    public function update(BaseConfiguration $configuration): BaseConfiguration
    {
        $response = $this->configurationRepository->update($configuration);

        Cache::put(
            $this->cacheKey($configuration::type()),
            $response,
        );

        return $response;
    }
}
