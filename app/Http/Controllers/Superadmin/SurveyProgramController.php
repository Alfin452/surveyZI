<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // DITAMBAHKAN: Diperlukan untuk database transaction

class SurveyProgramController extends Controller
{
    /**
     * Menampilkan daftar semua Program Survei (Wadah).
     */
    public function index()
    {
        $programs = SurveyProgram::withCount('surveys', 'targetedUnitKerjas')->latest()->paginate(10);
        return view('superadmin.programs.index', compact('programs'));
    }

    /**
     * Menampilkan form untuk membuat Program Survei baru.
     */
    public function create()
    {
        $program = new SurveyProgram();
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.create', compact('program', 'unitKerjas'));
    }

    /**
     * Menyimpan Program Survei baru ke database.
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
     * Menampilkan detail dari sebuah Program Survei.
     */
    public function show(SurveyProgram $program)
    {
        $program->load('targetedUnitKerjas', 'surveys.unitKerja');
        return view('superadmin.programs.show', compact('program'));
    }

    /**
     * Menampilkan form untuk mengedit Program Survei.
     */
    public function edit(SurveyProgram $program)
    {
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.edit', compact('program', 'unitKerjas'));
    }

    /**
     * Memperbarui Program Survei di database.
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

    /**
     * DITAMBAHKAN: Mengkloning program survei beserta seluruh relasinya.
     */
    public function cloneProgram(Request $request, SurveyProgram $program)
    {
        // 1. Buat judul & alias baru, cek keunikan
        $newTitle = $program->title . ' (Salinan)';
        $newAlias = Str::slug($newTitle);

        // Cek jika judul atau alias salinan sudah ada
        if (SurveyProgram::where('title', $newTitle)->orWhere('alias', $newAlias)->exists()) {
            // Tambahkan timestamp unik jika sudah ada untuk menghindari error
            $newTitle .= ' ' . time();
            $newAlias .= '-' . time();
        }

        DB::transaction(function () use ($program, $newTitle, $newAlias) {

            // 2. Muat semua relasi yang diperlukan dari program asli
            $program->load('targetedUnitKerjas', 'surveys.questions.options');

            // 3. Kloning Program Survei (Wadah) itu sendiri
            $newProgram = $program->replicate();
            $newProgram->title = $newTitle;
            $newProgram->alias = $newAlias;
            $newProgram->created_at = now();
            $newProgram->updated_at = now();
            $newProgram->save();

            // 4. Sinkronkan unit kerja yang ditargetkan
            $newProgram->targetedUnitKerjas()->sync($program->targetedUnitKerjas->pluck('id'));

            // 5. Lakukan "Deep Clone" untuk setiap survei pelaksanaan (Turunan)
            foreach ($program->surveys as $survey) {
                // 5a. Kloning survei pelaksanaan
                $newSurvey = $survey->replicate();
                $newSurvey->survey_program_id = $newProgram->id; // Hubungkan ke program baru
                $newSurvey->created_at = now();
                $newSurvey->updated_at = now();
                $newSurvey->save();

                // 5b. Kloning setiap pertanyaan
                foreach ($survey->questions as $question) {
                    $newQuestion = $question->replicate();
                    $newQuestion->survey_id = $newSurvey->id; // Hubungkan ke survei baru
                    $newQuestion->created_at = now();
                    $newQuestion->updated_at = now();
                    $newQuestion->save();

                    // 5c. Kloning setiap opsi
                    foreach ($question->options as $option) {
                        $newOption = $option->replicate();
                        $newOption->question_id = $newQuestion->id; // Hubungkan ke pertanyaan baru
                        $newOption->created_at = now();
                        $newOption->updated_at = now();
                        $newOption->save();
                    }
                }
            }
        });

        return redirect()->route('superadmin.programs.index')->with('success', 'Program survei berhasil dikloning.');
    }
}
