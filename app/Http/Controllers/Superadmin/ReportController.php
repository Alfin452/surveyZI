<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\Answer;
use App\Models\PreSurveyResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProgramAverageExport;
use App\Exports\RespondentDataExport;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Halaman Utama Laporan
     */
    public function index(Request $request)
    {
        // 1. Ambil Daftar Program untuk Dropdown Filter
        $programs = SurveyProgram::orderBy('created_at', 'desc')->get();

        $selectedProgram = null;
        $reportData = [];

        // 2. Jika Admin Memilih Program (Filter)
        if ($request->filled('program_id')) {
            $selectedProgram = SurveyProgram::with(['questionSections.questions', 'unitKerja'])
                ->findOrFail($request->program_id);

            // Hitung Laporan Per Unit untuk Program Terpilih
            $reportData = $this->calculateReportData($selectedProgram);
        }

        return view('superadmin.reports.index', compact('programs', 'selectedProgram', 'reportData'));
    }

    /**
     * Helper: Menghitung Skor Rata-rata Per Unit Kerja
     */
    private function calculateReportData($program)
    {
        // Ambil ID Unit yang sudah ada jawaban di program ini
        $unitIds = Answer::where('survey_program_id', $program->id)
            ->distinct()
            ->pluck('unit_kerja_id');

        $units = UnitKerja::whereIn('id', $unitIds)->get();
        $data = [];

        foreach ($units as $unit) {
            $row = [
                'unit_id' => $unit->id,
                'unit_name' => $unit->unit_kerja_name,
                'section_scores' => [],
                'total_avg' => 0
            ];

            $totalScore = 0;
            $sectionCount = 0;

            foreach ($program->questionSections as $section) {
                // Hitung rata-rata skor per section untuk unit ini
                $avg = Answer::where('survey_program_id', $program->id)
                    ->where('unit_kerja_id', $unit->id)
                    ->whereIn('question_id', $section->questions->pluck('id'))
                    ->avg('answer_skor');

                $row['section_scores'][] = $avg ?? 0;

                if ($avg) {
                    $totalScore += $avg;
                    $sectionCount++;
                }
            }

            $row['total_avg'] = $sectionCount > 0 ? ($totalScore / $sectionCount) : 0;
            $data[] = $row;
        }

        return $data;
    }

    /**
     * Export Laporan Analisis (Global per Program)
     */
    public function exportAverage(SurveyProgram $program)
    {
        $filename = 'Analisis_Skor_' . \Illuminate\Support\Str::slug($program->title) . '.xlsx';
        return Excel::download(new ProgramAverageExport($program->id), $filename);
    }

    /**
     * Export Data Responden (Global per Program)
     */
    public function exportRespondents(SurveyProgram $program)
    {
        $filename = 'Data_Responden_' . \Illuminate\Support\Str::slug($program->title) . '.xlsx';
        return Excel::download(new RespondentDataExport($program), $filename);
    }

    /**
     * Export Data Responden (Spesifik per Unit)
     */
    public function exportUnitRespondents(SurveyProgram $program, $unitId)
    {
        $unitName = UnitKerja::find($unitId)->uk_short_name ?? 'Unit';
        $filename = 'Data_' . $unitName . '_' . \Illuminate\Support\Str::slug($program->title) . '.xlsx';

        return Excel::download(new RespondentDataExport($program, $unitId), $filename);
    }

    /**
     * Menampilkan Detail Laporan per Unit Kerja
     */
    public function showUnitDetail($program_id, $unit_kerja_id)
    {
        $program = SurveyProgram::findOrFail($program_id);
        $unitKerja = UnitKerja::findOrFail($unit_kerja_id);

        $sections = $program->questionSections()->orderBy('order_column')->get();

        // Ambil Responden di Unit ini
        $respondentIds = Answer::where('survey_program_id', $program->id)
            ->where('unit_kerja_id', $unitKerja->id)
            ->distinct()
            ->pluck('user_id');

        $reportData = [];

        foreach ($respondentIds as $userId) {
            $preSurvey = PreSurveyResponse::where('user_id', $userId)
                ->where('survey_program_id', $program->id)
                ->first();

            $respondentName = $preSurvey ? $preSurvey->full_name : ('User #' . $userId);

            $sectionScores = [];
            $totalScore = 0;
            $totalCount = 0;

            foreach ($sections as $section) {
                $avg = Answer::where('user_id', $userId)
                    ->where('survey_program_id', $program->id)
                    ->where('unit_kerja_id', $unitKerja->id)
                    ->whereIn('question_id', $section->questions->pluck('id'))
                    ->avg('answer_skor');

                $sectionScores[] = $avg ?? 0;
                if ($avg) {
                    $totalScore += $avg;
                    $totalCount++;
                }
            }

            $reportData[] = [
                'respondent_name' => $respondentName,
                'section_scores' => $sectionScores,
                'total_avg' => $totalCount > 0 ? $totalScore / $totalCount : 0
            ];
        }

        return view('superadmin.reports.show_unit', compact(
            'program',
            'unitKerja',
            'sections',
            'reportData'
        ));
    }
}
