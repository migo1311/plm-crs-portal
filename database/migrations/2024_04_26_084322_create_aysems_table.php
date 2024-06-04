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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id('academic_year_id');
            $table->string('academic_year_code');
            $table->date('date_start');
            $table->date('date_end');
            $table->timestamps();
        });

        Schema::create('aysems', function (Blueprint $table) {
            $table->id('aysem_id');
            $table->foreignId('academic_year_id')
                    ->nullable()
                    ->constrained('academic_years', 'academic_year_id')
                    ->cascadeOnDelete();
            $table->integer('year');
            $table->integer('semester_index');
            $table->date('date_end');
            $table->date('date_start');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aysems');
    }
};
