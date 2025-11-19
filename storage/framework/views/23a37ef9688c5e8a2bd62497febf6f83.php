
<div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl p-8">
    <div class="space-y-10">

        
        <div class="space-y-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="p-2 bg-teal-100 text-teal-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Informasi Program</h3>
            </div>

            <div class="grid grid-cols-1 gap-6">
                
                <div class="group">
                    <label for="title" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">
                        Judul Program <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-teal-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <input type="text" name="title" id="title"
                            value="<?php echo e(old('title', $program->title ?? '')); ?>" required
                            class="block w-full pl-11 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                            placeholder="Contoh: Survei Evaluasi Kinerja Dosen 2025">
                    </div>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="group">
                    <label for="description" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all placeholder-slate-400 hover:bg-white"
                        placeholder="Jelaskan tujuan survei ini secara singkat..."><?php echo e(old('description', $program->description ?? '')); ?></textarea>
                    <?php $__errorArgs = ['description'];
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

        
        <div class="pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Periode Aktif</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="start_date" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Tanggal Mulai <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="start_date" id="start_date"
                            value="<?php echo e(old('start_date', $program->start_date?->format('Y-m-d'))); ?>" required
                            class="datepicker block w-full pl-4 pr-10 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer hover:bg-white"
                            placeholder="Pilih tanggal...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs mt-1 block ml-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="group">
                    <label for="end_date" class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Tanggal Selesai <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="end_date" id="end_date"
                            value="<?php echo e(old('end_date', $program->end_date?->format('Y-m-d'))); ?>" required
                            class="datepicker block w-full pl-4 pr-10 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer hover:bg-white"
                            placeholder="Pilih tanggal...">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <?php $__errorArgs = ['end_date'];
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

        
        <div class="pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Pengaturan Tambahan</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <label class="relative cursor-pointer group">
                    <input type="checkbox" name="is_active" value="1" class="peer sr-only" <?php echo e(old('is_active', $program->is_active ?? true) ? 'checked' : ''); ?>>
                    <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl hover:border-emerald-300 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all shadow-sm h-full">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-slate-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <p class="font-bold text-slate-700 group-hover:text-emerald-600">Publikasikan Survei</p>
                        <p class="text-xs text-slate-400 mt-1">Program dapat diakses oleh responden.</p>
                    </div>
                </label>

                
                <label class="relative cursor-pointer group">
                    <input type="checkbox" name="requires_pre_survey" value="1" class="peer sr-only" <?php echo e(old('requires_pre_survey', $program->requires_pre_survey ?? true) ? 'checked' : ''); ?>>
                    <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl hover:border-blue-300 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all shadow-sm h-full">
                        <div class="flex items-center justify-between mb-2">
                            <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.5 2-2 2h4c-1.5 0-2-1.116-2-2z" />
                                </svg>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-slate-200 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <p class="font-bold text-slate-700 group-hover:text-blue-600">Wajib Data Diri</p>
                        <p class="text-xs text-slate-400 mt-1">Responden wajib mengisi biodata.</p>
                    </div>
                </label>
            </div>
        </div>

        
        <div class="pt-6 border-t border-slate-100 flex flex-col-reverse md:flex-row justify-end gap-3">
            <a href="<?php echo e(route('unitkerja.admin.programs.index')); ?>"
                class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all text-center">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-500 hover:to-emerald-500 shadow-lg hover:shadow-teal-500/30 hover:-translate-y-1 transition-all">
                Simpan Program
            </button>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/programs/_form.blade.php ENDPATH**/ ?>