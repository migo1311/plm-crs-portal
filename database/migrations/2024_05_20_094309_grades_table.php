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
            $table->foreignId('class_id')
                    ->constrained('ta_classes', 'class_id');
            $table->foreignId('student_id')
                    ->constrained('students', 'student_id');
            $table->double('grade')->unsigned();
            $table->double('completion_grade')->unsigned()->nullable();
            $table->date('submitted_date')->nullable();
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
