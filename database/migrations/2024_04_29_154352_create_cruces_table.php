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
        Schema::create('cruces', function (Blueprint $table) {
            $table->id("idCruce");
            
            $table->unsignedBigInteger('idIncapacidades')->nullable();
            $table->foreign('idIncapacidades')->references('idIncapacidades')->on('incapacidades')
            ->onDelete('set null')->onUpdate('cascade');


            $table->float("valorIncapacidad");

            $table->float("valorCruce");

            $table->float("saldoCruce")->nullable(); 

            $table->json('PagoEPS')->nullable();  

            $table->string("Observaciones");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cruces');
    }
};
