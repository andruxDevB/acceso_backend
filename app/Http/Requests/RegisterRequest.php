<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // registro público
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\pL\s\-]+$/u'],
            'email'       => ['required', 'email:rfc,dns', 'max:100', Rule::unique('users', 'email')],
            'password'    => ['required', 'confirmed', Password::min(8)
                                ->letters()
                                ->mixedCase()
                                ->numbers()
                                ->symbols()],
            'role'        => ['sometimes', Rule::in(['ADMIN', 'SUPERVISOR', 'OPERADOR'])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'           => 'El nombre es obligatorio.',
            'name.regex'              => 'El nombre solo puede contener letras y espacios.',
            'email.required'          => 'El correo es obligatorio.',
            'email.unique'            => 'Este correo ya está registrado.',
            'password.required'       => 'La contraseña es obligatoria.',
            'password.confirmed'      => 'Las contraseñas no coinciden.',
            'password.min'            => 'La contraseña debe tener al menos 8 caracteres.',
            'role.in'                 => 'El rol debe ser ADMIN, SUPERVISOR u OPERADOR.',
        ];
    }
}