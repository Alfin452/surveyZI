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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_program_id')->constrained('survey_programs')->onDelete('cascade');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->boolean('requires_pre_survey')->default(false); // Untuk fitur pra-survei

            $table->boolean('is_template')->default(false);
            $table->boolean('is_global_template')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
