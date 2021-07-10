<?php

namespace GamingEngine\Core\Migrations;

use GamingEngine\Core\Core;

abstract class CoreMigration extends BaseMigration implements IGamingEngineMigration
{
    public function package(): string
    {
        return Core::PACKAGE;
    }
}
