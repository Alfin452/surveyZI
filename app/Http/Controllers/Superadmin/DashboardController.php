<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\Answer;
use Carbon\Carbon; // Penting untuk tanggal
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. Statistik Utama (Cards) ---
        $totalPrograms = SurveyProgram::count();
        $totalUnitKerja = UnitKerja::count();
        $totalUsers = User::count();
        $totalRespondents = Answer::distinct('user_id')->count();

        // --- 2. Data untuk Grafik Tren Responden (7 Hari Terakhir) ---
        $chartLabels = [];
        $chartData = [];

        // Loop 7 hari ke belakang
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $formattedDate = $date->format('Y-m-d');
            // Format label: "Senin, 12 Okt"
            $displayDate = $date->locale('id')->isoFormat('dddd, D MMM');

            // Hitung responden unik per hari
            $count = Answer::whereDate('created_at', $formattedDate)
                ->distinct('user_id')
                ->count();

            $chartLabels[] = $displayDate;
            $chartData[] = $count;
        }

        // --- 3. Data untuk Donut Chart (Status Program) ---
        $activePrograms = SurveyProgram::where('is_active', true)->count();
        $inactivePrograms = $totalPrograms - $activePrograms;

        // --- 4. Aktivitas Terbaru (Tabel) ---
        // Ambil 5 jawaban terakhir
        $recentActivities = Answer::with('user')
            ->select('user_id', 'created_at')
            ->distinct('user_id')
            ->latest('created_at')
            ->take(5)
            ->get();

        // Kirim SEMUA variabel ini ke view
        return view('superadmin.dashboard', compact(
            'totalPrograms',
            'totalUnitKerja',
            'totalUsers',
            'totalRespondents',
            'chartLabels',
            'chartData',
            'activePrograms',
            'inactivePrograms',
            'recentActivities'
        ));
    }
}
