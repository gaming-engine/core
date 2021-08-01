<?php

namespace GamingEngine\Core\Framework\Environment;

use GamingEngine\Core\Framework\Configuration\Application\ApplicationConfiguration;

class EnvironmentFactory
{
    private ApplicationConfiguration $configuration;

    public function __construct(ApplicationConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function build(): Environment
    {
        switch ($this->configuration->environment()) {
            case Environments::DEVELOPMENT:
            case Environments::TESTING:
                return new DevelopmentEnvironment();
            default:
                return new ProductionEnvironment();
        }
    }
}
