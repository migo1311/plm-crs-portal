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
        Schema::create('designations', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->integer('eq_units')->unsigned();
            $table->string('plm_email_address')->nullable();
            $table->enum('type_load', ['RL', 'EL', 'AL', 'SL', 'OCL', 'StL', 'OTL', 'SLW'])
                    ->default('RL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
