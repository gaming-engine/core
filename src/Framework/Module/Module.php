<?php

namespace GamingEngine\Core\Framework\Module;

interface Module
{
    public function name(): string;

    public function version(): string;

    public function license(): ?string;

    public function setLicense(string $license);
}
