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
        Schema::table('pre_survey_responses', function (Blueprint $table) {
            // Tambahkan kolom unit_kerja_id setelah survey_program_id
            // Nullable agar data lama tidak error
            $table->foreignId('unit_kerja_id')
                ->nullable()
                ->after('survey_program_id')
                ->constrained('unit_kerjas')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pre_survey_responses', function (Blueprint $table) {
            $table->dropForeign(['unit_kerja_id']);
            $table->dropColumn('unit_kerja_id');
        });
    }
};
