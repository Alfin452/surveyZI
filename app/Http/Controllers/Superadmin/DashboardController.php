<?php

    namespace App\Http\Controllers\Superadmin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class DashboardController extends Controller
    {
        /**
         * Menampilkan halaman dashboard untuk Super Admin.
         */
        public function index()
        {
            // Untuk saat ini, kita hanya akan menampilkan view.
            // Nanti kita bisa menambahkan logika untuk mengambil data statistik.
            return view('superadmin.dashboard');
        }
    }
