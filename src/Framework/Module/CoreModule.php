<?php

namespace GamingEngine\Core\Framework\Module;

class CoreModule extends BaseModule implements Module
{
    const PACKAGE = 'gaming-engine:core';
    const VERSION = '0.0.0';

    public function name(): string
    {
        return self::PACKAGE;
    }

    public function version(): string
    {
        return self::VERSION;
    }
}
