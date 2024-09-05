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
        Schema::table('cesantias_empleados', function (Blueprint $table) {
            $table->decimal('totalCesantias', 15, 2)->change(); // Cambia VARCHAR a DECIMAL con precisión de 15 dígitos y 2 decimales
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cesantias_empleados', function (Blueprint $table) {
            //
        });
    }
};
