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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                {{-- PERBAIKAN: Menyamakan font size 'text-xl' --}}
                <h1 class="text-xl font-bold text-gray-800">Program Survei Tersedia</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar program survei dari pusat yang ditugaskan untuk unit Anda.</p>
            </div>
        </div>
    </div>

    {{-- PERBAIKAN: Notifikasi @if(session(...)) dihapus dari sini (diasumsikan sudah ada di layout) --}}

    {{-- Tabel Program Survei --}}
    {{-- PERBAIKAN: Menyamakan style card (radius, shadow) --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            {{-- PERBAIKAN: Mengubah thead bg-gray-50 menjadi bg-teal-50 --}}
            <thead class="bg-teal-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Program</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode Program</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($programs as $program)
                <tr class="hover:bg-teal-50/50 transition-colors duration-200">
                    {{-- PERBAIKAN: Menambahkan 'align-middle' --}}
                    <td class="px-6 py-4 align-middle">
                        <div class="font-semibold text-gray-900">{{ $program->title }}</div>
                        <div class="text-sm text-gray-500">{{ Str::limit($program->description, 80) }}</div>
                    </td>
                    {{-- PERBAIKAN: Menambahkan 'align-middle' --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 align-middle">
                        {{ $program->start_date?->format('d M Y') ?? 'N/A' }} - {{ $program->end_date?->format('d M Y') ?? 'N/A' }}
                    </td>
                    {{-- PERBAIKAN: Menambahkan 'align-middle' --}}
                    <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    </td>
                    {{-- PERBAIKAN: Menambahkan 'align-middle' --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
                        <a href="{{ route('unitkerja.admin.programs.results', $program) }}" class="inline-block bg-teal-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-teal-600 transition shadow-sm">
                            Lihat Hasil
                        </a>
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
                            <p class="text-sm mt-1">Saat ini tidak ada program survei yang ditugaskan untuk unit kerja Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PERBAIKAN: Menyamakan margin pagination --}}
    <div class="mt-6">
        {{ $programs->links() }}
    </div>
</div>
@endsection