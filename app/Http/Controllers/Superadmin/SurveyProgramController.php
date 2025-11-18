<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Services\ProgramCloningService;
use App\Http\Requests\Superadmin\StoreSurveyProgramRequest;
use App\Http\Requests\Superadmin\UpdateSurveyProgramRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class SurveyProgramController extends Controller
{
    
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = SurveyProgram::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $programs = $query->with('unitKerja')
            ->withCount('questionSections', 'targetedUnitKerjas')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('superadmin.programs.index', compact('programs'));
    }

    public function create()
    {
        $program = new SurveyProgram();
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.create', compact('program', 'unitKerjas'));
    }

    private function handleFeaturedStatus(Request $request, ?SurveyProgram $program = null)
    {
        $isFeatured = $request->boolean('is_featured');
        if ($isFeatured) {
            $query = SurveyProgram::query();
            if ($program) {
                $query->where('id', '!=', $program->id);
            }
            $query->update(['is_featured' => false]);
        }
        return $isFeatured;
    }

    public function store(StoreSurveyProgramRequest $request)
    {
        $validated = $request->validated();

        $isFeatured = $this->handleFeaturedStatus($request);

        $program = SurveyProgram::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'alias' => Str::slug($validated['title']),
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
            'is_featured' => $isFeatured,
            'unit_kerja_id' => null,
        ]);

        $program->targetedUnitKerjas()->sync($validated['targeted_unit_kerjas']);

        return redirect()->route('superadmin.programs.questions.index', $program)
            ->with('success', 'Program Survei berhasil dibuat. Silakan tambahkan bagian dan pertanyaan.');
    }

    public function show(SurveyProgram $program)
    {
        return redirect()->route('superadmin.programs.questions.index', $program);
    }

    public function edit(SurveyProgram $program)
    {
        $program->load('targetedUnitKerjas');
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.edit', compact('program', 'unitKerjas'));
    }

    public function update(UpdateSurveyProgramRequest $request, SurveyProgram $program)
    {
        $validated = $request->validated();

        $isFeatured = $this->handleFeaturedStatus($request, $program);

        $program->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'alias' => Str::slug($validated['title']),
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
            'is_featured' => $isFeatured,
        ]);

        $program->targetedUnitKerjas()->sync($validated['targeted_unit_kerjas']);

        return redirect()->route('superadmin.programs.index')->with('success', 'Program Survei berhasil diperbarui.');
    }

    public function destroy(SurveyProgram $program)
    {
        if ($program->answers()->exists()) {
            return back()->with('error', 'Program ini tidak dapat dihapus karena sudah memiliki jawaban responden.');
        }
        $program->delete();
        return redirect()->route('superadmin.programs.index')->with('success', 'Program Survei berhasil dihapus.');
    }

    public function cloneProgram(Request $request, SurveyProgram $program, ProgramCloningService $cloningService)
    {
        $cloningService->clone($program);
        return redirect()->route('superadmin.programs.index')->with('success', 'Program survei berhasil dikloning.');
    }

    public function showQuestionsPage(SurveyProgram $program)
    {
        $program->load(['questionSections' => function ($query) {
            $query->orderBy('order_column', 'asc')->withCount('questions');
        }]);
        return view('superadmin.programs.questions.index', compact('program'));
    }
}