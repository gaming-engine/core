<?php

namespace GamingEngine\Core\Framework\Http\Middleware;

use Closure;
use GamingEngine\Core\Core;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class InstallationStatusMiddleware
{
    private Core $core;

    public function __construct(Core $core)
    {
        $this->core = $core;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->core->installed()) {
            return $next($request);
        }

        if (Route::has('install.index')) {
            return redirect()->route('install.index');
        }

        return redirect()->route('installation-required');
    }
}
