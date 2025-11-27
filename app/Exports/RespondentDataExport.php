<?php

namespace App\Exports;

use App\Models\SurveyProgram;
use App\Models\PreSurveyResponse;
use App\Models\Answer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RespondentDataExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, ShouldQueue
{
    protected $program;
    protected $unitId;
    protected $formFields;
    protected $sections; // Kita pakai Section, bukan Questions lagi

    public function __construct(SurveyProgram $program, $unitId = null)
    {
        $this->program = $program;
        $this->unitId = $unitId;

        // 1. Ambil Form Builder (Tapi filter "Nama" agar tidak double)
        $this->formFields = $program->formFields()
            ->orderBy('order')
            ->get()
            ->filter(function ($field) {
                // Hapus field jika labelnya mengandung kata "Nama" (Case insensitive)
                return !str_contains(strtolower($field->field_label), 'nama');
            });

        // 2. Ambil Section (Bukan Question per butir)
        $this->sections = $program->questionSections()->orderBy('order_column')->get();
    }

    public function collection()
    {
        $query = PreSurveyResponse::with(['unitKerja'])
            ->where('survey_program_id', $this->program->id);

        if ($this->unitId) {
            $query->where('unit_kerja_id', $this->unitId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        // Header Statis
        $headers = ['Tanggal', 'Unit Kerja', 'Nama Lengkap'];

        // Header Dinamis (Biodata selain Nama)
        foreach ($this->formFields as $field) {
            $headers[] = $field->field_label;
        }

        // Header Nilai (Per BAGIAN / Section)
        foreach ($this->sections as $section) {
            $headers[] = "Skor: " . $section->title;
        }

        // Tambahan: Rata-rata Total Individu
        $headers[] = 'Skor Akhir';

        return $headers;
    }

    public function map($response): array
    {
        // 1. Data Bawaan
        $row = [
            $response->created_at->format('d/m/Y H:i'),
            $response->unitKerja->unit_kerja_name ?? 'Global',
            $response->full_name, // Ini Nama Utama
        ];

        // 2. Data Biodata Dinamis (Tanpa Nama Double)
        $dynamicData = $response->dynamic_data ?? [];
        foreach ($this->formFields as $field) {
            $val = $dynamicData[$field->field_label] ?? '-';
            $row[] = is_array($val) ? implode(', ', $val) : $val;
        }

        // 3. Hitung Skor Per Section (Rapor Individu)
        $totalScoreAccumulator = 0;
        $totalSectionCount = 0;

        foreach ($this->sections as $section) {
            // Query Jawaban User untuk Section ini
            $avgSection = Answer::where('user_id', $response->user_id)
                ->where('survey_program_id', $this->program->id)
                // Kita gunakan filter unit kerja jika ada, jika tidak abaikan agar data tetap muncul
                ->when($response->unit_kerja_id, function ($q) use ($response) {
                    return $q->where('unit_kerja_id', $response->unit_kerja_id);
                })
                ->whereIn('question_id', $section->questions->pluck('id'))
                ->avg('answer_skor');

            if ($avgSection) {
                $row[] = number_format($avgSection, 2);
                $totalScoreAccumulator += $avgSection;
                $totalSectionCount++;
            } else {
                $row[] = '-'; // Jika kosong/belum jawab
            }
        }

        // 4. Skor Akhir Individu
        $finalScore = $totalSectionCount > 0 ? ($totalScoreAccumulator / $totalSectionCount) : 0;
        $row[] = $finalScore > 0 ? number_format($finalScore, 2) : '-';

        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '10B981']], // Warna Emerald/Hijau agar beda dengan Analisis
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ]
        ];
    }
}
