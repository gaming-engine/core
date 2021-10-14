<?php

namespace GamingEngine\Core\Account\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public ?int $id;

    public string $name;

    public string $email;

    public string $password;
}
