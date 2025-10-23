@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-indigo-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-indigo-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Dashboard Super Admin</h1>
                <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, {{ Auth::user()->username }}!</p>
            </div>
        </div>
    </div>

    {{-- Konten Dashboard: Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Kartu 1: Program Survei -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-indigo-100 to-indigo-200 text-indigo-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Program</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPrograms }}</p>
                </div>
            </div>
            <a href="{{ route('superadmin.programs.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 mt-4 inline-block">
                Kelola Program &rarr;
            </a>
        </div>

        <!-- Kartu 2: Pelaksanaan Survei -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pelaksanaan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPelaksanaan }}</p>
                </div>
            </div>
            <a href="{{ route('superadmin.programs.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 mt-4 inline-block">
                Lihat Detail Pelaksanaan &rarr;
            </a>
        </div>

        <!-- Kartu 3: Unit Kerja -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-green-100 to-green-200 text-green-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Unit Kerja</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUnitKerja }}</p>
                </div>
            </div>
            <a href="{{ route('superadmin.unit-kerja.index') }}" class="text-sm font-medium text-green-600 hover:text-green-800 mt-4 inline-block">
                Kelola Unit Kerja &rarr;
            </a>
        </div>

        <!-- Kartu 4: Pengguna -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.125-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                </div>
            </div>
            <a href="{{ route('superadmin.users.index') }}" class="text-sm font-medium text-yellow-700 hover:text-yellow-900 mt-4 inline-block">
                Kelola Pengguna &rarr;
            </a>
        </div>

    </div>
</div>
@endsection