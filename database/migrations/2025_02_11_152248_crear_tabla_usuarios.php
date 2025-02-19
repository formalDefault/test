<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('usuario', 50); // Área: admin, sistemas, RH
            $table->string('nombre', 100); // Nombre completo
            $table->char('contraseña', 4); // Contraseña de 4 dígitos numéricos
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
