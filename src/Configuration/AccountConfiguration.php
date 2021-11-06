<?php

namespace GamingEngine\Core\Configuration;

use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;

/**
 * @property-read bool $numberedAccounts
 * @property-read int $numberedAccountSeed
 */
class AccountConfiguration extends BaseConfiguration
{
    /**
     * Whether numbered accounts are enabled
     *
     * @var bool
     */
    public bool $numberedAccounts;

    /**
     * If numbered accounts is enabled, this is the base ID value that
     * users will get.
     *
     * @var int
     */
    public int $numberedAccountSeed;

    public static function type(): string
    {
        return ConfigurationCategoryTypes::ACCOUNT;
    }
}
