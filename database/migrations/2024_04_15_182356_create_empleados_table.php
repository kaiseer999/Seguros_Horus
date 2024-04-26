<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('numeroEmpleado'); // Este será autoincremental y también será la clave primaria
            $table->string('tipoDocumentoempleado'); // Este será un varchar de 255
            $table->string('idEmpleado')->unique(); // Este será único en la tabla
            $table->string('nombreEmpleado', 180)->nullable(); // Este será un varchar de 255
            $table->string('apellidoEmpleado', 180)->nullable(); // Este será un varchar de 255
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
