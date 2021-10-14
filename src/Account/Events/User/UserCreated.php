<?php

namespace GamingEngine\Core\Account\Events\User;

use GamingEngine\Core\Account\Entities\User;

class UserCreated
{
    public function __construct(public User $user)
    {
    }
}
