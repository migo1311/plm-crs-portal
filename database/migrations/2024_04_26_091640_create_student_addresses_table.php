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
        Schema::create('student_addresses', function (Blueprint $table) {
            $table->id('student_address_id');
            $table->foreignId('student_id')
                    ->nullable()
                    ->constrained('students', 'student_id')
                    ->cascadeOnDelete();
            $table->string('home_street');
            $table->string('home_brgy');
            $table->string('home_sub_municipality');
            $table->string('home_city_municipality');
            $table->string('home_province');
            $table->string('home_zipcode', length: 4);
            $table->string('home_contact_no');
            $table->integer('permanent_street');
            $table->string('permanent_brgy');
            $table->string('permanent_sub_municipality');
            $table->string('permanent_city_municipality');
            $table->string('permanent_province');
            $table->string('permanent_zipcode', length: 4);
            $table->string('permanent_contact_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_addresses');
    }
};
