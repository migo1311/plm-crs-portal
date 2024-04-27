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
            $table->id('grade_id');
            $table->foreignId('student_id')
                    ->nullable()
                    ->constrained('students', 'student_id')
                    ->cascadeOnDelete();
            $table->foreignId('class_id')
                    ->nullable()
                    ->constrained('ta_classes', 'class_id')
                    ->cascadeOnDelete();
            $table->float('initial_grade');
            $table->float('final_grade');
            $table->date('finalization_date');
            $table->float('completion_grade');
            $table->foreignId('remark_id')
                    ->nullable()
                    ->constrained('remarks', 'remark_id');
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
