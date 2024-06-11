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
        Schema::table('info_empleado_admin_nominas', function (Blueprint $table) {
         //   $table->unsignedBigInteger('idEstadoEmpleadoNomina')->nullable()->after('idCargoNomina');
         //   $table->foreign('idEstadoEmpleadoNomina')->references('idEstadoEmpleadoNomina')->on('estados__empleado_nominas')
        // ->onDelete('set null')->onUpdate('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info_empleado_admin_nominas', function (Blueprint $table) {
            //
        });
    }
};
