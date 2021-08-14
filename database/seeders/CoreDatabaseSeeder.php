<?php

namespace GamingEngine\Core\Database\Seeders;

use Illuminate\Database\Seeder;

class CoreDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AccountConfigurationKeySeeder::class);
        $this->call(SiteConfigurationKeySeeder::class);
    }
}
