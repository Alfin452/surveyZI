@extends('layouts.unit_kerja_admin')

@section('content')
<div class="p-4 sm:p-6">

    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-teal-500 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 bg-teal-500 text-white p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Program Survei Tersedia</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar program survei dari pusat yang ditugaskan untuk unit Anda.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Tabel Program Survei --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Program</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode Program</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pelaksanaan Anda</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($programs as $program)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $program->title }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($program->description, 80) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        {{ $program->start_date?->format('d M Y') ?? 'N/A' }} - {{ $program->end_date?->format('d M Y') ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        {{-- surveys_count di sini adalah hasil dari withCount yang sudah difilter di controller --}}
                        @if($program->surveys_count > 0)
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sudah Dibuat</span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum Dibuat</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        @if($program->surveys_count > 0)
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">Lihat/Edit Pelaksanaan</a>
                        @else
                        <a href="#" class="inline-block bg-teal-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-teal-600 transition">Buat Pelaksanaan</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12 px-4">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="mt-4 font-semibold text-gray-600">Belum Ada Program Survei</p>
                            <p class="text-gray-500 text-sm mt-1">Saat ini tidak ada program survei yang ditugaskan untuk unit kerja Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $programs->links() }}
    </div>
</div>
@endsection