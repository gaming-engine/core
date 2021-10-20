<?php

namespace GamingEngine\Core\Account\Exceptions;

use GamingEngine\Core\Account\DataTransfer\UserDTO;

class DuplicateEmailException extends \Exception
{
    public function __construct(UserDTO $user)
    {
        parent::__construct(
            (string)__('gaming-engine:core::exceptions.account.duplicate-email', [
                'email' => $user->email,
            ])
        );
    }
}
