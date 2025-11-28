@extends('layouts.superadmin')

@section('content')
{{-- Background Aurora --}}
<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-pink-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    {{-- 1. Hero Header Section (Dengan Ikon 3D) --}}
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-indigo-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- 3D Icon Header --}}
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Spiral%20Notepad.png" alt="Survey Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Manajemen Program Survei</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">Kelola "wadah" survei, struktur soal, dan publikasi.</p>
                </div>
            </div>

            {{-- Tombol Buat Program (Gradient Style) --}}
            <a href="{{ route('superadmin.programs.create') }}"
                class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white rounded-xl font-bold shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all duration-300 text-sm">
                <div class="bg-white/20 p-1 rounded-lg group-hover:rotate-90 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span>Buat Program Baru</span>
            </a>
        </div>
    </div>

    {{-- 2. Filter & Search Bar --}}
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-lg rounded-2xl p-4">
        <form action="{{ route('superadmin.programs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">

            <div class="md:col-span-5 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full pl-10 pr-3 py-2.5 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/50 placeholder-gray-400 transition-all shadow-sm hover:bg-white"
                    placeholder="Cari judul program...">
            </div>

            <div class="md:col-span-3">
                <select name="status" class="block w-full py-2.5 px-3 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/50 text-gray-600 cursor-pointer hover:bg-white transition-colors shadow-sm">
                    <option value="">-- Semua Status --</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>✅ Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>🚫 Non-Aktif</option>
                </select>
            </div>

            <div class="md:col-span-3">
                <select name="unit_id" class="block w-full py-2.5 px-3 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/50 text-gray-600 cursor-pointer hover:bg-white transition-colors shadow-sm">
                    <option value="">-- Semua Tipe Unit --</option>
                    <option value="institutional" {{ request('unit_id') == 'institutional' ? 'selected' : '' }}>🏢 Institusional (Global)</option>
                    <option value="local" {{ request('unit_id') == 'local' ? 'selected' : '' }}>📍 Lokal (Unit Kerja)</option>
                </select>
            </div>

            <div class="md:col-span-1 flex gap-2">
                <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl transition-all shadow-md hover:shadow-indigo-200 active:scale-95 flex items-center justify-center" title="Terapkan Filter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
                @if(request()->hasany(['search', 'status', 'unit_id']))
                <a href="{{ route('superadmin.programs.index') }}" class="w-full bg-white hover:bg-rose-50 text-slate-400 hover:text-rose-500 border border-gray-200 rounded-xl transition-all shadow-sm flex items-center justify-center" title="Reset Filter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- 3. Tabel Data --}}
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-indigo-50/50 text-indigo-900 uppercase text-xs font-bold tracking-wider border-b border-indigo-100/50">
                        <th class="py-4 px-6">Informasi Program</th>
                        <th class="py-4 px-6">Target & Tipe</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Statistik</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100/50">
                    @forelse($programs as $program)
                    <tr class="hover:bg-white/60 transition-colors duration-200 group">

                        {{-- Judul --}}
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col max-w-xs">
                                <div class="flex items-center gap-2 mb-1">
                                    <a href="{{ route('superadmin.programs.questions.index', $program) }}" class="font-bold text-gray-800 text-base group-hover:text-indigo-600 transition-colors line-clamp-1">
                                        {{ $program->title }}
                                    </a>
                                    @if($program->is_featured)
                                    <span class="shrink-0 bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-0.5 rounded-full border border-amber-200 flex items-center gap-1 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                                    <span class="flex items-center gap-1 bg-slate-50 px-2 py-1 rounded-lg border border-slate-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $program->start_date?->format('d M Y') ?? '-' }} — {{ $program->end_date?->format('d M Y') ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </td>

                        {{-- Target Unit --}}
                        <td class="py-4 px-6 align-middle">
                            @if ($program->unit_kerja_id === null)
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-indigo-50 text-indigo-600 rounded-xl border border-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-indigo-700">Global</p>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wide mt-0.5">Institusional</p>
                                </div>
                            </div>
                            @else
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-teal-50 text-teal-600 rounded-xl border border-teal-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-teal-700">Lokal</p>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wide mt-0.5">{{ Str::limit($program->unitKerja->uk_short_name ?? 'N/A', 10) }}</p>
                                </div>
                            </div>
                            @endif
                        </td>

                        {{-- Status --}}
                        {{-- Status (LOGIKA BARU) --}}
                        <td class="py-4 px-6 text-center align-middle">
                            @if(!$program->is_active)
                            {{-- 1. Jika dimatikan manual --}}
                            <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 px-3 py-1.5 rounded-full text-xs font-bold border border-slate-200">
                                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                Non-Aktif
                            </span>

                            @elseif($program->end_date < now()->startOfDay())
                                {{-- 2. Jika Tanggal Berakhir sudah lewat (Expired) --}}
                                <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 px-3 py-1.5 rounded-full text-xs font-bold border border-rose-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Selesai
                                </span>

                                @elseif($program->start_date > now()->endOfDay())
                                {{-- 3. Jika Tanggal Mulai belum tiba (Terjadwal) --}}
                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 px-3 py-1.5 rounded-full text-xs font-bold border border-amber-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Terjadwal
                                </span>

                                @else
                                {{-- 4. Jika Aktif & Dalam Periode --}}
                                <span class="inline-flex items-center gap-1.5 bg-emerald-100/80 text-emerald-700 px-3 py-1.5 rounded-full text-xs font-bold border border-emerald-200 shadow-sm">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                    </span>
                                    Aktif
                                </span>
                                @endif
                        </td>
                        {{-- Statistik (Split Badge) --}}
                        <td class="py-4 px-6 text-center align-middle">
                            <div class="inline-flex bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                                <div class="px-3 py-2 bg-slate-50 border-r border-gray-200">
                                    <span class="block text-xs text-slate-400 font-bold uppercase">Bagian</span>
                                    <span class="block text-sm font-black text-slate-700">{{ $program->question_sections_count ?? 0 }}</span>
                                </div>
                                <div class="px-3 py-2">
                                    <span class="block text-xs text-indigo-300 font-bold uppercase">Soal</span>
                                    <span class="block text-sm font-black text-indigo-600">{{ $program->questions_count ?? 0 }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- Aksi (Tombol Candy Glass) --}}
                        {{-- Aksi (Tombol Candy Glass) --}}
                        <td class="py-4 px-6 text-center align-middle">
                            <div class="flex flex-col gap-2 max-w-[150px] mx-auto">
                                {{-- Tombol Utama (Hasil) --}}
                                <a href="{{ route('superadmin.programs.results', $program) }}"
                                    class="flex items-center justify-center gap-2 w-full bg-gradient-to-b from-emerald-400 to-emerald-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:from-emerald-500 hover:to-emerald-600 hover:shadow-lg hover:shadow-emerald-500/30 transition-all duration-200 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Hasil
                                </a>

                                <div class="flex gap-1.5 flex-wrap justify-center">
                                    {{-- 1. FORM BUILDER (BARU - UNGU) --}}
                                    <a href="{{ route('superadmin.programs.builder', $program) }}"
                                        class="flex-1 bg-white text-purple-600 border border-purple-100 p-1.5 rounded-lg hover:bg-purple-500 hover:text-white transition-colors shadow-sm"
                                        title="Atur Data Diri (Pre-Survey)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                    </a>

                                    {{-- 2. Pertanyaan (BIRU) --}}
                                    <a href="{{ route('superadmin.programs.questions.index', $program) }}" class="flex-1 bg-white text-blue-600 border border-blue-100 p-1.5 rounded-lg hover:bg-blue-500 hover:text-white transition-colors shadow-sm" title="Kelola Soal Survei">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>

                                    {{-- 3. Edit (AMBER) --}}
                                    <a href="{{ route('superadmin.programs.edit', $program) }}" class="flex-1 bg-white text-amber-600 border border-amber-100 p-1.5 rounded-lg hover:bg-amber-500 hover:text-white transition-colors shadow-sm" title="Edit Info Program">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- 4. Kloning & Hapus (Grouped) --}}
                                    <div class="w-full flex gap-1.5 mt-1.5">
                                        <button type="button"
                                            @click="$dispatch('open-clone-modal', { url: '{{ route('superadmin.programs.clone', $program) }}', name: '{{ addslashes($program->title) }}' })"
                                            class="flex-1 bg-white text-slate-600 border border-slate-200 p-1.5 rounded-lg hover:bg-slate-700 hover:text-white transition-colors shadow-sm" title="Kloning">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </button>

                                        <button type="button"
                                            @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.programs.destroy', $program) }}', name: '{{ addslashes($program->title) }}' })"
                                            class="flex-1 bg-white text-rose-600 border border-rose-100 p-1.5 rounded-lg hover:bg-rose-500 hover:text-white transition-colors shadow-sm" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                {{-- 3D Empty State Icon --}}
                                <div class="w-32 h-32 mb-4 drop-shadow-sm opacity-80">
                                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty Box" class="w-full h-full object-contain">
                                </div>
                                <h3 class="text-lg font-bold text-slate-700">Belum ada program ditemukan</h3>
                                <p class="text-slate-500 max-w-xs mx-auto mt-1 mb-6 text-sm">Mulai dengan membuat program survei baru atau ubah filter pencarian Anda.</p>
                                @if(request()->hasany(['search', 'status', 'unit_id']))
                                <a href="{{ route('superadmin.programs.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-bold text-sm hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset Filter
                                </a>
                                @else
                                <a href="{{ route('superadmin.programs.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-indigo-700 transition-all shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-1">
                                    + Buat Program Pertama
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($programs->hasPages())
        <div class="bg-white/50 px-6 py-4 border-t border-gray-100 flex justify-center">
            {{ $programs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection