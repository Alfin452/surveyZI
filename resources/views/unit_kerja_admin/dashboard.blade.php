@extends('layouts.unit_kerja_admin') {{-- Kita akan buat layout ini di langkah berikutnya --}}

@section('content')
<div class="p-4 sm:p-6">
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-teal-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-teal-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Dashboard Admin</h1>
                <p class="text-sm text-gray-500 mt-1">Selamat datang, <span class="font-semibold">{{ Auth::user()->username }}</span> dari <span class="font-semibold">{{ $unitKerja->unit_kerja_name ?? 'N/A' }}</span></p>
            </div>
        </div>
    </div>

    {{-- Konten dashboard akan ditambahkan di sini nanti --}}
    <div class="bg-white rounded-xl shadow-md p-8 text-center border-2 border-dashed">
        <p class="text-gray-600">Konten statistik dan ringkasan untuk unit kerja Anda akan ditampilkan di sini.</p>
    </div>
</div>
@endsection