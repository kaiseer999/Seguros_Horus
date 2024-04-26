<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incapacidades', function (Blueprint $table) {
            $table->id('idIncapacidades');
            $table->date('FechaInicioInc');
            $table->date('FechaFinInc');
            //este registro se llenara en base a lo ingresado fechaini y fechafin
            $table->integer('diasInc');

            $table->unsignedInteger('numeroEmpleado')->nullable();
            $table->foreign('numeroEmpleado')->references('numeroEmpleado')->on('empleados')
            ->onDelete('set null')->onUpdate('cascade');

            //clave foranea, si se borra el registro en tabla principal en esta aparecera null,
            //si se actuliza se reflejera en la tabla
            $table->unsignedInteger('numeroEmpleador')->nullable();
            $table->foreign('numeroEmpleador')->references('numeroEmpleador')->on('empleadors')
            ->onDelete('set null')->onUpdate('cascade');
            
            $table->string('RazonSocialInc');//Guarda el nombre de la Razon Social en la que el trabajador esta afiliado
                                            //Se deberia relacionar directamente con el empleador, pero por cuestiones de migraciones de datos, se pone asi.

            $table->string('EPS_ARL');//Ingresa el nombre de la EPS/ARL, quedo con la duda de que la mejor opcion sea crear una tabla aparte con todas las empresas

            $table->string('numeroRadicado');

            $table->unsignedBigInteger('idTipoInc')->nullable();
            $table->foreign('idTipoInc')->references('idTipoInc')->on('tipo_incapacidads')
            ->onDelete('set null')->onUpdate('cascade');

            
            $table->json('Historia_MedicaInc')->nullable();  

            $table->json('Soporte_Incapacidad')->nullable();  


            $table->text('Observaciones')->nullable();

            $table->unsignedBigInteger('idEstadoInc')->nullable();
            $table->foreign('idEstadoInc')->references('idEstadoInc')->on('estados')
            ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incapacidades');
    }
};
