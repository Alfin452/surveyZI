<?php
// Data Default untuk AlpineJS
$defaultOptions = [['id' => null, 'text' => '', 'score' => 1], ['id' => null, 'text' => '', 'score' => 1]];

// Ambil Data dari Database jika Edit
$dbOptions = null;
if (isset($question) && $question->options->isNotEmpty()) {
$dbOptions = $question->options->map(fn($o) => ['id' => $o->id, 'text' => $o->option_body, 'score' => $o->option_score])->toArray();
}

// Prioritas Data: Old Input > Database > Default
$finalOptions = array_values(old('options') ?? $dbOptions ?? $defaultOptions);
?>


<div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl p-8"
    x-data="questionFormHandler()">

    <div class="space-y-8">

        
        <input type="hidden" name="type" value="radio">

        <div class="grid grid-cols-1 gap-6">
            
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase ml-1">Bagian Soal</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <select name="question_section_id" class="block w-full pl-10 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all shadow-sm cursor-pointer hover:bg-white">
                        <?php $__currentLoopData = $program->questionSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($sec->id); ?>" <?php echo e((old('question_section_id') ?? $question->question_section_id ?? $section->id ?? '') == $sec->id ? 'selected' : ''); ?>>
                            <?php echo e($sec->title); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['question_section_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-500 text-xs mt-1 ml-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="space-y-2">
                <label class="block text-xs font-bold text-slate-500 uppercase ml-1">Pertanyaan <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <div class="absolute top-3 left-0 pl-4 flex items-start pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <textarea name="question_body" rows="3" required
                        class="block w-full pl-11 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all shadow-sm resize-none placeholder-slate-400 hover:bg-white"
                        placeholder="Tuliskan pertanyaan Anda di sini..."><?php echo e(old('question_body', $question->question_body ?? '')); ?></textarea>
                </div>
                <?php $__errorArgs = ['question_body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-500 text-xs mt-1 ml-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        
        <div class="space-y-4 pt-6 border-t border-slate-100">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Opsi Jawaban
                </h3>
                <button type="button" @click="addOption()" class="text-xs font-bold text-teal-600 bg-teal-50 hover:bg-teal-100 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Opsi
                </button>
            </div>

            <div class="space-y-3">
                <template x-for="(option, index) in options" :key="index">
                    <div class="flex items-center gap-3 group animate-fade-in-down">
                        
                        <div class="text-slate-300 cursor-move"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                            </svg></div>

                        
                        <div class="flex-1 relative">
                            <input type="text" :name="'options[' + index + '][text]'" x-model="option.text" placeholder="Teks Jawaban" required
                                class="block w-full pl-4 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all shadow-sm">
                        </div>

                        
                        <div class="w-24 relative" title="Bobot Nilai">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs font-bold">pts</div>
                            <input type="number" :name="'options[' + index + '][score]'" x-model="option.score" placeholder="0" required
                                class="block w-full pl-8 pr-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-center focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all shadow-sm">
                        </div>

                        
                        <input type="hidden" :name="'options[' + index + '][id]'" x-model="option.id">

                        
                        <button type="button" @click="removeOption(index)" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>

            
            <button type="button" @click="addOption()"
                class="mt-4 w-full py-3 border-2 border-dashed border-slate-300 rounded-xl text-slate-500 text-sm font-bold hover:border-teal-400 hover:text-teal-600 hover:bg-teal-50 transition-all flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Opsi Jawaban Lain
            </button>
        </div>

        
        <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
            <a href="<?php echo e(route('unitkerja.admin.programs.questions.index', $program)); ?>" class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-500 hover:to-emerald-500 shadow-lg hover:-translate-y-1 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Pertanyaan
            </button>
        </div>
    </div>
</div>

<script>
    function questionFormHandler() {
        return {
            options: <?php echo json_encode($finalOptions, 15, 512) ?>,
            addOption() {
                this.options.push({
                    id: null,
                    text: '',
                    score: 1
                });
            },
            removeOption(index) {
                if (this.options.length > 1) this.options.splice(index, 1);
            }
        }
    }
</script>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.3s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style><?php /**PATH C:\laragon\www\surveyZI\resources\views/unit_kerja_admin/programs/questions/_form.blade.php ENDPATH**/ ?>