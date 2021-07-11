<?php

namespace GamingEngine\Core\Framework\Migrations;

interface IGamingEngineMigration
{
    public function package(): string;

    public function filename(): string;
}
