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
        Schema::create('gwas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_no')
                    ->nullable()
                    ->constrained('students', 'student_no')
                    ->cascadeOnDelete();
            $table->float('gwa');
            $table->foreignId('aysem_id')
                    ->nullable()
                    ->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gwas');
    }
};
