<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Menampilkan form untuk membuat survei pelaksanaan baru untuk unit kerja tertentu.
     * Dipanggil saat Super Admin mengklik "Buatkan Pelaksanaan".
     */
    public function create(Request $request)
    {
        // Mengambil ID program dan unit dari request
        $program = SurveyProgram::findOrFail($request->query('program'));
        $unitKerja = UnitKerja::findOrFail($request->query('unit'));

        // Menyiapkan data untuk form
        $survey = new Survey([
            'title' => $program->title . ' - ' . $unitKerja->unit_kerja_name,
            'description' => $program->description,
        ]);

        return view('superadmin.surveys.create', compact('survey', 'program', 'unitKerja'));
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
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
        ]);

        Survey::create($validated);

        // Kembali ke halaman detail program survei induknya
        return redirect()->route('superadmin.programs.show', $request->survey_program_id)
            ->with('success', 'Survei pelaksanaan berhasil dibuat.');
    }

    /**
     * Menampilkan detail survei pelaksanaan (halaman kelola pertanyaan).
     */
    public function show(Survey $survey)
    {
        $survey->load('questions.options');
        return view('superadmin.surveys.show', compact('survey'));
    }

    /**
     * Menampilkan form untuk mengedit survei pelaksanaan.
     */
    public function edit(Survey $survey)
    {
        // Memuat relasi agar bisa menampilkan nama program dan unit
        $survey->load('surveyProgram', 'unitKerja');
        return view('superadmin.surveys.edit', compact('survey'));
    }

    /**
     * Memperbarui survei pelaksanaan di database.
     */
    public function update(Request $request, Survey $survey)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
        ]);

        $survey->update($validated);

        return redirect()->route('superadmin.programs.show', $survey->survey_program_id)
            ->with('success', 'Survei pelaksanaan berhasil diperbarui.');
    }

    /**
     * Menghapus survei pelaksanaan.
     */
    public function destroy(Survey $survey)
    {
        $programId = $survey->survey_program_id;
        $survey->delete();

        return redirect()->route('superadmin.programs.show', $programId)
            ->with('success', 'Survei pelaksanaan berhasil dihapus.');
    }
}
