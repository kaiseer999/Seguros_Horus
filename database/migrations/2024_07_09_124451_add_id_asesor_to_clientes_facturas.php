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
        Schema::table('clientes_facturas', function (Blueprint $table) {

            if (!Schema::hasColumn('cliente_facturas', 'idAsesorComercial')) {
                $table->foreignId('idAsesorComercial')->nullable()->after('id_cliente')->constrained('asesor_comercials', 'idAsesorComercial');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes_facturas', function (Blueprint $table) {
            //
        });
    }
};
