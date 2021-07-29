<?php

namespace GamingEngine\Core\Framework\Events\Module;

use GamingEngine\Core\Framework\Module\Module;

/**
 * @property-read Module $module
 */
class ModuleRemoved
{
    /**
     * @var Module
     */
    public Module $module;

    public function __construct(Module $module)
    {
        $this->module = $module;
    }
}
