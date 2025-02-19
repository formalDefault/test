<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'nombre',
        'contraseña',
    ];

    public $timestamps = true;

    protected $hidden = [
        'contraseña',
    ];
}
