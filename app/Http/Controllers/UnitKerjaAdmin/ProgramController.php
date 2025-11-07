<?php

    namespace App\Http\Controllers\UnitKerjaAdmin;

    use App\Http\Controllers\Controller;
    use App\Models\SurveyProgram;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class ProgramController extends Controller
    {
        /**
         * Menampilkan daftar "Program Survei" (Wadah) yang ditargetkan
         * ke unit kerja dari admin yang sedang login.
         */
        public function index()
        {
            $user = Auth::user();

            // Ambil unit kerja yang terkait dengan admin ini
            $unitKerja = $user->unitKerja;

            // Jika admin tidak terikat ke unit kerja, jangan tampilkan apa-apa
            if (!$unitKerja) {
                $programs = collect(); // Koleksi kosong
            } else {
                // Ambil hanya program yang aktif dan menargetkan unit kerja ini
                $programs = SurveyProgram::where('is_active', true)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->whereHas('targetedUnitKerjas', function ($query) use ($unitKerja) {
                        $query->where('unit_kerja_id', $unitKerja->id);
                    })
                    ->latest()
                    ->paginate(10);
            }

            return view('unit_kerja_admin.programs.index', compact('programs'));
        }
    }
