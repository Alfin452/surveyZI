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
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['survey_program_id']);
            $table->dropColumn('survey_program_id');
            $table->foreignId('question_section_id')
                ->after('id')
                ->constrained('question_sections')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['question_section_id']);
            $table->dropColumn('question_section_id');
            $table->foreignId('survey_program_id')
                ->nullable()
                ->after('id')
                ->constrained('survey_programs')
                ->onDelete('cascade');
        });
    }
};
