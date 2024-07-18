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
        Schema::create('pagos_facturas', function (Blueprint $table) {
            $table->id('idPagoFactura');
            $table->foreignId('idFactura')->constrained('facturas', 'idFactura');
            $table->foreignId('idFormaPago')->constrained('formas_pagos', 'idFormaPago');
            $table->decimal('valorPagado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_facturas');
    }
};
