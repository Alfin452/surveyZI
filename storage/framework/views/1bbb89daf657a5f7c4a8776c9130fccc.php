

<?php $__env->startSection('content'); ?>

<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-pink-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-6">

    
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-indigo-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 via-indigo-500/5 to-violet-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                
                <div class="w-14 h-14 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Bar%20Chart.png" alt="Report Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Laporan Agregat</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5">Rekapitulasi skor rata-rata per unit kerja untuk analisis data.</p>
                </div>
            </div>

            <?php if($selectedProgram): ?>
            <a href="<?php echo e(route('superadmin.reports.export', ['program_id' => $selectedProgram->id])); ?>"
                class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white rounded-xl font-bold shadow-lg hover:shadow-emerald-500/30 hover:-translate-y-1 transition-all duration-300 text-sm">
                <div class="bg-white/20 p-1 rounded-lg group-hover:rotate-12 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </div>
                <span>Ekspor Excel</span>
            </a>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-lg rounded-2xl p-5 z-20 relative">
        <form action="<?php echo e(route('superadmin.reports.index')); ?>" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label for="program_id" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Pilih Program Survei</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <select id="program_id" name="program_id" required
                        class="block w-full pl-10 pr-10 py-3 border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white/80 placeholder-gray-400 transition-all shadow-sm cursor-pointer hover:bg-white">
                        <option value="">-- Silakan Pilih Program --</option>
                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($program->id); ?>" <?php echo e($selectedProgram && $selectedProgram->id == $program->id ? 'selected' : ''); ?>>
                            <?php echo e($program->title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-6 py-3 rounded-xl font-bold shadow-md transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Tampilkan Laporan
                </button>
            </div>
        </form>
    </div>

    
    <?php if($selectedProgram): ?>
    <div class="bg-white/80 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl overflow-hidden relative">

        
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-600 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                        
                        <th class="px-6 py-4 text-left sticky left-0 bg-slate-50 z-20 shadow-r border-r border-slate-100">
                            Unit Kerja
                        </th>

                        <?php $__currentLoopData = $selectedProgram->questionSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th class="px-6 py-4 text-center min-w-[150px]">
                            <span class="block text-indigo-600"><?php echo e($section->title); ?></span>
                            <span class="text-[10px] text-slate-400 normal-case font-normal">Rata-rata</span>
                        </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <th class="px-6 py-4 text-center sticky right-[80px] bg-indigo-50 text-indigo-700 z-10 border-l border-indigo-100 shadow-l">
                            Total Skor
                        </th>
                        <th class="px-6 py-4 text-center sticky right-0 bg-slate-50 z-20 w-[80px]">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unitReport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-indigo-50/30 transition-colors duration-150 group">
                        
                        <td class="px-6 py-4 font-bold text-slate-700 sticky left-0 bg-white group-hover:bg-indigo-50/30 z-20 border-r border-slate-50 shadow-sm">
                            <?php echo e($unitReport['unit_name']); ?>

                        </td>

                        
                        <?php $__currentLoopData = $unitReport['section_scores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="px-6 py-4 text-center text-slate-600">
                            <span class="inline-block px-2 py-1 rounded-lg <?php echo e($score >= 3 ? 'bg-green-50 text-green-700' : ($score >= 2 ? 'bg-yellow-50 text-yellow-700' : 'bg-red-50 text-red-700')); ?> font-mono font-semibold">
                                <?php echo e(number_format($score, 2)); ?>

                            </span>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <td class="px-6 py-4 text-center sticky right-[80px] bg-white group-hover:bg-indigo-50/30 z-10 border-l border-slate-50">
                            <span class="text-lg font-black text-indigo-600"><?php echo e(number_format($unitReport['total_avg'], 2)); ?></span>
                        </td>

                        
                        <td class="px-6 py-4 text-center sticky right-0 bg-white group-hover:bg-indigo-50/30 z-20">
                            <a href="<?php echo e(route('superadmin.reports.showUnit', [$selectedProgram->id, $unitReport['unit_id']])); ?>"
                                class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-400 hover:text-indigo-600 hover:border-indigo-200 flex items-center justify-center transition-all shadow-sm hover:shadow-md"
                                title="Lihat Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="100%" class="py-12 text-center text-slate-400 italic">
                            Belum ada respons masuk untuk program ini.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php elseif($selectedProgram): ?>
    
    <div class="flex flex-col items-center justify-center py-20 bg-white/50 backdrop-blur-sm rounded-3xl border border-dashed border-slate-300">
        <div class="w-24 h-24 mb-4 opacity-60">
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
        </div>
        <p class="text-slate-500 font-medium">Belum ada data laporan untuk program ini.</p>
    </div>

    <?php else: ?>
    
    <div class="flex flex-col items-center justify-center py-24 px-4 bg-white/60 backdrop-blur-xl rounded-3xl shadow-sm border-2 border-dashed border-slate-200">
        <div class="w-32 h-32 mb-6 drop-shadow-sm animate-float">
            <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Magnifying%20Glass%20Tilted%20Right.png" alt="Search" class="w-full h-full object-contain">
        </div>
        <h3 class="text-xl font-black text-slate-700 mb-2">Pilih Program Survei</h3>
        <p class="text-slate-500 text-center max-w-md">Silakan pilih salah satu program survei pada menu di atas untuk menampilkan analisis data laporan.</p>
    </div>
    <?php endif; ?>
</div>

<style>
    /* Custom Scrollbar untuk Tabel Lebar */
    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Animasi Mengambang */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    /* Shadow untuk Sticky Columns */
    .shadow-r {
        box-shadow: 4px 0 12px -4px rgba(0, 0, 0, 0.05);
    }

    .shadow-l {
        box-shadow: -4px 0 12px -4px rgba(0, 0, 0, 0.05);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/reports/index.blade.php ENDPATH**/ ?>