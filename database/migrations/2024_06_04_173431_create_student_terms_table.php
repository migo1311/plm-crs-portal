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
        Schema::create('student_terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_no')->constrained('students', 'student_no')->cascadeOnDelete();
            $table->foreignId('aysem_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('program_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('block_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('registration_status_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('student_type');
            $table->boolean('graduating');
            $table->boolean('enrolled');
            $table->unsignedInteger('year_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_terms');
    }
};
