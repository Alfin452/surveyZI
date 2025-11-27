<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProgramAverageExport;
use App\Exports\RespondentDataExport;

class ReportController extends Controller
{
    /**
     * Halaman Index Laporan (Filter Style)
     */
    public function index(Request $request)
    {
        $unitId = Auth::user()->unit_kerja_id;

        // LOGIKA BARU YANG LEBIH LENGKAP
        $programs = SurveyProgram::query()
            // 1. Program milik Unit sendiri
            ->where('unit_kerja_id', $unitId)

            // 2. ATAU Program Pusat yang secara eksplisit menargetkan Unit ini (Survey Baru)
            ->orWhereHas('targetedUnitKerjas', function ($q) use ($unitId) {
                $q->where('unit_kerjas.id', $unitId);
            })

            // 3. ATAU Program Pusat yang sudah ada jawabannya dari unit ini (Data Lama/Legacy)
            ->orWhereHas('answers', function ($q) use ($unitId) {
                $q->where('unit_kerja_id', $unitId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // ... (Sisa kode ke bawah SAMA SEPERTI SEBELUMNYA) ...

        $selectedProgram = null;
        $stats = null;
        $sectionScores = [];

        if ($request->filled('program_id')) {
            $selectedProgram = SurveyProgram::with(['questionSections.questions'])
                ->findOrFail($request->program_id);

            // Hitung Statistik Global Unit Ini
            $respondentCount = Answer::where('survey_program_id', $selectedProgram->id)
                ->where('unit_kerja_id', $unitId)
                ->distinct('user_id')
                ->count('user_id');

            $totalAvg = Answer::where('survey_program_id', $selectedProgram->id)
                ->where('unit_kerja_id', $unitId)
                ->avg('answer_skor');

            $stats = [
                'respondents' => $respondentCount,
                'average' => $totalAvg
            ];

            foreach ($selectedProgram->questionSections as $section) {
                $avg = Answer::where('survey_program_id', $selectedProgram->id)
                    ->where('unit_kerja_id', $unitId)
                    ->whereIn('question_id', $section->questions->pluck('id'))
                    ->avg('answer_skor');

                $sectionScores[] = [
                    'title' => $section->title,
                    'score' => $avg ?? 0
                ];
            }
        }

        return view('unit_kerja_admin.reports.index', compact('programs', 'selectedProgram', 'stats', 'sectionScores'));
    }

    // --- EXPORT EXCEL ---

    public function exportAverage(SurveyProgram $program)
    {
        $unitId = Auth::user()->unit_kerja_id;
        $filename = 'Analisis_' . ($program->alias ?? 'Data') . '_' . date('Ymd') . '.xlsx';
        return Excel::download(new ProgramAverageExport($program->id, $unitId), $filename);
    }

    public function exportRespondents(SurveyProgram $program)
    {
        $unitId = Auth::user()->unit_kerja_id;
        $filename = 'Responden_' . ($program->alias ?? 'Data') . '_' . date('Ymd') . '.xlsx';
        return Excel::download(new RespondentDataExport($program, $unitId), $filename);
    }
}
