<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $programs = SurveyProgram::whereNull('unit_kerja_id')
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        $selectedProgram = null;
        $reportData = [];
        $questions = collect();

        if ($request->filled('program_id')) {
            $selectedProgram = SurveyProgram::with('targetedUnitKerjas', 'questionSections.questions')
                ->findOrFail($request->program_id);

            $questions = $selectedProgram->questionSections->flatMap->questions;

            $averageScores = Answer::where('survey_program_id', $selectedProgram->id)
                ->select('unit_kerja_id', 'question_id', DB::raw('AVG(answer_skor) as avg_score'))
                ->groupBy('unit_kerja_id', 'question_id')
                ->get()
                ->groupBy('unit_kerja_id')
                ->map(function ($answers) {
                    return $answers->pluck('avg_score', 'question_id');
                });

            foreach ($selectedProgram->targetedUnitKerjas as $unit) {
                $unitScores = $averageScores->get($unit->id) ?? collect();

                $unitReport = [
                    'unit_name' => $unit->unit_kerja_name,
                    'scores' => [],
                    'section_totals' => [],
                    'section_max' => [],
                    'section_avg' => [],
                    'total_avg' => $unitScores->avg(),
                ];

                foreach ($questions as $question) {
                    $unitReport['scores'][$question->id] = $unitScores->get($question->id);
                }

                $reportData[] = $unitReport;
            }
        }

        return view('superadmin.reports.index', compact(
            'programs',
            'selectedProgram',
            'questions',
            'reportData'
        ));
    }

    public function export(Request $request)
    {
        return redirect()->route('superadmin.reports.index')->with('info', 'Fitur ekspor akan segera hadir.');
    }
}
