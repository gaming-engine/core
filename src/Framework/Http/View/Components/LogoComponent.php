<?php

namespace GamingEngine\Core\Framework\Http\View\Components;

use Illuminate\View\Component;

class LogoComponent extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('gaming-engine:core::framework.components.logo');
    }
}
