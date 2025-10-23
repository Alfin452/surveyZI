@extends('layouts.superadmin')

@section('content')
<div class="p-4 sm:p-6">

    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-indigo-500 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="{{ route('superadmin.dashboard') }}" class="hover:text-indigo-600">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.index') }}" class="hover:text-indigo-600">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Detail</span></li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 bg-indigo-500 text-white p-3 rounded-lg shadow-md"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg></div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">{{ $program->title }}</h1>
                        <p class="text-sm text-gray-500 mt-1">Detail program, target unit kerja, dan pelaksanaan survei.</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="{{ route('superadmin.programs.index') }}" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border">Kembali</a>
                <a href="{{ route('superadmin.programs.edit', $program) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">Edit Program</a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Detail & Statistik Program --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-lg font-semibold text-gray-800">Deskripsi</h3>
            <p class="mt-2 text-gray-600">{{ $program->description ?? 'Tidak ada deskripsi.' }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-lg font-semibold text-gray-800">Periode Program</h3>
            <p class="mt-2 text-gray-600">{{ $program->start_date->format('d M Y') }} - {{ $program->end_date->format('d M Y') }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-lg font-semibold text-gray-800">Status</h3>
            @if($program->is_active)
            <p class="mt-2 text-green-600 font-semibold">Aktif</p>
            @else
            <p class="mt-2 text-gray-600 font-semibold">Tidak Aktif</p>
            @endif
        </div>
    </div>

    {{-- Daftar Unit Kerja Target & Pelaksanaan --}}
    <div class="bg-white rounded-xl shadow-lg border p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Unit Kerja Target & Status Pelaksanaan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Kerja</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Status Pelaksanaan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($program->targetedUnitKerjas as $unit)
                    @php
                    $pelaksanaan = $program->surveys->firstWhere('unit_kerja_id', $unit->id);
                    @endphp
                    <tr>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">{{ $unit->uk_short_name }}</div>
                            <div class="text-sm text-gray-500">{{ $unit->unit_kerja_name }}</div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($pelaksanaan)
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Sudah Dibuat</span>
                            @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum Dibuat</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-3">
                                @if($pelaksanaan)
                                <a href="{{ route('superadmin.surveys.results', $pelaksanaan) }}" class="text-green-600 hover:text-green-800 font-medium" title="Lihat Hasil Survei">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                                    </svg>
                                </a>
                                <a href="{{ route('superadmin.surveys.show', $pelaksanaan) }}" class="text-blue-600 hover:text-blue-800 font-medium" title="Kelola Pertanyaan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('superadmin.surveys.edit', $pelaksanaan) }}" class="text-indigo-600 hover:text-indigo-800 font-medium" title="Edit Detail Pelaksanaan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.surveys.destroy', $pelaksanaan) }}', name: '{{ addslashes($pelaksanaan->title) }}' })" class="text-red-600 hover:text-red-800" title="Hapus Pelaksanaan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                    </svg>
                                </button>
                                @else
                                <a href="{{ route('superadmin.surveys.create', ['program' => $program->id, 'unit' => $unit->id]) }}" class="text-blue-600 hover:text-blue-800 font-medium">Buatkan Pelaksanaan</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-gray-500">Belum ada unit kerja yang ditargetkan untuk program ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection