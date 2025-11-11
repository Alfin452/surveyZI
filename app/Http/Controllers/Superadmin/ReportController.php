<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\Answer;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AggregateReportExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $programs = SurveyProgram::where('is_active', true)
            ->orderBy('title')
            ->get();

        $selectedProgram = null;
        $reportData = [];

        if ($request->filled('program_id')) {
            $selectedProgram = SurveyProgram::with([
                'targetedUnitKerjas' => fn($q) => $q->orderBy('unit_kerja_name'),
                'questionSections' => fn($q) => $q->orderBy('order_column'),
                'unitKerja' // <-- Tambahkan ini
            ])
                ->findOrFail($request->program_id);

            $sectionIds = $selectedProgram->questionSections->pluck('id');

            $sectionAverages = DB::table('answers')
                ->join('questions', 'answers.question_id', '=', 'questions.id')
                ->select(
                    'answers.unit_kerja_id',
                    'questions.question_section_id',
                    DB::raw('AVG(answers.answer_skor) as avg_section_score')
                )
                ->where('answers.survey_program_id', $selectedProgram->id)
                ->whereIn('questions.question_section_id', $sectionIds)
                ->groupBy('answers.unit_kerja_id', 'questions.question_section_id')
                ->get()
                ->groupBy('unit_kerja_id');

            $totalAverages = DB::table('answers')
                ->select(
                    'unit_kerja_id',
                    DB::raw('AVG(answer_skor) as avg_total_score')
                )
                ->where('survey_program_id', $selectedProgram->id)
                ->groupBy('unit_kerja_id')
                ->get()
                ->pluck('avg_total_score', 'unit_kerja_id');

            $reportData = [];
            $unitsToReportOn = collect();
            if ($selectedProgram->unit_kerja_id === null) {
                $unitsToReportOn = $selectedProgram->targetedUnitKerjas;
            } else {
                if ($selectedProgram->unitKerja) { // Cek relasinya
                    $unitsToReportOn->push($selectedProgram->unitKerja);
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
                foreach ($selectedProgram->questionSections as $section) {
                    $score = $unitSectionScores
                        ? $unitSectionScores->firstWhere('question_section_id', $section->id)
                        : null;
                    $unitReport['section_scores'][$section->id] = $score ? $score->avg_section_score : 0;
                }
                $reportData[] = $unitReport;
            }
        }
        return view('superadmin.reports.index', compact(
            'programs',
            'selectedProgram',
            'reportData'
        ));
    }

    public function showUnitDetail($program_id, $unit_kerja_id)
    {
        $program = SurveyProgram::findOrFail($program_id);
        $unitKerja = UnitKerja::findOrFail($unit_kerja_id);
        $respondentIds = Answer::where('survey_program_id', $program->id)
            ->where('unit_kerja_id', $unitKerja->id)
            ->distinct()
            ->pluck('user_id');

        $respondents = User::whereIn('id', $respondentIds)->get();
        $sections = $program->questionSections()->orderBy('order_column')->get();

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
            foreach ($sections as $section) {
                $score = $userSectionScores
                    ? $userSectionScores->firstWhere('question_section_id', $section->id)
                    : null;
                $reportRow['section_scores'][$section->id] = $score ? $score->avg_section_score : 0;
            }
            $reportData[] = $reportRow;
        }
        return view('superadmin.reports.show_unit', compact(
            'program',
            'unitKerja',
            'sections',
            'reportData'
        ));
    }

    public function export(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:survey_programs,id',
        ]);
        $program = SurveyProgram::findOrFail($request->program_id);
        $fileName = 'Laporan Agregat - ' . Str::slug($program->title) . '.xlsx';
        return Excel::download(new AggregateReportExport($program), $fileName);
    }
}
