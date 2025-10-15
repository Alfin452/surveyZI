<?php

    namespace App\Http\Controllers\UnitKerjaAdmin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class DashboardController extends Controller
    {
        /**
         * Menampilkan halaman dashboard untuk Admin Unit Kerja.
         */
        public function index()
        {
            // Untuk saat ini, kita hanya akan menampilkan view.
            // Nanti kita bisa menambahkan logika untuk mengambil data statistik.
            return view('unit_kerja_admin.dashboard');
        }
    }
