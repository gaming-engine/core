<?php

namespace GamingEngine\Core\Framework\Module;

use GamingEngine\Core\Framework\Events\License\LicenseAdded;
use GamingEngine\Core\Framework\Events\License\LicenseRemoved;

abstract class BaseModule implements Module
{
    private ?string $license;

    abstract public function name(): string;

    abstract public function version(): string;

    public function license(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license)
    {
        $this->license = $license;

        event(new LicenseAdded($this, $this->license));
    }

    public function removeLicense()
    {
        if (! isset($this->license)) {
            return;
        }

        event(new LicenseRemoved($this, $this->license));
        $this->license = null;
    }
}
