<?php

namespace GamingEngine\Core\Tests\Configuration\Repositories;

use GamingEngine\Core\Configuration\Entities\Configuration;
use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;
use GamingEngine\Core\Configuration\Repositories\DatabaseConfigurationRepository;
use GamingEngine\Core\Configuration\SiteConfiguration;
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

    /**
     * @test
     */
    public function database_configuration_can_update_values()
    {
        /**
         * @var DatabaseConfigurationRepository $subject
         */
        $subject = $this->app->get(DatabaseConfigurationRepository::class);
        $configuration = $subject->site();

        $updated = new SiteConfiguration(
            collect(
                array_merge(
                    (array)$configuration,
                    [
                        'name' => 'Hello',
                    ]
                )
            )->transform(function ($value, $key) {
                return new Configuration([
                    'key' => $key,
                    'value' => $value,
                ]);
            })
        );

        // Act
        $subject->update($updated);

        // Assert
        $this->assertDatabaseHas('configurations', [
            'value' => 'Hello',
            'key' => 'name',
            'category' => $configuration::type(),
        ]);
    }
}
