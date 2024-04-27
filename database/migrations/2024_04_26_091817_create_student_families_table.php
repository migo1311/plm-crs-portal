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
        Schema::create('student_families', function (Blueprint $table) {
            $table->id('student_family_id');
            $table->foreignId('student_id')
                    ->nullable()
                    ->constrained('students', 'student_id')
                    ->cascadeOnDelete();
            $table->string('father_last_name');
            $table->string('father_first_name');
            $table->string('father_middle_name');
            $table->string('father_address');
            $table->string('father_contact_no');
            $table->string('father_office_employer');
            $table->string('father_office_address');
            $table->string('father_office_num');
            $table->string('mother_lastname');
            $table->string('mother_first_name');
            $table->string('mother_middle_name');
            $table->string('mother_address');
            $table->integer('mother_contact_no');
            $table->string('mother_office_employer');
            $table->string('mother_office_address');
            $table->string('mother_office_num');
            $table->string('guardian_lastname');
            $table->string('guardian_first_name');
            $table->string('guardian_middle_name');
            $table->string('guardian_address');
            $table->string('guardian_contact_no');
            $table->string('guardian_office_employer');
            $table->string('guardian_office_address');
            $table->string('guardian_office_num');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_families');
    }
};
