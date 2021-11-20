<?php

namespace GamingEngine\Core\Account\Models;

class Authentication
{
    public function __construct(public string $username, public string $password)
    {
    }
}
