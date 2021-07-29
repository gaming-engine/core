<?php

namespace GamingEngine\Core\Framework\Events\License;

use GamingEngine\Core\Framework\Module\Module;

/**
 * @property-read Module $module
 * @property-read string $license
 */
class LicenseRemoved
{
    public Module $module;

    public string $license;

    public function __construct(Module $module, string $license)
    {
        $this->module = $module;
        $this->license = $license;
    }
}
