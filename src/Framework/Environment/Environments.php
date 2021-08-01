<?php

namespace GamingEngine\Core\Framework\Environment;

class Environments
{
    const DEVELOPMENT = 'local';
    const STAGING = 'staging';
    const TESTING = 'testing';
    const PRODUCTION = 'prod';

    public static function available(): array
    {
        return [
            self::DEVELOPMENT,
            self::STAGING,
            self::TESTING,
            self::PRODUCTION,
        ];
    }
}
