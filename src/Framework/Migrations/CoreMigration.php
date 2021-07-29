<?php

namespace GamingEngine\Core\Framework\Migrations;

use GamingEngine\Core\Framework\Module\CoreModule;

abstract class CoreMigration extends BaseMigration implements IGamingEngineMigration
{
    public function package(): string
    {
        return CoreModule::PACKAGE;
    }
}
