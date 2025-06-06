<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Domain\User\Services\AuthService;
use App\Http\Responses\ApiResponse;
use App\Enums\ApiResponseCode;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginUserRequest $request)
    {
        $user = $this->authService->login($request->validated());
        if (!$user) {
            return new ApiResponse(null, 'Credenciales inválidas.', ApiResponseCode::UNAUTHORIZED);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return new ApiResponse([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 'Login exitoso.', ApiResponseCode::SUCCESS);
    }
}
