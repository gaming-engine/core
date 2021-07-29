<?php

namespace GamingEngine\Core\Framework\Installation;

use GamingEngine\Core\Framework\Models\FrameworkModule;
use Illuminate\Support\Facades\Schema;

class CoreInstallationVerification implements InstallationVerification
{
    public function installed(): bool
    {
        return Schema::hasTable((new FrameworkModule())->getTable());
    }
}
