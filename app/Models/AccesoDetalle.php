<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccesoDetalle extends Model
{
    protected $fillable = [
        'requerimiento_id',
        'nombre_persona',
        'apellido_persona',
        'cedula_persona',
        'empresa'
    ];

    public function requerimiento()
    {
        return $his->belongTo(Acceso::class);
    }
}
