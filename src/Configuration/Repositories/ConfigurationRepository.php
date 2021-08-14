<?php

namespace GamingEngine\Core\Configuration\Repositories;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\SiteConfiguration;

interface ConfigurationRepository
{
    public function account(): AccountConfiguration;

    public function site(): SiteConfiguration;
}
