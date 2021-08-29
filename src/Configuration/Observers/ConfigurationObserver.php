<?php

namespace GamingEngine\Core\Configuration\Observers;

use GamingEngine\Core\Configuration\Entities\Configuration;
use GamingEngine\Core\Configuration\Repositories\CachedConfigurationRepository;
use GamingEngine\StringTools\StringHelper;
use Illuminate\Support\Facades\Cache;

class ConfigurationObserver
{
    private $cacheKeys = [
        CachedConfigurationRepository::CACHE_KEY,
    ];

    private StringHelper $helper;

    public function __construct(StringHelper $helper)
    {
        $this->helper = $helper;
    }

    public function created(Configuration $module)
    {
        $this->removeFromCache($module);
    }

    public function updated(Configuration $module)
    {
        $this->removeFromCache($module);
    }

    public function deleted(Configuration $module)
    {
        $this->removeFromCache($module);
    }

    public function forceDeleted(Configuration $module)
    {
        $this->removeFromCache($module);
    }

    private function removeFromCache(Configuration $configuration)
    {
        foreach ($this->cacheKeys as $cacheKey) {
            Cache::forget(
                $this->helper->template(
                    $cacheKey,
                    [
                        'category' => $configuration->category,
                        'key' => $configuration->key,
                    ]
                )
            );
        }
    }
}
