<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Tentang Portal Survei']); ?>

    <?php $__env->startPush('styles'); ?>
    <style>
        /* Background System */
        body {
            background-color: #f8fafc;
        }

        .bg-mesh {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -20;
            background: radial-gradient(circle at 50% 0%, #f1f5f9 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, #e2e8f0 0%, transparent 50%);
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
    </style>
    <?php $__env->stopPush(); ?>

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="min-h-screen py-20 overflow-hidden">

        
        <div class="container mx-auto px-4 mb-24">
            <div class="text-center max-w-3xl mx-auto hero-anim">
                <span class="inline-block py-1 px-3 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-[10px] font-bold uppercase tracking-widest mb-6">
                    Portal Survei Terintegrasi
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 leading-tight tracking-tight">
                    Satu Pintu untuk <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-teal-500">Semua Aspirasi</span>
                </h1>
                <p class="text-lg text-slate-500 leading-relaxed">
                    Platform digital terpusat yang mengelola seluruh instrumen evaluasi dan survei di lingkungan UIN Antasari Banjarmasin. Dari survei ZI, Berakhlak, hingga kepuasan akademik.
                </p>
            </div>
        </div>

        
        <div class="container mx-auto px-4 mb-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                
                <div class="relative about-anim">
                    <div class="absolute -inset-4 bg-gradient-to-r from-teal-100 to-indigo-100 rounded-[2.5rem] blur-2xl opacity-60 -z-10"></div>
                    <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl shadow-slate-200/50 relative overflow-hidden aspect-square md:aspect-auto md:h-[500px] flex items-center justify-center">
                        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#6366f1 1px, transparent 1px); background-size: 24px 24px;"></div>

                        <div class="text-center p-8">
                            <div class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo UIN" class="w-12 h-12 object-contain">
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">UIN Antasari</h3>
                            <p class="text-sm text-slate-400 uppercase tracking-widest">Quality Assurance System</p>
                        </div>
                    </div>
                </div>

                
                <div class="space-y-10 about-anim">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Wadah Tunggal Penjaminan Mutu</h2>
                        <p class="text-slate-500 leading-relaxed">
                            Kami menyadari bahwa banyaknya platform survei yang terpisah dapat membingungkan sivitas akademika. Oleh karena itu, aplikasi ini hadir sebagai <strong>hub sentral</strong>.
                        </p>
                        <p class="text-slate-500 leading-relaxed mt-4">
                            Sistem ini dirancang fleksibel untuk menampung berbagai jenis kuesioner mulai dari penilaian integritas (ZI), budaya kerja (Berakhlak), evaluasi dosen, hingga survei fasilitas semua dalam satu akun dan satu antarmuka.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 mb-4">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-slate-900 mb-1">Multi-Instrumen</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Mendukung berbagai format survei dinamis untuk kebutuhan unit kerja berbeda.</p>
                        </div>

                        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-4">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-slate-900 mb-1">Data Terpusat</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">Semua hasil evaluasi tersimpan dalam satu pangkalan data untuk analisis komprehensif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container mx-auto px-4 mb-24">
            <div class="bg-white rounded-[3rem] p-10 md:p-16 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.05)] border border-slate-100 relative overflow-hidden section-anim">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-indigo-50 to-transparent rounded-bl-full pointer-events-none"></div>

                <div class="text-center mb-12 max-w-2xl mx-auto">
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 mb-4">Cakupan Layanan</h2>
                    <p class="text-slate-500 text-lg mb-6">
                        Platform ini adalah <strong>rumah bagi seluruh instrumen survei</strong> institusi. Semua jenis penilaian kinerja dan layanan tertampung di sini secara terpadu.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    
                    <div class="group">
                        <div class="w-16 h-16 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 mb-4 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm">Zona Integritas</h4>
                    </div>
                    
                    <div class="group">
                        <div class="w-16 h-16 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 mb-4 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm">Budaya Berakhlak</h4>
                    </div>
                    
                    <div class="group">
                        <div class="w-16 h-16 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 mb-4 group-hover:bg-rose-50 group-hover:text-rose-600 transition-colors">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm">Evaluasi Akademik</h4>
                    </div>
                    
                    <div class="group">
                        <div class="w-16 h-16 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 mb-4 group-hover:bg-amber-50 group-hover:text-amber-600 transition-colors">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm">Kepuasan Layanan</h4>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container mx-auto px-4 mb-12 text-center section-anim">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Dikelola Oleh</h3>
            <div class="inline-flex items-center gap-4 bg-white px-8 py-4 rounded-2xl border border-slate-200 shadow-sm">
                <div class="text-right">
                    <p class="font-bold text-slate-900 text-sm">UIN Antasari Banjarmasin</p>
                    <p class="text-xs text-slate-500">Pengawasan Mutu</p>
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="text-left">
                    <p class="font-bold text-slate-900 text-sm">UTIPD</p>
                    <p class="text-xs text-slate-500">Pengembangan Sistem</p>
                </div>
            </div>
        </div>

        
        <div class="text-center section-anim">
            <a href="<?php echo e(route('public.programs.list')); ?>" class="inline-flex items-center justify-center bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-lg hover:bg-teal-600 hover:-translate-y-1 transition-all duration-300">
                Lihat Daftar Survei
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.hero-anim', {
                    opacity: 0,
                    y: 30,
                    duration: 1,
                    ease: "power3.out"
                });

                gsap.from('.about-anim', {
                    scrollTrigger: {
                        trigger: '.about-anim',
                        start: 'top 80%'
                    },
                    opacity: 0,
                    y: 30,
                    stagger: 0.2,
                    duration: 0.8
                });

                gsap.from('.section-anim', {
                    scrollTrigger: {
                        trigger: '.section-anim',
                        start: 'top 80%'
                    },
                    opacity: 0,
                    scale: 0.95,
                    duration: 0.8,
                    ease: "power2.out"
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
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/public/tentang.blade.php ENDPATH**/ ?>