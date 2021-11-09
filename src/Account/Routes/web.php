<?php

use GamingEngine\Core\Framework\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('login', HomeController::class)
    ->name('login');
