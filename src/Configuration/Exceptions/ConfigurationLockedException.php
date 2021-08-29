<?php

namespace GamingEngine\Core\Configuration\Exceptions;

use Exception;
use GamingEngine\Core\Configuration\Entities\Configuration;

class ConfigurationLockedException extends Exception
{
    public function __construct(Configuration $configuration, string $value)
    {
        parent::__construct(
            __('gaming-engine:core::configuration.exceptions.locked', [
                'key' => $configuration->key,
                'value' => $value,
            ])
        );
    }
}
