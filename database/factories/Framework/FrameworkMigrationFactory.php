<?php

namespace GamingEngine\Core\Database\Factories\Framework;

use GamingEngine\Core\Framework\Models\FrameworkMigration;
use Illuminate\Database\Eloquent\Factories\Factory;

class FrameworkMigrationFactory extends Factory
{
    protected $model = FrameworkMigration::class;

    public function definition()
    {
        return [
            'migration' => $this->faker->slug(4),
            'module_name' => $this->faker->slug(3),
        ];
    }
}
