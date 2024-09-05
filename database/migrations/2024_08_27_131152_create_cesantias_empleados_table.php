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
        Schema::create('cesantias_empleados', function (Blueprint $table) {
            $table->id('IdCesantiasEmpleado');
            $table->integer('Anio');
            $table->foreignId('id_EmpleadoNomina')
            ->constrained('info_empleado_per_nominas', 'id_EmpleadoNomina');
            $table->decimal('salarioEmpleado');
            $table->integer('diasLaborados');
            $table->string('Observaciones');
            $table->string('totalCesantias');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cesantias_empleados');
    }
};
