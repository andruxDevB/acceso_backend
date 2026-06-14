<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    public function __construct(private readonly AuthService $service) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->service->register($request);

        return $this->sendResponse([
            'user'  => new UserResource($result['user']),
            'token' => $result['token'],
        ], 'Usuario registrado exitosamente.', 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->service->login($request);

        return $this->sendResponse([
            'user'  => new UserResource($result['user']),
            'token' => $result['token'],
        ], 'Sesión iniciada exitosamente.');
    }

    public function logout(): JsonResponse
    {
        $this->service->logout(auth()->user());
        return $this->sendResponse([], 'Sesión cerrada exitosamente.');
    }

    public function me(): JsonResponse
    {
        return $this->sendResponse(
            new UserResource(auth()->user()),
            'Usuario autenticado.'
        );
    }
}