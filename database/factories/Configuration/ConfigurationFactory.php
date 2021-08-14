<?php

namespace GamingEngine\Core\Database\Factories\Configuration;

use GamingEngine\Core\Configuration\Enumerations\ConfigurationCategoryTypes;
use GamingEngine\Core\Configuration\Models\Configuration;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigurationFactory extends Factory
{
    protected $model = Configuration::class;

    public function definition()
    {
        return [
            'category' => $this->faker->slug(1),
            'key' => $this->faker->slug(3),
            'type' => $this->faker->slug(1),
            'default_value' => mt_rand(0, 1) === 1 ? $this->faker->numberBetween() : $this->faker->text,
            'value' => null,
        ];
    }

    public function account()
    {
        return $this->state([
            'type' => ConfigurationCategoryTypes::ACCOUNT,
        ]);
    }

    public function site()
    {
        return $this->state([
            'type' => ConfigurationCategoryTypes::SITE,
        ]);
    }
}
