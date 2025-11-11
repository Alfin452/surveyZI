<?php

namespace App\Http\Controllers;

use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\Answer;
use App\Models\Option;
use App\Models\PreSurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class SurveyResponseController extends Controller
{
    /**
     * Menampilkan form yang sesuai (Pra-Survei atau Survei Utama).
     */
    public function showFillForm(SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        $user = Auth::user();

        if (!$program->targetedUnitKerjas->contains($unitKerja)) {
            abort(404, 'Program survei ini tidak ditargetkan untuk unit kerja yang dipilih.');
        }

        $hasAnsweredMainSurvey = Answer::where('user_id', $user->id)
            ->where('survey_program_id', $program->id)
            ->where('unit_kerja_id', $unitKerja->id)
            ->exists();

        if ($hasAnsweredMainSurvey) {
            return redirect()->route('public.survey.thankyou')->with('info', 'Anda sudah pernah mengisi survei ini untuk unit layanan terkait.');
        }

        if ($program->requires_pre_survey) {
            $hasFilledPreSurvey = PreSurveyResponse::where('user_id', $user->id)
                ->where('survey_program_id', $program->id)
                ->exists();

            if (!$hasFilledPreSurvey) {
                return redirect()->route('public.pre-survey.create', ['program' => $program, 'unitKerja' => $unitKerja]);
            }
        }

        // PERBAIKAN: Memuat relasi nested (Bagian -> Pertanyaan -> Opsi)
        $program->load('questionSections.questions.options');

        return view('public.fill', compact('program', 'unitKerja'));
    }

    /**
     * Menyimpan jawaban dari survei utama.
     */
    public function storeResponse(Request $request, SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();
        $user = Auth::user();

        // PERBAIKAN: Mengambil semua ID pertanyaan dari semua bagian
        $program->load('questionSections.questions');
        $questionIds = $program->questionSections->flatMap(function ($section) {
            return $section->questions;
        })->pluck('id');

        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:options,id',
        ]);

        $submittedQuestionIds = collect($request->answers)->keys();

        // Cek apakah semua pertanyaan (dari semua bagian) telah dijawab
        if ($questionIds->diff($submittedQuestionIds)->isNotEmpty()) {
            throw ValidationException::withMessages(['answers' => 'Harap jawab semua pertanyaan yang tersedia.']);
        }

        DB::transaction(function () use ($request, $user, $program, $unitKerja) {
            foreach ($request->answers as $question_id => $option_id) {
                $option = Option::find($option_id);
                if (!$option) continue;

                Answer::create([
                    'user_id' => $user->id,
                    'survey_program_id' => $program->id,
                    'unit_kerja_id' => $unitKerja->id,
                    'question_id' => $question_id,
                    'option_id' => $option_id,
                    'answer_skor' => $option->option_score ?? 0,
                ]);
            }
        });

        return redirect()->route('public.survey.thankyou');
    }

    /**
     * Menampilkan halaman ucapan terima kasih.
     */
    public function thankYou()
    {
        return view('public.thank-you');
    }
}
