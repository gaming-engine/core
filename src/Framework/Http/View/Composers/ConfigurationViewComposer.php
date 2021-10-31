<?php

namespace GamingEngine\Core\Framework\Http\View\Composers;

use GamingEngine\Core\Configuration\AccountConfiguration;
use GamingEngine\Core\Configuration\SiteConfiguration;
use Illuminate\View\View;

class ConfigurationViewComposer
{
    public function __construct(private AccountConfiguration $accountConfiguration, private SiteConfiguration $siteConfiguration)
    {
    }

    public function compose(View $view)
    {
        $view->with('accountConfiguration', $this->accountConfiguration);
        $view->with('siteConfiguration', $this->siteConfiguration);
    }
}
