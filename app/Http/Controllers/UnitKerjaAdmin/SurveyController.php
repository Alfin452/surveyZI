<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SurveyController extends Controller
{
    use AuthorizesRequests;

    /**
     * DITAMBAHKAN: Menampilkan daftar survei pelaksanaan yang sudah dibuat oleh unit kerja ini.
     * Ini adalah halaman untuk menu "Pelaksanaan Saya".
     */
    public function index()
    {
        $user = Auth::user();

        $surveys = Survey::where('unit_kerja_id', $user->unit_kerja_id)
            ->with('surveyProgram')
            ->latest()
            ->paginate(10);

        return view('unit_kerja_admin.surveys.index', compact('surveys'));
    }

    /**
     * Menampilkan form untuk membuat survei pelaksanaan baru dari sebuah program.
     */
    public function create(Request $request)
    {
        $program = SurveyProgram::findOrFail($request->query('program'));
        $unitKerja = Auth::user()->unitKerja;

        if (!$program->targetedUnitKerjas->contains($unitKerja)) {
            abort(403, 'Akses ditolak.');
        }

        $survey = new Survey([
            'title' => $program->title . ' - ' . $unitKerja->unit_kerja_name,
            'description' => $program->description,
            'start_date' => $program->start_date,
            'end_date' => $program->end_date,
        ]);

        $this->authorize('create', Survey::class);

        return view('unit_kerja_admin.surveys.create', compact('survey', 'program'));
    }

    /**
     * Menyimpan survei pelaksanaan baru ke database.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Survey::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
            'survey_program_id' => 'required|exists:survey_programs,id',
        ]);

        $user = Auth::user();

        $survey = Survey::create($validated + [
            'unit_kerja_id' => $user->unit_kerja_id
        ]);

        // DIUBAH: Arahkan langsung ke halaman Kelola Pertanyaan setelah dibuat
        return redirect()->route('unitkerja.admin.surveys.show', $survey)
            ->with('success', 'Survei pelaksanaan berhasil dibuat. Sekarang Anda bisa menambahkan pertanyaan.');
    }

    /**
     * DITAMBAHKAN: Menampilkan halaman kelola pertanyaan untuk survei pelaksanaan.
     */
    public function show(Survey $survey)
    {
        $this->authorize('view', $survey);

        $survey->load('questions.options');
        return view('unit_kerja_admin.surveys.show', compact('survey'));
    }

    /**
     * DITAMBAHKAN: Menampilkan form untuk mengedit survei pelaksanaan.
     */
    public function edit(Survey $survey)
    {
        $this->authorize('update', $survey);

        $survey->load('surveyProgram');
        $program = $survey->surveyProgram;
        return view('unit_kerja_admin.surveys.edit', compact('survey', 'program'));
    }

    /**
     * DITAMBAHKAN: Memperbarui survei pelaksanaan di database.
     */
    public function update(Request $request, Survey $survey)
    {
        $this->authorize('update', $survey);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'nullable|boolean',
            'requires_pre_survey' => 'nullable|boolean',
        ]);

        $survey->update($validated);

        // DIUBAH: Arahkan kembali ke halaman Kelola Pertanyaan setelah update
        return redirect()->route('unitkerja.admin.surveys.show', $survey)
            ->with('success', 'Survei pelaksanaan berhasil diperbarui.');
    }

    /**
     * DITAMBAHKAN: Menghapus survei pelaksanaan.
     */
    public function destroy(Survey $survey)
    {
        $this->authorize('delete', $survey);

        $survey->delete();

        // DIUBAH: Arahkan kembali ke halaman daftar pelaksanaan
        return redirect()->route('unitkerja.admin.surveys.index')
            ->with('success', 'Survei pelaksanaan berhasil dihapus.');
    }
}
