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
        Schema::table('survey_programs', function (Blueprint $table) {
            // Menambahkan kolom baru setelah kolom 'is_active'
            $table->boolean('requires_pre_survey')->default(false)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_programs', function (Blueprint $table) {
            $table->dropColumn('requires_pre_survey');
        });
    }
};