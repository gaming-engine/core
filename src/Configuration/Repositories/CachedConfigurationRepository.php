<?php

namespace GamingEngine\Core\Configuration\Repositories;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;
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
            ConfigurationCategoryTypes::ACCOUNT,
            fn () => $this->configurationRepository->account()
        );
    }

    public function site(): SiteConfiguration
    {
        return $this->cache(
            ConfigurationCategoryTypes::SITE,
            fn () => $this->configurationRepository->site()
        );
    }

    private function cache(string $category, callable $values)
    {
        return Cache::rememberForever(
            StringHelper::template(
                self::CACHE_KEY,
                [
                    'category' => $category,
                ]
            ),
            $values
        );
    }
}
