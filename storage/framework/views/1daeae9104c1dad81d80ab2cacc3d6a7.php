<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Terima Kasih']); ?>

    <?php $__env->startPush('styles'); ?>
    <style>
        [x-cloak] {
            display: none !important;
        }

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

        /* Confetti & Checkmark (Sama seperti sebelumnya) */
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #10b981;
            animation: confetti-fall 4s linear infinite;
            opacity: 0;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-10vh) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        .c-1 {
            background: #34d399;
            left: 10%;
            animation-delay: 0s;
        }

        .c-2 {
            background: #60a5fa;
            left: 20%;
            animation-delay: 2s;
            width: 12px;
            height: 12px;
        }

        .c-3 {
            background: #f472b6;
            left: 30%;
            animation-delay: 1s;
        }

        .c-4 {
            background: #a78bfa;
            left: 40%;
            animation-delay: 3s;
            width: 8px;
            height: 8px;
        }

        .c-5 {
            background: #34d399;
            left: 50%;
            animation-delay: 1.5s;
        }

        .c-6 {
            background: #60a5fa;
            left: 60%;
            animation-delay: 0.5s;
            width: 12px;
            height: 12px;
        }

        .c-7 {
            background: #f472b6;
            left: 70%;
            animation-delay: 2.5s;
        }

        .c-8 {
            background: #a78bfa;
            left: 80%;
            animation-delay: 1s;
            width: 8px;
            height: 8px;
        }

        .c-9 {
            background: #fbbf24;
            left: 90%;
            animation-delay: 3.5s;
        }

        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #10b981;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark-check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }
    </style>
    <?php $__env->stopPush(); ?>

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="confetti c-1"></div>
        <div class="confetti c-2"></div>
        <div class="confetti c-3"></div>
        <div class="confetti c-4"></div>
        <div class="confetti c-5"></div>
        <div class="confetti c-6"></div>
        <div class="confetti c-7"></div>
        <div class="confetti c-8"></div>
        <div class="confetti c-9"></div>
    </div>

    
    <div class="min-h-screen flex items-center justify-center p-4 relative z-10 pt-32 pb-20"
        x-data="{
             countdown: 10,
             init() {
                 setInterval(() => {
                     if (this.countdown > 0) {
                         this.countdown--;
                     } else {
                         window.location.href = '<?php echo e(route('home')); ?>';
                     }
                 }, 1000);
             }
         }">

        <div class="w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white/60 p-10 sm:p-14 text-center form-anim relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-400 via-teal-500 to-cyan-500"></div>

            <div class="mb-8 relative inline-block">
                <div class="absolute inset-0 bg-emerald-100 rounded-full blur-xl opacity-50 animate-pulse"></div>
                <div class="relative w-24 h-24 rounded-full bg-emerald-50 flex items-center justify-center mx-auto">
                    <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                        <path class="checkmark-check" fill="none" stroke="#10b981" stroke-width="5" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                </div>
            </div>

            <div class="space-y-4 mb-10">
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Terima Kasih!</h1>
                <p class="text-slate-500 text-lg leading-relaxed">
                    Jawaban survei Anda telah berhasil kami rekam. Partisipasi Anda sangat berarti bagi kemajuan layanan kami.
                </p>
            </div>

            <div class="space-y-3">
                <a href="<?php echo e(route('home')); ?>" class="block w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm uppercase tracking-widest shadow-lg shadow-slate-300/50 hover:bg-emerald-600 transition-all hover:-translate-y-0.5">
                    Kembali ke Beranda
                </a>
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('public.profile.history')); ?>" class="block w-full py-4 bg-white border border-slate-200 text-slate-600 rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-slate-50 transition-all">
                    Lihat Riwayat Saya
                </a>
                <?php endif; ?>
            </div>

            
            <div class="mt-10 pt-6 border-t border-slate-100">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">
                    © <?php echo e(date('Y')); ?> SurveyZI UIN Antasari
                </p>
                <p class="text-[10px] font-bold text-teal-600 animate-pulse">
                    Otomatis kembali dalam <span x-text="countdown"></span> detik...
                </p>
            </div>

        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.form-anim', {
                    opacity: 0,
                    scale: 0.9,
                    y: 30,
                    duration: 1,
                    ease: "elastic.out(1, 0.7)"
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
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/public/thank-you.blade.php ENDPATH**/ ?>