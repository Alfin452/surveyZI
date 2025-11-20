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

        // Load sections agar dropdown "Bagian Soal" tidak error jika dipanggil
        $sections = $program->questionSections;

        return view('unit_kerja_admin.programs.questions.create', compact('program', 'section', 'sections', 'question'));
    }

    public function store(Request $request, QuestionSection $section)
    {
        $this->authorize('update', $section->surveyProgram);

        // 1. Validasi disesuaikan dengan nama field di Form Baru
        $validated = $request->validate([
            'question_section_id' => 'required|exists:question_sections,id', // Tambahan: Support pindah section
            'question_body' => 'required|string',
            'type' => 'required|in:radio,text', // Form kirim 'radio', bukan 'multiple_choice'
            'options' => 'nullable|array',
            'options.*.text' => 'required_if:type,radio|string|max:255', // Form kirim 'text'
            'options.*.score' => 'required_if:type,radio|integer', // Form kirim 'score'
        ]);

        DB::transaction(function () use ($validated) {
            // 2. Mapping Tipe Form (radio) ke Database (multiple_choice)
            $dbType = $validated['type'] === 'radio' ? 'multiple_choice' : 'essay';

            $question = Question::create([
                'question_section_id' => $validated['question_section_id'],
                'question_body' => $validated['question_body'],
                'type' => $dbType,
            ]);

            // 3. Simpan Opsi dengan Mapping yang Benar
            if ($validated['type'] === 'radio' && !empty($validated['options'])) {
                $optionsData = [];
                foreach ($validated['options'] as $opt) {
                    if (!empty($opt['text'])) {
                        $optionsData[] = [
                            'option_body' => $opt['text'],   // Mapping: text -> option_body
                            'option_score' => $opt['score'] ?? 0, // Mapping: score -> option_score
                        ];
                    }
                }
                if (count($optionsData) > 0) {
                    $question->options()->createMany($optionsData);
                }
            }
        });

        // Redirect kembali ke section yang dipilih (bisa jadi beda dengan $section awal)
        $targetSection = QuestionSection::find($validated['question_section_id']);

        return redirect()->route('unitkerja.admin.programs.questions.index', $targetSection->surveyProgram)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(QuestionSection $section, Question $question)
    {
        $this->authorize('update', $section->surveyProgram);
        $question->load('options');
        $program = $section->surveyProgram;
        $sections = $program->questionSections;

        // Konversi Tipe DB ke Tipe Form agar terbaca di View
        if ($question->type === 'multiple_choice') {
            $question->type = 'radio';
        } elseif ($question->type === 'essay') {
            $question->type = 'text';
        }

        return view('unit_kerja_admin.programs.questions.edit', compact('program', 'section', 'sections', 'question'));
    }

    public function update(Request $request, QuestionSection $section, Question $question)
    {
        $this->authorize('update', $section->surveyProgram);

        $validated = $request->validate([
            'question_section_id' => 'required|exists:question_sections,id',
            'question_body' => 'required|string',
            'type' => 'required|in:radio,text',
            'options' => 'nullable|array',
            'options.*.id' => 'nullable',
            'options.*.text' => 'required_if:type,radio|string|max:255',
            'options.*.score' => 'required_if:type,radio|integer',
        ]);

        DB::transaction(function () use ($question, $validated) {
            $dbType = $validated['type'] === 'radio' ? 'multiple_choice' : 'essay';

            $question->update([
                'question_section_id' => $validated['question_section_id'],
                'question_body' => $validated['question_body'],
                'type' => $dbType,
            ]);

            if ($validated['type'] === 'radio') {
                // Logika Sync Opsi (Hapus yang tidak ada, Update yang ada, Create yang baru)
                $submittedIds = collect($validated['options'])->pluck('id')->filter()->toArray();
                $question->options()->whereNotIn('id', $submittedIds)->delete();

                if (!empty($validated['options'])) {
                    foreach ($validated['options'] as $opt) {
                        if (!empty($opt['text'])) {
                            $question->options()->updateOrCreate(
                                ['id' => $opt['id'] ?? null],
                                [
                                    'option_body' => $opt['text'],
                                    'option_score' => $opt['score'] ?? 0,
                                    'question_id' => $question->id
                                ]
                            );
                        }
                    }
                }
            } else {
                $question->options()->delete(); // Hapus opsi jika ganti jadi esai
            }
        });

        $targetSection = QuestionSection::find($validated['question_section_id']);

        return redirect()->route('unitkerja.admin.programs.questions.index', $targetSection->surveyProgram)
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
