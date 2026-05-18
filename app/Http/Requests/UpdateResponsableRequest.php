<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateResponsableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nombre'        => ['sometimes', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'apellido'      => ['sometimes', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            // unique ignora el registro actual
            'email'         => ['sometimes', 'email:rfc,dns', 'max:100',
                                Rule::unique('responsables', 'email')->ignore($this->responsable->id)],
            'usuario_red'   => ['sometimes', 'string', 'max:10', 'alpha_num',
                                Rule::unique('responsables', 'usuario_red')->ignore($this->responsable->id)],

        ];
    }
}