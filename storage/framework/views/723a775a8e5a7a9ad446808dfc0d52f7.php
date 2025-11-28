<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Data Responden - ' . $program->title)]); ?>

    <?php $__env->startPush('styles'); ?>
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Background Noise */
        .bg-noise {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -10;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Gradient Mesh */
        .bg-mesh {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -20;
            background: radial-gradient(circle at 0% 0%, #f8fafc 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, #f1f5f9 0%, transparent 50%);
            background-color: #ffffff;
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
    </style>
    <?php $__env->stopPush(); ?>

    
    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="min-h-screen flex flex-col items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative">

        
        <div class="text-center mb-14 form-anim">
            <div class="inline-block border border-slate-300 px-3 py-1 rounded-full mb-6">
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">
                    <?php echo e($program->title); ?>

                </span>
            </div>
            <h1 class="text-5xl font-black text-slate-900 tracking-tight mb-4 leading-tight">
                Data Responden
            </h1>
            <p class="text-slate-500 font-medium text-lg max-w-lg mx-auto leading-relaxed">
                Mohon lengkapi data diri Anda sesuai formulir berikut.
            </p>
        </div>

        
        <div class="w-full max-w-3xl bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden form-anim">

            
            <div class="absolute top-0 left-0 w-full h-1 bg-slate-900"></div>

            <form action="<?php echo e(route('public.pre-survey.store', ['program' => $program, 'unitKerja' => $unitKerja])); ?>" method="POST" class="p-10 sm:p-16">
                <?php echo csrf_field(); ?>

                <div class="space-y-10">

                    
                    <div class="mb-8 border-b border-slate-100 pb-4">
                        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-[0.15em]">Identitas Diri</h3>
                    </div>

                    
                    <?php if($program->formFields->count() > 0): ?>
                    <?php $__currentLoopData = $program->formFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    // Logic Autofill
                    $defaultValue = old('dynamic_data.'.$field->field_label);
                    if (!$defaultValue && (stripos($field->field_label, 'nama') !== false)) {
                    $defaultValue = Auth::user()->username;
                    }
                    ?>

                    <div class="group">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3 ml-1">
                            <?php echo e($field->field_label); ?>

                            <?php if($field->is_required): ?> <span class="text-red-400">*</span> <?php endif; ?>
                        </label>

                        
                        <?php if($field->field_type == 'text'): ?>
                        <input type="text"
                            name="dynamic_data[<?php echo e($field->field_label); ?>]"
                            <?php echo e($field->is_required ? 'required' : ''); ?>

                            value="<?php echo e($defaultValue); ?>"
                            maxlength="100"
                            class="block w-full px-6 py-4 bg-slate-50 border-0 ring-1 ring-slate-200 rounded-2xl text-slate-900 font-bold text-base placeholder:text-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-900 transition-all shadow-sm"
                            placeholder="Masukkan <?php echo e($field->field_label); ?>...">
                        <p class="text-[10px] text-slate-400 mt-2 text-right tracking-wide">Maks. 100 karakter</p>

                        
                        <?php elseif($field->field_type == 'number'): ?>
                        <input type="number"
                            name="dynamic_data[<?php echo e($field->field_label); ?>]"
                            <?php echo e($field->is_required ? 'required' : ''); ?>

                            value="<?php echo e($defaultValue); ?>"
                            oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15);"
                            class="block w-full px-6 py-4 bg-slate-50 border-0 ring-1 ring-slate-200 rounded-2xl text-slate-900 font-bold text-base placeholder:text-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-900 transition-all shadow-sm"
                            placeholder="Hanya angka...">
                        <p class="text-[10px] text-slate-400 mt-2 text-right tracking-wide">Maks. 15 digit</p>

                        
                        <?php elseif($field->field_type == 'date'): ?>
                        <input type="date"
                            name="dynamic_data[<?php echo e($field->field_label); ?>]"
                            <?php echo e($field->is_required ? 'required' : ''); ?>

                            value="<?php echo e($defaultValue); ?>"
                            class="block w-full px-6 py-4 bg-slate-50 border-0 ring-1 ring-slate-200 rounded-2xl text-slate-900 font-bold text-base placeholder:text-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-900 transition-all shadow-sm">

                        
                        <?php elseif($field->field_type == 'select'): ?>
                        <div x-data="{ 
                                open: false, 
                                selected: '<?php echo e(old('dynamic_data.'.$field->field_label)); ?>',
                                options: <?php echo e(json_encode($field->field_options)); ?>

                             }" class="relative">

                            <input type="hidden" name="dynamic_data[<?php echo e($field->field_label); ?>]" :value="selected" <?php echo e($field->is_required ? 'required' : ''); ?>>

                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="w-full flex items-center justify-between px-6 py-4 bg-slate-50 border-0 ring-1 ring-slate-200 rounded-2xl text-left transition-all focus:bg-white focus:ring-2 focus:ring-slate-900"
                                :class="{'bg-white ring-2 ring-slate-900': open}">
                                <span class="text-base font-bold text-slate-900 truncate" x-text="selected ? selected : 'Pilih Opsi...'" :class="{'text-slate-300': !selected}"></span>
                                <div class="text-slate-400 transition-transform duration-300" :class="{'rotate-180 text-slate-900': open}">
                                    <div class="w-0 h-0 border-l-[5px] border-l-transparent border-r-[5px] border-r-transparent border-t-[6px] border-t-current"></div>
                                </div>
                            </button>

                            <div x-show="open" x-transition class="absolute z-50 w-full mt-2 bg-white rounded-2xl shadow-2xl shadow-slate-200/50 ring-1 ring-black/5 py-2 max-h-[240px] overflow-y-auto custom-scrollbar" style="display: none;">
                                <template x-for="option in options" :key="option">
                                    <div @click="selected = option; open = false"
                                        class="px-6 py-3 text-sm font-bold text-slate-500 cursor-pointer hover:bg-slate-50 hover:text-slate-900 transition-colors flex justify-between items-center">
                                        <span x-text="option"></span>
                                        <div x-show="selected === option" class="w-2 h-2 rounded-full bg-slate-900"></div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        
                        <?php elseif($field->field_type == 'radio'): ?>
                        <div class="flex flex-wrap gap-3">
                            <?php $__currentLoopData = $field->field_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="cursor-pointer relative">
                                <input type="radio" name="dynamic_data[<?php echo e($field->field_label); ?>]" value="<?php echo e($option); ?>" class="peer sr-only" <?php echo e($field->is_required ? 'required' : ''); ?>

                                    <?php echo e(old('dynamic_data.'.$field->field_label) == $option ? 'checked' : ''); ?>>

                                <div class="px-5 py-3 rounded-xl bg-slate-50 ring-1 ring-slate-200 text-sm font-bold text-slate-400 transition-all 
                                                        peer-checked:bg-white peer-checked:text-slate-900 peer-checked:ring-2 peer-checked:ring-slate-900 peer-checked:shadow-md hover:bg-white">
                                    <?php echo e($option); ?>

                                </div>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>

                        <?php $__errorArgs = ['dynamic_data.'.$field->field_label];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs text-red-500 font-bold ml-1 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <?php echo e($message); ?>

                        </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <div class="text-center py-10 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                        <p class="text-slate-400 text-sm font-medium">Formulir data diri belum dikonfigurasi oleh Admin.</p>
                    </div>
                    <?php endif; ?>

                </div>

                
                <div class="mt-16 pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        DATA TERENKRIPSI & AMAN
                    </div>

                    <button type="submit" class="w-full sm:w-auto bg-slate-900 text-white px-12 py-4 rounded-2xl font-bold text-sm tracking-[0.15em] uppercase hover:bg-slate-800 hover:shadow-xl hover:shadow-slate-200 hover:-translate-y-0.5 transition-all duration-300 active:scale-95">
                        Lanjutkan
                    </button>
                </div>

            </form>
        </div>

        
        <div class="mt-12 text-[10px] font-bold text-slate-300 uppercase tracking-[0.2em] form-anim">
            &copy; <?php echo e(date('Y')); ?> SurveyZI <span class="mx-2 opacity-30">|</span> <?php echo e($unitKerja->unit_kerja_name); ?>

        </div>

    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.form-anim', {
                    opacity: 0,
                    y: 30,
                    duration: 1,
                    stagger: 0.15,
                    ease: "power3.out"
                });
            }
        });
    </script>
    <?php $__env->stopPush(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/public/pre-survey-form.blade.php ENDPATH**/ ?>