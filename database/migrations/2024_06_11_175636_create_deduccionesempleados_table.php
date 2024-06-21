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
        Schema::create('deduccionesempleados', function (Blueprint $table) {
            $table->id('idDeduccion_EmpNom');

            $table->unsignedBigInteger('id_EmpleadoNomina')->nullable();
            $table->foreign('id_EmpleadoNomina')->references('id_EmpleadoNomina')->on('info_empleado_per_nominas')
            ->onDelete('set null')->onUpdate('cascade');
            
            $table->unsignedBigInteger('idTipoDeduccionesNomina')->nullable();
            $table->foreign('idTipoDeduccionesNomina')->references('idTipoDeduccionesNomina')->on('tipo_deducciones_nominas')
            ->onDelete('set null')->onUpdate('cascade');

            $table->double('MontoDeduccionNom');

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deduccionesempleados');
    }
};
