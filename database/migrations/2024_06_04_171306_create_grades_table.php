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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')
                ->constrained('classes', 'id')->cascadeOnDelete();
            $table->foreignId('student_no')
                ->constrained('students', 'student_no')->cascadeOnDelete();
            $table->double('grade')->unsigned()->nullable();
            $table->string('remarks');
            $table->double('completion_grade')->unsigned()->nullable();
            $table->date('submitted_date')->nullable();
            $table->date('finalization_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
