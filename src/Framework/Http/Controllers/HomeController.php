<?php

namespace GamingEngine\Core\Framework\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('gaming-engine:core::framework.home');
    }
}
