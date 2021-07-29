<?php

namespace GamingEngine\Core\Framework\Module;

use GamingEngine\Dictionary\Dictionary;

class ModuleCollection implements IModuleCollection
{
    private Dictionary $modules;

    /**
     * @param Module[] $modules
     */
    public function __construct(array $modules = [])
    {
        $this->modules = new Dictionary();
        $this->addModules($modules);
    }

    /**
     * @param Module[] $modules
     */
    public function addModules(array $modules): int
    {
        return collect($modules)
            ->filter(fn (Module $module) => $this->addModule($module))
            ->count();
    }

    public function addModule(Module $module): bool
    {
        if ($this->hasModule($module)) {
            return false;
        }

        $this->modules->offsetSet($module, $module);

        return true;
    }

    public function hasModule(Module $module): bool
    {
        return $this->modules->offsetExists($module);
    }

    /**
     * @return Module[]
     */
    public function all(): array
    {
        return $this->modules->values();
    }
}
