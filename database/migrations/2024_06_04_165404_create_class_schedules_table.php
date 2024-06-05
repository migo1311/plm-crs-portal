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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')
                    ->constrained('classes', 'id')
                    ->cascadeOnDelete();
            $table->foreignId('day_id')
                    ->constrained();
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('class_mode_id')
                    ->nullable()
                    ->constrained();
            $table->foreignId('room_id')
                    ->nullable()
                    ->constrained();
            $table->string('schedule_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
