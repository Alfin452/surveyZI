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
    protected $unitId; // Tambahan Property
    protected $formFields;
    protected $questions;

    // Constructor terima Unit ID (Opsional, Default null)
    public function __construct(SurveyProgram $program, $unitId = null)
    {
        $this->program = $program;
        $this->unitId = $unitId;

        $this->formFields = $program->formFields()->orderBy('order')->get();
        $this->questions = $program->questionSections->flatMap->questions;
    }

    public function collection()
    {
        $query = PreSurveyResponse::with(['unitKerja'])
            ->where('survey_program_id', $this->program->id);

        // Filter Jika Unit ID ada
        if ($this->unitId) {
            $query->where('unit_kerja_id', $this->unitId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        $headers = ['Tanggal', 'Unit Kerja', 'Nama Lengkap'];

        foreach ($this->formFields as $field) {
            $headers[] = $field->field_label;
        }

        foreach ($this->questions as $index => $question) {
            $headers[] = "Q" . ($index + 1);
        }

        return $headers;
    }

    public function map($response): array
    {
        $row = [
            $response->created_at->format('d/m/Y H:i'),
            $response->unitKerja->unit_kerja_name ?? 'N/A',
            $response->full_name,
        ];

        $dynamicData = $response->dynamic_data ?? [];
        foreach ($this->formFields as $field) {
            $val = $dynamicData[$field->field_label] ?? '-';
            $row[] = is_array($val) ? implode(', ', $val) : $val;
        }

        $answers = Answer::where('user_id', $response->user_id)
            ->where('survey_program_id', $this->program->id)
            // Filter jawaban agar sesuai unit (Penting jika user isi >1 unit di program yg sama)
            ->where('unit_kerja_id', $response->unit_kerja_id)
            ->get()
            ->keyBy('question_id');

        foreach ($this->questions as $question) {
            $ans = $answers->get($question->id);
            $row[] = $ans ? ($ans->option->option_score ?? $ans->option->option_body) : '-';
        }

        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
