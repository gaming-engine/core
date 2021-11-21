<?php

namespace GamingEngine\Core\Framework\Http\View\Components\Alerts;

use Illuminate\View\Component;
use function view;

class ErrorAlertComponent extends Component
{
    public function render()
    {
        return view('gaming-engine:core::framework.components.alert.error');
    }
}
