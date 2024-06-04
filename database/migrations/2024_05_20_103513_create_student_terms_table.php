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
            $table->id('student_term_id');
            $table->foreignId('student_id')
                ->constrained('students', 'student_id')
                ->cascadeOnDelete();
            $table->string('academic_year');
            $table->string('semester');
            $table->foreignId('aysem_id')
                ->nullable()
                ->constrained('aysems', 'aysem_id')
                ->cascadeOnDelete();
            $table->foreignId('college_id')
                ->nullable()
                ->constrained('colleges', 'college_id')
                ->cascadeOnDelete();
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('programs', 'program_id')
                ->cascadeOnDelete();
            $table->foreignId('block_id')
                ->nullable()
                ->constrained('blocks', 'block_id')
                ->cascadeOnDelete();
            $table->string('student_type');
            $table->string('registration_status');
            $table->string('graduating');
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
