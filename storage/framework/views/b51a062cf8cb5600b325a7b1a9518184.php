<div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
    <div class="space-y-8">

        
        <div class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                    Judul Program Survei <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title"
                    value="<?php echo e(old('title', $program->title ?? '')); ?>"
                    required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-1 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Contoh: Survei Penilaian Zona Integritas 2025">

                <div class="mt-1 min-h-5">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs block"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-1 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Jelaskan tujuan umum dari program survei ini..."><?php echo e(old('description', $program->description ?? '')); ?></textarea>

                <div class="mt-1 min-h-5">
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs block"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="space-y-4 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-900">Periode Program</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Mulai Program <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="start_date" id="start_date"
                        value="<?php echo e(old('start_date', $program->start_date?->format('Y-m-d'))); ?>"
                        required
                        class="datepicker block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-1 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="Pilih tanggal...">

                    <div class="mt-1 min-h-5">
                        <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-xs block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Selesai Program <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="end_date" id="end_date"
                        value="<?php echo e(old('end_date', $program->end_date?->format('Y-m-d'))); ?>"
                        required
                        class="datepicker block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 ring-1 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="Pilih tanggal...">

                    <div class="mt-1 min-h-5">
                        <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-xs block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="space-y-4 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-900">Opsi Program</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="is_active" name="is_active" type="checkbox" value="1"
                            <?php echo e(old('is_active', $program->is_active ?? true) ? 'checked' : ''); ?>

                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="is_active" class="font-medium text-gray-900">Aktifkan Program</label>
                        <p class="text-gray-500">Akan terlihat di halaman publik.</p>
                    </div>
                </div>

                <div class="relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="requires_pre_survey" name="requires_pre_survey" type="checkbox" value="1"
                            <?php echo e(old('requires_pre_survey', $program->requires_pre_survey ?? true) ? 'checked' : ''); ?>

                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="requires_pre_survey" class="font-medium text-gray-900">Wajibkan Pra-Survei</label>
                        <p class="text-gray-500">Responden wajib isi data diri.</p>
                    </div>
                </div>

                <div class="relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="is_featured" name="is_featured" type="checkbox" value="1"
                            <?php echo e(old('is_featured', $program->is_featured ?? false) ? 'checked' : ''); ?>

                            class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="is_featured" class="font-medium text-gray-900">Program Unggulan</label>
                        <p class="text-gray-500">Tampilkan di Halaman Utama.</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="space-y-4 pt-6 border-t border-gray-200">
            <div>
                <label for="targeted_unit_kerjas_select" class="block text-sm font-medium text-gray-900 mb-1">
                    Targetkan ke Unit Kerja <span class="text-red-500">*</span>
                </label>
                <p class="text-sm text-gray-500 mb-2">Pilih minimal satu unit kerja yang akan mengisi survei ini.</p>

                <div class="flex gap-2 mb-2">
                    <button type="button" id="select-all-button" class="px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Pilih Semua
                    </button>
                    <button type="button" id="deselect-all-button" class="px-3 py-1 text-xs font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                        Hapus Semua
                    </button>
                </div>

                <select
                    name="targeted_unit_kerjas[]"
                    id="targeted_unit_kerjas_select"
                    multiple
                    required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <?php $__currentLoopData = $unitKerjas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($unit->id); ?>"
                        <?php echo e(in_array($unit->id, old('targeted_unit_kerjas', $program->targetedUnitKerjas?->pluck('id')->toArray() ?? [])) ? 'selected' : ''); ?>>
                        <?php echo e($unit->unit_kerja_name); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <div class="mt-1 min-h-5">
                    <?php $__errorArgs = ['targeted_unit_kerjas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-xs block"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
            <a href="<?php echo e(route('superadmin.programs.index')); ?>"
                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Batal
            </a>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Simpan Program
            </button>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/programs/_form.blade.php ENDPATH**/ ?>