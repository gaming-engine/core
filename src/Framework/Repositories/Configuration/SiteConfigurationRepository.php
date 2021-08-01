<?php

namespace GamingEngine\Core\Framework\Repositories\Configuration;

use GamingEngine\Core\Framework\Configuration\Site\SiteConfiguration;

interface SiteConfigurationRepository
{
    public function build(): SiteConfiguration;
}
