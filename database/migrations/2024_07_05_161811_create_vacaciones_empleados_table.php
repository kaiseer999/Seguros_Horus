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
        Schema::create('vacaciones_empleados', function (Blueprint $table) {
            $table->id("idVacacionesEmpleados");

            $table->unsignedBigInteger('id_EmpleadoNomina'); 
            $table->foreign('id_EmpleadoNomina')
                  ->references('id_EmpleadoNomina')->on('info_empleado_per_nominas')
                  ->onDelete('cascade');

            
            

            $table->date('fecha_inicio');
            $table->date('fecha_salida');
            $table->integer('dias_vacaciones'); 
            $table->integer('dias_trabajados'); 
            $table->decimal('pago_vacaciones', 10, 2); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacaciones_empleados');
    }
};
