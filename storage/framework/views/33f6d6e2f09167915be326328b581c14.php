

<?php $__env->startSection('content'); ?>

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

    /* --- SELECT2 CUSTOMIZATION (Integrated Capsule Style) --- */

    /* 1. Wadah Utama: Transparan & Hilangkan Border Bawaan */
    .select2-container .select2-selection--single {
        height: 100% !important;
        /* Ikuti tinggi parent (56px) */
        background-color: transparent !important;
        border: none !important;
        box-shadow: none !important;
        display: flex !important;
        align-items: center !important;
        /* Center Flex Parent */
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
    }

    /* Placeholder Text Style */
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #94a3b8 !important;
        /* slate-400 */
        font-weight: 500;
    }

    /* 3. Hilangkan Elemen Pengganggu */
    .select2-container--default .select2-selection--single .select2-selection__arrow,
    .select2-container--default .select2-selection--single .select2-selection__clear {
        display: none !important;
        /* Hapus panah dan tombol X */
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

    /* Badge Lokal/Pusat di dalam dropdown */
    .badge-option {
        font-size: 0.7rem;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 6px;
        margin-left: 10px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
</style>


<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 right-1/4 w-[600px] h-[600px] bg-teal-400/10 rounded-full mix-blend-multiply filter blur-[100px] animate-blob"></div>
    <div class="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-indigo-400/10 rounded-full mix-blend-multiply filter blur-[80px] animate-blob animation-delay-2000"></div>
</div>

<div class="relative z-10 space-y-8 pb-20">

    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-2">
        <div class="flex items-center gap-5">
            
            <div class="relative group">
                <div class="absolute inset-0 bg-indigo-500/20 rounded-2xl blur-lg group-hover:blur-xl transition-all duration-500"></div>
                <div class="w-16 h-16 relative bg-white/80 backdrop-blur-xl rounded-2xl border border-white/60 shadow-lg flex items-center justify-center overflow-hidden">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Bar%20Chart.png" alt="Report" class="w-10 h-10 object-contain drop-shadow-sm group-hover:scale-110 transition-transform duration-500">
                </div>
            </div>

            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Laporan Unit Saya</h1>
                <p class="text-slate-500 font-medium mt-1 text-base">Pantau kinerja unit Anda secara real-time.</p>
            </div>
        </div>
    </div>

    
    <div class="max-w-3xl mx-auto mt-4 relative z-30">
        <form action="<?php echo e(route('unitkerja.admin.reports.index')); ?>" method="GET">

            
            <div class="group bg-white rounded-full p-1 pl-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-100 hover:border-indigo-100 transition-all duration-300 flex items-center gap-3 relative overflow-visible focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500/50 h-[56px]">

                
                <div class="shrink-0 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                
                <div class="flex-1 h-full relative">
                    <select id="program_id" name="program_id" required class="select2-init w-full h-full opacity-0 cursor-pointer">
                        <option value=""></option>
                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($program->id); ?>" <?php echo e($selectedProgram && $selectedProgram->id == $program->id ? 'selected' : ''); ?>>
                            <?php echo e($program->title); ?>

                            
                            (<?php echo e($program->unit_kerja_id == auth()->user()->unit_kerja_id ? 'Lokal' : 'Pusat'); ?>)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <button type="submit"
                    class="shrink-0 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full px-8 h-full font-bold text-sm shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform active:scale-95 flex items-center gap-2">
                    Tampilkan
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>

        </form>

        
        <?php if(!$selectedProgram): ?>
        <div class="text-center mt-4">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100/50 border border-slate-200/50 text-xs font-semibold text-slate-500 animate-pulse">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                Silakan pilih program survei untuk memulai
            </span>
        </div>
        <?php endif; ?>
    </div>

    
    <?php if($selectedProgram): ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up" style="animation-duration: 0.6s;">

        
        <div class="lg:col-span-1 space-y-6">

            
            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden">
                
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -mr-8 -mt-8 opacity-50"></div>

                
                <div class="mb-5 relative z-10">
                    <?php if($selectedProgram->unit_kerja_id == auth()->user()->unit_kerja_id): ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-teal-50 text-teal-700 text-[10px] font-extrabold uppercase tracking-wider border border-teal-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                        Program Unit Sendiri
                    </span>
                    <?php else: ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-extrabold uppercase tracking-wider border border-indigo-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                        Program Institusional
                    </span>
                    <?php endif; ?>
                </div>

                <h2 class="text-xl font-black text-slate-800 mb-3 leading-tight relative z-10"><?php echo e($selectedProgram->title); ?></h2>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed relative z-10"><?php echo e($selectedProgram->description); ?></p>

                <div class="text-xs text-slate-400 font-bold flex items-center gap-2 pt-6 border-t border-slate-50">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Dibuat: <?php echo e($selectedProgram->created_at->format('d M Y')); ?>

                </div>
            </div>

            
            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/50">
                <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-6">Statistik Unit Anda</h3>

                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-400 shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase">Responden</span>
                        </div>
                        <span class="text-3xl font-black text-slate-700"><?php echo e($stats['respondents']); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-400 shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase">Rata-rata</span>
                        </div>
                        <span class="text-3xl font-black <?php echo e($stats['average'] >= 3 ? 'text-emerald-500' : ($stats['average'] >= 2 ? 'text-amber-500' : 'text-rose-500')); ?>">
                            <?php echo e(number_format($stats['average'], 2)); ?>

                        </span>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/50">
                <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-6">Unduh Laporan</h3>
                <div class="space-y-3">
                    <a href="<?php echo e(route('unitkerja.admin.reports.export.average', $selectedProgram)); ?>" class="flex items-center justify-center gap-3 w-full py-4 bg-white border-2 border-slate-100 hover:border-indigo-500 hover:text-indigo-600 text-slate-600 font-bold rounded-2xl transition-all text-sm group">
                        <div class="p-1 rounded-lg bg-slate-100 text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        Excel Analisis
                    </a>
                    <a href="<?php echo e(route('unitkerja.admin.reports.export.respondents', $selectedProgram)); ?>" class="flex items-center justify-center gap-3 w-full py-4 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-2xl shadow-lg shadow-slate-900/20 hover:shadow-slate-900/30 hover:-translate-y-0.5 transition-all text-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Data Responden
                    </a>
                </div>
            </div>
        </div>

        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/60 overflow-hidden h-full flex flex-col">
                <div class="p-8 border-b border-slate-100 bg-slate-50/30 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Rincian Skor per Bagian</h3>
                        <p class="text-sm text-slate-500 font-medium">Detail performa unit Anda berdasarkan aspek penilaian.</p>
                    </div>
                </div>
                <div class="overflow-x-auto flex-1 custom-scrollbar">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                            <tr>
                                <th class="px-8 py-5 font-extrabold tracking-wider">Bagian (Section)</th>
                                <th class="px-6 py-5 font-extrabold text-center w-32 tracking-wider">Skor</th>
                                <th class="px-6 py-5 font-extrabold text-center w-40 tracking-wider">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php $__currentLoopData = $sectionScores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-8 py-6 font-bold text-slate-700">
                                    <?php echo e($section['title']); ?>

                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="inline-block px-4 py-1.5 rounded-xl font-bold text-sm <?php echo e($section['score'] >= 3 ? 'bg-emerald-100 text-emerald-700' : ($section['score'] >= 2 ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700')); ?>">
                                        <?php echo e(number_format($section['score'], 2)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="text-xs font-bold uppercase tracking-wide 
                                        <?php if($section['score'] >= 3.26): ?> text-emerald-600
                                        <?php elseif($section['score'] >= 2.51): ?> text-emerald-500
                                        <?php elseif($section['score'] >= 1.76): ?> text-amber-500
                                        <?php else: ?> text-rose-500
                                        <?php endif; ?>">
                                        <?php if($section['score'] >= 3.26): ?> Sangat Baik
                                        <?php elseif($section['score'] >= 2.51): ?> Baik
                                        <?php elseif($section['score'] >= 1.76): ?> Cukup
                                        <?php else: ?> Kurang
                                        <?php endif; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php elseif(request('program_id')): ?>
    
    <div class="flex flex-col items-center justify-center py-20 bg-white/50 backdrop-blur-sm rounded-[2rem] border-2 border-dashed border-slate-300">
        <div class="w-24 h-24 mb-4 opacity-60">
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
        </div>
        <p class="text-slate-500 font-medium">Belum ada data responden unit Anda untuk program ini.</p>
    </div>
    <?php else: ?>
    
    <div class="flex flex-col items-center justify-center py-32 px-4">
        <div class="w-40 h-40 bg-white rounded-full shadow-2xl shadow-indigo-100 flex items-center justify-center mb-8 animate-float-slow relative">
            <div class="absolute inset-0 bg-indigo-50 rounded-full animate-ping opacity-20"></div>
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Magnifying%20Glass%20Tilted%20Right.png" alt="Search" class="w-24 h-24 object-contain">
        </div>
        <h3 class="text-2xl font-black text-slate-800 mb-2">Mulai Analisis Unit</h3>
        <p class="text-slate-500 text-center max-w-md">Silakan pilih program survei di atas untuk melihat laporan detail performa unit Anda.</p>
    </div>
    <?php endif; ?>

</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2-init').select2({
            placeholder: "Cari nama program survei...",
            allowClear: false, // Hilangkan tombol X
            width: '100%',
            language: {
                noResults: function() {
                    return '<span class="text-xs text-slate-400 p-2 block">Program tidak ditemukan</span>';
                }
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            // Custom Template agar info Lokal/Pusat terlihat rapi di dropdown
            templateResult: formatProgram,
            templateSelection: formatProgram
        });

        // Event listener untuk focus ring effect pada parent capsule
        $('.select2-init').on('select2:open', function(e) {
            $(this).closest('.group').addClass('ring-4 ring-indigo-500/10 border-indigo-500/50');
        });
        $('.select2-init').on('select2:close', function(e) {
            $(this).closest('.group').removeClass('ring-4 ring-indigo-500/10 border-indigo-500/50');
        });

        // Fungsi format tampilan dropdown
        function formatProgram(program) {
            if (!program.id) {
                return program.text;
            }

            // Logika sederhana memisahkan Nama dan (Label)
            var text = program.text;
            var label = "";
            var cleanText = text;

            if (text.includes('(Lokal)')) {
                label = '<span class="badge-option bg-teal-100 text-teal-800">Lokal</span>';
                cleanText = text.replace('(Lokal)', '');
            } else if (text.includes('(Pusat)')) {
                label = '<span class="badge-option bg-indigo-100 text-indigo-800">Pusat</span>';
                cleanText = text.replace('(Pusat)', '');
            }

            var $program = $(
                '<span class="flex items-center">' + cleanText + label + '</span>'
            );
            return $program;
        };
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.unit_kerja_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/reports/index.blade.php ENDPATH**/ ?>