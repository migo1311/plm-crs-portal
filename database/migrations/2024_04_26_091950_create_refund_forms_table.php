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
        Schema::create('refund_forms', function (Blueprint $table) {
            $table->id('refund_form_id');
            $table->foreignId('assessment_id')
                    ->nullable()
                    ->constrained('assessments', 'assessment_id')
                    ->cascadeOnDelete();
            $table->string('type_of_refund');
            $table->string('rate_of_refund');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_forms');
    }
};
