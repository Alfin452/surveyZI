<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Halaman Tidak Ditemukan']); ?>

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
            background: radial-gradient(circle at 50% 50%, #f1f5f9 0%, transparent 50%);
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
            opacity: 0.5;
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
    </style>
    <?php $__env->stopPush(); ?>

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    
    <div class="blob bg-rose-200 w-96 h-96 top-0 left-0 rounded-full mix-blend-multiply"></div>
    <div class="blob bg-indigo-200 w-80 h-80 bottom-0 right-0 rounded-full mix-blend-multiply animation-delay-2000"></div>

    
    <div class="min-h-screen flex flex-col items-center justify-center p-4 relative z-10 pt-32 pb-32">

        
        <div class="relative mb-8 form-anim">
            <div class="absolute inset-0 bg-slate-200 rounded-full blur-3xl opacity-40 animate-pulse"></div>
            <h1 class="relative text-[120px] sm:text-[180px] leading-none font-black text-transparent bg-clip-text bg-gradient-to-r from-slate-200 to-slate-300 select-none drop-shadow-sm">
                404
            </h1>
        </div>

        
        <div class="w-full max-w-lg bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white/60 p-10 sm:p-14 text-center form-anim relative overflow-hidden" style="animation-delay: 0.1s;">

            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-rose-400 via-pink-500 to-purple-500"></div>

            <h2 class="text-3xl font-black text-slate-900 mb-4 tracking-tight">
                404 Not Found
            </h2>
            <p class="text-slate-500 text-lg leading-relaxed mb-10">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin tautan rusak atau halaman telah dihapus.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo e(route('home')); ?>"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-xl hover:bg-indigo-600 hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Ke Beranda
                </a>

                <a href="javascript:history.back()"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-600 px-8 py-4 rounded-2xl font-bold text-sm hover:bg-slate-50 hover:text-slate-900 hover:border-slate-300 transition-all">
                    Kembali
                </a>
            </div>
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
                    stagger: 0.1,
                    ease: "elastic.out(1, 0.8)"
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
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/errors/404.blade.php ENDPATH**/ ?>