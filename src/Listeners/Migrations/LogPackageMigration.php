<?php

namespace GamingEngine\Core\Listeners\Migrations;

use GamingEngine\Core\Migrations\IGamingEngineMigration;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LogPackageMigration
{
    public function handle(MigrationEnded $migrationEnded): void
    {
        $migration = $this->frameworkMigration($migrationEnded->migration);

        if (!$migration) {
            return;
        }

        if ($migrationEnded->method === 'up') {
            $this->logUpgrade($migration);
        }
        else {
            $this->logDowngrade($migration);
        }
    }

    private function logUpgrade(IGamingEngineMigration $migration): void
    {
        DB::table('core_migrations')
            ->insert([
                'migration' => $migration->filename(),
                'package_name' => $migration->package(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    private function logDowngrade(IGamingEngineMigration $migration): void
    {
        if(!Schema::hasTable('core_migrations')) {
            return;
        }

        DB::table('core_migrations')
            ->where([
                'migration' => $migration->filename(),
                'package_name' => $migration->package(),
            ])
            ->update([
                'deleted_at' => now(),
            ]);
    }

    private function frameworkMigration(Migration $migration): ?IGamingEngineMigration
    {
        if($migration instanceof IGamingEngineMigration) {
            return $migration;
        }

        return null;
    }
}
