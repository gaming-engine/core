<?php

namespace GamingEngine\Core\Framework\Environment;

class ProductionEnvironment implements Environment
{
    public function name(): string
    {
        return Environments::PRODUCTION;
    }

    public function debug(): bool
    {
        return false;
    }

    public function cache(): bool
    {
        return true;
    }
}
