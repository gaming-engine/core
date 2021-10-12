<?php

namespace GamingEngine\Core\Account\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class CoreUser extends User
{
    use SoftDeletes;

    protected $table = 'users';

    protected $guarded = [];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
