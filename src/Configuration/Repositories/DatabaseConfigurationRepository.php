<?php

namespace GamingEngine\Core\Configuration\Repositories;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\BaseConfiguration;
use GamingEngine\Core\Configuration\Entities\Configuration;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationPropertyException;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationValueException;
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
            Configuration::category(AccountConfiguration::type())
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
            Configuration::category(SiteConfiguration::type())
                ->get()
        );
    }

    public function update(BaseConfiguration $configuration): BaseConfiguration
    {
        Configuration::category($configuration::type())
            ->get()
            ->each(function (Configuration $config) use ($configuration) {
                $property = $config->property_name;

                if ($config->value == $configuration->$property) {
                    return;
                }

                $config->update([
                    'value' => $configuration->$property,
                ]);
            });

        return $configuration;
    }
}
