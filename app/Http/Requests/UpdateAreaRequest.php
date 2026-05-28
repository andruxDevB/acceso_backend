<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nombre'        => ['sometimes', 'string', 'min:2', 'max:100', Rule::unique('areas', 'nombre')->ignore($this->area->id)],
            'descripcion'   => ['sometimes', 'nullable', 'string', 'max:255'],
            'estado'        => ['sometimes', Rule::in(['ACTIVO', 'INACTIVO'])],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.unique' => 'Ya existe un área con ese nombre.',
            'estado.in'     => 'El estado debe ser ACTIVO o INACTIVO',
        ];
    }
}