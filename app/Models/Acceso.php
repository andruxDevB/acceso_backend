<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $fillable = [
        'numero_requerimiento',
        'area_id',
        'responsable_id',
        'check_in',
        'check_out',
        'estado',
        'area_responsable'
    ];

    public function detalles()
    {
        return $this->hasMany(AccesoDetalle::class);
    }
}
