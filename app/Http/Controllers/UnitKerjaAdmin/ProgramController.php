<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $user = Auth::user();
        $unitKerjaId = $user->unit_kerja_id;

        $programs = SurveyProgram::where('is_active', true)
            ->whereHas('targetedUnitKerjas', function ($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            })
            ->withCount(['surveys' => function ($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            }])
            ->latest()
            ->paginate(10);

        return view('unit_kerja_admin.programs.index', compact('programs'));
    }
}
