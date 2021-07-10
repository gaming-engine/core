<?php

namespace GamingEngine\Core\Migrations;

interface IGamingEngineMigration
{
    function package(): string;

    function filename(): string;
}
