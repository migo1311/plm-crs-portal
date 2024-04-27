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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('middleinitial');
            $table->string('nameextension');
            $table->foreignId('college_id')
                    ->nullable()
                    ->constrained('colleges', 'college_id');
            $table->foreignId('program_id')
                    ->nullable()
                    ->constrained('programs', 'program_id');
            $table->unsignedInteger('yearlevel');
            $table->string('plm_email_address');
            $table->foreignId('aysem_id')
                    ->nullable()
                    ->constrained('aysems', 'aysem_id');
            $table->string('registration_status');
            $table->foreignId('block_id')
                    ->nullable()
                    ->constrained('blocks', 'block_id');
            $table->boolean('graduating');
            $table->string('student_type');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->integer('age');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('mobile_num');
            $table->string('email_add');
            $table->string('religion');
            $table->integer('height');
            $table->integer('weight');
            $table->string('complexion');
            $table->string('blood_type');
            $table->string('telephone_num');
            $table->string('dominant_hand');
            $table->string('medical_history');
            $table->integer('annual_income');
            $table->longText('q1_answer');
            $table->longText('q2_answer');
            $table->longText('q2a_answer');
            $table->longText('q2b_answer');
            $table->longText('q3_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
