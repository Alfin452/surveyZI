
<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Program Survei']); ?>

    
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 md:py-24">
        
        <div class="text-center mb-12 sm:mb-16 md:mb-20 section-title-anim">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 tracking-tight">Semua Program Survei</h1>
            <p class="mt-4 max-w-2xl mx-auto text-base sm:text-lg text-gray-600">Pilih salah satu program survei yang sedang aktif di bawah ini.</p>
        </div>

        
        <div class="programs-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 md:gap-8 max-w-6xl mx-auto">
            <?php $__empty_1 = true; $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <a href="<?php echo e(route('public.survey.directory', $program)); ?>"
                class="program-card group block rounded-3xl shadow-lg hover:shadow-2xl 
                      transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden
                      bg-white/50 backdrop-blur-lg border border-white/30">

                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 absolute -bottom-8 -right-8 text-gray-900 opacity-[0.03] group-hover:opacity-10 transition-all duration-300 transform group-hover:rotate-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>

                
                <div class="relative z-10 p-6 flex flex-col h-full space-y-4">
                    
                    <div>
                        <span class="inline-block bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full border border-green-200/50">
                            <?php echo e($program->start_date?->format('d M Y') ?? 'N/A'); ?> - <?php echo e($program->end_date?->format('d M Y') ?? 'N/A'); ?>

                        </span>
                    </div>

                    
                    <div class="flex-grow">
                        <h3 class="text-xl font-black text-gray-900 group-hover:text-indigo-600 transition-colors duration-300" style="min-height: 4.5rem;">
                            <?php echo e($program->title); ?>

                        </h3>
                    </div>

                    
                    <div class="pt-4 flex justify-end">
                        <div class="flex items-center text-indigo-600 font-bold text-sm group-hover:text-indigo-700">
                            <span class="mr-2">Lihat Unit Layanan</span>
                            <div class="h-8 w-8 flex items-center justify-center rounded-full bg-indigo-100 group-hover:bg-gradient-to-r group-hover:from-indigo-600 group-hover:to-purple-600 group-hover:text-white text-indigo-600 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state sm:col-span-2 lg:col-span-3 text-center py-12 sm:py-16 md:py-20 px-4">
                <div class="max-w-md mx-auto">
                    <div class="bg-slate-100 rounded-full w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 sm:h-12 sm:w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Belum Ada Program Aktif</h3>
                    <p class="text-sm sm:text-base text-gray-600">Saat ini belum ada program survei lain yang tersedia. Silakan kembali lagi nanti.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/public/programs-list.blade.php ENDPATH**/ ?>