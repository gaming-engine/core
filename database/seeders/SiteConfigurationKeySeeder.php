<?php

namespace GamingEngine\Core\Database\Seeders;

use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;
use GamingEngine\Core\Configuration\Enumerations\ConfigurationValueTypes;
use GamingEngine\Core\Configuration\Models\Configuration;
use Illuminate\Database\Seeder;

class SiteConfigurationKeySeeder extends Seeder
{
    public function run()
    {
        Configuration::unlock(fn () => $this->seed());
    }

    private function seed()
    {
        $keys = [
            'dark-mode' => [
                'type' => ConfigurationValueTypes::BOOLEAN,
                'value' => true,
            ],
            'default-theme' => [
                'type' => ConfigurationValueTypes::STRING,
                'value' => 'default',
            ],
            'title-format' => [
                'type' => ConfigurationValueTypes::STRING,
                'value' => '{title} :: {site}',
            ],
            'minimum-age' => [
                'type' => ConfigurationValueTypes::INTEGER,
                'value' => 13,
            ],
            'name' => [
                'type' => ConfigurationValueTypes::STRING,
                'value' => 'gaming-engine',
            ],
            'logo-url' => [
                'type' => ConfigurationValueTypes::STRING,
                'value' => '/images/framework/logo.svg',
            ],
        ];

        foreach ($keys as $key => $value) {
            $configuration = Configuration::firstOrNew([
                'category' => ConfigurationCategoryTypes::SITE,
                'key' => $key,
            ]);

            $configuration->type = $value['type'];
            $configuration->default_value = $value['value'];

            $configuration->save();
        }
    }
}
