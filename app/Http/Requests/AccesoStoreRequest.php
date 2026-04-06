<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AccesoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero_requerimiento'          => 'required|string|max:10|distinct',
            'area_id'                       => 'required|exists:area,id',
            'responsable_id'                => 'required|exists:responsables,id',
            'area_responsable'              => 'required|string|max:50',

            'persona'                       => 'required|array|min:1',

            'persona.*.nombre_persona'      => 'required|string|max:50',
            'persona.*.apellido_persona'    => 'required|string|mas:50',
            'persona.*.cedula_persona'      => 'required|string|max:15',
            'persona.*.empresa'             => 'required|string|max:50'
        ];
    }

    public function messages()
    {
        return [
            'numero_requerimiento.required'         => 'El número de requerimiento es obligatorio.',
            'area_id.required'                      => 'El area restringida a acceder es obligatoria.',
            'responsable_id.required'               => 'El responsable de registrar el acceso al area restringida es obligatorio.',
            'area_responsable.required'             => 'El area responsable de la visita es obligatoria.',

            'persona'                               => 'Debe registrar al menos una persona.',

            'persona.*.nombre_persona.required'     => 'El nombre de la persona es obligatorio.',
            'persona.*.apellido_persona.required'   => 'El apellido de la persona es obligatorio.',
            'persona.*.cedula_persona.required'     => 'El número de cédula de la persona es obligatorio.',
            'persona.*.empresa.required'            => 'La empresa a la que pertenece la persona es obligatorio.'
        ];
    }
}
