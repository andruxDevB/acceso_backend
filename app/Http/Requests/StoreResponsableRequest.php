<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResponsableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // no más hardcode true
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'apellido'  => ['required', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'email'      => ['required', 'email:rfc,dns', 'max:100', Rule::unique('responsables', 'email')],
            'usuario_red'  => ['required', 'string', 'max:10', 'alpha_num', Rule::unique('responsables', 'usuario_red')],

        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex'    => 'El nombre solo puede contener letras y espacios.',
            'apellido.required'  => 'El apellido es obligatorio.',
            'apellido.regex'     => 'El apellido solo puede contener letras y espacios.',
            'email.required'      => 'El correo es obligatorio.',
            'email.email'         => 'El formato del correo no es válido.',
            'email.unique'        => 'Este correo ya está registrado.',
            'usuario_red.required'  => 'El usuario de red es obligatorio.',
            'usuario_red.max'       => 'El usuario de red no puede superar los 10 caracteres.',
            'usuario_red.alpha_num' => 'El usuario de red solo puede contener letras y números.',
            'usuario_red.unique'    => 'Este usuario de red ya está registrado.',

        ];
    }
}