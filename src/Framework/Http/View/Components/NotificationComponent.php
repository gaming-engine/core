<?php

namespace GamingEngine\Core\Framework\Http\View\Components;

use Illuminate\View\Component;

class NotificationComponent extends Component
{
    public function render()
    {
        return view('gaming-engine:core::framework.components.notifications');
    }
}
