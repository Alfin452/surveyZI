<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // DITAMBAHKAN: Diperlukan untuk transaksi

class QuestionController extends Controller
{
    /**
     * Menampilkan form untuk membuat pertanyaan baru.
     */
    public function create(Survey $survey)
    {
        $question = new Question();
        return view('superadmin.questions.create', compact('survey', 'question'));
    }

    /**
     * Menyimpan pertanyaan baru beserta opsi-opsinya.
     */
    public function store(Request $request, Survey $survey)
    {
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

        return redirect()->route('superadmin.surveys.show', $survey)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit pertanyaan.
     */
    public function edit(Survey $survey, Question $question)
    {
        $question->load('options'); // Memuat opsi yang sudah ada untuk ditampilkan di form
        return view('superadmin.questions.edit', compact('survey', 'question'));
    }

    /**
     * Memperbarui pertanyaan beserta opsi-opsinya.
     */
    public function update(Request $request, Survey $survey, Question $question)
    {
        // PERBAIKAN: Validasi sekarang juga mencakup opsi jawaban
        $validated = $request->validate([
            'question_body' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*.option_body' => 'required|string|max:255',
            'options.*.option_score' => 'required|integer',
        ]);

        // PERBAIKAN: Menggunakan transaksi untuk keamanan data
        DB::transaction(function () use ($question, $validated) {
            // Langkah 1: Perbarui teks pertanyaan
            $question->update([
                'question_body' => $validated['question_body'],
            ]);

            // Langkah 2: Hapus semua opsi lama yang terkait dengan pertanyaan ini
            $question->options()->delete();

            // Langkah 3: Buat kembali opsi-opsi yang baru dari data form
            $question->options()->createMany($validated['options']);
        });

        return redirect()->route('superadmin.surveys.show', $survey)
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Menghapus sebuah pertanyaan.
     */
    public function destroy(Survey $survey, Question $question)
    {
        $question->delete();

        return redirect()->route('superadmin.surveys.show', $survey)
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
