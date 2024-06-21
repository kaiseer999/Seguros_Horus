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
            Schema::create('pago_empleados', function (Blueprint $table) {
                
                $table->id('id_PagoEmpleado');

                $table->double('SueldoBruto');

                $table->date('fechaDePagoNom');

                $table->unsignedBigInteger('id_EmpleadoNomina')->nullable();
                $table->foreign('id_EmpleadoNomina')->references('id_EmpleadoNomina')->on('info_empleado_per_nominas')
                ->onDelete('set null')->onUpdate('cascade');

                $table->unsignedBigInteger('idTipoPagoNomina')->nullable();
                $table->foreign('idTipoPagoNomina')->references('idTipoPagoNomina')->on('tipo_pago_nominas')
                ->onDelete('set null')->onUpdate('cascade');

                $table->double('AuxiliodeTransporte');

                $table->double('HorasExtras');


                $table->double('SueldoNeto');

                $table->timestamps();
                
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_empleados');
    }
};
