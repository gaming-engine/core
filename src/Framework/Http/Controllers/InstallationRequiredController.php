<?php

namespace GamingEngine\Core\Framework\Http\Controllers;

use GamingEngine\Core\Core;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;

class InstallationRequiredController extends Controller
{
    public function __invoke(Core $core): View|RedirectResponse
    {
        if ($core->installed()) {
            return redirect('/');
        }

        if (Route::has('install.index')) {
            return redirect()->route('install.index');
        }

        return view('gaming-engine:core::framework.install.required');
    }
}
