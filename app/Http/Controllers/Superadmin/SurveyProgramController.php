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

    public function index()
    {
        $programs = SurveyProgram::withCount('questions', 'targetedUnitKerjas')->latest()->paginate(10);
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
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:survey_programs,title',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'targeted_unit_kerjas' => 'required|array',
            'targeted_unit_kerjas.*' => 'exists:unit_kerjas,id',
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
        ]);

        $program->targetedUnitKerjas()->sync($validated['targeted_unit_kerjas']);

        return redirect()->route('superadmin.programs.index')->with('success', 'Program Survei berhasil dibuat.');
    }

    public function show(SurveyProgram $program)
    {
        return redirect()->route('superadmin.programs.questions.index', $program);
    }

    public function edit(SurveyProgram $program)
    {
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.edit', compact('program', 'unitKerjas'));
    }

    public function update(Request $request, SurveyProgram $program)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('survey_programs')->ignore($program->id)],
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'targeted_unit_kerjas' => 'required|array',
            'targeted_unit_kerjas.*' => 'exists:unit_kerjas,id',
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
        // Sekarang kita cek 'questions' bukan 'surveys'
        if ($program->questions()->exists() || $program->answers()->exists()) {
            return back()->with('error', 'Program ini tidak dapat dihapus karena sudah memiliki pertanyaan atau jawaban terkait.');
        }

        $program->delete();
        return redirect()->route('superadmin.programs.index')->with('success', 'Program Survei berhasil dihapus.');
    }

    /**
     */
    public function cloneProgram(Request $request, SurveyProgram $program)
    {
        $newTitle = $program->title . ' (Salinan)';
        $newAlias = Str::slug($newTitle);
        if (SurveyProgram::where('title', $newTitle)->orWhere('alias', $newAlias)->exists()) {
            $newTitle .= ' ' . time();
            $newAlias .= '-' . time();
        }

        DB::transaction(function () use ($program, $newTitle, $newAlias) {

            $program->load('targetedUnitKerjas', 'questions.options');

            // 3. Kloning Program (Wadah)
            $newProgram = $program->replicate();
            $newProgram->title = $newTitle;
            $newProgram->alias = $newAlias;
            $newProgram->created_at = now();
            $newProgram->updated_at = now();
            $newProgram->save();

            $newProgram->targetedUnitKerjas()->sync($program->targetedUnitKerjas->pluck('id'));

            foreach ($program->questions as $question) {
                $newQuestion = $question->replicate();
                $newQuestion->survey_program_id = $newProgram->id; // Hubungkan ke program baru
                $newQuestion->created_at = now();
                $newQuestion->updated_at = now();
                $newQuestion->save();

                // 6. Kloning setiap opsi
                foreach ($question->options as $option) {
                    $newOption = $option->replicate();
                    $newOption->question_id = $newQuestion->id; // Hubungkan ke pertanyaan baru
                    $newOption->created_at = now();
                    $newOption->updated_at = now();
                    $newOption->save();
                }
            }
        });

        return redirect()->route('superadmin.programs.index')->with('success', 'Program survei berhasil dikloning.');
    }

    /**
     */
    public function showQuestions(SurveyProgram $program)
    {
        $program->load('questions.options');
        return view('superadmin.programs.questions.index', compact('program'));
    }

    /**
     */
    public function createQuestion(SurveyProgram $program)
    {
        $question = new Question();
        return view('superadmin.programs.questions.create', compact('program', 'question'));
    }

    /**
     */
    public function storeQuestion(Request $request, SurveyProgram $program)
    {
        $validated = $request->validate([
            'question_body' => 'required|string',
            'type' => 'required|in:multiple_choice',
            'options' => 'required|array|min:1',
            'options.*.option_body' => 'required|string|max:255',
            'options.*.option_score' => 'required|integer',
        ]);

        DB::transaction(function () use ($program, $validated) {
            $question = $program->questions()->create([
                'question_body' => $validated['question_body'],
                'type' => $validated['type'],
            ]);
            $question->options()->createMany($validated['options']);
        });

        return redirect()->route('superadmin.programs.questions.index', $program)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function editQuestion(SurveyProgram $program, Question $question)
    {
        $question->load('options');
        return view('superadmin.programs.questions.edit', compact('program', 'question'));
    }


    public function updateQuestion(Request $request, SurveyProgram $program, Question $question)
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

        return redirect()->route('superadmin.programs.questions.index', $program)
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }


    public function destroyQuestion(SurveyProgram $program, Question $question)
    {
        $question->delete();
        return redirect()->route('superadmin.programs.questions.index', $program)
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }


    public function reorderQuestions(Request $request, SurveyProgram $program)
    {
        $request->validate(['order' => 'required|array', 'order.*' => 'exists:questions,id']);

        DB::transaction(function () use ($request, $program) {
            foreach ($request->order as $index => $questionId) {
                Question::where('id', $questionId)
                    ->where('survey_program_id', $program->id)
                    ->update(['order_column' => $index + 1]);
            }
        });

        return response()->json(['status' => 'success', 'message' => 'Urutan pertanyaan berhasil disimpan.']);
    }

    private function applyFilters($query, Request $request)
    {
        $query->when($request->filled('gender'), function ($q) use ($request) {
            $q->where('pre_survey_responses.gender', $request->gender);
        });
        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('pre_survey_responses.status', $request->status);
        });
        // Tambahkan filter lain (usia, fakultas) di sini jika perlu
    }

    private function getFilterOptions(SurveyProgram $program)
    {
        $preSurveyData = PreSurveyResponse::where('survey_program_id', $program->id)
            ->select('gender', 'status') // Ambil hanya kolom yang ingin kita filter
            ->distinct()
            ->get();

        // Buat daftar unik untuk setiap filter
        $genders = $preSurveyData->pluck('gender')->unique()->filter()->values();
        $statuses = $preSurveyData->pluck('status')->unique()->filter()->values();

        return compact('genders', 'statuses');
    }

    public function showResults(Request $request, SurveyProgram $program)
    {
        $program->load('questions.options');

        $respondentsQuery = Answer::where('answers.survey_program_id', $program->id)
            ->join('pre_survey_responses', function ($join) {
                $join->on('answers.user_id', '=', 'pre_survey_responses.user_id')
                    ->on('answers.survey_program_id', '=', 'pre_survey_responses.survey_program_id');
            });

        $this->applyFilters($respondentsQuery, $request); // Terapkan filter
        $totalRespondents = $respondentsQuery->distinct('answers.user_id')->count('answers.user_id');

        $answerCountsQuery = Answer::where('answers.survey_program_id', $program->id)
            ->join('pre_survey_responses', function ($join) {
                $join->on('answers.user_id', '=', 'pre_survey_responses.user_id')
                    ->on('answers.survey_program_id', '=', 'pre_survey_responses.survey_program_id');
            });

        $this->applyFilters($answerCountsQuery, $request); // Terapkan filter

        $answerCounts = $answerCountsQuery->select('question_id', 'option_id', DB::raw('count(*) as total'))
            ->groupBy('question_id', 'option_id')
            ->get()
            ->groupBy('question_id');

        $filterOptions = $this->getFilterOptions($program);

        $chartData = [];
        foreach ($program->questions as $question) {
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
