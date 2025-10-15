    @extends('layouts.superadmin')

    @section('content')
    <div class="p-4 sm:p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Super Admin</h1>
            <p class="text-gray-500 mt-1">Selamat datang kembali, {{ Auth::user()->username }}!</p>
        </div>

        {{-- Konten dashboard akan ditambahkan di sini nanti --}}
        <div class="bg-white rounded-xl shadow-md p-8 text-center border-2 border-dashed">
            <p class="text-gray-600">Konten statistik dan ringkasan akan ditampilkan di sini.</p>
        </div>
    </div>
    @endsection