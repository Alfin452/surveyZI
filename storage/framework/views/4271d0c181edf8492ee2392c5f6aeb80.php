

<?php $__env->startSection('content'); ?>
<div class="space-y-1">
    
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 bg-gradient-to-br from-green-100 to-green-200 text-green-600 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Manajemen Unit Kerja</h1>
                        <p class="text-sm text-gray-500 mt-1">Kelola semua unit kerja yang terdaftar dalam sistem.</p>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(route('superadmin.unit-kerja.create')); ?>" class="mt-4 md:mt-0 bg-green-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-300 shadow-sm flex items-center space-x-2 self-start md:self-end">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Unit Kerja</span>
            </a>
        </div>
    </div>
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <form action="<?php echo e(route('superadmin.unit-kerja.index')); ?>" method="GET" class="space-y-4 md:space-y-0 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-4">
            <div>
                <label for="search" class="text-sm font-medium text-gray-700">Cari Nama</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg></div>
                    
                    <input type="text" id="search" name="search" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g. UPT TIPD" value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div>
                <label for="type" class="text-sm font-medium text-gray-700">Tipe Unit</label>
                
                <select id="type" name="type" class="mt-1 w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Tipe</option>
                    <?php $__currentLoopData = $tipeUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tipe->id); ?>" <?php echo e(request('type') == $tipe->id ? 'selected' : ''); ?>><?php echo e($tipe->nama_tipe_unit); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label for="parent" class="text-sm font-medium text-gray-700">Induk Unit</label>
                <select id="parent" name="parent" class="mt-1 w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua Induk</option>
                    <?php $__currentLoopData = $parentUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($parent->id); ?>" <?php echo e(request('parent') == $parent->id ? 'selected' : ''); ?>><?php echo e($parent->unit_kerja_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="flex items-end gap-3">
                <button type="submit" class="w-full bg-blue-600 text-white px-5 py-2 rounded-md font-semibold hover:bg-blue-700 transition shadow-sm flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter</span>
                </button>
                <a href="<?php echo e(route('superadmin.unit-kerja.index')); ?>" class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-gray-800 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">Reset</a>
            </div>
        </form>
    </div>

    
    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No.</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Unit</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Induk Unit</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stats</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $unitKerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-blue-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                        <?php echo e($unitKerja->firstItem() + $loop->index); ?>

                    </td>
                    <td class="px-6 py-4 align-top">
                        <div class="font-semibold text-gray-900"><?php echo e($unit->unit_kerja_name); ?></div>
                        <div class="text-sm text-gray-500"><?php echo e($unit->uk_short_name); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap align-top">
                        <?php if($unit->tipeUnit): ?>
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-800"><?php echo e($unit->tipeUnit->nama_tipe_unit); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700 align-top">
                        <?php echo e($unit->parent->unit_kerja_name ?? '—'); ?>

                    </td>

                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-top">
                        <div class="flex items-center justify-center divide-x divide-gray-200">
                            <div class="text-center px-4">
                                <p class="font-bold text-gray-800"><?php echo e($unit->users_count); ?></p>
                                <p class="text-xs">Admin</p>
                            </div>
                            <div class="text-center px-4">
                                <p class="font-bold text-gray-800"><?php echo e($unit->children_count); ?></p>
                                <p class="text-xs">Sub-unit</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium align-top">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="<?php echo e(route('superadmin.unit-kerja.edit', $unit)); ?>" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <button type="button" @click="$dispatch('open-delete-modal', { url: '<?php echo e(route('superadmin.unit-kerja.destroy', $unit)); ?>', name: '<?php echo e(addslashes($unit->unit_kerja_name)); ?>' })" class="text-red-600 hover:text-red-800" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-12 px-4">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <p class="mt-4 font-semibold text-gray-600">Data Tidak Ditemukan</p>
                            <p class="text-gray-500 text-sm mt-1">Belum ada unit kerja yang dibuat atau sesuai dengan filter Anda.</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php echo e($unitKerja->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.superadmin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/unit_kerja/index.blade.php ENDPATH**/ ?>