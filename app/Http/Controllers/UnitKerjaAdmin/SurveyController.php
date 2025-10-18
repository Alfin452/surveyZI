<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    /**
     * Menampilkan daftar survei pelaksanaan yang sudah dibuat oleh unit kerja ini.
     */
    public function index()
    {
        // (Akan kita implementasikan nanti)
    }

    /**
     * Menampilkan form untuk membuat survei pelaksanaan baru dari sebuah program.
     */
    public function create(Request $request)
    {
        // Ambil program induk dari request
        $program = SurveyProgram::findOrFail($request->query('program'));
        $unitKerja = Auth::user()->unitKerja;

        // Siapkan data awal untuk form
        $survey = new Survey([
            'title' => $program->title . ' - ' . $unitKerja->unit_kerja_name,
            'description' => $program->description,
            'start_date' => $program->start_date,
            'end_date' => $program->end_date,
        ]);

        return view('unit_kerja_admin.surveys.create', compact('survey', 'program'));
    }

    /**
     * Menyimpan survei pelaksanaan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
            'survey_program_id' => 'required|exists:survey_programs,id',
        ]);

        $user = Auth::user();

        // Buat survei baru dan kaitkan dengan program induk serta unit kerja pemilik
        Survey::create($validated + [
            'unit_kerja_id' => $user->unit_kerja_id
        ]);

        // Kembali ke halaman daftar program survei dengan pesan sukses
        return redirect()->route('unitkerja.admin.programs.index')
            ->with('success', 'Survei pelaksanaan berhasil dibuat.');
    }

    // Metode show, edit, update, destroy akan kita tambahkan nanti.
}
