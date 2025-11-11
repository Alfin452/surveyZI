<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SurveyProgramController extends Controller
{
    use AuthorizesRequests;
    public function create()
    {
        $this->authorize('create', SurveyProgram::class);
        $program = new SurveyProgram();
        return view('unit_kerja_admin.programs.create', compact('program'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', SurveyProgram::class);
        $user = Auth::user();
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('survey_programs')->where(function ($query) use ($user) {
                    return $query->where('unit_kerja_id', $user->unit_kerja_id);
                })
            ],
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
        ]);

        $program = SurveyProgram::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'alias' => Str::slug($validated['title']),
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
            'is_featured' => false,
            'unit_kerja_id' => $user->unit_kerja_id, 
        ]);

        return redirect()->route('unitkerja.admin.programs.questions.index', $program)
            ->with('success', 'Program Survei berhasil dibuat. Silakan tambahkan bagian dan pertanyaan.');
    }

    public function edit(SurveyProgram $program)
    {
        $this->authorize('update', $program); // Otorisasi
        return view('unit_kerja_admin.programs.edit', compact('program'));
    }

    public function update(Request $request, SurveyProgram $program)
    {
        $this->authorize('update', $program);
        $user = Auth::user();
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('survey_programs')->where(function ($query) use ($user) {
                    return $query->where('unit_kerja_id', $user->unit_kerja_id);
                })->ignore($program->id)
            ],
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
        ]);

        $program->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'alias' => Str::slug($validated['title']),
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
        ]);

        return redirect()->route('unitkerja.admin.programs.index')->with('success', 'Program Survei berhasil diperbarui.');
    }

    public function destroy(SurveyProgram $program)
    {
        $this->authorize('delete', $program);
        if ($program->answers()->exists()) {
            return back()->with('error', 'Program ini tidak dapat dihapus karena sudah memiliki jawaban responden.');
        }
        $program->delete();
        return redirect()->route('unitkerja.admin.programs.index')->with('success', 'Program Survei berhasil dihapus.');
    }

    public function cloneProgram(SurveyProgram $program)
    {
        $this->authorize('create', SurveyProgram::class); // Otorisasi
        $this->authorize('view', $program); // Pastikan dia hanya bisa meng-kloning programnya sendiri

        $newTitle = $program->title . ' (Salinan)';
        $newAlias = Str::slug($newTitle);
        if (SurveyProgram::where('alias', $newAlias)->where('unit_kerja_id', $program->unit_kerja_id)->exists()) {
            $newAlias .= '-' . time();
        }

        DB::transaction(function () use ($program, $newTitle, $newAlias) {
            $program->load('questionSections.questions.options');

            $newProgram = $program->replicate();
            $newProgram->title = $newTitle;
            $newProgram->alias = $newAlias;
            $newProgram->is_active = false; 
            $newProgram->is_featured = false;
            $newProgram->created_at = now();
            $newProgram->updated_at = now();
            $newProgram->save();

            foreach ($program->questionSections as $section) {
                $newSection = $section->replicate();
                $newSection->survey_program_id = $newProgram->id;
                $newSection->created_at = now();
                $newSection->updated_at = now();
                $newSection->save();

                foreach ($section->questions as $question) {
                    $newQuestion = $question->replicate();
                    $newQuestion->question_section_id = $newSection->id;
                    $newQuestion->created_at = now();
                    $newQuestion->updated_at = now();
                    $newQuestion->save();

                    foreach ($question->options as $option) {
                        $newOption = $option->replicate();
                        $newOption->question_id = $newQuestion->id;
                        $newOption->created_at = now();
                        $newOption->updated_at = now();
                        $newOption->save();
                    }
                }
            }
        });

        return redirect()->route('unitkerja.admin.programs.index')->with('success', 'Program survei berhasil dikloning.');
    }

    public function showQuestionsPage(SurveyProgram $program)
    {
        $this->authorize('update', $program);

        $program->load(['questionSections' => function ($query) {
            $query->orderBy('order_column', 'asc')->withCount('questions');
        }]);

        return view('unit_kerja_admin.programs.questions.index', compact('program'));
    }
}
