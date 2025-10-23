<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Menampilkan form untuk membuat pertanyaan baru.
     */
    public function create(Survey $survey)
    {
        // Pastikan admin ini berhak mengupdate (menambah pertanyaan) survei ini
        $this->authorize('update', $survey);

        $question = new Question();
        return view('unit_kerja_admin.questions.create', compact('survey', 'question'));
    }

    /**
     * Menyimpan pertanyaan baru ke database.
     */
    public function store(Request $request, Survey $survey)
    {
        $this->authorize('update', $survey);

        $validated = $request->validate([
            'question_body' => 'required|string',
            'type' => 'required|in:multiple_choice',
            'options' => 'required|array|min:1',
            'options.*.option_body' => 'required|string|max:255',
            'options.*.option_score' => 'required|integer',
        ]);

        DB::transaction(function () use ($survey, $validated) {
            $question = $survey->questions()->create([
                'question_body' => $validated['question_body'],
                'type' => $validated['type'],
            ]);

            $question->options()->createMany($validated['options']);
        });

        return redirect()->route('unitkerja.admin.surveys.show', $survey)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit pertanyaan.
     */
    public function edit(Survey $survey, Question $question)
    {
        $this->authorize('update', $survey);

        $question->load('options');
        return view('unit_kerja_admin.questions.edit', compact('survey', 'question'));
    }

    /**
     * Memperbarui pertanyaan di database.
     */
    public function update(Request $request, Survey $survey, Question $question)
    {
        $this->authorize('update', $survey);

        $validated = $request->validate([
            'question_body' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*.option_body' => 'required|string|max:255',
            'options.*.option_score' => 'required|integer',
        ]);

        DB::transaction(function () use ($question, $validated) {
            $question->update([
                'question_body' => $validated['question_body'],
            ]);
            $question->options()->delete();
            $question->options()->createMany($validated['options']);
        });

        return redirect()->route('unitkerja.admin.surveys.show', $survey)
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Menghapus sebuah pertanyaan.
     */
    public function destroy(Survey $survey, Question $question)
    {
        $this->authorize('update', $survey);

        $question->delete();

        return redirect()->route('unitkerja.admin.surveys.show', $survey)
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
