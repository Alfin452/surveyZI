

<?php $__env->startSection('content'); ?>

<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-teal-400/10 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-indigo-400/10 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
</div>

<div class="relative z-10 space-y-6">

    
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">Laporan Unit Saya</h1>
                <p class="text-slate-500 text-sm font-medium">Pantau kinerja unit Anda baik dari survei mandiri maupun survei institusional.</p>
            </div>
        </div>
    </div>

    
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-lg rounded-2xl p-5 z-20">
        <form action="<?php echo e(route('unitkerja.admin.reports.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label for="program_id" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Pilih Program Survei</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <select id="program_id" name="program_id" required onchange="this.form.submit()"
                        class="block w-full pl-10 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/80 placeholder-gray-400 transition-all shadow-sm cursor-pointer hover:bg-white">
                        <option value="">-- Pilih Program --</option>
                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($program->id); ?>" <?php echo e($selectedProgram && $selectedProgram->id == $program->id ? 'selected' : ''); ?>>
                            <?php echo e($program->title); ?>

                            
                            (<?php echo e($program->unit_kerja_id == auth()->user()->unit_kerja_id ? 'Lokal' : 'Pusat'); ?>)
                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </form>
    </div>

    
    <?php if($selectedProgram): ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-1 space-y-6">

            
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">

                
                <div class="mb-4">
                    <?php if($selectedProgram->unit_kerja_id == auth()->user()->unit_kerja_id): ?>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-teal-50 text-teal-700 text-[10px] font-bold uppercase tracking-wider border border-teal-100">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Program Unit Sendiri
                    </span>
                    <?php else: ?>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-wider border border-indigo-100">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                        Program Institusional (Pusat)
                    </span>
                    <?php endif; ?>
                </div>

                <h2 class="text-lg font-black text-slate-800 mb-2 leading-tight"><?php echo e($selectedProgram->title); ?></h2>
                <p class="text-xs text-slate-500 mb-4 line-clamp-3"><?php echo e($selectedProgram->description); ?></p>

                <div class="text-xs text-slate-400 font-medium flex items-center gap-2 pt-4 border-t border-slate-50">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Dibuat: <?php echo e($selectedProgram->created_at->format('d M Y')); ?>

                </div>
            </div>

            
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Statistik Unit Anda</h3>

                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Responden</span>
                        <span class="text-2xl font-black text-slate-700"><?php echo e($stats['respondents']); ?></span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Rata-rata</span>
                        <span class="text-2xl font-black <?php echo e($stats['average'] >= 3 ? 'text-emerald-600' : ($stats['average'] >= 2 ? 'text-amber-600' : 'text-rose-600')); ?>">
                            <?php echo e(number_format($stats['average'], 2)); ?>

                        </span>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Unduh Laporan</h3>
                <div class="space-y-3">
                    <a href="<?php echo e(route('unitkerja.admin.reports.export.average', $selectedProgram)); ?>" class="flex items-center justify-center gap-3 w-full py-3 bg-white border-2 border-slate-100 hover:border-indigo-500 hover:text-indigo-600 text-slate-600 font-bold rounded-xl transition-all text-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Excel Analisis
                    </a>
                    <a href="<?php echo e(route('unitkerja.admin.reports.export.respondents', $selectedProgram)); ?>" class="flex items-center justify-center gap-3 w-full py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 transition-all text-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Data Responden
                    </a>
                </div>
            </div>
        </div>

        
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-lg overflow-hidden h-full flex flex-col">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-slate-700">Rincian Skor per Bagian</h3>
                        <p class="text-xs text-slate-400">Detail performa unit Anda berdasarkan aspek penilaian.</p>
                    </div>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 font-bold">Bagian (Section)</th>
                                <th class="px-6 py-4 font-bold text-center w-32">Skor</th>
                                <th class="px-6 py-4 font-bold text-center w-40">Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php $__currentLoopData = $sectionScores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-indigo-50/30 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-700">
                                    <?php echo e($section['title']); ?>

                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-lg font-bold <?php echo e($section['score'] >= 3 ? 'bg-emerald-100 text-emerald-700' : ($section['score'] >= 2 ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700')); ?>">
                                        <?php echo e(number_format($section['score'], 2)); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase">
                                    <?php if($section['score'] >= 3.26): ?> Sangat Baik
                                    <?php elseif($section['score'] >= 2.51): ?> Baik
                                    <?php elseif($section['score'] >= 1.76): ?> Cukup
                                    <?php else: ?> Kurang
                                    <?php endif; ?>
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
    
    <div class="flex flex-col items-center justify-center py-20 bg-white/50 backdrop-blur-sm rounded-3xl border border-dashed border-slate-300">
        <div class="w-24 h-24 mb-4 opacity-60">
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
        </div>
        <p class="text-slate-500 font-medium">Belum ada data responden unit Anda untuk program ini.</p>
    </div>
    <?php else: ?>
    
    <div class="flex flex-col items-center justify-center py-24 px-4 bg-white/60 backdrop-blur-xl rounded-3xl shadow-sm border-2 border-dashed border-slate-200">
        <div class="w-32 h-32 mb-6 drop-shadow-sm animate-float">
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Magnifying%20Glass%20Tilted%20Right.png" alt="Search" class="w-full h-full object-contain">
        </div>
        <h3 class="text-xl font-black text-slate-700 mb-2">Mulai Analisis</h3>
        <p class="text-slate-500 text-center max-w-md">Silakan pilih program survei di atas untuk melihat laporan detail unit Anda.</p>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.unit_kerja_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/reports/index.blade.php ENDPATH**/ ?>