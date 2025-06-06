<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Domain\User\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Enums\ApiResponseCode;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request)
    {   
        $user = $this->userService->register($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        return new ApiResponse([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 'Usuario registrado correctamente.', ApiResponseCode::CREATED);
    }
}
