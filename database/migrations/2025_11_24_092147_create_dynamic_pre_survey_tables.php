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
        // 1. Tabel untuk menyimpan Konfigurasi Field (Pertanyaan Data Diri Custom)
        // Contoh isi: Label="NIM", Type="number", Required=true
        Schema::create('survey_program_form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_program_id')->constrained('survey_programs')->onDelete('cascade');

            $table->string('field_label');      // Contoh: "Tahun Lulus", "NIM", "Asal Sekolah"
            $table->string('field_type');       // text, number, select, radio, date
            $table->json('field_options')->nullable(); // Simpan opsi jika tipe select/radio (["2020", "2021"])
            $table->boolean('is_required')->default(true);
            $table->integer('order')->default(0); // Untuk urutan tampilan

            $table->timestamps();
        });

        // 2. Update tabel Respon untuk menampung jawaban dinamis (JSON)
        Schema::table('pre_survey_responses', function (Blueprint $table) {
            // Kolom 'dynamic_data' akan menyimpan jawaban user dalam format JSON
            // Contoh: {"NIM": "12345", "Tahun Lulus": "2023"}
            $table->json('dynamic_data')->nullable()->after('survey_program_id');

            // Kita buat kolom lama menjadi NULLABLE agar tidak error saat insert data baru
            // (Data lama tetap aman, data baru akan masuk ke dynamic_data atau kolom ini jika di-mapping)
            $table->string('age')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('unit_kerja_or_fakultas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback
        Schema::table('pre_survey_responses', function (Blueprint $table) {
            $table->dropColumn('dynamic_data');
            // Kembalikan kolom lama ke not null (opsional, hati-hati jika ada data null)
        });

        Schema::dropIfExists('survey_program_form_fields');
    }
};
