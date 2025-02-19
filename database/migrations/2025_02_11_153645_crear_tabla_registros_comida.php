<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('registros_comida', function (Blueprint $table) {
            $table->id(); // ID del registro del día
            $table->string('id_empleado', 4); // Relación con empleados
            $table->string('nombre_empleado', 100); // Nombre del empleado
            $table->date('fecha'); // Fecha del registro
            $table->time('hora'); // Hora cuando registró la comida
            $table->timestamps(); // created_at y updated_at

            // Definir clave foránea con empleados
            $table->foreign('id_empleado')->references('id_empleado')->on('empleados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registros_comida');
    }
};
