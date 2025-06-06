<?php

namespace App\Domain\User\Ports;

interface UserServicePort
{
    public function register(array $data);
}
