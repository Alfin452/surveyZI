@extends('layouts.superadmin')

@section('content')
{{-- Background Aurora --}}
<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-pink-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    {{-- 1. Hero Header Section --}}
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-indigo-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-green-500/5 via-teal-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- 3D Icon --}}
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Travel%20and%20places/Office%20Building.png" alt="Office Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Manajemen Unit Kerja</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">Kelola struktur organisasi, fakultas, dan unit layanan.</p>
                </div>
            </div>

            <a href="{{ route('superadmin.unit-kerja.create') }}"
                class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white rounded-xl font-bold shadow-lg hover:shadow-emerald-500/30 hover:-translate-y-1 transition-all duration-300 text-sm">
                <div class="bg-white/20 p-1 rounded-lg group-hover:rotate-90 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span>Tambah Unit Kerja</span>
            </a>
        </div>
    </div>

    {{-- 2. Filter & Search Bar Glassmorphism --}}
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-lg rounded-2xl p-4">
        <form action="{{ route('superadmin.unit-kerja.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">

            {{-- Search Input --}}
            <div class="md:col-span-4 relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full pl-10 pr-3 py-2.5 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white/50 placeholder-gray-400 transition-all shadow-sm hover:bg-white"
                    placeholder="Cari nama unit...">
            </div>

            {{-- Filter Tipe --}}
            <div class="md:col-span-3">
                <select name="type" class="block w-full py-2.5 px-3 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white/50 text-gray-600 cursor-pointer hover:bg-white transition-colors shadow-sm">
                    <option value="">-- Semua Tipe --</option>
                    @foreach ($tipeUnits as $tipe)
                    <option value="{{ $tipe->id }}" {{ request('type') == $tipe->id ? 'selected' : '' }}>{{ $tipe->nama_tipe_unit }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Parent --}}
            <div class="md:col-span-3">
                <select name="parent" class="block w-full py-2.5 px-3 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white/50 text-gray-600 cursor-pointer hover:bg-white transition-colors shadow-sm">
                    <option value="">-- Semua Induk --</option>
                    @foreach ($parentUnits as $parent)
                    <option value="{{ $parent->id }}" {{ request('parent') == $parent->id ? 'selected' : '' }}>{{ $parent->unit_kerja_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="md:col-span-2 flex gap-2">
                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all shadow-md hover:shadow-emerald-200 active:scale-95 flex items-center justify-center" title="Terapkan Filter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
                @if(request()->hasany(['search', 'type', 'parent']))
                <a href="{{ route('superadmin.unit-kerja.index') }}" class="w-full bg-white hover:bg-rose-50 text-slate-400 hover:text-rose-500 border border-gray-200 rounded-xl transition-all shadow-sm flex items-center justify-center" title="Reset Filter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- 3. Main Table Card Glassmorphism --}}
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-emerald-50/50 text-emerald-900 uppercase text-xs font-bold tracking-wider border-b border-emerald-100/50">
                        <th class="py-4 px-6 w-16 text-center">No</th>
                        <th class="py-4 px-6">Identitas Unit</th>
                        <th class="py-4 px-6">Klasifikasi</th>
                        <th class="py-4 px-6">Induk Organisasi</th>
                        <th class="py-4 px-6 text-center">Statistik</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100/50">
                    @forelse ($unitKerja as $unit)
                    <tr class="hover:bg-white/60 transition-colors duration-200 group">

                        {{-- No --}}
                        <td class="py-4 px-6 text-center align-middle font-semibold text-slate-400">
                            {{ $unitKerja->firstItem() + $loop->index }}
                        </td>

                        {{-- Nama Unit --}}
                        <td class="py-4 px-6 align-middle">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800 text-base group-hover:text-emerald-600 transition-colors">
                                    {{ $unit->unit_kerja_name }}
                                </span>
                                @if($unit->uk_short_name)
                                <span class="inline-block mt-1">
                                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                        {{ $unit->uk_short_name }}
                                    </span>
                                </span>
                                @endif
                            </div>
                        </td>

                        {{-- Tipe --}}
                        <td class="py-4 px-6 align-middle">
                            @if($unit->tipeUnit)
                            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-bold border border-blue-100 shadow-sm">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                {{ $unit->tipeUnit->nama_tipe_unit }}
                            </span>
                            @else
                            <span class="text-slate-400 italic text-xs">-</span>
                            @endif
                        </td>

                        {{-- Induk --}}
                        <td class="py-4 px-6 align-middle">
                            @if($unit->parent)
                            <div class="flex items-center gap-2 text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                </svg>
                                <span class="font-medium text-xs">{{ $unit->parent->unit_kerja_name }}</span>
                            </div>
                            @else
                            <span class="text-slate-400 text-xs italic flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Top Level Unit
                            </span>
                            @endif
                        </td>

                        {{-- Statistik (Split Badge) --}}
                        <td class="py-4 px-6 text-center align-middle">
                            <div class="inline-flex bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                                <div class="px-3 py-2 bg-slate-50 border-r border-gray-200" title="Jumlah Admin">
                                    <span class="block text-[10px] text-slate-400 font-bold uppercase">Admin</span>
                                    <span class="block text-sm font-black text-slate-700">{{ $unit->users_count }}</span>
                                </div>
                                <div class="px-3 py-2" title="Jumlah Sub-unit">
                                    <span class="block text-[10px] text-emerald-400 font-bold uppercase">Sub</span>
                                    <span class="block text-sm font-black text-emerald-600">{{ $unit->children_count }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- Aksi --}}
                        <td class="py-4 px-6 text-center align-middle">
                            <div class="flex justify-center gap-2">
                                {{-- Edit --}}
                                <a href="{{ route('superadmin.unit-kerja.edit', $unit) }}" class="p-2 bg-white text-amber-600 border border-amber-100 rounded-lg hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                {{-- Hapus --}}
                                <button type="button"
                                    @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.unit-kerja.destroy', $unit) }}', name: '{{ addslashes($unit->unit_kerja_name) }}' })"
                                    class="p-2 bg-white text-rose-600 border border-rose-100 rounded-lg hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                {{-- 3D Empty State --}}
                                <div class="w-24 h-24 mb-4 opacity-70">
                                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
                                </div>
                                <h3 class="text-lg font-bold text-slate-700">Tidak ada unit kerja ditemukan</h3>
                                <p class="text-slate-500 max-w-xs mx-auto mt-1 mb-6 text-sm">Coba ubah filter pencarian Anda atau tambahkan unit baru.</p>
                                <a href="{{ route('superadmin.unit-kerja.index') }}" class="text-emerald-600 hover:text-emerald-800 font-bold text-sm underline">Reset Pencarian</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($unitKerja->hasPages())
        <div class="bg-white/50 px-6 py-4 border-t border-gray-100 flex justify-center">
            {{ $unitKerja->links() }}
        </div>
        @endif
    </div>
</div>
@endsection