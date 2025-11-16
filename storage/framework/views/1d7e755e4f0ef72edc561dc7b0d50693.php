

<?php $__env->startSection('content'); ?>
<div class="space-y-6" x-data="{ activeTab: 'institusional' }">

    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 bg-gray-800 text-white p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Program Survei</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola program yang ditugaskan dan program yang Anda buat.</p>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(route('unitkerja.admin.my-programs.create')); ?>" class="mt-4 md:mt-0 bg-green-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-300 shadow-sm flex items-center space-x-2 self-start md:self-end">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Buat Program Baru</span>
            </a>
        </div>
    </div>

    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                <button @click="activeTab = 'institusional'"
                    :class="activeTab === 'institusional' ? 'border-gray-800 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Program Institusional
                    <span class="ml-1.5 rounded-full <?php echo e($institutionalPrograms->count() > 0 ? 'bg-gray-200 text-gray-700' : 'bg-gray-100 text-gray-500'); ?> py-0.5 px-2 text-xs"><?php echo e($institutionalPrograms->count()); ?></span>
                </button>
                <button @click="activeTab = 'myPrograms'"
                    :class="activeTab === 'myPrograms' ? 'border-gray-800 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                    Program Unit Saya
                    <span class="ml-1.5 rounded-full <?php echo e($myPrograms->total() > 0 ? 'bg-gray-200 text-gray-700' : 'bg-gray-100 text-gray-500'); ?> py-0.5 px-2 text-xs"><?php echo e($myPrograms->total()); ?></span>
                </button>
            </nav>
        </div>
    </div>

    <div>
        <div x-show="activeTab === 'institusional'" x-transition>
            <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Program</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $institutionalPrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 align-middle">
                                <div class="font-semibold text-gray-900"><?php echo e($program->title); ?></div>
                                <div class="text-sm text-gray-500"><?php echo e(Str::limit($program->description, 80)); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 align-middle">
                                <?php echo e($program->start_date?->format('d M Y') ?? 'N/A'); ?> - <?php echo e($program->end_date?->format('d M Y') ?? 'N/A'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
                                <a href="<?php echo e(route('unitkerja.admin.programs.results', $program)); ?>" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition shadow-sm">
                                    Lihat Hasil
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center py-12 px-4 text-gray-500">
                                Belum ada program institusional yang ditugaskan untuk Anda.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="activeTab === 'myPrograms'" x-transition>
            <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Program</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $myPrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 align-middle">
                                <a href="<?php echo e(route('unitkerja.admin.programs.questions.index', $program)); ?>" class="font-semibold text-gray-800 hover:text-black"><?php echo e($program->title); ?></a>
                                <div class="text-sm text-gray-500"><?php echo e(Str::limit($program->description, 80)); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                                <?php if($program->is_active): ?>
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                <?php else: ?>
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 align-middle">
                                <?php echo e($program->start_date?->format('d M Y') ?? 'N/A'); ?> - <?php echo e($program->end_date?->format('d M Y') ?? 'N/A'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium align-middle">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="<?php echo e(route('unitkerja.admin.programs.results', $program)); ?>" class="text-green-600 hover:text-green-800" title="Lihat Hasil">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                                        </svg>
                                    </a>
                                    <a href="<?php echo e(route('unitkerja.admin.programs.questions.index', $program)); ?>" class="text-blue-600 hover:text-blue-800" title="Kelola Pertanyaan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    <a href="<?php echo e(route('unitkerja.admin.my-programs.edit', $program)); ?>" class="text-blue-600 hover:text-blue-800" title="Edit Program">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="<?php echo e(route('unitkerja.admin.my-programs.clone', $program)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengkloning program ini?');">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="text-gray-500 hover:text-gray-700" title="Kloning Program">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <button type="button" @click="$dispatch('open-delete-modal', { url: '<?php echo e(route('unitkerja.admin.my-programs.destroy', $program)); ?>', name: '<?php echo e(addslashes($program->title)); ?>' })" class="text-red-600 hover:text-red-800" title="Hapus Program">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-12 px-4 text-gray-500">
                                Anda belum membuat program survei sendiri.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if($myPrograms->hasPages()): ?>
            <div class="mt-6">
                <?php echo e($myPrograms->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.unit_kerja_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/programs/index.blade.php ENDPATH**/ ?>