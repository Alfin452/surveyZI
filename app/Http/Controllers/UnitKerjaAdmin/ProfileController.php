<?php

namespace App\Http\Controllers\UnitKerjaAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UnitKerja;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil unit kerja.
     */
    public function edit()
    {
        // Ambil unit kerja yang terkait dengan admin yang sedang login
        $unitKerja = Auth::user()->unitKerja;

        if (!$unitKerja) {
            // Jika admin tidak terikat pada unit kerja, kembalikan ke dashboard
            return redirect()->route('unitkerja.admin.dashboard')->with('error', 'Akun Anda tidak terikat pada unit kerja.');
        }

        return view('unit_kerja_admin.profile.edit', compact('unitKerja'));
    }

    public function update(Request $request)
    {
        $unitKerja = Auth::user()->unitKerja;

        if (!$unitKerja) {
            return redirect()->route('unitkerja.admin.dashboard')->with('error', 'Akun Anda tidak terikat pada unit kerja.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'start_time' => 'nullable|string|max:100', 
            'end_time' => 'nullable|string|max:100',   
        ]);

        // Update data
        $unitKerja->update($validatedData);

        return redirect()->route('unitkerja.admin.profile.edit')->with('success', 'Profil Unit Kerja berhasil diperbarui.');
    }
}
