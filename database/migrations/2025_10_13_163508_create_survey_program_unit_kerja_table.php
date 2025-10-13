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
        Schema::create('survey_program_unit_kerja', function (Blueprint $table) {
            $table->foreignId('survey_program_id')->constrained('survey_programs')->onDelete('cascade');

            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->onDelete('cascade');

            $table->primary(['survey_program_id', 'unit_kerja_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_program_unit_kerja');
    }
};
