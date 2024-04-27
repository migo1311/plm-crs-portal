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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id('block_id');
            $table->unsignedInteger('year_level');
            $table->unsignedInteger('section');
            $table->foreignId('program_id')
                    ->nullable()
                    ->constrained('programs', 'program_id');
            $table->foreignId('aysem_id')
                    ->nullable()
                    ->constrained('aysems', 'aysem_id');
            $table->string('block_name');
            $table->string('block_code');
            $table->unsignedInteger('slots');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
