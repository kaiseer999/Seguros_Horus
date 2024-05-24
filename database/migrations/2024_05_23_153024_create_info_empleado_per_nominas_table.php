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
        Schema::create('info_empleado_per_nominas', function (Blueprint $table) {
            $table->id('id_EmpleadoNomina');

            $table->unsignedBigInteger('idEmpleadoAdmNom')->nullable();
            $table->foreign('idEmpleadoAdmNom')->references('idEmpleadoAdmNom')->on('info_empleado_admin_nominas')
            ->onDelete('set null')->onUpdate('cascade');

            $table->string('cedulaEmpleadoNom');
            $table->string('nombreEmpleadoNom');
            $table->string('direccionEmpleadoNom');
            $table->string('sexoEmpleadoNom');

            $table->unsignedBigInteger('idEstadoCivilNomina')->nullable();
            $table->foreign('idEstadoCivilNomina')->references('idEstadoCivilNomina')->on('estado_civil_nominas')
            ->onDelete('set null')->onUpdate('cascade');

            $table->date('fechaNacEmpleadoNom');
            $table->string('emailEmpleadoNom');
            $table->string('telefonoEmpleadoNom');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_empleado_per_nominas');
    }
};
