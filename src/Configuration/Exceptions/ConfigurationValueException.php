<?php

namespace GamingEngine\Core\Configuration\Exceptions;

use Exception;
use GamingEngine\Core\Configuration\Entities\Configuration;

class ConfigurationValueException extends Exception
{
    public function __construct(Configuration $configuration)
    {
        parent::__construct(
            __(
                'gaming-engine:core::configuration.exceptions.invalid-value',
                [
                    'key' => $configuration->key,
                    'value' => $configuration->value,
                ]
            )
        );
    }
}
