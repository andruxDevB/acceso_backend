<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'usuario_red'
        // 'active' fuera de fillable — se controla solo desde el Service
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Scope reutilizable
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}