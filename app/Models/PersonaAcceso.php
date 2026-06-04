<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonaAcceso extends Model
{
    use HasFactory;

    protected $table = 'personas_acceso';

    protected $fillable = [
        'acceso_id',
        'nombre',
        'apellido',
        'cedula',
        'empresa',
    ];

    public function acceso(): BelongsTo
    {
        return $this->belongsTo(Acceso::class);
    }
}