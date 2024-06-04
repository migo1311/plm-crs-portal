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
        Schema::create('class_schedules',function(Blueprint $table){
            $table->id('class_schedule_id');
            $table->foreignId('classes_id')
                    ->nullable()
                    ->constrained('ta_classes', 'class_id')
                    ->cascadeOnDelete();
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('mode_id')
                    ->nullable()
                    ->constrained('modes', 'mode_id')
                    ->cascadeOnDelete();
            $table->foreignId('room_id')
                    ->nullable()
                    ->constrained('rooms', 'room_id')
                    ->cascadeOnDelete();
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
