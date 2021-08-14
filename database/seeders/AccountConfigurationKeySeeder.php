<?php

namespace GamingEngine\Core\Database\Seeders;

use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;
use GamingEngine\Core\Configuration\Enumerations\ConfigurationValueTypes;
use GamingEngine\Core\Configuration\Models\Configuration;
use Illuminate\Database\Seeder;

class AccountConfigurationKeySeeder extends Seeder
{
    public function run()
    {
        Configuration::unlock(fn () => $this->seed());
    }

    private function seed()
    {
        $keys = [
            'numbered-accounts' => [
                'type' => ConfigurationValueTypes::BOOLEAN,
                'value' => false,
            ],
            'numbered-account-seed' => [
                'type' => ConfigurationValueTypes::INTEGER,
                'value' => 1000,
            ],
        ];

        foreach ($keys as $key => $value) {
            $configuration = Configuration::firstOrNew([
                'category' => ConfigurationCategoryTypes::ACCOUNT,
                'key' => $key,
            ]);

            $configuration->type = $value['type'];
            $configuration->default_value = $value['value'];

            $configuration->save();
        }
    }
}
