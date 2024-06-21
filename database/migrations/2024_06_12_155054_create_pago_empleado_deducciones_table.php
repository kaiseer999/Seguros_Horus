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
        Schema::create('pago_empleado_deducciones', function (Blueprint $table) {
            $table->id('id_pago_deduccion_empleado');

            $table->unsignedBigInteger('id_PagoEmpleado');
            $table->foreign('id_PagoEmpleado')->references('id_PagoEmpleado')->on('pago_empleados')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('idDeduccion_EmpNom');
            $table->foreign('idDeduccion_EmpNom')->references('idDeduccion_EmpNom')->on('deduccionesempleados')
            ->onDelete('cascade')->onUpdate('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_empleado_deducciones');
    }
};
