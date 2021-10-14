<?php

namespace GamingEngine\Core\Account\Repositories;

use GamingEngine\Core\Account\DataTransfer\UserDTO;
use GamingEngine\Core\Account\Entities\User;
use GamingEngine\Core\Account\Events\User\UserCreated;

class EloquentUserRepository implements UserRepository
{
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function create(UserDTO $user): User
    {
        $coreUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        event(new UserCreated($coreUser));

        return $coreUser;
    }
}
