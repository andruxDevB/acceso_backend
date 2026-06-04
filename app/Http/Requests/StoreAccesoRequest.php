<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccesoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'numero_requerimiento' => ['required','string','min:4','max:50', Rule::unique('accesos', 'numero_requerimiento'), 'regex:/^\pL[\pL\d]*\d$/u',],
            'area_id'              => ['required', 'integer', Rule::exists('areas', 'id')],
            'responsable_id'       => ['required', 'integer', Rule::exists('responsables', 'id')],

            // Validación del array de personas
            'personas'             => ['required', 'array', 'min:1'],
            'personas.*.nombre'    => ['required', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'personas.*.apellido'  => ['required', 'string', 'min:2', 'max:50', 'regex:/^[\pL\s\-]+$/u'],
            'personas.*.cedula'    => ['required', 'string', 'max:20'],
            'personas.*.empresa'   => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'numero_requerimiento.required' => 'El número de requerimiento es obligatorio.',
            'numero_requerimiento.unique'   => 'Este número de requerimiento ya está registrado.',
            'numero_requerimiento.regex'    => 'El número de requerimiento solo permite letras y números, debe iniciar con una letra y terminar con un número.',
            'area_id.required'              => 'El área es obligatoria.',
            'area_id.exists'                => 'El área seleccionada no existe.',
            'responsable_id.required'       => 'El responsable es obligatorio.',
            'responsable_id.exists'         => 'El responsable seleccionado no existe.',
            'personas.required'             => 'Debe registrar al menos una persona.',
            'personas.min'                  => 'Debe registrar al menos una persona.',
            'personas.*.nombre.required'    => 'El nombre de cada persona es obligatorio.',
            'personas.*.apellido.required'  => 'El apellido de cada persona es obligatorio.',
            'personas.*.cedula.required'    => 'La cédula de cada persona es obligatoria.',
            'personas.*.empresa.required'   => 'La empresa de cada persona es obligatoria.',
        ];
    }
}