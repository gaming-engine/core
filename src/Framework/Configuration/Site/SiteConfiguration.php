<?php

namespace GamingEngine\Core\Framework\Configuration\Site;

interface SiteConfiguration
{
    public function name(): string;

    public function theme(): string;

    public function language(): string;
}
