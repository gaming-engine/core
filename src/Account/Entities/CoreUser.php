<?php

namespace GamingEngine\Core\Account\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class CoreUser extends User
{
    use SoftDeletes;
}
