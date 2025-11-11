<?php

namespace App\Policies;

use App\Models\SurveyProgram;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SurveyPolicy
{
    /**
     * Izinkan Super Admin untuk melakukan apa saja, kapan saja.
     */
    public function before(User $user, string $ability): bool|null
    {
        if (strtolower($user->role?->role_name) === 'superadmin') {
            return true;
        }
        return null; // Lanjutkan ke pemeriksaan aturan lain
    }

    /**
     * Tentukan apakah pengguna dapat melihat daftar program.
     */
    public function viewAny(User $user): bool
    {
        // Izinkan Super Admin (dari before()) dan Admin Unit Kerja
        return strtolower($user->role?->role_name) === 'admin';
    }

    /**
     * Tentukan apakah pengguna dapat melihat program survei tertentu.
     */
    public function view(User $user, SurveyProgram $program): bool
    {
        // Tipe 1 (Institusional): Boleh dilihat jika unitnya ditargetkan
        if ($program->unit_kerja_id === null) {
            return $program->targetedUnitKerjas->contains($user->unitKerja);
        }

        // Tipe 2 (Lokal): Boleh dilihat jika dia pemiliknya
        return $user->unit_kerja_id === $program->unit_kerja_id;
    }

    /**
     * Tentukan apakah pengguna dapat membuat program survei.
     */
    public function create(User $user): bool
    {
        // Super Admin (dari before()) dan Admin Unit Kerja boleh membuat.
        return strtolower($user->role?->role_name) === 'admin';
    }

    /**
     * Tentukan apakah pengguna dapat memperbarui program survei.
     */
    public function update(User $user, SurveyProgram $program): bool
    {
        // Admin Unit Kerja hanya bisa mengedit program Tipe 2 milik mereka sendiri.
        // Super Admin sudah ditangani oleh before().
        return $user->unit_kerja_id === $program->unit_kerja_id;
    }

    /**
     * Tentukan apakah pengguna dapat menghapus program survei.
     */
    public function delete(User $user, SurveyProgram $program): bool
    {
        // Aturan sama seperti 'update'
        return $user->unit_kerja_id === $program->unit_kerja_id;
    }
}
