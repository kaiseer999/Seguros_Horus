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
        Schema::table('producto_facturas', function (Blueprint $table) {
            $table->string('descripcionProducto')->after('precioProducto');
            $table->foreignId('idCategoriaProducto')->after('codigoProducto')->constrained('categoria_productos', 'idCategoriaProducto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('producto_facturas', function (Blueprint $table) {
            //
        });
    }
};
