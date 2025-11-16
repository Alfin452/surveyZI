

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
                        <h1 class="text-xl font-bold text-gray-800">Laporan Agregat</h1>
                        <p class="text-sm text-gray-500 mt-1">Tabel skor rata-rata per unit kerja untuk program survei institusional.</p>
                    </div>
                </div>
            </div>
            <?php if($selectedProgram): ?>
            <a href="<?php echo e(route('superadmin.reports.export', ['program_id' => $selectedProgram->id])); ?>" class="mt-4 md:mt-0 bg-green-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-300 shadow-sm flex items-center space-x-2 self-start md:self-end">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span>Ekspor ke Excel</span>
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 relative z-20">
        <form action="<?php echo e(route('superadmin.reports.index')); ?>" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="program_id" class="block text-sm font-medium text-gray-700">Pilih Program Survei</label>
                    <select id="program_id" name="program_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                        <option value="">Pilih program...</option>
                        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($program->id); ?>" <?php echo e($selectedProgram && $selectedProgram->id == $program->id ? 'selected' : ''); ?>>
                            <?php echo e($program->title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full md:w-auto inline-flex justify-center rounded-md border border-transparent bg-gray-800 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700">
                        Tampilkan Laporan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php if($selectedProgram): ?>
    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-indigo-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider sticky left-0 z-10">
                        Unit Kerja
                    </th>
                    <?php $section = ''; ?>
                    <?php $__currentLoopData = $selectedProgram->questionSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($section->title != $section): ?>
                    <?php $section = $section->title; ?>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-indigo-600 text-center text-xs font-semibold text-white uppercase tracking-wider">
                        <?php echo e($section); ?> (Rata-rata)
                    </th>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-indigo-50 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider sticky right-0 z-10">
                        Rata-rata Total
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-indigo-50 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unitReport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-indigo-50/50 group">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm sticky left-0 group-hover:bg-indigo-50/50">
                        <p class="text-gray-900 font-semibold whitespace-no-wrap"><?php echo e($unitReport['unit_name']); ?></p>
                    </td>
                    <?php $__currentLoopData = $unitReport['section_scores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center group-hover:bg-indigo-50/50">
                        <p class="text-gray-900 whitespace-no-wrap"><?php echo e(number_format($score, 2)); ?></p>
                    </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold text-center sticky right-0 group-hover:bg-indigo-50/50">
                        <p class="text-indigo-700 whitespace-no-wrap"><?php echo e(number_format($unitReport['total_avg'], 2)); ?></p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center group-hover:bg-indigo-50/50">
                        <a href="<?php echo e(route('superadmin.reports.showUnit', [$selectedProgram->id, $unitReport['unit_id']])); ?>" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php elseif($selectedProgram): ?>
    <div class="mt-6 text-center text-gray-500">
        Belum ada data laporan untuk program ini.
    </div>
    <?php else: ?>
    <div class="text-center py-16 px-4 bg-white rounded-lg shadow-sm border-2 border-dashed">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
        </svg>
        <p class="mt-4 font-semibold text-gray-600">Pilih Program Survei</p>
        <p class="text-sm mt-1 text-gray-500">Silakan pilih salah satu program survei di atas untuk menampilkan laporan.</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect('#program_id', {
            placeholder: 'Pilih program survei...',
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/reports/index.blade.php ENDPATH**/ ?>