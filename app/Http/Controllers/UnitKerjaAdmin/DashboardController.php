<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SurveyProgram;
use App\Models\Answer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $unitKerja = $user->unitKerja;

        if (!$unitKerja) {
            return view('unit_kerja_admin.dashboard', [
                'unitKerja' => null,
                'totalPrograms' => 0,
                'totalResponden' => 0,
                'chartLabels' => [],
                'chartData' => [],
                'recentActivities' => []
            ]);
        }

        // 1. Statistik Utama
        // Program yang ditargetkan khusus ke unit ini (Lokal) ATAU Institusional (Global)
        $totalPrograms = SurveyProgram::where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->where(function ($q) use ($unitKerja) {
                $q->whereHas('targetedUnitKerjas', function ($subQ) use ($unitKerja) {
                    $subQ->where('unit_kerja_id', $unitKerja->id);
                })
                    ->orWhereNull('unit_kerja_id'); // Program Global juga dihitung
            })
            ->count();

        $totalResponden = Answer::where('unit_kerja_id', $unitKerja->id)
            ->distinct('user_id')
            ->count('user_id');

        // 2. Data Grafik Tren (7 Hari Terakhir untuk Unit Ini)
        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $formattedDate = $date->format('Y-m-d');
            $displayDate = $date->locale('id')->isoFormat('dddd, D MMM');

            $count = Answer::where('unit_kerja_id', $unitKerja->id)
                ->whereDate('created_at', $formattedDate)
                ->distinct('user_id')
                ->count();

            $chartLabels[] = $displayDate;
            $chartData[] = $count;
        }

        // 3. Aktivitas Terbaru (Khusus Unit Ini)
        $recentActivities = Answer::where('unit_kerja_id', $unitKerja->id)
            ->with('user')
            ->select('user_id', 'created_at')
            ->distinct('user_id')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('unit_kerja_admin.dashboard', compact(
            'unitKerja',
            'totalPrograms',
            'totalResponden',
            'chartLabels',
            'chartData',
            'recentActivities'
        ));
    }
}
