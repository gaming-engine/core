<?php

namespace GamingEngine\Core\Account\Http\View\Components;

use GamingEngine\Core\Configuration\SiteConfiguration;
use Illuminate\View\Component;

/**
 * @property-read SiteConfiguration $siteConfiguration
 */
class RegisterComponent extends Component
{
    public SiteConfiguration $siteConfiguration;

    public function __construct(SiteConfiguration $siteConfiguration)
    {
        $this->siteConfiguration = $siteConfiguration;
    }

    public function render()
    {
        return view(
            'gaming-engine:core::account.components.auth.register',
            [
                'siteConfiguration' => $this->siteConfiguration,
            ]
        );
    }
}
