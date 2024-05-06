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
        Schema::table('ta_classes', function (Blueprint $table) {
            $table->integer('minimum_year_level')
                ->nullable()
                ->after('instruction_language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ta_classes', function (Blueprint $table) {
            $table->dropColumn('minimum_year_level');
        });
    }
};
