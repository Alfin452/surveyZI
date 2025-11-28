

<?php $__env->startSection('content'); ?>

<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-teal-400/10 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-indigo-400/10 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
</div>

<div class="relative z-10 space-y-8">

    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-white/60 backdrop-blur-xl p-8 rounded-[2rem] border border-white/40 shadow-sm">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-white text-indigo-600 rounded-2xl flex items-center justify-center shadow-sm border border-indigo-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 mb-1 uppercase tracking-wider">
                    <a href="<?php echo e(route('superadmin.reports.index', ['program_id' => $program->id])); ?>" class="hover:text-indigo-600 transition-colors">Laporan</a>
                    <span>/</span>
                    <span>Detail Unit</span>
                </nav>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight"><?php echo e($unitKerja->unit_kerja_name); ?></h1>
                <p class="text-slate-500 text-sm font-medium">Program: <span class="text-indigo-600"><?php echo e($program->title); ?></span></p>
            </div>
        </div>

        <div class="flex gap-3">
            
            <a href="<?php echo e(route('superadmin.reports.index', ['program_id' => $program->id])); ?>"
                class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 rounded-xl font-bold text-sm shadow-sm transition-all">
                &larr; Kembali
            </a>

            
            <a href="<?php echo e(route('superadmin.reports.export.unit', ['program' => $program, 'unit' => $unitKerja->id])); ?>"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-sm shadow-lg hover:bg-emerald-700 transition-all hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Unduh Excel
            </a>
        </div>
    </div>

    
    <?php if(!empty($reportData)): ?>
    <div class="bg-white/80 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl overflow-hidden relative">

        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-600 text-xs uppercase font-bold tracking-wider border-b border-slate-200">
                        <th class="px-6 py-4 text-left sticky left-0 bg-slate-50 z-20 shadow-r border-r border-slate-100 min-w-[200px]">
                            Nama Responden
                        </th>
                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th class="px-6 py-4 text-center min-w-[150px]">
                            <span class="block text-indigo-600"><?php echo e($section->title); ?></span>
                            <span class="text-[9px] text-slate-400 font-normal">Rata-rata</span>
                        </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <th class="px-6 py-4 text-center sticky right-0 bg-indigo-50 text-indigo-700 z-10 border-l border-indigo-100 shadow-l">
                            Total Skor
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 text-sm">
                    <?php $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-indigo-50/30 transition-colors duration-150 group">
                        
                        <td class="px-6 py-4 font-bold text-slate-700 sticky left-0 bg-white group-hover:bg-indigo-50/30 z-20 border-r border-slate-50 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-black text-slate-500">
                                    <?php echo e(strtoupper(substr($row['respondent_name'], 0, 1))); ?>

                                </div>
                                <?php echo e($row['respondent_name']); ?>

                            </div>
                        </td>

                        
                        <?php $__currentLoopData = $row['section_scores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="px-6 py-4 text-center text-slate-600">
                            <?php echo e(number_format($score, 2)); ?>

                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <td class="px-6 py-4 text-center sticky right-0 bg-white group-hover:bg-indigo-50/30 z-10 border-l border-slate-50">
                            <span class="font-black text-indigo-600"><?php echo e(number_format($row['total_avg'], 2)); ?></span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    
    <div class="text-center py-24 bg-white rounded-[3rem] border border-dashed border-slate-200">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 opacity-50">
            <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Responden</h3>
        <p class="text-slate-500 text-sm">Belum ada data yang masuk untuk unit kerja ini.</p>
    </div>
    <?php endif; ?>

</div>

<style>
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

    .shadow-r {
        box-shadow: 4px 0 12px -4px rgba(0, 0, 0, 0.05);
    }

    .shadow-l {
        box-shadow: -4px 0 12px -4px rgba(0, 0, 0, 0.05);
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/reports/show_unit.blade.php ENDPATH**/ ?>