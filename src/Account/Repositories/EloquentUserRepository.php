<?php

namespace GamingEngine\Core\Account\Repositories;

use GamingEngine\Core\Account\DataTransfer\UserDTO;
use GamingEngine\Core\Account\Entities\User;
use GamingEngine\Core\Account\Events\User\UserCreated;
use GamingEngine\Core\Account\Exceptions\DuplicateEmailException;

class EloquentUserRepository implements UserRepository
{
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @throws DuplicateEmailException
     */
    public function create(UserDTO $user): User
    {
        $this->validateUser($user);

        $coreUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        event(new UserCreated($coreUser));

        return $coreUser;
    }

    /**
     * @throws DuplicateEmailException
     */
    private function validateUser(UserDTO $user): void
    {
        $emailExists = User::whereEmail($user->email)->exists();

        if ($emailExists) {
            throw new DuplicateEmailException($user);
        }
    }
}
