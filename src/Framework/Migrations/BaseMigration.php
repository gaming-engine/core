<?php

namespace GamingEngine\Core\Framework\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Arr;
use ReflectionClass;

abstract class BaseMigration extends Migration implements IGamingEngineMigration
{
    public function filename(): string
    {
        $filename = (new ReflectionClass($this))->getFileName();

        $elements = explode('/', $filename);

        $name = Arr::last($elements);

        [$name,] = explode('.', $name);

        return $name;
    }
}
