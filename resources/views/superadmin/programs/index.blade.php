@extends('layouts.superadmin')

@section('content')

{{-- Header Halaman --}}
<div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 bg-indigo-500 text-white p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Manajemen Program Survei</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola "wadah" survei terpusat dan pertanyaannya di sini.</p>
            </div>
        </div>

        <a href="{{ route('superadmin.programs.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition-colors duration-200 flex items-center justify-center gap-2 justify-self-start md:justify-self-end w-full md:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            <span>Buat Program Baru</span>
        </a>
    </div>
</div>

{{-- Tabel Program Survei --}}
<div class="bg-white rounded-lg border border-gray-200 overflow-x-auto shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-indigo-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Judul Program</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Program</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Statistik</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($programs as $program)
            <tr class="hover:bg-gray-50 transition-colors duration-200">

                <td class="px-6 py-4 align-middle">
                    <a href="{{ route('superadmin.programs.questions.index', $program) }}" class="font-semibold text-indigo-600 hover:text-indigo-800">{{ $program->title }}</a>
                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit($program->description, 80) }}</div>
                </td>

                {{-- PERUBAHAN: whitespace-nowrap dihapus dari sini --}}
                <td class="px-6 py-4 align-middle">
                    @if ($program->unit_kerja_id === null)
                    <span class="font-semibold text-indigo-600">Institusional</span>
                    <div class="text-xs text-gray-500">{{ $program->targeted_unit_kerjas_count }} Unit Target</div>
                    @else
                    <span class="font-semibold text-teal-600">Lokal</span>
                    <div class="text-xs text-gray-500">Pemilik: {{ $program->unitKerja->uk_short_name ?? 'N/A' }}</div>
                    @endif
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                    @if($program->is_active)
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>
                    @endif
                    @if($program->is_featured)
                    <span class="mt-1 px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Unggulan</span>
                    @endif
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-middle">
                    <div class="text-center">
                        <p class="font-bold text-gray-800">{{ $program->question_sections_count }}</p>
                        <p class="text-xs">Bagian Soal</p>
                    </div>
                </td>

                {{-- PERUBAHAN: whitespace-nowrap TETAP ada di sini --}}
                <td class="px-6 py-4 text-sm text-gray-700 align-middle whitespace-nowrap">
                    {{ $program->start_date?->format('d M Y') ?? 'N/A' }} - {{ $program->end_date?->format('d M Y') ?? 'N/A' }}
                </td>

                <td class="px-6 py-4 align-middle">
                    <div class="flex flex-col items-center space-y-2">
                        <a href="{{ route('superadmin.programs.results', $program) }}" class="w-full bg-green-300 text-green-800 px-4 py-2 rounded-md text-xs font-medium hover:bg-green-200 transition-colors text-center" title="Lihat Hasil Survei">
                            Lihat Hasil
                        </a>
                        <a href="{{ route('superadmin.programs.questions.index', $program) }}" class="w-full bg-blue-300 text-blue-800 px-4 py-2 rounded-md text-xs font-medium hover:bg-blue-200 transition-colors text-center" title="Kelola Pertanyaan">
                            Pertanyaan
                        </a>
                        <a href="{{ route('superadmin.programs.edit', $program) }}" class="w-full bg-indigo-300 text-indigo-800 px-4 py-2 rounded-md text-xs font-medium hover:bg-indigo-200 transition-colors text-center" title="Edit Program">
                            Edit
                        </a>
                        <button type="button"
                            @click="$dispatch('open-clone-modal', { url: '{{ route('superadmin.programs.clone', $program) }}', name: '{{ addslashes($program->title) }}' })"
                            class="w-full bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-xs font-medium hover:bg-gray-200 transition-colors text-center"
                            title="Kloning Program">
                            Kloning
                        </button>
                        <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.programs.destroy', $program) }}', name: '{{ addslashes($program->title) }}' })" class="w-full bg-red-300 text-red-800 px-4 py-2 rounded-md text-xs font-medium hover:bg-red-200 transition-colors text-center" title="Hapus Program">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-12 px-6">
                    <div class="space-y-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <div>
                            <p class="font-medium text-gray-600">Belum Ada Program Survei</p>
                            <p class="text-sm text-gray-500">Klik tombol "Buat Program Baru" untuk memulai.</p>
                        </div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($programs->hasPages())
<div class="flex justify-center mt-6">
    {{ $programs->links() }}
</div>
@endif
@endsection