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
        Schema::create('prima_empleados', function (Blueprint $table) {
            $table->id('idPrimaEmpleado');
            $table->integer('AnoPago');
            $table->foreignId('id_EmpleadoNomina')
                  ->constrained('info_empleado_per_nominas', 'id_EmpleadoNomina');
            $table->string('periodoPago');
            $table->string('diasLaborados');
            $table->decimal('AuxTransporte');
            $table->decimal('TotalPagoPrima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prima_empleados');
    }
};
