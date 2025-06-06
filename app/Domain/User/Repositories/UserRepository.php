<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Ports\UserRepositoryPort;
use App\Models\User;

class UserRepository implements UserRepositoryPort
{
    public function create(array $data): User
    {
        return User::create($data);
    }
}
