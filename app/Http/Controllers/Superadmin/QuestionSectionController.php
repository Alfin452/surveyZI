<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\QuestionSection;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionSectionController extends Controller
{
    public function store(Request $request, SurveyProgram $program)
    {
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
    public function update(Request $request, QuestionSection $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $section->update($validated);
        return back()->with('success', 'Bagian soal telah diperbarui.');
    }
    public function destroy(QuestionSection $section)
    {
        if ($section->questions()->exists()) {
            return back()->with('error', 'Gagal menghapus! Hapus semua pertanyaan di dalam bagian ini terlebih dahulu.');
        }
        $section->delete();
        return back()->with('success', 'Bagian soal telah dihapus.');
    }
    public function reorder(Request $request, SurveyProgram $program)
    {
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
