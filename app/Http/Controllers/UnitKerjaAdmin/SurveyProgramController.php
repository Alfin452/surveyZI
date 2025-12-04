<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\ProgramCloningService;

class SurveyProgramController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $unitKerja = Auth::user()->unitKerja;

        // 1. Program Institusional (Dari Pusat untuk Unit ini)
        $institutionalPrograms = SurveyProgram::where('is_active', true)
            ->whereNull('unit_kerja_id') // Program milik pusat
            ->whereHas('targetedUnitKerjas', function ($q) use ($unitKerja) {
                $q->where('unit_kerja_id', $unitKerja->id);
            })
            ->latest()
            ->get();

        // 2. Program Mandiri (Dibuat oleh Unit ini)
        $myPrograms = SurveyProgram::where('unit_kerja_id', $unitKerja->id)
            ->withCount(['questions', 'questionSections'])
            ->latest()
            ->paginate(10);

        return view('unit_kerja_admin.programs.index', compact('institutionalPrograms', 'myPrograms'));
    }

    public function create()
    {
        $program = new SurveyProgram();
        return view('unit_kerja_admin.programs.create', compact('program'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'requires_pre_survey' => 'boolean',
        ]);

        $unitKerja = Auth::user()->unitKerja;

        // Buat Program
        $program = SurveyProgram::create([
            'unit_kerja_id' => $unitKerja->id, // SET KEPEMILIKAN (Milik Unit)
            'title' => $validated['title'],
            'alias' => Str::slug($validated['title']) . '-' . Str::random(5),
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
            'is_featured' => false, // Program unit tidak bisa set featured sendiri
        ]);

        // --- SOLUSI MASALAH #2 (PENTING) ---
        // Otomatis masukkan unit kerja ini sebagai TARGET sasaran programnya sendiri.
        // Tanpa baris ini, program tidak akan muncul di halaman "Pilih Unit Layanan" di frontend.
        $program->targetedUnitKerjas()->attach($unitKerja->id);

        return redirect()->route('unitkerja.admin.programs.questions.index', $program)
            ->with('success', 'Program survei berhasil dibuat.');
    }

    public function edit(SurveyProgram $program)
    {
        $this->authorize('update', $program);
        return view('unit_kerja_admin.programs.edit', compact('program'));
    }

    public function update(Request $request, SurveyProgram $program)
    {
        $this->authorize('update', $program);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'requires_pre_survey' => 'boolean',
        ]);

        $program->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            // 'alias' => ... (Opsional: mau update slug atau tidak)
            'is_active' => $request->boolean('is_active'),
            'requires_pre_survey' => $request->boolean('requires_pre_survey'),
        ]);

        // Safety Check: Pastikan target unit tetap ada saat update
        if ($program->targetedUnitKerjas()->count() == 0) {
            $program->targetedUnitKerjas()->attach($program->unit_kerja_id);
        }

        return redirect()->route('unitkerja.admin.programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(SurveyProgram $program)
    {
        $this->authorize('delete', $program);

        if ($program->answers()->exists()) {
            return back()->with('error', 'Program tidak dapat dihapus karena sudah ada data jawaban.');
        }

        $program->delete();
        return redirect()->route('unitkerja.admin.programs.index')->with('success', 'Program berhasil dihapus.');
    }

    public function cloneProgram(Request $request, SurveyProgram $program, ProgramCloningService $cloningService)
    {
        // Cek Policy (pastikan admin boleh mengkloning program ini)
        $this->authorize('view', $program);

        $newProgram = $cloningService->clone($program);

        $unitKerja = Auth::user()->unitKerja;
        if ($unitKerja) {
            $newProgram->update(['unit_kerja_id' => $unitKerja->id]);
            $newProgram->targetedUnitKerjas()->sync([$unitKerja->id]);
        }

        // Redirect ke Index Admin Unit (Bukan Superadmin)
        return redirect()->route('unitkerja.admin.programs.index')->with('success', 'Program berhasil dikloning.');
    }

    public function showQuestionsPage(SurveyProgram $program)
    {
        $this->authorize('view', $program);
        $program->load(['questionSections' => function ($query) {
            $query->orderBy('order_column', 'asc')->withCount('questions');
        }]);
        return view('unit_kerja_admin.programs.questions.index', compact('program'));
    }

    public function editFields(SurveyProgram $program)
    {
        // PERBAIKAN: Definisikan $user atau $unitKerja terlebih dahulu
        $user = Auth::user();

        // 1. Validasi Kepemilikan (Security)
        // Pastikan program ini milik unit kerja dari user yang sedang login
        if ($program->unit_kerja_id !== $user->unit_kerja_id) {
            abort(403, 'Akses ditolak. Program ini bukan milik unit kerja Anda.');
        }

        // 2. Load fields yang sudah ada, urutkan berdasarkan 'order'
        $program->load(['formFields' => function ($q) {
            $q->orderBy('order');
        }]);

        // 3. Tampilkan View Builder (Pastikan view ini sudah Anda buat di langkah sebelumnya)
        return view('unit_kerja_admin.programs.builder', compact('program'));
    }

    /**
     * Menyimpan Perubahan Field Pre-Survey (Unit Kerja Admin)
     */
    public function updateFields(Request $request, SurveyProgram $program)
    {
        $user = Auth::user();

        // 1. Validasi Kepemilikan
        if ($program->unit_kerja_id !== $user->unit_kerja_id) {
            abort(403, 'Akses ditolak. Program ini bukan milik unit kerja Anda.');
        }

        // 2. Validasi Input
        $data = $request->validate([
            'fields' => 'present|array',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.key' => 'nullable|string|max:255', // [BARU] Validasi Key
            'fields.*.type' => 'required|in:text,number,date,select,radio',
            'fields.*.max_length' => 'nullable|integer', // [BARU] Validasi Max Length
            'fields.*.options' => 'nullable|string',
            'fields.*.required' => 'nullable|boolean',
            'requires_pre_survey' => 'boolean',
        ]);

        // 3. Full Sync Fields
        $program->formFields()->delete();

        if (!empty($data['fields'])) {
            foreach ($data['fields'] as $index => $fieldData) {

                // Konversi opsi string ke Array JSON
                $optionsArray = null;
                if (in_array($fieldData['type'], ['select', 'radio']) && !empty($fieldData['options'])) {
                    $optionsArray = array_map('trim', explode(',', $fieldData['options']));
                }

                $program->formFields()->create([
                    'field_label'   => $fieldData['label'],

                    // Gunakan Str::slug sebagai fallback jika key kosong
                    'field_key'     => $fieldData['key'] ?? Str::slug($fieldData['label'], '_'),

                    'field_type'    => $fieldData['type'],

                    // Simpan Max Length
                    'max_length'    => $fieldData['max_length'] ?? null,

                    'field_options' => $optionsArray,
                    'is_required'   => isset($fieldData['required']) ? 1 : 0,
                    'order'         => $index,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Formulir data diri berhasil diperbarui!');
    }
}
