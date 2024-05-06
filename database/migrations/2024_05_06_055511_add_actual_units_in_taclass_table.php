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
            $table->unsignedSmallInteger('actual_units')->after('credited_units')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ta_classes', function (Blueprint $table) {
            $table->dropColumn('actual_units');
        });
    }
};
