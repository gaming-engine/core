<?php

namespace GamingEngine\Core\Tests\Feature\Configuration\Repositories;

use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;
use GamingEngine\Core\Configuration\Models\Configuration;
use GamingEngine\Core\Configuration\Repositories\DatabaseConfigurationRepository;
use GamingEngine\Core\Tests\TestCase;

class DatabaseConfigurationRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function database_configuration_can_retrieve_the_account_configuration()
    {
        // Arrange
        /**
         * @var DatabaseConfigurationRepository $repository
         */
        $repository = $this->app->get(DatabaseConfigurationRepository::class);

        // Act
        $output = $repository->account();

        // Assert
        Configuration::category(ConfigurationCategoryTypes::ACCOUNT)
            ->get()
            ->each(function (Configuration $configuration) use ($output) {
                $property = $configuration->property_name;
                $this->assertEquals(
                    $configuration->value,
                    $output->$property,
                );
            });
    }

    /**
     * @test
     */
    public function database_configuration_can_retrieve_the_site_configuration()
    {
        // Arrange
        /**
         * @var DatabaseConfigurationRepository $repository
         */
        $repository = $this->app->get(DatabaseConfigurationRepository::class);

        // Act
        $output = $repository->site();

        // Assert
        Configuration::category(ConfigurationCategoryTypes::SITE)
            ->get()
            ->each(function (Configuration $configuration) use ($output) {
                $property = $configuration->property_name;
                $this->assertEquals(
                    $configuration->value,
                    $output->$property,
                );
            });
    }
}
