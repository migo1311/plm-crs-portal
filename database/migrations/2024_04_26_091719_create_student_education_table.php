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
        Schema::create('student_education', function (Blueprint $table) {
            $table->id('student_education_id');
            $table->foreignId('student_id')
                    ->nullable()
                    ->constrained('students', 'student_id')
                    ->cascadeOnDelete();
            $table->integer('lrn');
            $table->string('school_name');
            $table->string('school_address');
            $table->string('school_type');
            $table->string('strand');
            $table->integer('year_entered');
            $table->integer('year_graduated');
            $table->string('honors_awards');
            $table->float('general_average');
            $table->string('remarks');
            $table->string('org_name');
            $table->string('org_position');
            $table->string('previous_tertiary');
            $table->string('previous_sem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_education');
    }
};
