<?php

namespace GamingEngine\Core\Configuration\Repositories;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\BaseConfiguration;
use GamingEngine\Core\Configuration\SiteConfiguration;

interface ConfigurationRepository
{
    public function account(): AccountConfiguration;

    public function site(): SiteConfiguration;

    public function update(BaseConfiguration $configuration): BaseConfiguration;
}
