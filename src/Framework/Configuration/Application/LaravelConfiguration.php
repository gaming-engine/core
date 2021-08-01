<?php

namespace GamingEngine\Core\Framework\Configuration\Application;

use GamingEngine\Core\Framework\Environment\Environments;
use InvalidArgumentException;

class LaravelConfiguration implements ApplicationConfiguration
{
    private array $configurations;
    private string $environment;

    public function __construct(array $configuration)
    {
        $this->configurations = $configuration;

        $this->setEnvironment(
            $this->deriveValue('env', Environments::PRODUCTION)
        );
    }

    public function environment(): string
    {
        return $this->environment;
    }

    private function setEnvironment(string $environment)
    {
        if (! in_array($environment, Environments::available())) {
            throw new InvalidArgumentException("Invalid environment specified: $environment");
        }

        $this->environment = $environment;
    }

    private function deriveValue(string $key, mixed $default): mixed
    {
        return $this->configurations[$key] ?? $default;
    }
}
