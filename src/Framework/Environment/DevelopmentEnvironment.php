<?php

namespace GamingEngine\Core\Framework\Environment;

class DevelopmentEnvironment implements Environment
{
    public function name(): string
    {
        return Environments::DEVELOPMENT;
    }

    public function debug(): bool
    {
        return true;
    }

    public function cache(): bool
    {
        return false;
    }
}
