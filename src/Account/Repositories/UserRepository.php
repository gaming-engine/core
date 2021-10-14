<?php

namespace GamingEngine\Core\Account\Repositories;

use GamingEngine\Core\Account\DataTransfer\UserDTO;
use GamingEngine\Core\Account\Entities\User;

interface UserRepository
{
    public function find(int $id): ?User;

    public function create(UserDTO $user): User;
}
