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
        Schema::create('interesescesantias_empleados', function (Blueprint $table) {
            $table->id('idInteresesCesantias');
            $table->foreignId('id_EmpleadoNomina')
            ->constrained('info_empleado_per_nominas', 'id_EmpleadoNomina');
            $table->foreignId('IdCesantiasEmpleado')
            ->constrained('cesantias_empleados', 'IdCesantiasEmpleado');;
            $table->decimal('valorInteresesCesantias');
            $table->timestamps();     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interesescesantias_empleados');

    }
};
