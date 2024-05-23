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
        Schema::table('cruces', function (Blueprint $table) {
            $table->json('PagoCruce')->nullable()->after('PagoEPS');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cruces', function (Blueprint $table) {
            $table->dropColumn('PagoCruce');
        });
    }
};
