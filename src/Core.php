<?php

namespace GamingEngine\Core;

use GamingEngine\Core\Framework\Events\Module\ModuleAdded;
use GamingEngine\Core\Framework\Installation\CoreInstallationVerification;
use GamingEngine\Core\Framework\Models\FrameworkModule;
use GamingEngine\Core\Framework\Module\IModuleCollection;
use GamingEngine\Core\Framework\Module\Module;

class Core
{
    private IModuleCollection $moduleCollection;
    private CoreInstallationVerification $verification;

    public function __construct(IModuleCollection $moduleCollection, CoreInstallationVerification $verification)
    {
        $this->moduleCollection = $moduleCollection;
        $this->verification = $verification;
    }

    public function registerPackage(Module $module): void
    {
        if (! $this->installed()) {
            return;
        }

        $frameworkModule = FrameworkModule::firstOrCreate([
            'module_name' => $module->name(),
        ], [
            'enabled_at' => now(),
        ]);

        if ($frameworkModule->license_key) {
            $module->setLicense($frameworkModule->license_key);
        }

        if ($this->moduleCollection->addModule($module)) {
            event(new ModuleAdded($module));
        }
    }

    public function hasRegisteredPackage(Module $module): bool
    {
        return $this->moduleCollection->hasModule($module);
    }

    public function installed(): bool
    {
        return $this->verification->installed();
    }
}
