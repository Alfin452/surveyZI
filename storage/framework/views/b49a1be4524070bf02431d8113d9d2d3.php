<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
    <section id="beranda" class="relative min-h-screen flex items-center pt-20 pb-10 overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-20">

                
                <div class="lg:w-1/2 text-center lg:text-left hero-content space-y-6">
                    
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/60 border border-white/50 shadow-sm backdrop-blur-md animate-fade-in-down">
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-teal-500"></span>
                        </span>
                        <span class="text-[10px] sm:text-xs font-bold text-slate-600 tracking-widest uppercase">Portal Resmi UIN Antasari</span>
                    </div>

                    
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-slate-900 leading-tight tracking-tight">
                        Suara Anda,<br class="hidden sm:block">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-blue-600">Kemajuan Kami.</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Platform resmi evaluasi layanan akademik dan non-akademik UIN Antasari. Partisipasi Anda adalah kunci peningkatan mutu institusi yang berkelanjutan.
                    </p>

                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                        <a href="#program"
                            class="px-8 py-4 rounded-2xl bg-slate-900 text-white font-bold text-sm sm:text-base shadow-xl shadow-slate-900/20 hover:bg-teal-600 hover:shadow-teal-500/30 hover:-translate-y-1 transition-all duration-300 text-center">
                            Mulai Penilaian
                        </a>
                        <a href="<?php echo e(route('public.programs.list')); ?>"
                            class="px-8 py-4 rounded-2xl bg-white text-slate-700 border border-slate-200 font-bold text-sm sm:text-base hover:bg-slate-50 hover:border-slate-300 transition-all duration-300 text-center shadow-sm">
                            Daftar Kuesioner
                        </a>
                    </div>

                    
                    <div class="grid grid-cols-2 md:flex items-center justify-center lg:justify-start gap-6 md:gap-8 pt-8 md:pt-10 border-t border-slate-200/60">
                        <div class="text-center lg:text-left">
                            <p class="text-2xl sm:text-3xl font-black text-slate-800"><?php echo e($totalRespondents); ?>+</p>
                            <p class="text-xs sm:text-sm text-slate-500 font-bold uppercase tracking-wide">Partisipan</p>
                        </div>
                        <div class="hidden md:block w-px h-10 bg-slate-200"></div>
                        <div class="text-center lg:text-left">
                            <p class="text-2xl sm:text-3xl font-black text-slate-800"><?php echo e($totalPrograms); ?></p>
                            <p class="text-xs sm:text-sm text-slate-500 font-bold uppercase tracking-wide">Instrumen Aktif</p>
                        </div>
                        <div class="hidden md:block w-px h-10 bg-slate-200"></div>
                        <div class="col-span-2 md:col-span-1 text-center lg:text-left">
                            <div class="flex items-center justify-center lg:justify-start gap-2">
                                <span class="text-2xl sm:text-3xl font-black text-slate-800"><?php echo e(round($satisfactionPercentage)); ?>%</span>
                                <div class="flex text-amber-400">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 font-bold uppercase tracking-wide">Indeks Mutu</p>
                        </div>
                    </div>
                </div>

                
                <div class="lg:w-1/2 relative hero-image mt-10 lg:mt-0">
                    <div class="relative w-full max-w-[280px] sm:max-w-sm md:max-w-md lg:max-w-lg mx-auto">
                        
                        <div class="absolute top-0 right-0 w-64 h-64 bg-teal-300/30 rounded-full blur-3xl animate-pulse"></div>
                        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-300/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

                        
                        
                        <img src="<?php echo e(asset('images/hero-survey-uin.png')); ?>"
                            alt="Survey Illustration"
                            class="relative w-full h-auto drop-shadow-2xl animate-float z-10 transform hover:scale-105 transition-transform duration-500 object-contain">

                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section id="langkah" class="py-24 relative overflow-hidden">
        
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-indigo-50/50 rounded-full blur-3xl -z-10"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="text-center max-w-3xl mx-auto mb-20 animate-on-scroll">
                <span class="text-indigo-500 font-bold tracking-wider uppercase text-xs mb-2 block">Alur Partisipasi</span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 mb-6">
                    Kontribusi dalam <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">3 Langkah</span>
                </h2>
                <p class="text-slate-500 text-lg">Proses yang dirancang cepat dan mudah agar Anda dapat segera kembali beraktivitas.</p>
            </div>

            
            <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-indigo-200 to-transparent z-0 transform translate-y-4"></div>

                
                <div class="step-card group relative z-10">
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-indigo-100/20 hover:shadow-2xl hover:shadow-indigo-200/40 transition-all duration-500 hover:-translate-y-2 text-center h-full">
                        <div class="relative w-24 h-24 mx-auto mb-6">
                            <div class="absolute inset-0 bg-indigo-100 rounded-full blur-xl opacity-50 group-hover:opacity-80 transition-opacity"></div>
                            <div class="relative bg-white rounded-2xl p-2 shadow-sm border border-indigo-50">
                                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Magnifying%20Glass%20Tilted%20Right.png" alt="Search" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm border-4 border-white shadow-md">1</div>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors">Temukan Survei</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Cari program survei yang relevan dengan status atau unit layanan Anda di halaman program.
                        </p>
                    </div>
                </div>

                
                <div class="step-card group relative z-10" style="transition-delay: 100ms">
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-purple-100/20 hover:shadow-2xl hover:shadow-purple-200/40 transition-all duration-500 hover:-translate-y-2 text-center h-full">
                        <div class="relative w-24 h-24 mx-auto mb-6">
                            <div class="absolute inset-0 bg-purple-100 rounded-full blur-xl opacity-50 group-hover:opacity-80 transition-opacity"></div>
                            <div class="relative bg-white rounded-2xl p-2 shadow-sm border border-purple-50">
                                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Memo.png" alt="Fill" class="w-full h-full object-contain group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-500">
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm border-4 border-white shadow-md">2</div>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-purple-600 transition-colors">Isi Kuesioner</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Jawab pertanyaan dengan jujur dan objektif. Identitas Anda dijamin kerahasiaannya.
                        </p>
                    </div>
                </div>

                
                <div class="step-card group relative z-10" style="transition-delay: 200ms">
                    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-emerald-100/20 hover:shadow-2xl hover:shadow-emerald-200/40 transition-all duration-500 hover:-translate-y-2 text-center h-full">
                        <div class="relative w-24 h-24 mx-auto mb-6">
                            <div class="absolute inset-0 bg-emerald-100 rounded-full blur-xl opacity-50 group-hover:opacity-80 transition-opacity"></div>
                            <div class="relative bg-white rounded-2xl p-2 shadow-sm border border-emerald-50">
                                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Rocket.png" alt="Submit" class="w-full h-full object-contain group-hover:scale-110 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform duration-500">
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-sm border-4 border-white shadow-md">3</div>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors">Kirim Jawaban</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Selesai! Masukan Anda akan langsung masuk ke sistem untuk dianalisis demi perbaikan mutu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section id="program" class="py-20 sm:py-24 bg-white/60 backdrop-blur-sm relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 sm:mb-12 gap-4 animate-on-scroll">
                <div class="text-center md:text-left w-full md:w-auto">
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mb-2">Program Unggulan</h2>
                    <p class="text-slate-500 text-sm sm:text-base">Survei prioritas yang paling banyak dicari saat ini.</p>
                </div>
                <a href="<?php echo e(route('public.programs.list')); ?>" class="hidden md:flex items-center gap-2 text-teal-600 font-bold hover:text-teal-700 transition-colors bg-teal-50 px-4 py-2 rounded-xl">
                    Lihat Semua
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $featuredPrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="program-card group flex flex-col h-full bg-white border border-slate-100 rounded-3xl p-6 sm:p-8 shadow-lg hover:shadow-2xl hover:shadow-teal-500/10 transition-all duration-300 hover:-translate-y-2 relative overflow-hidden">

                    
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-400 via-blue-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                    
                    <div class="flex justify-between items-start mb-5">
                        <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wide bg-slate-50 text-slate-600 border border-slate-200 group-hover:bg-teal-50 group-hover:text-teal-700 group-hover:border-teal-200 transition-colors">
                            <?php echo e($program->unit_kerja_id ? 'Unit Lokal' : 'Institusional'); ?>

                        </span>
                        <?php if($program->is_featured): ?>
                        <span class="text-amber-400 drop-shadow-sm" title="Unggulan">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </span>
                        <?php endif; ?>
                    </div>

                    
                    <h3 class="text-xl font-bold text-slate-800 mb-3 line-clamp-2 group-hover:text-teal-700 transition-colors">
                        <?php echo e($program->title); ?>

                    </h3>
                    <p class="text-sm text-slate-500 mb-6 line-clamp-3 leading-relaxed flex-1">
                        <?php echo e($program->description); ?>

                    </p>

                    
                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <?php echo e($program->start_date ? $program->start_date->format('d M Y') : 'Sekarang'); ?> s/d <?php echo e($program->end_date ? $program->end_date->format('d M Y') : 'Selesai'); ?>

                    </div>

                    
                    <div class="pt-6 border-t border-slate-100 group-hover:border-teal-50 mt-auto">
                        <a href="<?php echo e(route('public.survey.directory', $program->alias)); ?>" class="flex items-center justify-center w-full py-3.5 rounded-xl bg-slate-900 text-white font-bold text-sm shadow-lg group-hover:bg-teal-600 group-hover:shadow-teal-500/30 transition-all transform group-hover:-translate-y-1">
                            Isi Kuesioner
                            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full py-16 text-center bg-slate-50/50 rounded-3xl border-2 border-dashed border-slate-200">
                    <div class="w-20 h-20 mx-auto mb-4 opacity-50 grayscale">
                        <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
                    </div>
                    <p class="text-slate-400 font-medium">Belum ada program unggulan yang aktif saat ini.</p>
                    <a href="<?php echo e(route('public.programs.list')); ?>" class="mt-4 inline-block text-teal-600 font-bold text-sm hover:underline">Cek Semua Program &rarr;</a>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="mt-10 text-center md:hidden">
                <a href="<?php echo e(route('public.programs.list')); ?>" class="inline-block px-6 py-3 bg-white border border-slate-200 text-teal-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-all text-sm">
                    Lihat Semua Program &rarr;
                </a>
            </div>
        </div>
    </section>

    
    <div class="h-10"></div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/welcome.blade.php ENDPATH**/ ?>