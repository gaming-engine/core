<?php

namespace GamingEngine\Core\Account\Http\Controllers;

use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('gaming-engine:core::account.login');
    }
}
