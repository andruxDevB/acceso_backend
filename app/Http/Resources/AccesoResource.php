<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccesoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'numero_requerimiento'  => $this->numero_requerimiento,
            'estado'                => $this->estado,
            'fecha_ingreso'         => $this->created_at->toDateTimeString(),
            'check_out'             => $this->check_out?->toDateTimeString(),
            'area'                  => new AreaResource($this->whenLoaded('area')),
            'responsable'           => new ResponsableResource($this->whenLoaded('responsable')),
            'personas'              => PersonaAccesoResource::collection($this->whenLoaded('personas')),
        ];
    }
}