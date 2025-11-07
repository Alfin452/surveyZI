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
        Schema::create('pre_survey_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('survey_program_id')->constrained('survey_programs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->string('gender');
            $table->integer('age');
            $table->string('status');
            $table->string('unit_kerja_or_fakultas');
            $table->timestamps();

            $table->unique(['survey_program_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_survey_responses');
    }
};
