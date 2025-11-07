@extends('layouts.unit_kerja_admin')

@section('content')
{{-- PERBAIKAN: Menyamakan padding 'p-2 space-y-6' --}}
<div class="space-y-2">

    {{-- Header Halaman --}}
    {{-- PERBAIKAN: Menyamakan style header card (padding, border, radius, shadow) --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex items-start gap-3">

            {{-- PERBAIKAN: Menyamakan ikon (padding, size) --}}
            <div class="flex-shrink-0 bg-teal-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
            <div>
                {{-- PERBAIKAN: Menyamakan font size 'text-xl' --}}
                <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Selamat datang, <span class="font-semibold">{{ Auth::user()->username }}</span>!</p>
                <p class="text-sm text-gray-500">Anda mengelola: <span class="font-semibold">{{ $unitKerja->unit_kerja_name ?? 'N/A' }}</span></p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-teal-100 to-teal-200 text-teal-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Program Ditugaskan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPrograms }}</p>
                </div>
            </div>
            <a href="{{ route('unitkerja.admin.programs.index') }}" class="text-sm font-medium text-teal-600 hover:text-teal-800 mt-4 inline-block">
                Lihat Program &rarr;
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Responden Anda</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalResponden }}</p>
                </div>
            </div>
            <a href="{{ route('unitkerja.admin.programs.index') }}" class="text-sm font-medium text-yellow-700 hover:text-yellow-900 mt-4 inline-block">
                Lihat Hasil Survei &rarr;
            </a>
        </div>

    </div>
</div>
@endsection