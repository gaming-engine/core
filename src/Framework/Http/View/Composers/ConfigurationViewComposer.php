<?php

namespace GamingEngine\Core\Framework\Http\View\Composers;

use GamingEngine\Core\Framework\Configuration\Site\SiteConfiguration;
use Illuminate\View\View;

class ConfigurationViewComposer
{
    private SiteConfiguration $siteConfiguration;

    public function __construct(SiteConfiguration $siteConfiguration)
    {
        $this->siteConfiguration = $siteConfiguration;
    }

    public function compose(View $view)
    {
        $view->with('configuration', (object)[
            'site' => $this->siteConfiguration,
        ]);
    }
}
