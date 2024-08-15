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
        // $table->foreignId('idFactura')->constrained('facturas', 'idFactura');

        Schema::create('vencimientos_polizas', function (Blueprint $table) {
            $table->id('idVencimiento'); // Esto crea un campo `idVencimiento` como `bigIncrements`
            $table->unsignedBigInteger('idFactura'); // Asegúrate de que esto sea un `unsignedBigInteger`
            $table->foreign('idFactura')
                  ->references('idFactura')->on('facturas')
                  ->onDelete('cascade'); // Asegúrate de que coincida con el tipo de datos de `idFacturas`
            $table->string('Avisos')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vencimientos_polizas');
    }
};
