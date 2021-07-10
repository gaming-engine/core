<?php

namespace GamingEngine\Core;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GamingEngine\Core\Core
 * @codeCoverageIgnore
 */
class CoreFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'core';
    }
}
