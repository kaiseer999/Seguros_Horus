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
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->id('idDetalleFactura');
            $table->foreignId('idFactura')->constrained('facturas', 'idFactura');
            $table->foreignId('codigoProducto')->constrained('producto_facturas', 'codigoProducto');
            $table->decimal('precioPagarProducto');
            $table->integer('cantidadProducto');
            $table->decimal('totalFactura'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_facturas');
    }
};
