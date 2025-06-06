<?php

namespace App\Domain\User\Ports;

use App\Models\User;

interface UserRepositoryPort
{
    public function create(array $data): User;
}
