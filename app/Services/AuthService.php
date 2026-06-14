<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(RegisterRequest $request): array
    {
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => $request->password, // Model cast 'hashed' lo encripta solo
            'role'        => $request->role ?? 'OPERADOR',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function login(LoginRequest $request): array
    {
        $user = User::where('email', $request->email)->first();

        // Verificar credenciales
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Las credenciales no son correctas.',
            ]);
        }

        // Verificar que el usuario esté activo
        if (!$user->active) {
            throw ValidationException::withMessages([
                'email' => 'Tu cuenta ha sido desactivada.',
            ]);
        }

        // Revocar tokens anteriores — una sesión activa a la vez
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function logout(User $user): void
    {
        // Revocar solo el token actual
        $user->currentAccessToken()->delete();
    }
}