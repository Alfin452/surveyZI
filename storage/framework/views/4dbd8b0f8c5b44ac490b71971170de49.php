
<div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl p-8">
    <div class="space-y-10">

        
        <div class="space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Identitas Unit Kerja</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="group">
                    <label for="unit_kerja_name" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Nama Unit <span class="text-rose-500">*</span></label>
                    <input type="text" name="unit_kerja_name" id="unit_kerja_name"
                        value="<?php echo e(old('unit_kerja_name', $unitKerja->unit_kerja_name ?? '')); ?>" required
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="Contoh: Fakultas Tarbiyah dan Keguruan">
                    <?php $__errorArgs = ['unit_kerja_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="group">
                    <label for="uk_short_name" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Singkatan / Alias</label>
                    <input type="text" name="uk_short_name" id="uk_short_name"
                        value="<?php echo e(old('uk_short_name', $unitKerja->uk_short_name ?? '')); ?>"
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="Contoh: FTK">
                    <?php $__errorArgs = ['uk_short_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="group">
                    <label for="tipe_unit_id" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Tipe Unit <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="tipe_unit_id" id="tipe_unit_id" required
                            class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all cursor-pointer hover:bg-white">
                            <option value="">-- Pilih Tipe --</option>
                            <?php $__currentLoopData = $tipeUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tipe->id); ?>" <?php echo e((old('tipe_unit_id') ?? $unitKerja->tipe_unit_id ?? '') == $tipe->id ? 'selected' : ''); ?>>
                                <?php echo e($tipe->nama_tipe_unit); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__errorArgs = ['tipe_unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="group">
                    <label for="parent_id" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Unit Induk (Opsional)</label>
                    <div class="relative">
                        <select name="parent_id" id="parent_id"
                            class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all cursor-pointer hover:bg-white">
                            <option value="">-- Tidak Ada (Top Level) --</option>
                            <?php $__currentLoopData = $parentUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($parent->id); ?>" <?php echo e((old('parent_id') ?? $unitKerja->parent_id ?? '') == $parent->id ? 'selected' : ''); ?>>
                                <?php echo e($parent->unit_kerja_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__errorArgs = ['parent_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="pt-6 border-t border-slate-100 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-teal-100 text-teal-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Kontak & Lokasi</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="group">
                    <label for="contact" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Kontak (Email/Telp)</label>
                    <input type="text" name="contact" id="contact"
                        value="<?php echo e(old('contact', $unitKerja->contact ?? '')); ?>"
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="Contoh: admin.ftk@uin-antasari.ac.id">
                    <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="group">
                    <label for="address" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Alamat Lengkap</label>
                    <input type="text" name="address" id="address"
                        value="<?php echo e(old('address', $unitKerja->address ?? '')); ?>"
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="Contoh: Gedung A, Lantai 2, Kampus 1">
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="pt-6 border-t border-slate-100 space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Jam Pelayanan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="start_time" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Jam Buka</label>
                    <input type="text" name="start_time" id="start_time"
                        value="<?php echo e(old('start_time', $unitKerja->start_time ?? '')); ?>"
                        class="timepicker block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="08:00">
                </div>
                <div class="group">
                    <label for="end_time" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Jam Tutup</label>
                    <input type="text" name="end_time" id="end_time"
                        value="<?php echo e(old('end_time', $unitKerja->end_time ?? '')); ?>"
                        class="timepicker block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="16:00">
                </div>
            </div>
        </div>

        
        <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
            <a href="<?php echo e(route('superadmin.unit-kerja.index')); ?>"
                class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 shadow-lg hover:shadow-emerald-500/30 hover:-translate-y-1 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Data
            </button>
        </div>

    </div>
</div><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/unit_kerja/_form.blade.php ENDPATH**/ ?>