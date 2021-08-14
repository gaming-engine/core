<?php

namespace GamingEngine\Core\Framework\Observers;

use GamingEngine\Core\Framework\Models\FrameworkModule;
use GamingEngine\Core\Framework\Module\CachedModuleCollection;
use Illuminate\Support\Facades\Cache;

class FrameworkModuleObserver
{
    private $cacheKeys = [
        CachedModuleCollection::CACHE_KEY,
    ];

    public function created(FrameworkModule $module)
    {
        $this->removeFromCache($module);
    }

    private function removeFromCache(FrameworkModule $module)
    {
        foreach ($this->cacheKeys as $cacheKey) {
            Cache::forget($cacheKey);
        }
    }

    public function updated(FrameworkModule $module)
    {
        $this->removeFromCache($module);
    }

    public function deleted(FrameworkModule $module)
    {
        $this->removeFromCache($module);
    }

    public function forceDeleted(FrameworkModule $module)
    {
        $this->removeFromCache($module);
    }
}
