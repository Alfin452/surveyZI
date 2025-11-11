<?php

namespace App\Exports;

use App\Models\SurveyProgram;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AggregateReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $program;
    protected $sections;
    protected $averageScores;

    public function __construct(SurveyProgram $program)
    {
        $this->program = $program;

        // Load questions grouped by section
        $questions = Question::join('question_sections', 'questions.question_section_id', '=', 'question_sections.id')
            ->where('question_sections.survey_program_id', $program->id)
            ->orderBy('question_sections.order_column')
            ->orderBy('questions.order_column')
            ->select('questions.*', 'question_sections.title as section_title')
            ->get();

        $this->sections = $questions->groupBy('section_title');

        $this->averageScores = Answer::where('survey_program_id', $program->id)
            ->select('unit_kerja_id', 'question_id', DB::raw('AVG(answer_skor) as avg_score'))
            ->groupBy('unit_kerja_id', 'question_id')
            ->get()
            ->groupBy('unit_kerja_id')
            ->map(fn($answers) => $answers->pluck('avg_score', 'question_id'));
    }

    public function headings(): array
    {
        $head = ['Unit Kerja'];

        foreach ($this->sections as $section => $qs) {
            $head[] = "$section Total";
            $head[] = "$section Max";
            $head[] = "$section Avg";
        }

        $head[] = 'Rata Rata Total';

        return $head;
    }

    public function map($row): array
    {
        $unitId = $row['unit_id'];
        $scores = $this->averageScores->get($unitId) ?? collect();
        $result = [$row['unit_name']];

        foreach ($this->sections as $section => $qs) {
            $vals = [];
            foreach ($qs as $q) {
                $vals[] = $scores[$q->id] ?? null;
            }

            $total = collect($vals)->filter()->sum();
            $max = $qs->count() * 5;
            $avg = $qs->count() ? collect($vals)->filter()->avg() : null;

            $result[] = $total;
            $result[] = $max;
            $result[] = $avg;
        }

        $result[] = $scores->avg();

        return $result;
    }

    public function collection(): Collection
    {
        $rows = collect();

        foreach ($this->program->targetedUnitKerjas as $unit) {
            $rows->push([
                'unit_id' => $unit->id,
                'unit_name' => $unit->unit_kerja_name,
            ]);
        }

        return $rows;
    }
}
