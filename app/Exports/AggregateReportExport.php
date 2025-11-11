<?php

namespace App\Exports;

use App\Models\SurveyProgram;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AggregateReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $program;
    protected $sections;
    public function __construct(SurveyProgram $program)
    {
        $this->program = $program->load('questionSections', 'targetedUnitKerjas', 'unitKerja');
        $this->sections = $this->program->questionSections;
    }

    public function headings(): array
    {
        $headings = ['Unit Kerja'];

        foreach ($this->sections as $section) {
            $headings[] = $section->title . ' (Rata-rata)';
        }
        $headings[] = 'Rata-rata Total';
        return $headings;
    }

    public function collection()
    {
        $sectionIds = $this->sections->pluck('id');

        $sectionAverages = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->select(
                'answers.unit_kerja_id',
                'questions.question_section_id',
                DB::raw('AVG(answers.answer_skor) as avg_section_score')
            )
            ->where('answers.survey_program_id', $this->program->id)
            ->whereIn('questions.question_section_id', $sectionIds)
            ->groupBy('answers.unit_kerja_id', 'questions.question_section_id')
            ->get()
            ->groupBy('unit_kerja_id');

        $totalAverages = DB::table('answers')
            ->select(
                'unit_kerja_id',
                DB::raw('AVG(answer_skor) as avg_total_score')
            )
            ->where('survey_program_id', $this->program->id)
            ->groupBy('unit_kerja_id')
            ->get()
            ->pluck('avg_total_score', 'unit_kerja_id');

        $unitsToReportOn = collect();
        if ($this->program->unit_kerja_id === null) {
            $unitsToReportOn = $this->program->targetedUnitKerjas;
        } else {
            if ($this->program->unitKerja) { // Cek relasinya
                $unitsToReportOn->push($this->program->unitKerja);
            }
        }
        $reportData = $unitsToReportOn->map(function ($unit) use ($sectionAverages, $totalAverages) {
            $row = [
                'Unit Kerja' => $unit->unit_kerja_name,
            ];

            $unitSectionScores = $sectionAverages->get($unit->id);
            foreach ($this->sections as $section) {
                $score = $unitSectionScores
                    ? $unitSectionScores->firstWhere('question_section_id', $section->id)
                    : null;
                $row['section_score_' . $section->id] = $score ? (float)number_format($score->avg_section_score, 2) : 0.0;
            }
            $row['total_avg'] = (float)number_format($totalAverages->get($unit->id) ?? 0, 2);
            return $row;
        });
        return $reportData;
    }
}
