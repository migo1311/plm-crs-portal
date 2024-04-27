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
        Schema::create('buildings',function(Blueprint $table){
            $table->id('building_id');
            $table->string('building_code');
            $table->string('building_name');
            $table->timestamps();
        });

        Schema::create('modes',function(Blueprint $table){
            $table->id('mode_id');
            $table->string('mode_code');
            $table->string('mode_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
