<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SurveyProgramController extends Controller
{
    /**
     */
    public function index()
    {
        $programs = SurveyProgram::withCount('surveys', 'targetedUnitKerjas')->latest()->paginate(10);
        return view('superadmin.programs.index', compact('programs'));
    }

    /**
     */
    public function create()
    {
        $program = new SurveyProgram();
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.create', compact('program', 'unitKerjas'));
    }

    /**
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:survey_programs,title',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'targeted_unit_kerjas' => 'required|array',
            'targeted_unit_kerjas.*' => 'exists:unit_kerjas,id',
        ]);

        $program = SurveyProgram::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_active' => $request->boolean('is_active'),
            'alias' => Str::slug($validated['title']),
        ]);

        $program->targetedUnitKerjas()->sync($validated['targeted_unit_kerjas']);

        return redirect()->route('superadmin.programs.index')->with('success', 'Program Survei berhasil dibuat.');
    }

    /**
     */
    public function show(SurveyProgram $program)
    {
        $program->load('targetedUnitKerjas', 'surveys.unitKerja');
        return view('superadmin.programs.show', compact('program'));
    }

    /**
     */
    public function edit(SurveyProgram $program)
    {
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.edit', compact('program', 'unitKerjas'));
    }

    /**
     */
    public function update(Request $request, SurveyProgram $program)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('survey_programs')->ignore($program->id)],
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'targeted_unit_kerjas' => 'required|array',
            'targeted_unit_kerjas.*' => 'exists:unit_kerjas,id',
        ]);

        $program->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_active' => $request->boolean('is_active'),
            'alias' => Str::slug($validated['title']),
        ]);

        $program->targetedUnitKerjas()->sync($validated['targeted_unit_kerjas']);

        return redirect()->route('superadmin.programs.index')->with('success', 'Program Survei berhasil diperbarui.');
    }

    /**
     * Menghapus Program Survei.
     */
    public function destroy(SurveyProgram $program)
    {
        if ($program->surveys()->exists()) {
            return back()->with('error', 'Program ini tidak dapat dihapus karena sudah memiliki survei pelaksanaan terkait.');
        }

        $program->delete();
        return redirect()->route('superadmin.programs.index')->with('success', 'Program Survei berhasil dihapus.');
    }
}
