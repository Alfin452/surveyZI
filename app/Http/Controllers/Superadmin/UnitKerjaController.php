<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\UnitKerja;
use App\Models\TipeUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UnitKerjaController extends Controller
{
    /**
     * Menampilkan daftar semua Unit Kerja.
     */
    public function index(Request $request)
    {
        $tipeUnits = TipeUnit::orderBy('nama_tipe_unit')->get();
        $parentUnits = UnitKerja::whereNull('parent_id')->orderBy('unit_kerja_name')->get();

        $query = UnitKerja::with(['tipeUnit', 'parent'])
            ->withCount(['users', 'children'])
            ->filter($request->only('search', 'type', 'parent'));

        $unitKerja = $query->latest()->paginate(10)->withQueryString();

        return view('superadmin.unit_kerja.index', compact('unitKerja', 'tipeUnits', 'parentUnits'));
    }

    /**
     * Menampilkan form untuk membuat Unit Kerja baru.
     */
    public function create()
    {
        $unitKerja = new UnitKerja();
        $tipeUnits = TipeUnit::all();
        $parentUnits = UnitKerja::whereNull('parent_id')->get();
        return view('superadmin.unit_kerja.create', compact('unitKerja', 'tipeUnits', 'parentUnits'));
    }

    /**
     * Menyimpan Unit Kerja baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_kerja_name' => 'required|string|max:255|unique:unit_kerjas,unit_kerja_name',
            'uk_short_name' => 'nullable|string|max:50',
            'tipe_unit_id' => 'required|exists:tipe_units,id',
            'parent_id' => 'nullable|exists:unit_kerjas,id',
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
        ]);

        UnitKerja::create($validated + ['alias' => Str::slug($validated['unit_kerja_name'])]);

        return redirect()->route('superadmin.unit-kerja.index')->with('success', 'Unit Kerja berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit Unit Kerja.
     */
    public function edit(UnitKerja $unitKerja)
    {
        $tipeUnits = TipeUnit::all();
        $parentUnits = UnitKerja::whereNull('parent_id')->where('id', '!=', $unitKerja->id)->get();
        return view('superadmin.unit_kerja.edit', compact('unitKerja', 'tipeUnits', 'parentUnits'));
    }

    /**
     * Memperbarui Unit Kerja di database.
     */
    public function update(Request $request, UnitKerja $unitKerja)
    {
        $validated = $request->validate([
            'unit_kerja_name' => ['required', 'string', 'max:255', Rule::unique('unit_kerjas')->ignore($unitKerja->id)],
            'uk_short_name' => 'nullable|string|max:50',
            'tipe_unit_id' => 'required|exists:tipe_units,id',
            'parent_id' => 'nullable|exists:unit_kerjas,id',
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
        ]);

        $unitKerja->update($validated + ['alias' => Str::slug($validated['unit_kerja_name'])]);

        return redirect()->route('superadmin.unit-kerja.index')->with('success', 'Unit Kerja berhasil diperbarui.');
    }

    /**
     * Menghapus Unit Kerja.
     */
    public function destroy(UnitKerja $unitKerja)
    {
        // Pengecekan keamanan: jangan hapus jika masih memiliki sub-unit atau pengguna
        if ($unitKerja->children()->exists() || $unitKerja->users()->exists()) {
            return back()->with('error', 'Unit Kerja tidak dapat dihapus karena masih memiliki sub-unit atau pengguna terkait.');
        }

        $unitKerja->delete();

        return redirect()->route('superadmin.unit-kerja.index')->with('success', 'Unit Kerja berhasil dihapus.');
    }
}
