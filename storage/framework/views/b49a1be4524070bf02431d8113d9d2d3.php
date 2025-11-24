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

    <?php $__env->startPush('styles'); ?>
    <style>
        /* Background System */
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

        .blob {
            position: absolute;
            filter: blur(80px);
            z-index: -15;
            opacity: 0.4;
            animation: float 10s infinite alternate;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(20px, -20px);
            }
        }

        /* Smooth Fade In */
        .fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <?php $__env->stopPush(); ?>

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="blob bg-teal-200 w-96 h-96 top-0 left-0 rounded-full mix-blend-multiply"></div>
    <div class="blob bg-blue-200 w-80 h-80 bottom-0 right-0 rounded-full mix-blend-multiply animation-delay-2000"></div>

    
    <section class="relative min-h-screen flex items-center justify-center pt-24 pb-20 overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-16">

                
                <div class="lg:w-1/2 text-center lg:text-left fade-in-up" style="animation-delay: 0.1s;">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 border border-slate-200/60 shadow-sm backdrop-blur-md mb-8">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-teal-500"></span>
                        </span>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Sistem Penjaminan Mutu</span>
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-slate-900 tracking-tighter leading-[1.1] mb-6">
                        Portal Survei <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-blue-600">Terintegrasi.</span>
                    </h1>

                    <p class="text-lg text-slate-600 leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0">
                        Platform terintegrasi evaluasi kinerja. Kontribusi objektif Anda adalah kunci utama dalam mewujudkan layanan pendidikan dan tata kelola kampus yang lebih unggul.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#program" class="group inline-flex items-center justify-center px-8 py-4 text-sm font-bold text-white bg-slate-900 rounded-2xl hover:bg-teal-600 transition-all shadow-xl hover:shadow-teal-500/30 hover:-translate-y-1">
                            Mulai Penilaian
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="<?php echo e(route('public.programs.list')); ?>" class="inline-flex items-center justify-center px-8 py-4 text-sm font-bold text-slate-600 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 hover:text-slate-900 transition-all shadow-sm">
                            Lihat Semua Program Survei
                        </a>
                    </div>

                    
                    <div class="hero-stat-anim pt-8 border-t border-slate-200 flex items-center justify-center lg:justify-start gap-8">
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-800"><?php echo e(number_format($totalRespondents)); ?>+</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Partisipan</p>
                        </div>
                        <div class="w-px h-10 bg-slate-200"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-800"><?php echo e($totalPrograms); ?></p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Program</p>
                        </div>
                        <div class="w-px h-10 bg-slate-200"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-800"><?php echo e(round($satisfactionPercentage)); ?>%</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Indeks Mutu</p>
                        </div>
                    </div>
                </div>

                
                <div class="lg:w-1/2 relative fade-in-up" style="animation-delay: 0.3s;">
                    <div class="relative z-10 bg-white/40 backdrop-blur-xl rounded-[3rem] p-4 border border-white/60 shadow-2xl shadow-indigo-500/10 transform hover:scale-[1.02] transition-transform duration-700">
                        <img src="<?php echo e(asset('images/hero-survey-uin5.png')); ?>" alt="Hero Image" class="w-full h-auto rounded-[2.5rem]">
                    </div>

                    
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-teal-400 to-blue-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full blur-3xl opacity-20 animate-pulse animation-delay-1000"></div>
                </div>

            </div>
        </div>
    </section>

    
    <section id="langkah" class="py-32 relative overflow-hidden">

        
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-7xl pointer-events-none">
            <div class="absolute top-20 left-20 w-96 h-96 bg-teal-50 rounded-full mix-blend-multiply filter blur-3xl opacity-60"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-indigo-50 rounded-full mix-blend-multiply filter blur-3xl opacity-60"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">

            
            <div class="text-center max-w-2xl mx-auto mb-20 animate-on-scroll">
                <span class="text-indigo-500 font-bold text-xs tracking-[0.2em] uppercase block mb-3">Panduan Pengguna</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 leading-tight">Tahapan Pengisian Survei</h2>
                <p class="text-slate-500 text-lg leading-relaxed">Proses yang dirancang sederhana, cepat, dan aman untuk kenyamanan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">

                
                <div class="hidden md:block absolute top-24 left-[15%] right-[15%] h-0.5 bg-gradient-to-r from-teal-100 via-indigo-100 to-rose-100 -z-10 rounded-full"></div>

                
                <div class="group bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:-translate-y-2 transition-all duration-500 relative step-card-anim">
                    <div class="w-20 h-20 mx-auto bg-teal-50 rounded-[1.5rem] flex items-center justify-center text-teal-600 mb-8 shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 text-center">1. Pilih Program</h3>
                    <p class="text-slate-500 text-sm leading-relaxed text-center">
                        Temukan survei yang relevan dengan unit layanan atau fakultas tujuan Anda melalui kolom pencarian.
                    </p>
                </div>

                
                <div class="group bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:-translate-y-2 transition-all duration-500 relative step-card-anim" style="animation-delay: 150ms">
                    <div class="w-20 h-20 mx-auto bg-indigo-50 rounded-[1.5rem] flex items-center justify-center text-indigo-600 mb-8 shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-all duration-500">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 text-center">2. Isi Penilaian</h3>
                    <p class="text-slate-500 text-sm leading-relaxed text-center">
                        Jawab pertanyaan kuesioner secara objektif. Identitas Anda dijamin kerahasiaannya oleh sistem.
                    </p>
                </div>

                
                <div class="group bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] hover:-translate-y-2 transition-all duration-500 relative step-card-anim" style="animation-delay: 300ms">
                    <div class="w-20 h-20 mx-auto bg-rose-50 rounded-[1.5rem] flex items-center justify-center text-rose-600 mb-8 shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4 text-center">3. Selesai</h3>
                    <p class="text-slate-500 text-sm leading-relaxed text-center">
                        Data Anda langsung tersimpan otomatis dan diolah oleh sistem untuk perbaikan mutu berkelanjutan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    
    <section id="program" class="py-24 bg-slate-50 relative"
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

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4 animate-on-scroll">
                <div class="text-center md:text-left w-full md:w-auto">
                    <h2 class="text-3xl font-black text-slate-900 mb-2">Program Prioritas</h2>
                    <p class="text-slate-500">Daftar Survei utama yang sedang berjalan.</p>
                </div>

                <div class="relative w-full md:w-72 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-teal-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    
                    <input type="text"
                        x-model.debounce.500ms="search"
                        class="block w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent shadow-sm bg-white placeholder-slate-400 transition-all"
                        placeholder="Cari Survei...">

                    <div x-show="isSearching" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="animate-spin h-4 w-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            
            <div x-show="isSearching"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="flex flex-wrap justify-center gap-8">

                <?php for($i = 0; $i < 3; $i++): ?>
                    <div class="w-full md:w-[380px] bg-white border border-slate-100 rounded-[2rem] p-6 shadow-sm h-[400px] flex flex-col justify-between">
                    <div class="animate-pulse space-y-6">
                        <div class="flex justify-between">
                            <div class="h-6 bg-slate-200 rounded w-1/3"></div>
                            <div class="h-6 w-6 bg-slate-200 rounded-full"></div>
                        </div>
                        <div class="space-y-3">
                            <div class="h-8 bg-slate-200 rounded w-3/4"></div>
                            <div class="h-8 bg-slate-200 rounded w-1/2"></div>
                        </div>
                        <div class="h-20 bg-slate-200 rounded-xl"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-slate-200 rounded"></div>
                            <div class="h-3 bg-slate-200 rounded"></div>
                        </div>
                    </div>
                    <div class="h-12 bg-slate-200 rounded-xl mt-4"></div>
            </div>
            <?php endfor; ?>
        </div>

        
        <div x-show="!isSearching"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="flex flex-wrap justify-center gap-8">

            <?php $__empty_1 = true; $__currentLoopData = $featuredPrograms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="program-card-anim group w-full md:w-[380px]"
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
                <p class="text-slate-500 font-medium">Belum ada program prioritas saat ini.</p>
                <a href="<?php echo e(route('public.programs.list')); ?>" class="mt-4 inline-block text-teal-600 font-bold text-sm hover:underline">Lihat Arsip Program &rarr;</a>
            </div>
            <?php endif; ?>

            
            <div class="w-full py-12 text-center" x-cloak x-show="search !== '' && !isSearching && $el.parentElement.querySelectorAll('.program-card-anim[style*=\'display: none\']').length === <?php echo e(count($featuredPrograms)); ?>">
                <div class="inline-flex bg-slate-50 px-4 py-2 rounded-full border border-slate-200">
                    <p class="text-slate-500 text-sm">Tidak ditemukan program dengan kata kunci "<span x-text="search" class="font-bold text-slate-800"></span>"</p>
                </div>
            </div>
        </div>

        
        <div class="mt-12 text-center md:hidden">
            <a href="<?php echo e(route('public.programs.list')); ?>" class="inline-block px-6 py-3 bg-white border border-slate-200 text-teal-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-all text-sm">
                Lihat Semua Program →
            </a>
        </div>
        </div>
    </section>

    
    <section id="faq" class="py-24 bg-white relative overflow-hidden border-t border-slate-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
                <span class="text-indigo-500 font-bold text-xs tracking-[0.2em] uppercase block mb-3">Pusat Bantuan</span>
                <h2 class="text-3xl font-black text-slate-900 mb-4">Pertanyaan Umum</h2>
                <p class="text-slate-500">Informasi mengenai penggunaan portal survei terintegrasi ini.</p>
            </div>

            <div class="max-w-4xl mx-auto space-y-5" x-data="{ active: null }">

                
                <div class="group bg-slate-50 hover:bg-white border border-slate-200 rounded-2xl transition-all duration-300 hover:shadow-lg overflow-hidden">
                    <button @click="active = (active === 1 ? null : 1)" class="flex items-center justify-between w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Apakah identitas saya aman untuk semua jenis survei?</span>
                        <span class="p-2 bg-white rounded-full shadow-sm text-slate-400 group-hover:text-teal-600 transition-transform duration-300" :class="active === 1 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak>
                        <div class="px-6 pb-8 text-slate-600 leading-relaxed text-base border-t border-slate-100 pt-4">
                            <p class="mb-3"><strong class="text-teal-600">Ya, 100% Aman & Rahasia.</strong></p>
                            <p>Portal ini dirancang sebagai wadah tunggal untuk berbagai instrumen penilaian (seperti Survei ZI, Survei Berakhlak, maupun Evaluasi Akademik). Sistem secara otomatis memisahkan data profil pengguna (untuk validasi akses) dengan data jawaban yang Anda berikan. Laporan yang dihasilkan bersifat <strong>agregat (kumpulan data)</strong>, sehingga tidak ada unit kerja atau pimpinan yang dapat melihat jawaban spesifik atas nama Anda secara individu.</p>
                        </div>
                    </div>
                </div>

                
                <div class="group bg-slate-50 hover:bg-white border border-slate-200 rounded-2xl transition-all duration-300 hover:shadow-lg overflow-hidden">
                    <button @click="active = (active === 2 ? null : 2)" class="flex items-center justify-between w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Bagaimana jika saya salah memilih Program atau Unit?</span>
                        <span class="p-2 bg-white rounded-full shadow-sm text-slate-400 group-hover:text-teal-600 transition-transform duration-300" :class="active === 2 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak>
                        <div class="px-6 pb-8 text-slate-600 leading-relaxed text-base border-t border-slate-100 pt-4">
                            <p class="mb-3">Harap perhatikan pilihan Anda sebelum memulai pengisian.</p>
                            <p>Karena portal ini menampung banyak program survei dari berbagai unit kerja, kesalahan memilih unit dapat menyebabkan data tidak valid. Jika Anda belum menekan tombol <strong>"Kirim Jawaban"</strong>, Anda masih bisa membatalkan dan kembali ke menu utama. Namun, data yang sudah dikirim akan langsung terkunci dalam sistem rekapitulasi dan tidak dapat diubah kembali oleh pengguna.</p>
                        </div>
                    </div>
                </div>

                
                <div class="group bg-slate-50 hover:bg-white border border-slate-200 rounded-2xl transition-all duration-300 hover:shadow-lg overflow-hidden">
                    <button @click="active = (active === 3 ? null : 3)" class="flex items-center justify-between w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Survei mana saja yang wajib saya isi?</span>
                        <span class="p-2 bg-white rounded-full shadow-sm text-slate-400 group-hover:text-teal-600 transition-transform duration-300" :class="active === 3 ? 'rotate-180' : ''">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="active === 3" x-collapse x-cloak>
                        <div class="px-6 pb-8 text-slate-600 leading-relaxed text-base border-t border-slate-100 pt-4">
                            <p class="mb-3">Kewajiban pengisian bergantung pada kebijakan masing-masing program yang aktif di portal ini.</p>
                            <ul class="list-disc pl-5 space-y-1 text-sm">
                                <li><strong>Wajib:</strong> Biasanya untuk survei akademik (EDOM), survei kepuasan layanan wajib tahunan, atau syarat yudisium.</li>
                                <li><strong>Sukarela:</strong> Survei insidental seperti penilaian fasilitas kantin, parkir, atau survei budaya kerja (Berakhlak) tertentu.</li>
                            </ul>
                            <p class="mt-3">Anda dapat melihat status atau label pada setiap kartu program di halaman "Daftar Program" untuk mengetahui prioritasnya.</p>
                        </div>
                    </div>
                </div>

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
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/welcome.blade.php ENDPATH**/ ?>