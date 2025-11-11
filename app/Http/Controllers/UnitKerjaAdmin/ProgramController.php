<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Menampilkan daftar program survei.
     * Tampilan ini sekarang akan memiliki dua tab:
     * 1. Program Institusional (Tipe 1: ditargetkan ke unit ini)
     * 2. Program Unit Saya (Tipe 2: dibuat oleh unit ini)
     */
    public function index()
    {
        $user = Auth::user();
        $unitKerja = $user->unitKerja;

        if (!$unitKerja) {
            $institutionalPrograms = collect();
            $myPrograms = collect();
        } else {
            // 1. Ambil Program Institusional (Tipe 1) yang ditargetkan ke unit ini
            $institutionalPrograms = SurveyProgram::where('is_active', true)
                ->whereNull('unit_kerja_id') // Tipe 1 (Institusional)
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->whereHas('targetedUnitKerjas', function ($query) use ($unitKerja) {
                    $query->where('unit_kerja_id', $unitKerja->id);
                })
                ->latest()
                ->get(); // Tidak perlu paginate di sini, bisa di-load semua

            // 2. Ambil Program Unit Saya (Tipe 2) yang dibuat oleh unit ini
            $myPrograms = SurveyProgram::where('unit_kerja_id', $unitKerja->id) // Tipe 2 (Milik Sendiri)
                ->latest()
                ->paginate(10); // Paginate hanya untuk program buatan sendiri
        }

        return view('unit_kerja_admin.programs.index', compact(
            'institutionalPrograms',
            'myPrograms'
        ));
    }
}
