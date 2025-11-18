

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 bg-gray-800 text-white p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-7m-6 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2h-5a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Laporan Detail per Responden</h1>
                        <p class="text-sm text-gray-500 mt-1">Unit Kerja: <span class="font-semibold"><?php echo e($unitKerja->unit_kerja_name); ?></span></p>
                        <p class="text-sm text-gray-500">Program: <?php echo e($program->title); ?></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="<?php echo e(route('superadmin.reports.index', ['program_id' => $program->id])); ?>" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border border-gray-300 shadow-sm">
                    &larr; Kembali ke Laporan Agregat
                </a>
            </div>
        </div>
    </div>

    <?php if(!empty($reportData)): ?>
    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider sticky left-0 z-10">
                        Nama Responden
                    </th>
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-800 text-center text-xs font-semibold text-white uppercase tracking-wider">
                        <?php echo e($section->title); ?> (Rata-rata)
                    </th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Rata-rata Total
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50 group">
                    <td class="px-6 py-4 border-b border-gray-200 bg-white text-sm sticky left-0 group-hover:bg-gray-50">
                        <p class="text-gray-900 font-semibold whitespace-no-wrap"><?php echo e($row['respondent_name']); ?></p>
                    </td>
                    <?php $__currentLoopData = $row['section_scores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="px-6 py-4 border-b border-gray-200 bg-white text-sm text-center">
                        <p class="text-gray-900 whitespace-no-wrap"><?php echo e(number_format($score, 2)); ?></p>
                    </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td class="px-6 py-4 border-b border-gray-200 bg-white text-sm font-bold text-center">
                        <p class="text-gray-900 whitespace-no-wrap"><?php echo e(number_format($row['total_avg'], 2)); ?></p>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="text-center py-16 px-4 bg-white rounded-lg shadow-sm border-2 border-dashed">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="mt-4 font-semibold text-gray-600">Belum Ada Data</p>
        <p class="text-sm mt-1 text-gray-500">Belum ada responden yang mengisi survei untuk unit kerja ini.</p>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/reports/show_unit.blade.php ENDPATH**/ ?>