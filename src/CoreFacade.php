<?php

namespace GamingEngine\Core;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GamingEngine\Core\Core
 */
class CoreFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'core';
    }
}
