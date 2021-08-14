<?php

namespace GamingEngine\Core\Configuration\Repositories;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationPropertyException;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationValueException;
use GamingEngine\Core\Configuration\Models\Configuration;
use GamingEngine\Core\Configuration\SiteConfiguration;

class DatabaseConfigurationRepository implements ConfigurationRepository
{
    /**
     * @throws ConfigurationValueException
     * @throws ConfigurationPropertyException
     */
    public function account(): AccountConfiguration
    {
        return new AccountConfiguration(
            Configuration::category(ConfigurationCategoryTypes::ACCOUNT)
                ->get()
        );
    }

    /**
     * @throws ConfigurationValueException
     * @throws ConfigurationPropertyException
     */
    public function site(): SiteConfiguration
    {
        return new SiteConfiguration(
            Configuration::category(ConfigurationCategoryTypes::SITE)
                ->get()
        );
    }
}
