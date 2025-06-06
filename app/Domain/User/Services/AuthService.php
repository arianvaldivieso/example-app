<?php

namespace App\Domain\User\Services;

use App\Domain\User\Ports\AuthServicePort;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServicePort
{
    public function login(array $credentials): ?User
    {
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            return $user;
        }
        return null;
    }
}
