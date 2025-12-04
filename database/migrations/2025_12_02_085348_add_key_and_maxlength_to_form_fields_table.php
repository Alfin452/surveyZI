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
        Schema::table('survey_program_form_fields', function (Blueprint $table) {
            // Menambahkan kolom field_key (slug) dan max_length
            $table->string('field_key')->nullable()->after('survey_program_id');
            $table->integer('max_length')->nullable()->after('field_type');
        });
    }

    public function down(): void
    {
        Schema::table('survey_program_form_fields', function (Blueprint $table) {
            $table->dropColumn(['field_key', 'max_length']);
        });
    }
};
