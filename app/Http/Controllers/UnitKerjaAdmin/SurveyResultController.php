<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\Answer;
use App\Models\User;
use App\Models\PreSurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SurveyResultController extends Controller
{
    use AuthorizesRequests;
    private function applyFilters($query, Request $request)
    {
        $query->join('pre_survey_responses', function ($join) {
            $join->on('answers.user_id', '=', 'pre_survey_responses.user_id')
                ->on('answers.survey_program_id', '=', 'pre_survey_responses.survey_program_id');
        });

        $query->when($request->filled('gender'), function ($q) use ($request) {
            $q->where('pre_survey_responses.gender', $request->gender);
        });
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('pre_survey_responses.status', $request->status);
        });
    }
    private function getFilterOptions(SurveyProgram $program, $unitKerjaId)
    {
        $preSurveyData = PreSurveyResponse::where('pre_survey_responses.survey_program_id', $program->id)
            ->join('answers', function ($join) {
                $join->on('pre_survey_responses.user_id', '=', 'answers.user_id')
                    ->on('pre_survey_responses.survey_program_id', '=', 'answers.survey_program_id');
            })
            // Filter HANYA untuk unit kerja ini
            ->where('answers.unit_kerja_id', $unitKerjaId)
            ->select('pre_survey_responses.gender', 'pre_survey_responses.status')
            ->distinct()
            ->get();

        $genders = $preSurveyData->pluck('gender')->unique()->filter()->values();
        $statuses = $preSurveyData->pluck('status')->unique()->filter()->values();

        return compact('genders', 'statuses');
    }

    public function show(Request $request, SurveyProgram $program)
    {
        $user = Auth::user();
        $unitKerja = $user->unitKerja;

        // --- PERBAIKAN LOGIKA IZIN AKSES ---
        // 1. Cek apakah user punya unit kerja
        if (!$unitKerja) {
            abort(403, 'Akun Anda tidak terikat dengan Unit Kerja.');
        }

        // 2. Cek Hak Akses:
        //    A. Apakah ini program mandiri milik unit ini? ($program->unit_kerja_id == $unitKerja->id)
        //    B. ATAU Apakah ini program institusional yang menargetkan unit ini? ($program->targetedUnitKerjas->contains($unitKerja))
        $isOwnProgram = $program->unit_kerja_id == $unitKerja->id;
        $isTargetedProgram = $program->targetedUnitKerjas->contains($unitKerja);

        if (!$isOwnProgram && !$isTargetedProgram) {
            abort(403, 'Akses ditolak. Program ini bukan milik atau tidak ditargetkan untuk unit Anda.');
        }
        // -------------------------------------

        $program->load('questions.options');

        $respondentsQuery = Answer::where('answers.survey_program_id', $program->id)
            ->where('answers.unit_kerja_id', $unitKerja->id);

        if ($request->filled('gender') || $request->filled('status')) {
            $this->applyFilters($respondentsQuery, $request);
        }

        $totalRespondents = $respondentsQuery->distinct('answers.user_id')->count('answers.user_id');

        $answerCountsQuery = Answer::where('answers.survey_program_id', $program->id)
            ->where('answers.unit_kerja_id', $unitKerja->id);

        if ($request->filled('gender') || $request->filled('status')) {
            $this->applyFilters($answerCountsQuery, $request);
        }

        $answerCounts = $answerCountsQuery->select('question_id', 'option_id', DB::raw('count(*) as total'))
            ->groupBy('question_id', 'option_id')
            ->get()
            ->groupBy('question_id');

        $filterOptions = $this->getFilterOptions($program, $unitKerja->id);

        $chartData = [];
        foreach ($program->questions as $question) {
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

        return view('unit_kerja_admin.results.show', compact(
            'program',
            'unitKerja',
            'totalRespondents',
            'chartData',
            'filterOptions'
        ));
    }
}
