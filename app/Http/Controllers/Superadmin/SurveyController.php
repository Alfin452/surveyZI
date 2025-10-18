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
     */
    public function create(Request $request)
    {
        $program = SurveyProgram::findOrFail($request->query('program'));
        $unitKerja = UnitKerja::findOrFail($request->query('unit'));

        $survey = new Survey([
            'title' => $program->title . ' - ' . $unitKerja->unit_kerja_name,
            'description' => $program->description,
        ]);

        return view('superadmin.surveys.create', compact('survey', 'program', 'unitKerja'));
    }

    /**
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

        $program = SurveyProgram::find($request->survey_program_id);

        return redirect()->route('superadmin.programs.show', $program)
            ->with('success', 'Survei pelaksanaan berhasil dibuat.');
    }

    /**
     */
    public function show(Survey $survey)
    {
        $survey->load('questions.options');
        return view('superadmin.surveys.show', compact('survey'));
    }

    /**
     */
    public function edit(Survey $survey)
    {
        $survey->load('surveyProgram', 'unitKerja');
        return view('superadmin.surveys.edit', compact('survey'));
    }

    /**
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

        return redirect()->route('superadmin.programs.show', $survey->surveyProgram)
            ->with('success', 'Survei pelaksanaan berhasil diperbarui.');
    }

    /**
     * Menghapus survei pelaksanaan.
     */
    public function destroy(Survey $survey)
    {
        $program = $survey->surveyProgram;
        $survey->delete();

        return redirect()->route('superadmin.programs.show', $program)
            ->with('success', 'Survei pelaksanaan berhasil dihapus.');
    }
}
