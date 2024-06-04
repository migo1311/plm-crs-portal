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
        Schema::create('instructor_profiles', function (Blueprint $table) {
            $table->id('instructor_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('pedigree')->nullable();
            $table->string('maiden_name')->nullable();
            $table->string('birth_place');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('citizenship');
            $table->string('mobile_phone');
            $table->string('email_address');
            $table->string('tin_number', length: 15)->unique()->nullable();
            $table->string('gsis_number')->unique()->nullable();
            $table->string('instructor_code');
            $table->string('street_address')->nullable();
            $table->string('province_city')->nullable();
            $table->string('zip_code', length: 4)->nullable();
            $table->string('phone_number')->nullable();
            $table->string('faculty_name');
            $table->foreignId('college_id')
                    ->nullable()
                    ->constrained('colleges', 'college_id')
                    ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_profiles');
    }
};
