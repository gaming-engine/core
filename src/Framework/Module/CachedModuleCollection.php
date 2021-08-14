<?php

namespace GamingEngine\Core\Framework\Module;

use Illuminate\Support\Facades\Cache;

class CachedModuleCollection implements ModuleCollection
{
    const CACHE_KEY = 'gaming-engine::module-details';
    private ModuleCollection $moduleCollection;

    public function __construct(ModuleCollection $moduleCollection)
    {
        $this->moduleCollection = $moduleCollection;

        if ($cached = Cache::get(self::CACHE_KEY)) {
            $this->addModules($cached);
        }
    }

    /**
     * @inheritDoc
     */
    public function addModules(array $modules): int
    {
        $total = $this->moduleCollection->addModules($modules);

        if ($total > 0) {
            $this->updateCache();
        }

        return $total;
    }

    private function updateCache()
    {
        Cache::rememberForever(
            self::CACHE_KEY,
            fn () => $this->moduleCollection->all()
        );
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $this->moduleCollection->all();
    }

    public function addModule(Module $module): bool
    {
        $result = $this->moduleCollection->addModule($module);

        if ($result) {
            $this->updateCache();
        }

        return $result;
    }

    public function hasModule(Module $module): bool
    {
        return $this->moduleCollection->hasModule($module);
    }
}
