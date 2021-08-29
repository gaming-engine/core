<?php

namespace GamingEngine\Core\Database\Factories\Framework;

use GamingEngine\Core\Framework\Entities\FrameworkModule;
use Illuminate\Database\Eloquent\Factories\Factory;

class FrameworkModuleFactory extends Factory
{
    protected $model = FrameworkModule::class;

    public function definition()
    {
        return [
            'module_name' => $this->faker->slug(4),
            'license_key' => $this->faker->uuid,
            'enabled_at' => now(),
        ];
    }

    public function enabled()
    {
        return $this->state([
            'enabled_at' => now(),
        ]);
    }

    public function disabled()
    {
        return $this->state([
            'enabled_at' => null,
        ]);
    }
}
