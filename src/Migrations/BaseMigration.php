<?php

namespace GamingEngine\Core\Migrations;

use GamingEngine\Core\Core;
use Illuminate\Support\Arr;
use ReflectionClass;
use Illuminate\Database\Migrations\Migration;

abstract class BaseMigration extends Migration implements IGamingEngineMigration
{
    public function filename(): string
    {
        $filename = (new ReflectionClass($this))->getFileName();

        $elements = explode('/', $filename);

        $name = Arr::last($elements);

        [$name, ] = explode('.', $name);

        return $name;
    }
}
