<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nombre'        => ['required', 'string', 'min:2', 'max:100', Rule::unique('areas', 'nombre')],
            'descripcion'   => ['nullable', 'string', 'max:255'],
            'estado'        => ['required', Rule::in(['ACTIVO', 'INACTIVO'])],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'   => 'El nombre del área es obligatorio.',
            'nombre.unique'     => 'Ya existe un área con este nombre.',
            'nombre.max'        => 'El nombre no puede superar los 100 caracteres.',
            'estado.required'   => 'El estado es obligatorio.',
            'estado.in'         => 'El estado debe ser ACTIVO o INACTIVO.',
        ];
    }
}