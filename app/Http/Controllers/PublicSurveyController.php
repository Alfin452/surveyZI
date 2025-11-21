<?php

namespace App\Http\Controllers;

// HAPUS: use App\Models\Survey; // Kita tidak menggunakan model ini lagi
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicSurveyController extends Controller
{

    public function showHome()
    {
        // 1. Ambil Program UNGGULAN (Featured) & AKTIF
        // Kita ambil misal 3 program unggulan teratas
        $featuredPrograms = SurveyProgram::where('is_active', true)
            ->where('is_featured', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->take(3)
            ->get();

        // 2. Ambil Program LAINNYA (Aktif tapi tidak featured, atau sisa featured)
        // Untuk ditampilkan di list bawah jika mau, atau cukup featuredPrograms saja
        $activePrograms = SurveyProgram::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->take(6) // Ambil 6 program terbaru
            ->get();

        // 3. Statistik Global
        $totalRespondents = Answer::distinct('user_id')->count();
        $totalPrograms = SurveyProgram::where('is_active', true)->count();

        // Hitung kepuasan (contoh logika sederhana)
        $avgScore = Answer::avg('answer_skor') ?? 0;
        $satisfactionPercentage = ($avgScore / 4) * 100; // Asumsi skala 4

        return view('welcome', compact(
            'featuredPrograms',
            'activePrograms',
            'totalRespondents',
            'totalPrograms',
            'satisfactionPercentage'
        ));
    }

    public function showProgramList()
    {
        $programs = SurveyProgram::where('is_active', true)->latest()->paginate(9);
        return view('public.programs-list', compact('programs'));
    }

    public function showTentangPage()
    {
        return view('public.tentang');
    }

    public function showDirectory(SurveyProgram $program)
    {
        $unitKerjas = $program->targetedUnitKerjas()
            ->orderBy('unit_kerja_name')
            ->get();

        return view('public.directory', compact('program', 'unitKerjas'));
    }

    public function showUnitLanding(SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        if (!$program->targetedUnitKerjas->contains($unitKerja)) {
            abort(404, 'Unit kerja tidak ditemukan untuk program survei ini.');
        }

        return view('public.unit-landing', compact('program', 'unitKerja'));
    }
}
