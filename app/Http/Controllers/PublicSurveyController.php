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
    /**
     * Halaman 1: Menampilkan halaman landing page utama (welcome.blade.php).
     * PERBAIKAN: Sekarang mengambil Program Unggulan & Unit Kerjanya.
     */
    public function showHome()
    {
        // 1. Ambil Program Unggulan yang aktif
        $featuredProgram = SurveyProgram::where('is_featured', true)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->first(); // Ambil satu saja

        // 2. Ambil Unit Kerja dari Program Unggulan tersebut
        $unitKerjas = collect(); // Buat koleksi kosong
        if ($featuredProgram) {
            // Logika baru: Ambil unit kerja yang ditargetkan oleh program unggulan
            $unitKerjas = $featuredProgram->targetedUnitKerjas()
                ->orderBy('unit_kerja_name')
                ->get();
        }

        // 3. Ambil Statistik Global untuk Hero Section
        $totalPrograms = SurveyProgram::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();
        $totalRespondents = Answer::distinct('user_id')->count();
        $averageScore = Answer::avg('answer_skor');
        $maxScore = 4; // Asumsi skala 1-4
        $satisfactionPercentage = $totalRespondents > 0 ? ($averageScore / $maxScore) * 100 : 0;

        return view('welcome', compact(
            'featuredProgram', // Program unggulan (atau null)
            'unitKerjas',      // Unit kerja dari program unggulan
            'totalPrograms',   // Statistik total program
            'totalRespondents',
            'satisfactionPercentage'
        ));
    }

    /**
     * Halaman 2: Menampilkan halaman "Program Survei" (daftar semua program).
     */
    public function showProgramList()
    {
        $programs = SurveyProgram::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->withCount('targetedUnitKerjas')
            ->latest()
            ->get();

        return view('public.programs-list', compact('programs'));
    }

    /**
     * Halaman 3: Menampilkan halaman "Tentang".
     */
    public function showTentangPage()
    {
        return view('public.tentang');
    }

    /**
     * Halaman 4: Menampilkan halaman direktori unit kerja.
     * INI ADALAH HALAMAN 'DETAIL' DARI 'programs-list'
     */
    public function showDirectory(SurveyProgram $program)
    {
        // PERBAIKAN: Logika disederhanakan. Cukup ambil unit yang ditargetkan.
        $unitKerjas = $program->targetedUnitKerjas()
            ->orderBy('unit_kerja_name')
            ->get();

        return view('public.directory', compact('program', 'unitKerjas'));
    }

    /**
     * Halaman 5: Menampilkan halaman "landing" per unit kerja.
     */
    public function showUnitLanding(SurveyProgram $program, $unitKerjaAlias)
    {
        $unitKerja = UnitKerja::where('alias', $unitKerjaAlias)->firstOrFail();

        // Validasi: Pastikan unit kerja ini memang ditargetkan oleh program
        if (!$program->targetedUnitKerjas->contains($unitKerja)) {
            abort(404, 'Unit kerja tidak ditemukan untuk program survei ini.');
        }

        // PERBAIKAN: Kita tidak perlu lagi mencari $pelaksanaan.
        // Cukup kirim $program dan $unitKerja ke view.

        return view('public.unit-landing', compact('program', 'unitKerja'));
    }
}
