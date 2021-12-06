<?php

namespace GamingEngine\Core\Framework\Http\View\Components\Alerts;

use Illuminate\View\Component;
use function view;

class SuccessAlertComponent extends Component
{
    public function render()
    {
        return view('gaming-engine:core::framework.components.alert.success');
    }
}
