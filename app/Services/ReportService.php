<?php

namespace App\Services;

use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Mengambil data laporan agregat per unit kerja.
     * (Logika ini dipindah dari ReportController::index)
     */
    public function getAggregateReport(SurveyProgram $program): array
    {
        $sectionIds = $program->questionSections->pluck('id');

        $sectionAverages = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->select(
                'answers.unit_kerja_id',
                'questions.question_section_id',
                DB::raw('AVG(answers.answer_skor) as avg_section_score')
            )
            ->where('answers.survey_program_id', $program->id)
            ->whereIn('questions.question_section_id', $sectionIds)
            ->groupBy('answers.unit_kerja_id', 'questions.question_section_id')
            ->get()
            ->groupBy('unit_kerja_id');

        $totalAverages = DB::table('answers')
            ->select(
                'unit_kerja_id',
                DB::raw('AVG(answer_skor) as avg_total_score')
            )
            ->where('survey_program_id', $program->id)
            ->groupBy('unit_kerja_id')
            ->get()
            ->pluck('avg_total_score', 'unit_kerja_id');

        $reportData = [];
        $unitsToReportOn = collect();

        // Logika untuk menentukan unit kerja yang akan dilaporkan
        if ($program->unit_kerja_id === null) {
            // Program Tipe 1 (Institusional), ambil dari relasi many-to-many
            $unitsToReportOn = $program->targetedUnitKerjas;
        } else {
            // Program Tipe 2 (Milik Unit Kerja), ambil dari relasi one-to-one
            if ($program->unitKerja) {
                $unitsToReportOn->push($program->unitKerja);
            }
        }

        foreach ($unitsToReportOn as $unit) {
            $unitReport = [
                'unit_id' => $unit->id,
                'unit_name' => $unit->unit_kerja_name,
                'section_scores' => [],
                'total_avg' => $totalAverages->get($unit->id) ?? 0,
            ];

            $unitSectionScores = $sectionAverages->get($unit->id);
            foreach ($program->questionSections as $section) {
                $score = $unitSectionScores
                    ? $unitSectionScores->firstWhere('question_section_id', $section->id)
                    : null;
                $unitReport['section_scores'][$section->id] = $score ? $score->avg_section_score : 0;
            }
            $reportData[] = $unitReport;
        }

        return $reportData;
    }

    /**
     * Mengambil data laporan detail per responden untuk satu unit kerja.
     * (Logika ini dipindah dari ReportController::showUnitDetail)
     */
    public function getUnitDetailReport(SurveyProgram $program, UnitKerja $unitKerja): array
    {
        $respondentIds = Answer::where('survey_program_id', $program->id)
            ->where('unit_kerja_id', $unitKerja->id)
            ->distinct()
            ->pluck('user_id');

        $respondents = User::whereIn('id', $respondentIds)->get();

        $sectionAverages = DB::table('answers')
            ->join('questions', 'answers.question_id', '=', 'questions.id')
            ->select(
                'answers.user_id',
                'questions.question_section_id',
                DB::raw('AVG(answers.answer_skor) as avg_section_score')
            )
            ->where('answers.survey_program_id', $program->id)
            ->where('answers.unit_kerja_id', $unitKerja->id)
            ->groupBy('answers.user_id', 'questions.question_section_id')
            ->get()
            ->groupBy('user_id');

        $totalAverages = DB::table('answers')
            ->select(
                'user_id',
                DB::raw('AVG(answer_skor) as avg_total_score')
            )
            ->where('survey_program_id', $program->id)
            ->where('unit_kerja_id', $unitKerja->id)
            ->groupBy('user_id')
            ->get()
            ->pluck('avg_total_score', 'user_id');

        $reportData = [];
        foreach ($respondents as $respondent) {
            $reportRow = [
                'respondent_name' => $respondent->username,
                'section_scores' => [],
                'total_avg' => $totalAverages->get($respondent->id) ?? 0,
            ];
            $userSectionScores = $sectionAverages->get($respondent->id);
            foreach ($program->questionSections as $section) {
                $score = $userSectionScores
                    ? $userSectionScores->firstWhere('question_section_id', $section->id)
                    : null;
                $reportRow['section_scores'][$section->id] = $score ? $score->avg_section_score : 0;
            }
            $reportData[] = $reportRow;
        }

        return $reportData;
    }
}
