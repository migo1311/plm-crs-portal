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
        Schema::create('study_loads', function (Blueprint $table) {
            $table->id('study_load_id');
            $table->foreignId('instructor_id')
                    ->nullable()
                    ->constrained('instructor_profiles', 'instructor_id')
                    ->cascadeOnDelete();    
            $table->integer('study_units');
            $table->integer('teaching_units');
            $table->foreignId('aysem_id')
                    ->nullable()
                    ->constrained('aysems', 'aysem_id');
            $table->string('entered_by');
            $table->date('entered_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_loads');
    }
};
