<?php

namespace App\Exports;

use App\Models\SurveyProgram;
use App\Models\Answer;
use App\Models\PreSurveyResponse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RespondentDataExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $program;
    protected $formFields;
    protected $questions;

    public function __construct(SurveyProgram $program)
    {
        $this->program = $program;
        // Load konfigurasi field custom (NIM, Prodi, dll)
        $this->formFields = $program->formFields()->orderBy('order')->get();
        // Load pertanyaan survei untuk header
        $this->questions = $program->questionSections->flatMap->questions;
    }

    public function collection()
    {
        // Ambil semua respons pre-survey untuk program ini
        return PreSurveyResponse::with(['unitKerja', 'user'])
            ->where('survey_program_id', $this->program->id)
            ->get();
    }

    public function headings(): array
    {
        // 1. Header Standar
        $headers = [
            'Tanggal Pengisian',
            'Unit Kerja Tujuan',
            'Nama Lengkap',
        ];

        // 2. Header Dinamis dari Pre-Survey (Custom Fields)
        foreach ($this->formFields as $field) {
            $headers[] = $field->field_label; // Misal: "NIM", "Prodi", "Hobi"
        }

        // 3. Header Pertanyaan Survei (Q1, Q2, dst)
        foreach ($this->questions as $index => $question) {
            $headers[] = "Q" . ($index + 1) . ": " . \Illuminate\Support\Str::limit($question->question_body, 30);
        }

        return $headers;
    }

    public function map($response): array
    {
        // 1. Data Standar
        $row = [
            $response->created_at->format('d-m-Y H:i'),
            $response->unitKerja->unit_kerja_name ?? 'Global',
            $response->full_name,
        ];

        // 2. Data Dinamis (Pecah JSON ke Kolom)
        // $response->dynamic_data otomatis sudah jadi Array karena casting di Model
        $dynamicData = $response->dynamic_data ?? [];

        foreach ($this->formFields as $field) {
            // Ambil value berdasarkan label, jika tidak ada beri strip '-'
            $value = $dynamicData[$field->field_label] ?? '-';

            // Jika value array (misal checkbox), gabungkan jadi string
            if (is_array($value)) {
                $value = implode(', ', $value);
            }

            $row[] = $value;
        }

        // 3. Data Jawaban Survei (Opsional: Jika ingin sekalian jawaban soalnya)
        // Kita cari jawaban user ini untuk program ini
        $answers = Answer::where('user_id', $response->user_id)
            ->where('survey_program_id', $this->program->id)
            ->where('unit_kerja_id', $response->unit_kerja_id)
            ->get()
            ->keyBy('question_id');

        foreach ($this->questions as $question) {
            $ans = $answers->get($question->id);
            // Tampilkan teks opsinya, misal "Sangat Puas"
            $row[] = $ans ? $ans->option->option_body : '-';
        }

        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '4F46E5']]], // Header Style (Indigo)
        ];
    }
}
