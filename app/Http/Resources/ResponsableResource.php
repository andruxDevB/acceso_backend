<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponsableResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'nombre'        => $this->nombre,
            'apellido'      => $this->apellido,
            'email'         => $this->email,
            'usuario_red'   => $this->usuario_red,
            'active'        => $this->active,    // cast a boolean automático
            'created_at'    => $this->created_at->toDateTimeString(),
        ];
    }
}