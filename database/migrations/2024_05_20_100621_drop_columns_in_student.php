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
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['college_id']);
            $table->dropColumn('college_id');
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
            $table->dropForeign(['aysem_id']);
            $table->dropColumn('aysem_id');
            $table->dropForeign(['block_id']);
            $table->dropColumn('block_id');
            $table->dropColumn('graduating');
            $table->dropColumn('student_type');
            $table->dropColumn('registration_status');
            $table->dropColumn('yearlevel');

            $table->string('maiden_name')->nullable();
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('college_id')
                ->nullable()
                ->constrained('colleges', 'college_id');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('programs', 'program_id');
            $table->foreignId('aysem_id')
                ->nullable()
                ->constrained('aysems', 'aysem_id');
            $table->foreignId('block_id')
                ->nullable()
                ->constrained('blocks', 'block_id');
            $table->boolean('graduating');
            $table->string('student_type');
            $table->string('registration_status');

            $table->dropColumn('maiden_name');
            $table->dropColumn('country');
        });
    }
};
