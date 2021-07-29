<?php

namespace GamingEngine\Core\Account\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class CoreUser extends User
{
    use SoftDeletes;
}
