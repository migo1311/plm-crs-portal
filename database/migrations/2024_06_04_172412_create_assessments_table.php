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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_no')
                    ->nullable()
                    ->constrained('students', 'student_no');
            $table->double('assess_amount');
            $table->double('amount_paid');
            $table->double('subsidy');
            $table->double('tuition_fee');
            $table->double('library_fee');
            $table->double('athletic_fee');
            $table->double('registration_fee');
            $table->double('medical_dental_fee');
            $table->double('student_welfare');
            $table->double('cultural_activity');
            $table->double('guidance_fee');
            $table->double('laboratory_fee');
            $table->double('development_fund');
            $table->double('ang_pamantasan_fee');
            $table->double('ssc_fee');
            $table->foreignId('fee_status_id')->nullable()->constrained();
            $table->string('total_assess_fee');
            $table->string('previous_payment');
            $table->string('units');
            $table->foreignId('aysem_id')
                    ->nullable()
                    ->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
