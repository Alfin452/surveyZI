<?php
// Menyiapkan data untuk Alpine.js sesuai logika asli Anda
// Menggunakan nama field asli: option_body & option_score
$optionsData = json_encode(
old('options', ($question->exists && $question->options->count())
? $question->options->map->only(['option_body', 'option_score'])
: [['option_body' => '', 'option_score' => '']]
)
);
?>


<div class="bg-white/60 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl p-8"
    x-data="{ options: <?php echo e($optionsData); ?> }">

    <div class="space-y-8">

        
        <input type="hidden" name="type" value="multiple_choice">

        
        <div class="space-y-2">
            <label for="question_body" class="block text-xs font-bold text-slate-500 uppercase ml-1">
                Teks Pertanyaan <span class="text-rose-500">*</span>
            </label>
            <div class="relative group">
                <div class="absolute top-3 left-0 pl-4 flex items-start pointer-events-none">
                    
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <textarea name="question_body" id="question_body" rows="3" required
                    class="block w-full pl-11 pr-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all shadow-sm placeholder-slate-400 hover:bg-white resize-none"
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

        
        <div class="pt-6 border-t border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-slate-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Opsi Jawaban
                </h3>
                
                <button type="button" @click="options.push({ option_body: '', option_score: '' })"
                    class="text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Opsi
                </button>
            </div>

            <div class="space-y-3">
                <template x-for="(option, index) in options" :key="index">
                    <div class="flex items-center gap-3 group animate-fade-in">
                        
                        <div class="text-slate-300 cursor-move">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                            </svg>
                        </div>

                        
                        <div class="flex-1 relative">
                            <input type="text" :name="`options[${index}][option_body]`" x-model="option.option_body" required
                                class="block w-full pl-4 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm"
                                placeholder="Tulis teks jawaban...">
                        </div>

                        
                        <div class="w-24 relative" title="Bobot Nilai">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs font-bold">pts</div>
                            <input type="number" :name="`options[${index}][option_score]`" x-model="option.option_score" required
                                class="block w-full pl-8 pr-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-center focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all shadow-sm"
                                placeholder="0">
                        </div>

                        
                        <button type="button" @click="if(options.length > 1) options.splice(index, 1)"
                            :class="{'opacity-50 cursor-not-allowed': options.length <= 1}"
                            class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all"
                            title="Hapus Opsi">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </template>
            </div>

            
            <div class="mt-2">
                <?php $__errorArgs = ['options.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['options'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-rose-500 text-xs block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <button type="button" @click="options.push({ option_body: '', option_score: '' })"
                class="mt-4 w-full py-3 border-2 border-dashed border-slate-300 rounded-xl text-slate-500 text-sm font-bold hover:border-indigo-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Opsi Jawaban Lain
            </button>
        </div>

    </div>

    
    <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
        <a href="<?php echo e(route('superadmin.programs.questions.index', $program)); ?>"
            class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 transition-all">
            Batal
        </a>
        <button type="submit"
            class="px-6 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Simpan Pertanyaan
        </button>
    </div>
</div>


<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style><?php /**PATH C:\laragon\www\surveyZI\resources\views/superadmin/programs/questions/_form.blade.php ENDPATH**/ ?>