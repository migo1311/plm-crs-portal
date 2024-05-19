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
        Schema::create('block_class', function (Blueprint $table) {
            $table->id('block_class_id');
            $table->foreignIdFor(\App\Models\Block::class, 'block_id')
                    ->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\TaClass::class, 'class_id')
                    ->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('class_student', function (Blueprint $table) {
            $table->id('class_student_id');
            $table->foreignIdFor(\App\Models\TaClass::class, 'class_id')
                    ->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Student::class, 'student_id')
                    ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_class');
        Schema::dropIfExists('class_student');
    }
};
