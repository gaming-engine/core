<?php

namespace GamingEngine\Core\Account\DataTransfer;

use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?int   $id = null
    ) {
    }
}
