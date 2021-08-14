<?php

namespace GamingEngine\Core\Configuration;

use GamingEngine\Core\Configuration\Exceptions\ConfigurationPropertyException;
use GamingEngine\Core\Configuration\Exceptions\ConfigurationValueException;
use GamingEngine\Core\Configuration\Models\Configuration as ConfigurationModel;
use Illuminate\Support\Collection;
use TypeError;

abstract class BaseConfiguration
{
    /**
     * BaseConfiguration constructor.
     * @param Collection $keys
     * @throws ConfigurationPropertyException
     * @throws ConfigurationValueException
     */
    public function __construct(Collection $keys)
    {
        $keys
            ->each(function (ConfigurationModel $model) {
                $name = $model->property_name;

                // Ensure the property exists
                if (! property_exists($this, $name)) {
                    // It doesn't throw an exception
                    throw new ConfigurationPropertyException($model);
                }

                try {
                    $this->$name = $model->value;
                } catch (TypeError $exception) {
                    throw new ConfigurationValueException($model);
                }
            });
    }
}
