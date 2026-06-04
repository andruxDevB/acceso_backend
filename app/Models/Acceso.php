<?php

namespace App\Models;

use Illuminate\Database\Eloquetnt\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illumintae\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acceso extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'numero_requerimiento',
        'area_id',
        'responsable_id',
        'estado',
        'check_out',
    ];

    protected $casts = [
        'check_out'     => 'datetime',
        'created_at'    => 'datetime',
        'estado'        => 'string',
    ];

    // Relaciones
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(Responsable::class);
    }

    public function personas(): HasMany
    {
        return $this->hasMany(PersonaAcceso::class);
    }

    // Scopes
    public function scopeActivo($query)
    {
        return $query->where('estado', 'ACTIVO');
    }

    public function scopeFinalizado($query)
    {
        return $query->where('estado', 'FINALIZADO');
    }
}
