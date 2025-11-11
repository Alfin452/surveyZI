@extends('layouts.superadmin')

@section('content')
    {{-- Header --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm flex items-start gap-3">
        <div class="flex-shrink-0 bg-gray-800 text-white p-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </div>
        <div>
            <h1 class="text-xl font-bold text-gray-800">Dashboard Super Admin</h1>
            <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, {{ Auth::user()->username }}!</p>
        </div>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Program Survei -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
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

        <!-- Unit Kerja -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
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

        <!-- Pengguna -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-yellow-100 to-yellow-200 text-yellow-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
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

        <!-- Total Responden -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600 p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Responden</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalRespondents ?? 0 }}</p>
                </div>
            </div>
            <a href="{{ route('superadmin.programs.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 mt-4 inline-block">
                Lihat Hasil Survei &rarr;
            </a>
        </div>

    </div>

@endsection