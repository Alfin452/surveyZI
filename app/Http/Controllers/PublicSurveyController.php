<?php

namespace App\Http\Controllers;

use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicSurveyController extends Controller
{
    public function showHome()
    {
        // 1. Ambil Program UNGGULAN (Featured) & AKTIF (Multiple)
        $featuredPrograms = SurveyProgram::with('unitKerja') // Eager load unit kerja
            ->where('is_featured', true)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->take(6)
            ->get();

        // 2. Ambil Program LAINNYA (Opsional untuk list di bawah jika perlu)
        $activePrograms = SurveyProgram::where('is_active', true)
            ->where('is_featured', false)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->take(6)
            ->get();

        // 3. Statistik Global
        $totalPrograms = SurveyProgram::where('is_active', true)->count();
        $totalRespondents = Answer::distinct('user_id')->count();
        $averageScore = Answer::avg('answer_skor');
        $satisfactionPercentage = $averageScore ? ($averageScore / 4) * 100 : 0;

        return view('welcome', compact(
            'featuredPrograms',
            'activePrograms',
            'totalPrograms',
            'totalRespondents',
            'satisfactionPercentage'
        ));
    }

    public function showProgramList()
    {
        $programs = SurveyProgram::with('unitKerja')
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->paginate(9); // Pakai paginate agar rapi

        return view('public.programs-list', compact('programs'));
    }

    public function showTentangPage()
    {
        return view('public.tentang');
    }

    /**
     * Logika Cerdas: Show Directory (Pilih Unit) ATAU Redirect Langsung
     */
    public function showDirectory(SurveyProgram $program)
    {
        // LOGIKA BARU: Cek apakah program ini milik Unit Kerja Spesifik?
        if ($program->unit_kerja_id && $program->unitKerja) {
            $targetUnit = $program->unitKerja;

            // Jika ya, LEWATI direktori dan LEWATI landing page unit.
            // Langsung masuk ke alur pengisian.

            if ($program->requires_pre_survey) {
                // Ke Form Data Diri
                return redirect()->route('public.pre-survey.create', [
                    'program' => $program->alias,
                    'unitKerja' => $targetUnit->alias
                ]);
            } else {
                // Langsung Isi Soal
                return redirect()->route('public.survey.fill', [
                    'program' => $program->alias,
                    'unitKerja' => $targetUnit->alias
                ]);
            }
        }

        // Jika Program Institusional (Pusat), tampilkan daftar unit target
        $unitKerjas = $program->targetedUnitKerjas()
            ->orderBy('unit_kerja_name')
            ->get();

        // Optimasi Tambahan: Jika targetnya cuma 1 unit, langsung redirect juga
        if ($unitKerjas->count() === 1) {
            $singleUnit = $unitKerjas->first();
            if ($program->requires_pre_survey) {
                return redirect()->route('public.pre-survey.create', [
                    'program' => $program->alias,
                    'unitKerja' => $singleUnit->alias
                ]);
            } else {
                return redirect()->route('public.survey.fill', [
                    'program' => $program->alias,
                    'unitKerja' => $singleUnit->alias
                ]);
            }
        }

        return view('public.directory', compact('program', 'unitKerjas'));
    }

    public function showUnitLanding(SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        if (!$program->targetedUnitKerjas->contains($unitKerja)) {
            // Cek juga kalau ini unit pemilik program (untuk case program mandiri)
            if ($program->unit_kerja_id != $unitKerja->id) {
                abort(404, 'Unit kerja tidak terdaftar dalam program ini.');
            }
        }

        return view('public.unit-landing', compact('program', 'unitKerja'));
    }
}
