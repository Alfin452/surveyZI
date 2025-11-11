@extends('layouts.unit_kerja_admin')

@section('content')
<div class="p-4 sm:p-6" x-data="{ activeTab: 'institusional' }">

    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-teal-500 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 bg-teal-500 text-white p-3 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Program Survei</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola program yang ditugaskan dan program yang Anda buat.</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('unitkerja.admin.my-programs.create') }}" class="mt-4 md:mt-0 bg-teal-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-teal-700 transition duration-300 shadow-md flex items-center space-x-2 self-start md:self-end">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Buat Program Baru</span>
            </a>
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

    {{-- Navigasi Tab --}}
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                <button @click="activeTab = 'institusional'"
                    :class="activeTab === 'institusional' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Program Institusional
                    <span class="ml-1.5 rounded-full {{ $institutionalPrograms->count() > 0 ? 'bg-teal-100 text-teal-700' : 'bg-gray-100 text-gray-500' }} py-0.5 px-2 text-xs">{{ $institutionalPrograms->count() }}</span>
                </button>
                <button @click="activeTab = 'myPrograms'"
                    :class="activeTab === 'myPrograms' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Program Unit Saya
                    <span class="ml-1.5 rounded-full {{ $myPrograms->total() > 0 ? 'bg-teal-100 text-teal-700' : 'bg-gray-100 text-gray-500' }} py-0.5 px-2 text-xs">{{ $myPrograms->total() }}</span>
                </button>
            </nav>
        </div>
    </div>

    {{-- Konten Tab --}}
    <div>
        {{-- TAB 1: Program Institusional (Tipe 1) --}}
        <div x-show="activeTab === 'institusional'" x-transition>
            <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Program</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($institutionalPrograms as $program)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $program->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($program->description, 80) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $program->start_date?->format('d M Y') ?? 'N/A' }} - {{ $program->end_date?->format('d M Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <a href="{{ route('unitkerja.admin.programs.results', $program) }}" class="inline-block bg-teal-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-teal-600 transition">
                                    Lihat Hasil
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 px-4 text-gray-500">
                                Belum ada program institusional yang ditugaskan untuk Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TAB 2: Program Unit Saya (Tipe 2) --}}
        <div x-show="activeTab === 'myPrograms'" x-transition>
            <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Program</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($myPrograms as $program)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <a href="{{ route('unitkerja.admin.programs.questions.index', $program) }}" class="font-semibold text-indigo-600 hover:text-indigo-800">{{ $program->title }}</a>
                                <div class="text-sm text-gray-500">{{ Str::limit($program->description, 80) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($program->is_active)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $program->start_date?->format('d M Y') ?? 'N/A' }} - {{ $program->end_date?->format('d M Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('unitkerja.admin.programs.results', $program) }}" class="text-green-600 hover:text-green-800" title="Lihat Hasil">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('unitkerja.admin.programs.questions.index', $program) }}" class="text-blue-600 hover:text-blue-800" title="Kelola Pertanyaan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('unitkerja.admin.my-programs.edit', $program) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit Program">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('unitkerja.admin.my-programs.clone', $program) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengkloning program ini?');">
                                        @csrf
                                        <button type="submit" class="text-gray-500 hover:text-gray-700" title="Kloning Program">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('unitkerja.admin.my-programs.destroy', $program) }}', name: '{{ addslashes($program->title) }}' })" class="text-red-600 hover:text-red-800" title="Hapus Program">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 px-4 text-gray-500">
                                Anda belum membuat program survei sendiri.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                {{ $myPrograms->links() }}
            </div>
        </div>
    </div>
</div>
@endsection