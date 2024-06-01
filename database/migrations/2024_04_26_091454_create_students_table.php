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
            $table->string('maiden_name');
            $table->string('plm_email_address');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('country');
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
            // Student Address
            $table->string('home_street')->nullable();
            $table->string('home_brgy')->nullable();
            $table->string('home_sub_municipality')->nullable();
            $table->string('home_city_municipality')->nullable();
            $table->string('home_province')->nullable();
            $table->string('home_zipcode', length: 4)->nullable();
            $table->string('home_contact_no')->nullable();
            $table->integer('permanent_street')->nullable();
            $table->string('permanent_brgy')->nullable();
            $table->string('permanent_sub_municipality')->nullable();
            $table->string('permanent_city_municipality')->nullable();
            $table->string('permanent_province')->nullable();
            $table->string('permanent_zipcode', length: 4)->nullable();
            $table->string('permanent_contact_no')->nullable();
            // Student Education
            $table->integer('lrn')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->string('school_type')->nullable();
            $table->string('strand')->nullable();
            $table->integer('year_entered')->nullable();
            $table->integer('year_graduated')->nullable();
            $table->string('honors_awards')->nullable();
            $table->float('general_average')->nullable();
            $table->string('remarks')->nullable();
            $table->string('org_name')->nullable();
            $table->string('org_position')->nullable();
            $table->string('previous_tertiary')->nullable();
            $table->string('previous_sem')->nullable();
            // Student Family
            $table->string('father_last_name')->nullable();
            $table->string('father_first_name')->nullable();
            $table->string('father_middle_name')->nullable();
            $table->string('father_address')->nullable();
            $table->string('father_contact_no')->nullable();
            $table->string('father_office_employer')->nullable();
            $table->string('father_office_address')->nullable();
            $table->string('father_office_num')->nullable();
            $table->string('mother_lastname')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_middle_name')->nullable();
            $table->string('mother_address')->nullable();
            $table->integer('mother_contact_no')->nullable();
            $table->string('mother_office_employer')->nullable();
            $table->string('mother_office_address')->nullable();
            $table->string('mother_office_num')->nullable();
            $table->string('guardian_lastname')->nullable();
            $table->string('guardian_first_name')->nullable();
            $table->string('guardian_middle_name')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_contact_no')->nullable();
            $table->string('guardian_office_employer')->nullable();
            $table->string('guardian_office_address')->nullable();
            $table->string('guardian_office_num')->nullable();
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
