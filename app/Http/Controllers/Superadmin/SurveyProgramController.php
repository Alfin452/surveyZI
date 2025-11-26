<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Services\ProgramCloningService;
use App\Http\Requests\Superadmin\StoreSurveyProgramRequest;
use App\Http\Requests\Superadmin\UpdateSurveyProgramRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class SurveyProgramController extends Controller
{
    
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $query = SurveyProgram::with(['unitKerja'])
            ->withCount(['questions', 'questionSections', 'targetedUnitKerjas'])
            ->latest();

        // 1. Logika Pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 2. Logika Filter Status
        if ($request->filled('status')) {
            if ($request->status == 'active') {
                $query->where('is_active', true);
            } elseif ($request->status == 'inactive') {
                $query->where('is_active', false);
            }
        }

        // 3. Logika Filter Unit Kerja (Support Institusional/Lokal dari View baru)
        if ($request->filled('unit_id')) {
            if ($request->unit_id === 'institutional') {
                $query->whereNull('unit_kerja_id');
            } elseif ($request->unit_id === 'local') {
                $query->whereNotNull('unit_kerja_id');
            } else {
                $query->where('unit_kerja_id', $request->unit_id);
            }
        }

        $programs = $query->paginate(10)->withQueryString();

        $units = UnitKerja::orderBy('unit_kerja_name')->get();

        return view('superadmin.programs.index', compact('programs', 'units'));
    }

    public function create()
    {
        $program = new SurveyProgram();
        $unitKerjas = UnitKerja::orderBy('unit_kerja_name')->get();
        return view('superadmin.programs.create', compact('program', 'unitKerjas'));
    }

    public function store(StoreSurveyProgramRequest $request)
    {
        $validated = $request->validated();

        $program = SurveyProgram::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'alias' => Str::slug($validated['title']) . '-' . Str::random(5),
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
            'is_featured' => $request->boolean('is_featured'), // Langsung simpan statusnya
            'unit_kerja_id' => null, // Program buatan Superadmin selalu Global (null)
        ]);

        // Sinkronisasi target unit
        if (isset($validated['targeted_unit_kerjas'])) {
            $program->targetedUnitKerjas()->sync($validated['targeted_unit_kerjas']);
        }

        return redirect()->route('superadmin.programs.questions.index', $program)
            ->with('success', 'Program Survei berhasil dibuat.');
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

    public function update(UpdateSurveyProgramRequest $request, SurveyProgram $program)
    {
        $validated = $request->validated();

        $program->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            // Jangan update alias agar link lama tidak rusak, atau update jika perlu:
            // 'alias' => Str::slug($validated['title']), 
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
            'is_featured' => $request->boolean('is_featured'), // Update status featured
            // PERBAIKAN: Jangan ubah unit_kerja_id. Jika ini program unit, biarkan tetap milik unit.
        ]);

        // Update target unit HANYA JIKA ini program Institusional (milik Superadmin)
        if ($program->unit_kerja_id === null) {
            if (isset($validated['targeted_unit_kerjas'])) {
                $program->targetedUnitKerjas()->sync($validated['targeted_unit_kerjas']);
            } else {
                $program->targetedUnitKerjas()->detach();
            }
        }

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

    public function cloneProgram(Request $request, SurveyProgram $program, ProgramCloningService $cloningService)
    {
        $cloningService->clone($program);
        return redirect()->route('superadmin.programs.index')->with('success', 'Program survei berhasil dikloning.');
    }

    public function showQuestionsPage(SurveyProgram $program)
    {
        $program->load(['questionSections' => function ($query) {
            $query->orderBy('order_column', 'asc')->withCount('questions');
        }]);
        return view('superadmin.programs.questions.index', compact('program'));
    }

    // ... method resource lainnya ...

    /**
     * Menampilkan Halaman Form Builder
     */
    public function editFields(SurveyProgram $program)
    {
        // Load field yang sudah ada, urutkan
        $program->load(['formFields' => function ($q) {
            $q->orderBy('order');
        }]);

        return view('superadmin.programs.builder', compact('program'));
    }

    /**
     * Menyimpan Susunan Form Field
     */
    public function updateFields(Request $request, SurveyProgram $program)
    {
        $data = $request->validate([
            'fields' => 'present|array',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.type' => 'required|in:text,number,date,select,radio',
            'fields.*.options' => 'nullable|string', // Opsi dipisah koma
            'fields.*.required' => 'nullable|boolean',
        ]);

        // Strategi: Hapus semua field lama, buat ulang yang baru (Full Sync)
        // Ini cara paling aman untuk menghindari konflik urutan/penghapusan
        $program->formFields()->delete();

        if (!empty($data['fields'])) {
            foreach ($data['fields'] as $index => $fieldData) {
                // Konversi opsi string "A, B, C" menjadi Array JSON ["A", "B", "C"]
                $optionsArray = null;
                if (in_array($fieldData['type'], ['select', 'radio']) && !empty($fieldData['options'])) {
                    $optionsArray = array_map('trim', explode(',', $fieldData['options']));
                }

                $program->formFields()->create([
                    'field_label' => $fieldData['label'],
                    'field_type' => $fieldData['type'],
                    'field_options' => $optionsArray,
                    'is_required' => isset($fieldData['required']) ? 1 : 0,
                    'order' => $index, // Simpan urutan sesuai array
                ]);
            }
        }

        return redirect()->back()->with('success', 'Formulir data diri berhasil diperbarui!');
    }
}