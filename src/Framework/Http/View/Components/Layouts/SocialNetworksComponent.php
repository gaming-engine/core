<?php

namespace GamingEngine\Core\Framework\Http\View\Components\Layouts;

use GamingEngine\Core\Configuration\SiteConfiguration;
use Illuminate\View\Component;

/**
 * @property-read SiteConfiguration $siteConfiguration
 */
class SocialNetworksComponent extends Component
{
    public SiteConfiguration $siteConfiguration;

    public function __construct(SiteConfiguration $siteConfiguration)
    {
        $this->siteConfiguration = $siteConfiguration;
    }

    public function render()
    {
        return view(
            'gaming-engine:core::framework.components.layouts.social-networks',
            [
                'siteConfiguration' => $this->siteConfiguration,
            ]
        );
    }
}
