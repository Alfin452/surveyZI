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

    <?php $__env->startPush('styles'); ?>
    <style>
        /* Animasi Fade In untuk Kartu */
        .program-card-anim {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <?php $__env->stopPush(); ?>

    
    <section class="relative pt-32 pb-12 bg-slate-50 overflow-hidden">
        
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-teal-500/10 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 right-[-10%] w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight">
                Program Survei
            </h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto">
                Temukan dan ikuti berbagai survei aktif untuk peningkatan mutu universitas.
            </p>
        </div>
    </section>

    
    <section class="relative pb-24 bg-slate-50 min-h-screen"
        x-data="{ 
            search: '', 
            isSearching: false,
            init() {
                this.$watch('search', value => {
                    this.isSearching = true;
                    setTimeout(() => this.isSearching = false, 500);
                });
            }
        }">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            
            <div class="max-w-md mx-auto mb-12 relative group z-20">
                <div class="absolute -inset-1 bg-gradient-to-r from-teal-400 to-blue-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                <div class="relative bg-white rounded-xl shadow-sm border border-slate-200 flex items-center p-2">
                    <div class="pl-3 pr-2 text-slate-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                        x-model.debounce.500ms="search"
                        class="w-full bg-transparent border-none focus:ring-0 text-slate-800 placeholder-slate-400 text-sm font-medium h-10"
                        placeholder="Cari judul survei...">

                    
                    <div x-show="isSearching" class="pr-3">
                        <svg class="animate-spin h-4 w-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            
            <div x-show="isSearching" class="flex flex-wrap justify-center gap-8">
                <?php for($i = 0; $i < 3; $i++): ?>
                    <div class="w-full md:w-[380px] bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm h-[400px] animate-pulse">
                    <div class="flex justify-between mb-6">
                        <div class="h-6 bg-slate-200 rounded w-1/3"></div>
                        <div class="h-8 w-8 bg-slate-200 rounded-full"></div>
                    </div>
                    <div class="space-y-3">
                        <div class="h-6 bg-slate-200 rounded w-3/4"></div>
                        <div class="h-6 bg-slate-200 rounded w-1/2"></div>
                    </div>
                    <div class="h-20 bg-slate-200 rounded-xl mt-6"></div>
                    <div class="h-12 bg-slate-200 rounded-xl mt-auto"></div>
            </div>
            <?php endfor; ?>
        </div>

        
        <div x-show="!isSearching"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="flex flex-wrap justify-center gap-8">

            <?php $__empty_1 = true; $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="program-card-anim group w-full md:w-[380px]"
                style="animation-delay: <?php echo e($loop->index * 100); ?>ms"
                data-title="<?php echo e(strtolower($program->title)); ?>"
                x-show="search === '' || $el.dataset.title.includes(search.toLowerCase())">

                <div class="h-full block bg-white rounded-[2rem] p-1 border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-teal-500/10 transition-all duration-500 relative overflow-hidden transform hover:-translate-y-2">

                    
                    <div class="bg-white rounded-[1.8rem] p-6 h-full flex flex-col relative overflow-hidden group-hover:bg-teal-50/10 transition-colors duration-500">

                        
                        <div class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-teal-100/30 to-blue-100/30 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        
                        <div class="flex justify-between items-start mb-5 relative z-10">
                            <?php if($program->unit_kerja_id): ?>
                            <span class="px-3 py-1.5 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 text-[10px] font-bold uppercase tracking-wider group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                Unit Lokal
                            </span>
                            <?php else: ?>
                            <span class="px-3 py-1.5 rounded-lg bg-teal-50 border border-teal-100 text-teal-600 text-[10px] font-bold uppercase tracking-wider group-hover:bg-teal-600 group-hover:text-white transition-colors">
                                Institusional
                            </span>
                            <?php endif; ?>

                            <?php if($program->is_featured): ?>
                            <div class="bg-amber-50 p-1.5 rounded-full border border-amber-100 group-hover:border-amber-200 transition-colors">
                                <svg class="w-5 h-5 text-amber-500 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <?php endif; ?>
                        </div>

                        
                        <h3 class="text-2xl font-black text-slate-800 leading-tight mb-5 group-hover:text-teal-700 transition-colors line-clamp-2 min-h-[4rem]">
                            <?php echo e($program->title); ?>

                        </h3>

                        
                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 mb-5 space-y-3 group-hover:bg-white group-hover:border-teal-100 transition-colors">
                            
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 shrink-0 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Penyelenggara</p>
                                    <p class="text-sm font-bold text-slate-700 truncate">
                                        <?php echo e($program->unitKerja ? $program->unitKerja->unit_kerja_name : 'UIN Antasari Banjarmasin'); ?>

                                    </p>
                                </div>
                            </div>

                            
                            <div class="flex items-start gap-3 border-t border-slate-200/50 pt-3">
                                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-blue-500 shrink-0 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Periode Aktif</p>
                                    <p class="text-sm font-bold text-slate-700">
                                        <?php echo e(\Carbon\Carbon::parse($program->start_date)->format('d M')); ?> - <?php echo e(\Carbon\Carbon::parse($program->end_date)->format('d M Y')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>

                        
                        <p class="text-sm text-slate-500 mb-6 line-clamp-2 leading-relaxed px-1">
                            <?php echo e($program->description); ?>

                        </p>

                        
                        <div class="mt-auto relative z-10">
                            <a href="<?php echo e(route('public.survey.directory', $program->alias)); ?>" class="flex items-center justify-center w-full py-3.5 rounded-xl bg-slate-900 text-white font-bold text-sm shadow-lg group-hover:bg-teal-600 group-hover:shadow-teal-500/30 transition-all transform group-hover:-translate-y-1">
                                Isi Survei
                                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="w-full max-w-lg py-20 text-center bg-white rounded-[2rem] border border-dashed border-slate-300">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-50 rounded-full mb-4 text-slate-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada program survei saat ini.</p>
            </div>
            <?php endif; ?>

            
            <div class="w-full py-12 text-center" x-cloak x-show="search !== '' && !isSearching && $el.parentElement.querySelectorAll('.program-card-anim[style*=\'display: none\']').length === <?php echo e(count($programs)); ?>">
                <div class="inline-flex bg-slate-50 px-4 py-2 rounded-full border border-slate-200">
                    <p class="text-slate-500 text-sm">Tidak ditemukan program dengan kata kunci "<span x-text="search" class="font-bold text-slate-800"></span>"</p>
                </div>
            </div>
        </div>

        
        <div class="mt-12 flex justify-center">
            <?php echo e($programs->links()); ?>

        </div>

        </div>
    </section>

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