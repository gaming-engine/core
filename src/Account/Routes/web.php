<?php

use GamingEngine\Core\Account\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'index'])
    ->name('login');
