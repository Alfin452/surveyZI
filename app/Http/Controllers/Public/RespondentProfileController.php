<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\UnitKerja;
use App\Models\Answer;
use App\Models\User; // DITAMBAHKAN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // DITAMBAHKAN

class RespondentProfileController extends Controller
{
    /**
     * Menampilkan halaman "Profil Saya".
     */
    public function showProfile()
    {
        $user = Auth::user();

        // Ambil data profil dari tabel users
        $profileData = [
            'full_name' => $user->username, // Asumsi nama ada di 'username'
            'gender' => $user->gender,
            'age' => $user->age,
            'status' => $user->jenis_responden,
            'unit_kerja_or_fakultas' => $user->asal_responden,
        ];

        // Jika profil masih kosong, coba ambil dari isian pra-survei terakhir
        if (empty($user->jenis_responden)) {
            // Kita perlu menambahkan relasi 'preSurveyResponses' ke model User
            $lastPreSurvey = $user->preSurveyResponses()->latest()->first();
            if ($lastPreSurvey) {
                $profileData['full_name'] = $lastPreSurvey->full_name;
                $profileData['gender'] = $lastPreSurvey->gender;
                $profileData['age'] = $lastPreSurvey->age;
                $profileData['status'] = $lastPreSurvey->status;
                $profileData['unit_kerja_or_fakultas'] = $lastPreSurvey->unit_kerja_or_fakultas;
            }
        }

        $jenisRespondenList = [
            'Mahasiswa',
            'Dosen',
            'Tenaga Kependidikan',
            'Alumni',
            'Masyarakat Umum',
            'Mitra Kerjasama'
        ];

        return view('public.profile.show', compact('user', 'profileData', 'jenisRespondenList'));
    }

    /**
     * Memperbarui data profil responden di tabel 'users'.
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'full_name'                 => 'required|string|max:255',
            'gender'                    => 'required|string|in:Laki-laki,Perempuan',
            'age'                       => 'required|integer|min:15|max:100',
            'status'                    => 'required|string|max:255',
            'unit_kerja_or_fakultas'    => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $user->update([
            'username' => $validated['full_name'], // Update nama default
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'jenis_responden' => $validated['status'],
            'asal_responden' => $validated['unit_kerja_or_fakultas'],
        ]);

        return redirect()->route('public.profile')->with('success', 'Profil Anda berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman "Riwayat Survei".
     */
    public function showHistory()
    {
        $user = Auth::user();

        // Ambil daftar unik dari survei yang telah diisi oleh pengguna
        $responses = Answer::where('user_id', $user->id)
            ->with('surveyProgram', 'unitKerja')
            ->select('survey_program_id', 'unit_kerja_id', DB::raw('MAX(created_at) as completed_at'))
            ->distinct()
            ->groupBy('survey_program_id', 'unit_kerja_id')
            ->latest('completed_at')
            ->paginate(10);

        return view('public.profile.history', compact('responses'));
    }
}
