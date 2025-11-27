@extends('layouts.unit_kerja_admin')

@section('content')
{{-- Background Aurora --}}
<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-teal-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-cyan-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-8" x-data="{ activeTab: 'institusional' }">

    {{-- 1. Hero Header --}}
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-teal-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500/5 via-emerald-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Spiral%20Notepad.png" alt="Program Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Program Survei</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">Kelola program yang ditugaskan dan program mandiri unit Anda.</p>
                </div>
            </div>

            <a href="{{ route('unitkerja.admin.my-programs.create') }}"
                class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-500 hover:to-emerald-500 text-white rounded-xl font-bold shadow-lg hover:shadow-teal-500/30 hover:-translate-y-1 transition-all duration-300 text-sm">
                <div class="bg-white/20 p-1 rounded-lg group-hover:rotate-90 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span>Buat Program Baru</span>
            </a>
        </div>
    </div>

    {{-- 2. Tab Navigation --}}
    <div class="bg-white/40 backdrop-blur-md p-1.5 rounded-2xl inline-flex items-center gap-2 border border-white/40 shadow-sm">
        <button @click="activeTab = 'institusional'"
            :class="activeTab === 'institusional' ? 'bg-white text-teal-700 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-700 font-medium'"
            class="px-5 py-2.5 rounded-xl text-sm transition-all duration-200 flex items-center gap-2">
            <span>Program Institusional</span>
            <span :class="activeTab === 'institusional' ? 'bg-teal-100 text-teal-600' : 'bg-slate-200/50 text-slate-500'"
                class="px-2 py-0.5 rounded-md text-xs font-bold transition-colors">
                {{ $institutionalPrograms->count() }}
            </span>
        </button>
        <button @click="activeTab = 'myPrograms'"
            :class="activeTab === 'myPrograms' ? 'bg-white text-teal-700 shadow-sm font-bold' : 'text-slate-500 hover:text-slate-700 font-medium'"
            class="px-5 py-2.5 rounded-xl text-sm transition-all duration-200 flex items-center gap-2">
            <span>Program Unit Saya</span>
            <span :class="activeTab === 'myPrograms' ? 'bg-teal-100 text-teal-600' : 'bg-slate-200/50 text-slate-500'"
                class="px-2 py-0.5 rounded-md text-xs font-bold transition-colors">
                {{ $myPrograms->total() }}
            </span>
        </button>
    </div>

    {{-- 3. Content Area --}}
    <div class="relative min-h-[300px]">

        {{-- TAB 1: INSTITUSIONAL --}}
        <div x-show="activeTab === 'institusional'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-600 text-xs uppercase font-bold tracking-wider border-b border-slate-100">
                                <th class="py-4 px-6">Judul Program</th>
                                <th class="py-4 px-6">Periode</th>
                                <th class="py-4 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm divide-y divide-gray-100/50">
                            @forelse ($institutionalPrograms as $program)
                            <tr class="hover:bg-white/60 transition-colors duration-200 group">
                                <td class="py-4 px-6 align-middle">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-gray-800 text-base group-hover:text-teal-600 transition-colors">{{ $program->title }}</span>
                                        <span class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $program->description }}</span>
                                        <span class="inline-block mt-2">
                                            <span class="text-[10px] font-bold text-white bg-indigo-500 px-2 py-0.5 rounded shadow-sm">INSTITUSIONAL</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 align-middle">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100 w-fit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $program->start_date?->format('d M Y') ?? '-' }} — {{ $program->end_date?->format('d M Y') ?? '-' }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center align-middle">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Lihat Hasil --}}
                                        <a href="{{ route('unitkerja.admin.programs.results', $program) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-xl text-xs font-bold shadow-md hover:shadow-slate-500/30 transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                            Hasil
                                        </a>

                                        {{-- Salin (Clone) untuk Institusional --}}
                                        <button type="button"
                                            @click="$dispatch('open-clone-modal', { url: '{{ route('unitkerja.admin.my-programs.clone', $program) }}', name: '{{ addslashes($program->title) }}' })"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl text-xs font-bold shadow-sm transition-all"
                                            title="Salin ke Program Unit Saya">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                            Salin
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 mb-4 opacity-60">
                                            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
                                        </div>
                                        <p class="text-slate-500 font-medium">Belum ada program institusional yang ditugaskan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- TAB 2: PROGRAM UNIT SAYA --}}
        <div x-show="activeTab === 'myPrograms'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-teal-50/50 text-teal-900 uppercase text-xs font-bold tracking-wider border-b border-teal-100/50">
                                <th class="py-4 px-6">Judul Program</th>
                                <th class="py-4 px-6 text-center">Status</th>
                                <th class="py-4 px-6">Periode</th>
                                <th class="py-4 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm divide-y divide-gray-100/50">
                            @forelse ($myPrograms as $program)
                            <tr class="hover:bg-white/60 transition-colors duration-200 group">

                                {{-- Judul --}}
                                <td class="py-4 px-6 align-middle">
                                    <div class="flex flex-col">
                                        <a href="{{ route('unitkerja.admin.programs.questions.index', $program) }}" class="font-bold text-gray-800 text-base group-hover:text-teal-600 transition-colors">
                                            {{ $program->title }}
                                        </a>
                                        <span class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $program->description }}</span>
                                        <span class="inline-block mt-2">
                                            <span class="text-[10px] font-bold text-white bg-teal-500 px-2 py-0.5 rounded shadow-sm">MANDIRI</span>
                                        </span>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="py-4 px-6 text-center align-middle">
                                    @if($program->is_active)
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-100/80 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 px-3 py-1 rounded-full text-xs font-bold border border-slate-200">
                                        <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span> Nonaktif
                                    </span>
                                    @endif
                                </td>

                                {{-- Periode --}}
                                <td class="py-4 px-6 align-middle">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100 w-fit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $program->start_date?->format('d M Y') ?? '-' }} — {{ $program->end_date?->format('d M Y') ?? '-' }}
                                    </div>
                                </td>

                                {{-- Aksi --}}
                                <td class="py-4 px-6 text-center align-middle">
                                    <div class="flex justify-center gap-2">
                                        {{-- Hasil --}}
                                        <a href="{{ route('unitkerja.admin.programs.results', $program) }}" class="p-2 text-teal-600 bg-teal-50 border border-teal-100 rounded-lg hover:bg-teal-500 hover:text-white transition-all shadow-sm" title="Lihat Hasil">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </a>
                                        {{-- Pertanyaan --}}
                                        <a href="{{ route('unitkerja.admin.programs.questions.index', $program) }}" class="p-2 text-blue-600 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-500 hover:text-white transition-all shadow-sm" title="Kelola Pertanyaan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('unitkerja.admin.my-programs.edit', $program) }}" class="p-2 text-amber-600 bg-amber-50 border border-amber-100 rounded-lg hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit Program">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('unitkerja.admin.my-programs.builder', $program) }}"
                                            class="p-2 text-purple-600 bg-purple-50 border border-purple-100 rounded-lg hover:bg-purple-500 hover:text-white transition-all shadow-sm"
                                            title="Atur Data Diri (Pre-Survey)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                        </a>

                                        {{-- PERBAIKAN: Tombol Kloning (Duplikat) untuk Program Sendiri --}}
                                        <button type="button"
                                            @click="$dispatch('open-clone-modal', { url: '{{ route('unitkerja.admin.my-programs.clone', $program) }}', name: '{{ addslashes($program->title) }}' })"
                                            class="p-2 text-slate-600 bg-slate-50 border border-slate-200 rounded-lg hover:bg-slate-600 hover:text-white transition-all shadow-sm" title="Kloning Program">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </button>

                                        {{-- Hapus --}}
                                        <button type="button"
                                            @click="$dispatch('open-delete-modal', { url: '{{ route('unitkerja.admin.my-programs.destroy', $program) }}', name: '{{ addslashes($program->title) }}' })"
                                            class="p-2 text-rose-600 bg-rose-50 border border-rose-100 rounded-lg hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Hapus Program">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 mb-4 opacity-60">
                                            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
                                        </div>
                                        <p class="text-slate-500 font-medium">Anda belum membuat program survei mandiri.</p>
                                        <a href="{{ route('unitkerja.admin.my-programs.create') }}" class="mt-4 text-teal-600 hover:text-teal-800 font-bold text-sm underline">Buat Sekarang</a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($myPrograms->hasPages())
                <div class="bg-white/50 px-6 py-4 border-t border-gray-100 flex justify-center">
                    {{ $myPrograms->links() }}
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection