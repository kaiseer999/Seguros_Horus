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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('idFactura');
            $table->foreignId('id_cliente')->constrained('clientes_facturas', 'id_cliente');
            $table->date('fecha_Pago');
            $table->date('fecha_Vencimiento');
            $table->decimal('valorOriginal');
            $table->decimal('valorFinal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
