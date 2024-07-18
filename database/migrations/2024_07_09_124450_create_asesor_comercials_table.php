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
        Schema::create('asesor_comercials', function (Blueprint $table) {
            $table->id('idAsesorComercial');
            $table->string('nombreAsesor');
            $table->string('apellidoAsesor');
            $table->string('telefonoAsesor');
            $table->string('emailAsesor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesor_comercials');
    }
};
