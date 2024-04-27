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
        Schema::create('colleges', function (Blueprint $table) {
            $table->id('college_id');
            $table->string('college_code');
            $table->string('college_name');
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id('program_id');
            $table->string('program_title');
            $table->string('program_code');
            $table->string('major');
            $table->string('degree');
            $table->string('degree_level');
            $table->integer('num_credits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
        Schema::dropIfExists('programs');
    }
};
