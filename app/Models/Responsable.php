<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $fillable = [
        'nombre_responsable',
        'apellido_apellido',
        'user_ipa_responsable'
    ];
}
