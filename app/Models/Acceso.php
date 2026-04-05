<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $fillable = [
        'numero_requerimiento','area_id','responsable_id'
    ];

    public function detalles()
    {
        return $this->hasMany(AccesoDetalle::class);
    }
}
