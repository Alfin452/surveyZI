<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Pilih Unit - ' . $program->title)]); ?>

    <?php $__env->startPush('styles'); ?>
    <style>
        .dir-anim {
            opacity: 0;
            transform: translateY(20px);
        }

        /* Animasi Floating Halus Background */
        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-float {
            animation: float-slow 8s ease-in-out infinite;
        }
    </style>
    <?php $__env->stopPush(); ?>

    
    <section class="relative pt-32 pb-16 overflow-hidden bg-slate-50 min-h-[35vh] flex items-center">
        
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-teal-500/10 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 right-[-10%] w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            
            <nav class="dir-anim flex items-center justify-center gap-2 text-sm font-medium text-slate-500 mb-6">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-teal-600 transition-colors">Beranda</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-teal-600 font-bold">Pilih Unit Layanan</span>
            </nav>

            
            <h1 class="dir-anim text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 leading-tight mb-4 max-w-4xl mx-auto">
                <?php echo e($program->title); ?>

            </h1>

            <p class="dir-anim text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed mb-10">
                <?php echo e($program->description); ?>

            </p>

            
            <div class="dir-anim max-w-lg mx-auto relative z-20"
                x-data="{ search: '' }">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-teal-400 to-blue-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white rounded-xl shadow-xl flex items-center p-2 border border-slate-100">
                        <div class="pl-4 pr-3 text-slate-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        
                        <input type="text"
                            x-model="search"
                            @input="$dispatch('filter-units', search)"
                            class="w-full bg-transparent border-none focus:ring-0 text-slate-800 placeholder-slate-400 text-base font-medium h-12"
                            placeholder="Cari nama fakultas atau unit...">
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="relative pb-24 z-20 min-h-[400px]"
        x-data="{ 
                search: '', 
                isSearching: false,
                init() {
                    // Listener untuk event filter dengan delay simulasi loading
                    window.addEventListener('filter-units', event => {
                        this.isSearching = true;
                        this.search = event.detail.toLowerCase();
                        setTimeout(() => this.isSearching = false, 500); // Loading 0.5s
                    });
                }
             }">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            
            <div x-show="isSearching" class="flex flex-wrap justify-center gap-6">
                <?php for($i = 0; $i < 3; $i++): ?>
                    <div class="w-full sm:w-[350px] bg-white rounded-3xl p-6 border border-slate-100 shadow-sm h-[280px] flex flex-col justify-between">
                    <div class="flex justify-between items-start">
                        <div class="h-6 w-16 bg-slate-200 rounded-full animate-pulse"></div>
                    </div>
                    <div class="space-y-3 mt-4">
                        <div class="h-6 w-3/4 bg-slate-200 rounded animate-pulse"></div>
                        <div class="h-6 w-1/2 bg-slate-200 rounded animate-pulse"></div>
                    </div>
                    <div class="space-y-3 mt-auto pt-4 border-t border-slate-50">
                        <div class="h-4 w-full bg-slate-200 rounded animate-pulse"></div>
                        <div class="h-4 w-2/3 bg-slate-200 rounded animate-pulse"></div>
                    </div>
            </div>
            <?php endfor; ?>
        </div>

        
        <div x-show="!isSearching"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="flex flex-wrap justify-center gap-6">

            <?php $__empty_1 = true; $__currentLoopData = $unitKerjas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <div class="dir-card-anim w-full sm:w-[350px] group"
                data-name="<?php echo e(strtolower($unit->unit_kerja_name . ' ' . ($unit->uk_short_name ?? ''))); ?>"
                x-show="search === '' || $el.dataset.name.includes(search)">

                <a href="<?php echo e(route('public.unit.landing', ['program' => $program, 'unitKerja' => $unit])); ?>"
                    class="block bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-teal-500/10 hover:border-teal-300 transition-all duration-300 h-full relative overflow-hidden flex flex-col justify-between">

                    
                    <div class="flex justify-between items-start mb-4">
                        <?php if($unit->uk_short_name): ?>
                        <span class="inline-block bg-teal-50 text-teal-700 text-xs font-black px-3 py-1.5 rounded-lg border border-teal-100 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                            <?php echo e($unit->uk_short_name); ?>

                        </span>
                        <?php else: ?>
                        <span class="inline-block bg-slate-50 text-slate-500 text-xs font-bold px-3 py-1.5 rounded-lg border border-slate-100">
                            UNIT
                        </span>
                        <?php endif; ?>
                    </div>

                    
                    <div class="mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center shadow-inner group-hover:bg-gradient-to-br group-hover:from-teal-400 group-hover:to-blue-500 group-hover:text-white transition-all duration-500">
                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <h3 class="text-xl font-black text-slate-900 group-hover:text-teal-700 transition-colors leading-tight min-h-[3.5rem] flex items-center">
                            <?php echo e($unit->unit_kerja_name); ?>

                        </h3>
                    </div>

                    
                    <div class="pt-4 border-t border-slate-100 space-y-3 mt-auto">
                        <?php if($unit->address): ?>
                        <div class="flex items-start gap-2.5 text-sm text-slate-500 group-hover:text-slate-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 group-hover:text-teal-500 flex-shrink-0 mt-0.5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="line-clamp-1 text-xs leading-relaxed"><?php echo e($unit->address); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if($unit->start_time && $unit->end_time): ?>
                        <div class="flex items-center gap-2.5 text-sm text-slate-500 group-hover:text-slate-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 group-hover:text-teal-500 flex-shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs font-medium bg-slate-50 px-2 py-0.5 rounded group-hover:bg-teal-50 group-hover:text-teal-700 transition-colors">
                                <?php echo e(\Carbon\Carbon::parse($unit->start_time)->format('H:i')); ?> - <?php echo e(\Carbon\Carbon::parse($unit->end_time)->format('H:i')); ?> WITA
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>

                    
                    <div class="mt-6">
                        <span class="flex items-center justify-center w-full py-3 rounded-xl bg-white border-2 border-slate-100 text-slate-600 font-bold text-sm group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 transition-all shadow-sm">
                            Mulai Survei
                        </span>
                    </div>

                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="w-full text-center py-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4 text-slate-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada unit kerja yang terdaftar.</p>
            </div>
            <?php endif; ?>

            
            <div class="w-full text-center py-12 hidden"
                x-show="search !== '' && !isSearching && $el.parentElement.querySelectorAll('div[data-name]:not([style*=\'display: none\'])').length === 0">
                <p class="text-slate-400">Unit tidak ditemukan.</p>
                <button @click="search = ''; $dispatch('filter-units', '')" class="mt-2 text-teal-600 font-bold text-sm hover:underline">Tampilkan Semua</button>
            </div>
        </div>
        </div>
    </section>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            if (typeof gsap !== 'undefined') {
                gsap.to(".dir-anim", {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.1,
                    ease: "power2.out"
                });

                gsap.to(".dir-card-anim", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.05,
                    ease: "back.out(1.2)",
                    delay: 0.3
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
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/public/directory.blade.php ENDPATH**/ ?>