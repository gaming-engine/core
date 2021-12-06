<?php

namespace GamingEngine\Core\Account\Actions;

use GamingEngine\Core\Account\DataTransfer\UserDTO;
use GamingEngine\Core\Account\Repositories\UserRepository;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function create(array $input)
    {
        return $this->userRepository->create(
            new UserDTO(
                name: $input['name'],
                email: $input['email'],
                password: $input['password'],
            )
        );
    }
}
