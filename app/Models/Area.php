<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

    protected $casts = [
        'estado'    => 'string',
    ];

    // Scopes para filtros frecuentes
    public function scopeActivo($query)
    {
        return $query->where('estado', 'ACTIVO');
    }

    public function scopeInactivo($query)
    {
        return $query->where('estado', 'INACTIVO');
    }
}
