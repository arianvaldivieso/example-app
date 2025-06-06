<?php

namespace App\Domain\User\Ports;

use App\Models\User;

interface AuthServicePort
{
    public function login(array $credentials): ?User;
}
