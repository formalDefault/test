<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados'; // Asegúrate de que la tabla sea 'empleados'
    protected $primaryKey = 'id_empleado'; // Clave primaria personalizada
    public $incrementing = false; // Si la clave primaria no es auto incremental
    protected $keyType = 'string'; // Define que la clave primaria es de tipo string

    protected $fillable = [
        'id_empleado',
        'nombre_empleado',
        'rfc',
        'contraseña',
        'activo' // Asegúrate de que este campo esté en la base de datos
    ];

    protected $hidden = ['contraseña']; // Para ocultar la contraseña si la quieres manejar de forma segura
}
