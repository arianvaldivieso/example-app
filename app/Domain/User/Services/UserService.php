<?php

namespace App\Domain\User\Services;

use App\Domain\User\Ports\UserServicePort;
use App\Domain\User\Ports\UserRepositoryPort;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServicePort
{
    protected $userRepository;

    public function __construct(UserRepositoryPort $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);
        return $user;
    }
}
