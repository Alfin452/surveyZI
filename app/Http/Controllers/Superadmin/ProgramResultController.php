<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\Answer;
use App\Models\PreSurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramResultController extends Controller
{
    /**
     * Menerapkan filter berdasarkan data pra-survei.
     */
    private function applyFilters($query, Request $request)
    {
        // Bergabung dengan tabel pre_survey_responses
        $query->join('pre_survey_responses', function ($join) {
            $join->on('answers.user_id', '=', 'pre_survey_responses.user_id')
                ->on('answers.survey_program_id', '=', 'pre_survey_responses.survey_program_id');
        });

        // Terapkan filter
        $query->when($request->filled('gender'), function ($q) use ($request) {
            $q->where('pre_survey_responses.gender', $request->gender);
        });
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('pre_survey_responses.status', $request->status);
        });
    }

    /**
     * Mengambil opsi unik untuk dropdown filter.
     */
    private function getFilterOptions(SurveyProgram $program)
    {
        $preSurveyData = PreSurveyResponse::where('survey_program_id', $program->id)
            ->select('gender', 'status')
            ->distinct()
            ->get();

        $genders = $preSurveyData->pluck('gender')->unique()->filter()->values();
        $statuses = $preSurveyData->pluck('status')->unique()->filter()->values();

        return compact('genders', 'statuses');
    }

    /**
     * Menampilkan halaman hasil survei (statistik dan chart).
     */
    public function showResults(Request $request, SurveyProgram $program)
    {
        $program->load('questionSections.questions.options');
        $filterOptions = $this->getFilterOptions($program); // Ambil opsi filter
        $respondentsQuery = Answer::where('answers.survey_program_id', $program->id);

        if ($request->filled('gender') || $request->filled('status')) {
            $this->applyFilters($respondentsQuery, $request);
        }

        $totalRespondents = $respondentsQuery->distinct('answers.user_id')->count('answers.user_id');
        $answerCountsQuery = Answer::where('answers.survey_program_id', $program->id);

        if ($request->filled('gender') || $request->filled('status')) {
            $this->applyFilters($answerCountsQuery, $request);
        }

        $answerCounts = $answerCountsQuery->select('question_id', 'option_id', DB::raw('count(*) as total'))
            ->groupBy('question_id', 'option_id')
            ->get()
            ->groupBy('question_id');

        $chartData = [];
        $questions = $program->questionSections->flatMap->questions;

        foreach ($questions as $question) {
            $labels = $question->options->pluck('option_body');
            $data = $question->options->map(function ($option) use ($answerCounts, $question) {
                return $answerCounts->get($question->id)
                    ? $answerCounts->get($question->id)->firstWhere('option_id', $option->id)['total'] ?? 0
                    : 0;
            });

            $chartData[] = [
                'question_id' => $question->id,
                'question_body' => $question->question_body,
                'labels' => $labels,
                'data' => $data,
                'options' => $question->options
            ];
        }

        return view('superadmin.programs.results.show', compact(
            'program',
            'totalRespondents',
            'chartData',
            'filterOptions'
        ));
    }

    public function export(SurveyProgram $program)
    {
        $filename = 'Hasil_Survei_' . \Illuminate\Support\Str::slug($program->title) . '_' . date('Y-m-d_His') . '.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\RespondentDataExport($program), $filename);
    }
}
