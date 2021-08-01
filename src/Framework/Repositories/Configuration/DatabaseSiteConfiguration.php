<?php

namespace GamingEngine\Core\Framework\Repositories\Configuration;

use GamingEngine\Core\Framework\Configuration\Site\CoreSiteConfiguration;
use GamingEngine\Core\Framework\Configuration\Site\SiteConfiguration;

class DatabaseSiteConfiguration implements SiteConfigurationRepository
{
    public function __construct()
    {
    }

    public function build(): SiteConfiguration
    {
        return new CoreSiteConfiguration();
    }
}
