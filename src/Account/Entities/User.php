<?php

namespace GamingEngine\Core\Account\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Support\Facades\Hash;

class User extends BaseUser
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
