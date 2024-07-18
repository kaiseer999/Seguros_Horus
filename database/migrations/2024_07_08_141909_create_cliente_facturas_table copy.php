<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Descarta el espacio de tablas si existe

        Schema::create('clientes_facturas', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombreCompleto');
            $table->string('direccionCliente');
            $table->date('fechaNacimientoCliente');
            $table->string('telefono');
            $table->string('email')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_facturas');
    }
};
