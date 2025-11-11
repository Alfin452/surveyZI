<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionController extends Controller
{
    use AuthorizesRequests;

    public function create(QuestionSection $section)
    {
        $this->authorize('update', $section->surveyProgram);
        $question = new Question();
        $program = $section->surveyProgram;
        return view('unit_kerja_admin.programs.questions.create', compact('program', 'section', 'question'));
    }

    public function store(Request $request, QuestionSection $section)
    {
        $this->authorize('update', $section->surveyProgram);
        $validated = $request->validate([
            'question_body' => 'required|string',
            'type' => 'required|in:multiple_choice',
            'options' => 'required|array|min:1',
            'options.*.option_body' => 'required|string|max:255',
            'options.*.option_score' => 'required|integer',
        ]);
        DB::transaction(function () use ($section, $validated) {
            $question = $section->questions()->create([
                'question_body' => $validated['question_body'],
                'type' => $validated['type'],
            ]);
            $question->options()->createMany($validated['options']);
        });
        return redirect()->route('unitkerja.admin.programs.questions.index', $section->surveyProgram)
            ->with('success', 'Pertanyaan berhasil ditambahkan ke bagian "' . $section->title . '".');
    }

    public function edit(QuestionSection $section, Question $question)
    {
        $this->authorize('update', $section->surveyProgram);
        $question->load('options');
        $program = $section->surveyProgram;
        return view('unit_kerja_admin.programs.questions.edit', compact('program', 'section', 'question'));
    }

    public function update(Request $request, QuestionSection $section, Question $question)
    {
        $this->authorize('update', $section->surveyProgram);
        $validated = $request->validate([
            'question_body' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*.option_body' => 'required|string|max:255',
            'options.*.option_score' => 'required|integer',
        ]);
        DB::transaction(function () use ($question, $validated) {
            $question->update(['question_body' => $validated['question_body']]);
            $question->options()->delete();
            $question->options()->createMany($validated['options']);
        });
        return redirect()->route('unitkerja.admin.programs.questions.index', $section->surveyProgram)
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }
    public function destroy(QuestionSection $section, Question $question)
    {
        $this->authorize('update', $section->surveyProgram);
        $program = $section->surveyProgram;
        $question->delete();
        return redirect()->route('unitkerja.admin.programs.questions.index', $program)
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }

    public function reorder(Request $request, QuestionSection $section)
    {
        $this->authorize('update', $section->surveyProgram);
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:questions,id'
        ]);
        DB::transaction(function () use ($request, $section) {
            foreach ($request->order as $index => $questionId) {
                Question::where('id', $questionId)
                    ->where('question_section_id', $section->id)
                    ->update(['order_column' => $index + 1]);
            }
        });
        return response()->json(['status' => 'success', 'message' => 'Urutan pertanyaan berhasil disimpan.']);
    }
}
