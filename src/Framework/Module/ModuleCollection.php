<?php

namespace GamingEngine\Core\Framework\Module;

interface ModuleCollection
{
    /**
     * @param Module[] $modules
     */
    public function addModules(array $modules): int;

    public function addModule(Module $module): bool;

    public function hasModule(Module $module): bool;

    /**
     * @return Module[]
     */
    public function all(): array;
}
