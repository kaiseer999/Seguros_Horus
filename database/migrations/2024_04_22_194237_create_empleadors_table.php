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
        Schema::create('empleadors', function (Blueprint $table) {
            //Al tratar de exportarlos no habian numeros de identificacion ni tipos de documentos, se exportaron asi
            //NO CUMPLE CON TEMAS DE NORMALIZACION DE BD, SE CUMPLE CON LAS EXIGENCIAS DEL CLIENTE.
            $table->increments('numeroEmpleador'); // Este será autoincremental y también será la clave primaria
            $table->string('nombreEmpleador', 255); // Este será un varchar de 255
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleadors');
    }
};
