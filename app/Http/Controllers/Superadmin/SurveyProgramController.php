<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\PreSurveyResponse;

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

        // PERBAIKAN: Tambahkan ->with('unitKerja') untuk memuat relasi pemilik Tipe 2
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

    public function store(Request $request)
    {
        // Perbaikan: Set default array kosong jika tidak ada yang dikirim
        $request->merge([
            'targeted_unit_kerjas' => $request->input('targeted_unit_kerjas', [])
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:survey_programs,title',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'targeted_unit_kerjas' => 'required|array|min:1',
            'targeted_unit_kerjas.*' => 'exists:unit_kerjas,id',
        ], [
            'targeted_unit_kerjas.required' => 'Anda harus memilih minimal satu unit kerja.',
            'targeted_unit_kerjas.min' => 'Anda harus memilih minimal satu unit kerja.',
        ]);

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

    public function update(Request $request, SurveyProgram $program)
    {
        // Perbaikan: Set default array kosong jika tidak ada yang dikirim
        $request->merge([
            'targeted_unit_kerjas' => $request->input('targeted_unit_kerjas', [])
        ]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('survey_programs')->ignore($program->id)],
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'targeted_unit_kerjas' => 'required|array|min:1',
            'targeted_unit_kerjas.*' => 'exists:unit_kerjas,id',
        ], [
            'targeted_unit_kerjas.required' => 'Anda harus memilih minimal satu unit kerja.',
            'targeted_unit_kerjas.min' => 'Anda harus memilih minimal satu unit kerja.',
        ]);

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

    public function cloneProgram(Request $request, SurveyProgram $program)
    {
        $newTitle = $program->title . ' (Salinan)';
        $newAlias = Str::slug($newTitle);
        if (SurveyProgram::where('alias', $newAlias)->exists()) {
            $newAlias .= '-' . time();
        }
        DB::transaction(function () use ($program, $newTitle, $newAlias) {
            // PERBAIKAN: Muat relasi nested (Bagian -> Pertanyaan -> Opsi)
            $program->load('targetedUnitKerjas', 'questionSections.questions.options');
            // 1. Kloning Program
            $newProgram = $program->replicate();
            $newProgram->title = $newTitle;
            $newProgram->alias = $newAlias;
            $newProgram->is_featured = false;
            $newProgram->created_at = now();
            $newProgram->updated_at = now();
            $newProgram->save();
            // 2. Kloning Target Unit Kerja
            $newProgram->targetedUnitKerjas()->sync($program->targetedUnitKerjas->pluck('id'));
            // 3. Kloning Bagian Soal (Sections)
            foreach ($program->questionSections as $section) {
                $newSection = $section->replicate();
                $newSection->survey_program_id = $newProgram->id; 
                $newSection->created_at = now();
                $newSection->updated_at = now();
                $newSection->save();
                // 4. Kloning Pertanyaan (Questions)
                foreach ($section->questions as $question) {
                    $newQuestion = $question->replicate();
                    $newQuestion->question_section_id = $newSection->id; 
                    $newQuestion->created_at = now();
                    $newQuestion->updated_at = now();
                    $newQuestion->save();
                    // 5. Kloning Opsi (Options)
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
        return redirect()->route('superadmin.programs.index')->with('success', 'Program survei berhasil dikloning.');
    }

    public function showQuestionsPage(SurveyProgram $program)
    {
        $program->load(['questionSections' => function ($query) {
            $query->orderBy('order_column', 'asc')->withCount('questions');
        }]);
        return view('superadmin.programs.questions.index', compact('program'));
    }

    private function applyFilters($query, Request $request)
    {
        // Bergabung dengan tabel pre_survey_responses
        $query->join('pre_survey_responses', function ($join) {
            $join->on('answers.user_id', '=', 'pre_survey_responses.user_id')
                ->on('answers.survey_program_id', '=', 'pre_survey_responses.survey_program_id');
        });

        // Terapkan filter
        $query->when($request->filled('gender'), function ($q) use ($request) {
            $q->where('pre_survey_responses.gender', $request->gender);
        });
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('pre_survey_responses.status', $request->status);
        });
    }

    /**
     * Mengambil opsi unik untuk dropdown filter.
     */
    private function getFilterOptions(SurveyProgram $program)
    {
        $preSurveyData = PreSurveyResponse::where('survey_program_id', $program->id)
            ->select('gender', 'status')
            ->distinct()
            ->get();

        $genders = $preSurveyData->pluck('gender')->unique()->filter()->values();
        $statuses = $preSurveyData->pluck('status')->unique()->filter()->values();

        return compact('genders', 'statuses');
    }
    public function showResults(Request $request, SurveyProgram $program)
    {
        $program->load('questionSections.questions.options');
        $filterOptions = $this->getFilterOptions($program); // Ambil opsi filter
        $respondentsQuery = Answer::where('answers.survey_program_id', $program->id);

        if ($request->filled('gender') || $request->filled('status')) {
            $this->applyFilters($respondentsQuery, $request);
        }

        $totalRespondents = $respondentsQuery->distinct('answers.user_id')->count('answers.user_id');
        $answerCountsQuery = Answer::where('answers.survey_program_id', $program->id);

        if ($request->filled('gender') || $request->filled('status')) {
            $this->applyFilters($answerCountsQuery, $request);
        }

        $answerCounts = $answerCountsQuery->select('question_id', 'option_id', DB::raw('count(*) as total'))
            ->groupBy('question_id', 'option_id')
            ->get()
            ->groupBy('question_id');

        $chartData = [];
        $questions = $program->questionSections->flatMap->questions;

        foreach ($questions as $question) {
            $labels = $question->options->pluck('option_body');
            $data = $question->options->map(function ($option) use ($answerCounts, $question) {
                return $answerCounts->get($question->id)
                    ? $answerCounts->get($question->id)->firstWhere('option_id', $option->id)['total'] ?? 0
                    : 0;
            });

            $chartData[] = [
                'question_id' => $question->id,
                'question_body' => $question->question_body,
                'labels' => $labels,
                'data' => $data,
                'options' => $question->options
            ];
        }

        return view('superadmin.programs.results.show', compact(
            'program',
            'totalRespondents',
            'chartData',
            'filterOptions'
        ));
    }
}

