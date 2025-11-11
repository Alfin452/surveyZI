<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Menampilkan form untuk membuat pertanyaan baru DI DALAM sebuah Bagian.
     */
    public function create(QuestionSection $section)
    {
        $question = new Question();
        $program = $section->surveyProgram;
        return view('superadmin.programs.questions.create', compact('program', 'section', 'question'));
    }

    /**
     * Menyimpan pertanyaan baru ke database.
     */
    public function store(Request $request, QuestionSection $section)
    {
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

        return redirect()->route('superadmin.programs.questions.index', $section->surveyProgram)
            ->with('success', 'Pertanyaan berhasil ditambahkan ke bagian "' . $section->title . '".');
    }

    /**
     * Menampilkan form untuk mengedit pertanyaan.
     */
    // PERBAIKAN: Menambahkan parameter $section
    public function edit(QuestionSection $section, Question $question)
    {
        $question->load('options');
        $program = $section->surveyProgram;

        return view('superadmin.programs.questions.edit', compact('program', 'section', 'question'));
    }

    /**
     * Memperbarui pertanyaan di database.
     */
    // PERBAIKAN: Menambahkan parameter $section
    public function update(Request $request, QuestionSection $section, Question $question)
    {
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

        return redirect()->route('superadmin.programs.questions.index', $section->surveyProgram)
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Menghapus sebuah pertanyaan.
     */
    // PERBAIKAN: Menambahkan parameter $section
    public function destroy(QuestionSection $section, Question $question)
    {
        $program = $section->surveyProgram;
        $question->delete();
        return redirect()->route('superadmin.programs.questions.index', $program)
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }

    /**
     * Mengatur ulang urutan Pertanyaan (Drag-and-Drop) DI DALAM Bagian.
     */
    public function reorder(Request $request, QuestionSection $section)
    {
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
