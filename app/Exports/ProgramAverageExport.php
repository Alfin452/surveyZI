<?php

namespace App\Exports;

use App\Models\SurveyProgram;
use App\Models\Answer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ProgramAverageExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, ShouldQueue
{
    protected $programId;

    public function __construct($programId)
    {
        $this->programId = $programId;
    }

    public function collection()
    {
        // PERBAIKAN: Tambahkan 'answers.' pada survey_program_id
        return Answer::where('answers.survey_program_id', $this->programId)
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->join('question_sections', 'questions.question_section_id', '=', 'question_sections.id')
            ->select(
                'question_sections.title as section_title',
                'questions.question_body',
                DB::raw('AVG(answers.answer_skor) as average_score'),
                DB::raw('COUNT(answers.id) as total_answers')
            )
            ->groupBy('question_sections.title', 'questions.id', 'questions.question_body')
            ->orderBy('question_sections.title')
            ->get();
    }

    public function headings(): array
    {
        return ['Bagian', 'Pertanyaan', 'Skor Rata-rata (1-4)', 'Jumlah Responden', 'Kategori'];
    }

    public function map($row): array
    {
        $avg = $row->average_score;

        // Logika Kategori Mutu
        $kategori = 'Kurang';
        if ($avg >= 3.26) $kategori = 'Sangat Baik';
        elseif ($avg >= 2.51) $kategori = 'Baik';
        elseif ($avg >= 1.76) $kategori = 'Cukup';

        return [
            $row->section_title,
            $row->question_body,
            number_format($avg, 2),
            $row->total_answers,
            $kategori
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '4F46E5']]]
        ];
    }
}
