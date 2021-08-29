<?php

namespace GamingEngine\Core\Framework\Listeners\Migrations;

use GamingEngine\Core\Framework\Entities\FrameworkMigration;
use GamingEngine\Core\Framework\Migrations\IGamingEngineMigration;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class LogPackageMigration
{
    public function handle(MigrationEnded $migrationEnded): void
    {
        $migration = $this->frameworkMigration($migrationEnded->migration);

        if (! $migration) {
            return;
        }

        if ($migrationEnded->method === 'up') {
            $this->logUpgrade($migration);
        } else {
            $this->logDowngrade($migration);
        }
    }

    private function frameworkMigration(Migration $migration): ?IGamingEngineMigration
    {
        if ($migration instanceof IGamingEngineMigration) {
            return $migration;
        }

        return null;
    }

    private function logUpgrade(IGamingEngineMigration $migration): void
    {
        FrameworkMigration::create([
            'migration' => $migration->filename(),
            'module_name' => $migration->package(),
        ]);
    }

    private function logDowngrade(IGamingEngineMigration $migration): void
    {
        if (! Schema::hasTable((new FrameworkMigration())->getTable())) {
            return;
        }

        FrameworkMigration::where([
            'migration' => $migration->filename(),
            'module_name' => $migration->package(),
        ])->delete();
    }
}
