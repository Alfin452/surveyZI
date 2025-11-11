<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\QuestionSection;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionSectionController extends Controller
{
    use AuthorizesRequests;

    /**
     * Menyimpan Bagian Soal baru.
     */
    public function store(Request $request, SurveyProgram $program)
    {
        $this->authorize('update', $program);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $program->questionSections()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return back()->with('success', 'Bagian soal baru telah ditambahkan.');
    }

    /**
     * Memperbarui Bagian Soal.
     */
    public function update(Request $request, QuestionSection $section)
    {
        // Otorisasi: Dapatkan program induk dari section dan otorisasi
        $this->authorize('update', $section->surveyProgram);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $section->update($validated);

        return back()->with('success', 'Bagian soal telah diperbarui.');
    }

    /**
     * Menghapus Bagian Soal.
     */
    public function destroy(QuestionSection $section)
    {
        $this->authorize('update', $section->surveyProgram);

        if ($section->questions()->exists()) {
            return back()->with('error', 'Gagal menghapus! Hapus semua pertanyaan di dalam bagian ini terlebih dahulu.');
        }

        $section->delete();
        return back()->with('success', 'Bagian soal telah dihapus.');
    }

    /**
     * Mengatur ulang urutan Bagian Soal (Drag-and-Drop).
     */
    public function reorder(Request $request, SurveyProgram $program)
    {
        $this->authorize('update', $program);

        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:question_sections,id',
        ]);

        DB::transaction(function () use ($request, $program) {
            foreach ($request->order as $index => $sectionId) {
                QuestionSection::where('id', $sectionId)
                    ->where('survey_program_id', $program->id)
                    ->update(['order_column' => $index + 1]);
            }
        });

        return response()->json(['status' => 'success', 'message' => 'Urutan bagian berhasil disimpan.']);
    }
}
