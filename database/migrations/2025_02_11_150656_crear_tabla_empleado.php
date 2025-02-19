<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->string('id_empleado', 4)->primary(); // ID de 4 dígitos como clave primaria
            $table->string('nombre_empleado', 100);
            $table->string('rfc', 13)->unique(); // RFC con 13 caracteres y único
            $table->char('contraseña', 4); // Contraseña de 4 dígitos
            $table->boolean('activo')->default(true); // Campo activo/inactivo (true por defecto)
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
