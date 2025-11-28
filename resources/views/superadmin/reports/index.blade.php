@extends('layouts.superadmin')

@section('content')
{{-- Load CSS Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* --- ANIMATIONS --- */
    @keyframes float-slow {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    .animate-float-slow {
        animation: float-slow 5s ease-in-out infinite;
    }

    /* --- CUSTOM SCROLLBAR --- */
    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* --- TABLE STICKY STYLING --- */
    .shadow-r {
        box-shadow: 4px 0 12px -4px rgba(0, 0, 0, 0.05);
    }

    .shadow-l {
        box-shadow: -4px 0 12px -4px rgba(0, 0, 0, 0.05);
    }

    /* --- SELECT2 CUSTOMIZATION (Manual Padding Fix) --- */

    /* 1. Wadah Utama: Transparan */
    .select2-container .select2-selection--single {
        height: 100% !important;
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
    }

    /* 2. Teks Pilihan & Placeholder: PADDING MANUAL AGAR TENGAH */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #1e293b !important;
        /* slate-800 */
        font-weight: 700 !important;
        font-size: 1rem !important;

        /* Padding Search Solution */
        padding-top: 14px !important;
        /* Dorong teks ke bawah agar tengah */
        padding-left: 0 !important;
        line-height: normal !important;
        height: 100% !important;
        display: block !important;
        /* Pastikan block agar padding works */
    }

    /* Warna Placeholder */
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #94a3b8 !important;
        /* slate-400 */
        font-weight: 500;
    }

    /* 3. Hilangkan Panah & Tombol X */
    .select2-container--default .select2-selection--single .select2-selection__arrow,
    .select2-container--default .select2-selection--single .select2-selection__clear {
        display: none !important;
    }

    /* 4. Dropdown Menu (Glassmorphism) */
    .select2-dropdown {
        border: 0 !important;
        border-radius: 1.5rem !important;
        box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.1), 0 10px 15px -5px rgba(0, 0, 0, 0.05) !important;
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(12px);
        padding: 10px !important;
        margin-top: 10px !important;
        z-index: 9999;
    }

    /* Search Input dalam Dropdown */
    .select2-search--dropdown {
        padding: 5px 10px 10px 10px !important;
    }

    .select2-search__field {
        border-radius: 0.75rem !important;
        padding: 10px 15px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
        font-size: 0.9rem;
    }

    .select2-search__field:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
        outline: none !important;
    }

    /* Item Hasil */
    .select2-results__option {
        padding: 12px 16px !important;
        border-radius: 0.75rem !important;
        margin-bottom: 4px;
        font-size: 0.95rem;
        color: #475569;
        font-weight: 500;
        transition: all 0.2s;
    }

    .select2-results__option--highlighted[aria-selected] {
        background-color: #e0e7ff !important;
        /* indigo-50 */
        color: #4338ca !important;
        /* indigo-700 */
        font-weight: 700;
        padding-left: 20px !important;
        /* Efek geser saat hover */
    }
</style>

{{-- Background Aurora --}}
<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 right-1/4 w-[600px] h-[600px] bg-indigo-400/10 rounded-full mix-blend-multiply filter blur-[100px] animate-blob"></div>
    <div class="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-teal-400/10 rounded-full mix-blend-multiply filter blur-[80px] animate-blob animation-delay-2000"></div>
</div>

<div class="relative z-10 space-y-8 pb-20">

    {{-- 1. Header Section --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-2">
        <div class="flex items-center gap-5">
            {{-- Icon Container with Glow --}}
            <div class="relative group">
                <div class="absolute inset-0 bg-indigo-500/20 rounded-2xl blur-lg group-hover:blur-xl transition-all duration-500"></div>
                <div class="w-16 h-16 relative bg-white/80 backdrop-blur-xl rounded-2xl border border-white/60 shadow-lg flex items-center justify-center overflow-hidden">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Bar%20Chart.png" alt="Report" class="w-10 h-10 object-contain drop-shadow-sm group-hover:scale-110 transition-transform duration-500">
                </div>
            </div>

            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Laporan Agregat</h1>
                <p class="text-slate-500 font-medium mt-1 text-base">Analisis skor rata-rata per unit kerja secara real-time.</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        @if($selectedProgram)
        <div class="flex gap-3 animate-fade-in-up">
            <a href="{{ route('superadmin.reports.export.average', $selectedProgram) }}"
                class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 rounded-xl font-bold shadow-sm hover:shadow-md transition-all text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Export Analisis</span>
            </a>
            <a href="{{ route('superadmin.reports.export.respondents', $selectedProgram) }}"
                class="px-5 py-2.5 bg-slate-900 text-white hover:bg-slate-800 rounded-xl font-bold shadow-lg shadow-slate-900/20 hover:shadow-slate-900/30 hover:-translate-y-0.5 transition-all text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                <span>Data Responden</span>
            </a>
        </div>
        @endif
    </div>

    {{-- 2. SEARCH BAR (Kapsul Terintegrasi) --}}
    <div class="max-w-3xl mx-auto mt-4 relative z-30">
        <form action="{{ route('superadmin.reports.index') }}" method="GET">

            {{-- Main Capsule Container (Tinggi 56px) --}}
            <div class="group bg-white rounded-full p-1 pl-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-100 hover:border-indigo-100 transition-all duration-300 flex items-center gap-3 relative overflow-visible focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500/50 h-[56px]">

                {{-- Search Icon (Left) --}}
                <div class="shrink-0 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- Select2 Wrapper (Flexible & Full Height) --}}
                <div class="flex-1 h-full relative">
                    <select id="program_id" name="program_id" required class="select2-init w-full h-full opacity-0 cursor-pointer">
                        <option value=""></option>
                        @foreach($programs as $program)
                        <option value="{{ $program->id }}" {{ $selectedProgram && $selectedProgram->id == $program->id ? 'selected' : '' }}>
                            {{ $program->title }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit Button (Right - Inside Capsule) --}}
                <button type="submit"
                    class="shrink-0 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full px-8 h-full font-bold text-sm shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                    Tampilkan
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>

        </form>

        {{-- Helper Text --}}
        @if(!$selectedProgram)
        <div class="text-center mt-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100/50 border border-slate-200/50 text-xs font-semibold text-slate-500 animate-pulse">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                Silakan pilih program survei untuk memulai
            </span>
        </div>
        @endif
    </div>

    {{-- 3. Data Visualization / Table --}}
    @if($selectedProgram)
    <div class="animate-fade-in-up" style="animation-duration: 0.6s;">

        {{-- Section Divider --}}
        <div class="flex items-center gap-4 mb-6 mt-8">
            <div class="h-px bg-slate-200 flex-1"></div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Hasil Analisis</span>
            <div class="h-px bg-slate-200 flex-1"></div>
        </div>

        <div class="bg-white/80 backdrop-blur-xl border border-white/60 shadow-xl shadow-slate-200/40 rounded-[2rem] overflow-hidden relative">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead>
                        <tr class="bg-slate-50/80">
                            {{-- Unit Kerja (Sticky) --}}
                            <th class="px-8 py-5 text-left sticky left-0 bg-slate-50 z-20 shadow-r border-r border-slate-100 min-w-[240px]">
                                <span class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Unit Kerja</span>
                            </th>

                            @foreach ($selectedProgram->questionSections as $section)
                            <th class="px-6 py-5 text-center min-w-[180px]">
                                <div class="flex flex-col items-center">
                                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wide">{{ Str::limit($section->title, 20) }}</span>
                                    <span class="text-[10px] font-semibold text-indigo-400 mt-0.5">Rata-rata Skor</span>
                                </div>
                            </th>
                            @endforeach

                            {{-- Total (Sticky) --}}
                            <th class="px-6 py-5 text-center sticky right-[100px] bg-indigo-50/50 z-10 border-l border-indigo-50 shadow-l min-w-[120px]">
                                <span class="text-xs font-extrabold text-indigo-600 uppercase tracking-wider">Total Skor</span>
                            </th>

                            {{-- Aksi (Sticky) --}}
                            <th class="px-6 py-5 text-center sticky right-0 bg-slate-50 z-20 w-[100px]">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-50">
                        @forelse ($reportData as $unitReport)
                        <tr class="hover:bg-slate-50/80 transition-colors group">

                            {{-- Unit Name --}}
                            <td class="px-8 py-5 sticky left-0 bg-white group-hover:bg-slate-50/80 z-20 border-r border-slate-50 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-8 rounded-full {{ $unitReport['total_avg'] >= 3 ? 'bg-emerald-400' : ($unitReport['total_avg'] >= 2 ? 'bg-amber-400' : 'bg-rose-400') }}"></div>
                                    <span class="font-bold text-slate-700 text-sm">{{ $unitReport['unit_name'] }}</span>
                                </div>
                            </td>

                            {{-- Section Scores --}}
                            @foreach ($unitReport['section_scores'] as $score)
                            <td class="px-6 py-5 text-center">
                                <div class="relative inline-block group/tooltip">
                                    <span class="text-sm font-bold {{ $score >= 3 ? 'text-emerald-600' : ($score >= 2 ? 'text-amber-600' : 'text-rose-600') }}">
                                        {{ number_format($score, 2) }}
                                    </span>
                                    {{-- Tooltip bar visual --}}
                                    <div class="absolute bottom-0 left-0 w-full h-1 bg-slate-100 rounded-full mt-1 overflow-hidden">
                                        <div class="h-full {{ $score >= 3 ? 'bg-emerald-400' : ($score >= 2 ? 'bg-amber-400' : 'bg-rose-400') }}" style="width: {{ ($score/4)*100 }}%"></div>
                                    </div>
                                </div>
                            </td>
                            @endforeach

                            {{-- Total Score --}}
                            <td class="px-6 py-5 text-center sticky right-[100px] bg-white group-hover:bg-slate-50/80 z-10 border-l border-slate-50">
                                <span class="text-lg font-black text-slate-800">{{ number_format($unitReport['total_avg'], 2) }}</span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-5 text-center sticky right-0 bg-white group-hover:bg-slate-50/80 z-20">
                                <div class="flex justify-center gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('superadmin.reports.showUnit', [$selectedProgram->id, $unitReport['unit_id']]) }}"
                                        class="p-2 rounded-lg text-slate-400 hover:bg-indigo-50 hover:text-indigo-600 transition-colors" title="Detail">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('superadmin.reports.export.unit', ['program' => $selectedProgram, 'unit' => $unitReport['unit_id']]) }}"
                                        class="p-2 rounded-lg text-slate-400 hover:bg-emerald-50 hover:text-emerald-600 transition-colors" title="Download Excel">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%" class="py-20 text-center">
                                <div class="flex flex-col items-center justify-center opacity-50">
                                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Page%20Facing%20Up.png" alt="Empty" class="w-16 h-16 mb-4 grayscale">
                                    <p class="text-slate-500 font-medium">Belum ada data respons untuk program ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @else
    {{-- Empty State (Belum Pilih Program) --}}
    <div class="mt-20 flex flex-col items-center justify-center text-center px-4">
        <div class="w-40 h-40 bg-white rounded-full shadow-2xl shadow-indigo-100 flex items-center justify-center mb-8 animate-float-slow relative">
            <div class="absolute inset-0 bg-indigo-50 rounded-full animate-ping opacity-20"></div>
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Magnifying%20Glass%20Tilted%20Right.png" alt="Search" class="w-24 h-24 object-contain">
        </div>
        <h3 class="text-2xl font-black text-slate-800 mb-2">Mulai Analisis</h3>
        <p class="text-slate-500 max-w-md mx-auto leading-relaxed">
            Pilih salah satu program survei melalui pencarian di atas untuk melihat laporan detail dan statistik unit kerja.
        </p>
    </div>
    @endif

</div>

{{-- SCRIPTS --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2-init').select2({
            placeholder: "Ketik untuk mencari program...",
            allowClear: false, // PASTI HILANGKAN TANDA X
            width: '100%',
            language: {
                noResults: function() {
                    return '<span class="text-xs text-slate-400 p-2 block">Program tidak ditemukan</span>';
                }
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });

        // Event listener untuk focus ring effect pada parent capsule
        $('.select2-init').on('select2:open', function(e) {
            $(this).closest('.group').addClass('ring-4 ring-indigo-500/10 border-indigo-500/50');
        });
        $('.select2-init').on('select2:close', function(e) {
            $(this).closest('.group').removeClass('ring-4 ring-indigo-500/10 border-indigo-500/50');
        });
    });
</script>
@endsection