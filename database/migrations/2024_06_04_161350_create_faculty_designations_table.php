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
        Schema::create('faculty_designations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')
                    ->constrained()
                    ->cascadeOnDelete();
            $table->foreignId('designation_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnDelete();
            $table->string('schedule');
            $table->string('update_by');
            // $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_designations');
    }
};
