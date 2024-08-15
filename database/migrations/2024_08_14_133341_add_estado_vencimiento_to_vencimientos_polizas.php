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
        Schema::table('vencimientos_polizas', function (Blueprint $table) {
            $table->string('Estado')->nullable()->after('Avisos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vencimientos_polizas', function (Blueprint $table) {
            //
        });
    }
};
