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
        Schema::create('ta_consultations', function (Blueprint $table) {
            $table->id('ta_consultation_id');
            $table->foreignId('instructor_id')
                    ->nullable()
                    ->constrained('instructor_profiles', 'instructor_id')
                    ->cascadeOnDelete();
            $table->string('day');
            $table->time('time_start');
            $table->time('time_end');
            $table->unsignedInteger('num_hours');
            $table->foreignId('aysem_id')
                    ->nullable()
                    ->constrained('aysems', 'aysem_id')
                    ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ta_consultations');
    }
};
