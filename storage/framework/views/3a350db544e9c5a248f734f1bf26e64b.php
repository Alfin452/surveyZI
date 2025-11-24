<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unitKerja->unit_kerja_name . ' - ' . $program->title)]); ?>

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
    </style>
    <?php $__env->stopPush(); ?>

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="blob bg-teal-200 w-96 h-96 top-0 left-0 rounded-full mix-blend-multiply"></div>
    <div class="blob bg-blue-200 w-80 h-80 bottom-0 right-0 rounded-full mix-blend-multiply animation-delay-2000"></div>

    <section class="relative min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">

        <div class="max-w-5xl w-full">

            
            <nav class="flex items-center justify-center space-x-2 text-sm font-medium text-slate-500 mb-10 animate-fade-down">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-teal-600 transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="<?php echo e(route('public.survey.directory', $program->alias)); ?>" class="hover:text-teal-600 transition-colors">Pilih Unit Layanan</a>
                <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-slate-800 font-bold"><?php echo e(Str::limit($unitKerja->unit_kerja_name, 30)); ?></span>
            </nav>

            
            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white/50 overflow-hidden flex flex-col lg:flex-row min-h-[600px] unit-card-anim">

                
                <div class="lg:w-2/5 bg-slate-50/80 border-r border-slate-100 p-10 flex flex-col relative overflow-hidden">
                    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#64748b 1px, transparent 1px); background-size: 20px 20px;"></div>

                    <div class="relative z-10 flex flex-col h-full">

                        
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center justify-center text-teal-600 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>

                            <span class="inline-block px-3 py-1 bg-teal-100 text-teal-700 rounded-lg text-[10px] font-bold uppercase tracking-widest mb-3">
                                Unit Layanan
                            </span>

                            <h1 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight mb-4">
                                <?php echo e($unitKerja->unit_kerja_name); ?>

                            </h1>

                            <?php if($unitKerja->address): ?>
                            <div class="flex items-start gap-3 text-slate-500 text-sm font-medium leading-relaxed mb-8">
                                <svg class="w-5 h-5 shrink-0 mt-0.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p><?php echo e($unitKerja->address); ?></p>
                            </div>
                            <?php endif; ?>

                            
                            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm inline-block">
                                <div class="flex flex-col items-center">
                                    <div id="qrcode" class="mb-3"></div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Scan Masuk Cepat</p>
                                </div>
                            </div>
                        </div>

                        
                        <div class="mt-auto pt-8 border-t border-slate-200">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Jam Layanan
                            </p>
                            <p class="text-slate-700 font-bold text-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <?php if($unitKerja->start_time && $unitKerja->end_time): ?>
                                <?php echo e(\Carbon\Carbon::parse($unitKerja->start_time)->format('H:i')); ?> - <?php echo e(\Carbon\Carbon::parse($unitKerja->end_time)->format('H:i')); ?> WITA
                                <?php else: ?>
                                Senin - Jumat (Sesuai Jam Kerja)
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>

                
                <div class="lg:w-3/5 bg-white p-10 flex flex-col justify-center relative" x-data="{ copied: false }">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-teal-50 to-transparent rounded-bl-[3rem] pointer-events-none"></div>

                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-indigo-500 font-bold text-xs tracking-widest uppercase block">Program Survei</span>

                            
                            <?php $daysLeft = \Carbon\Carbon::now()->diffInDays($program->end_date, false); ?>
                            <?php if($daysLeft > 0 && $daysLeft <= 7): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-bold uppercase tracking-wider border border-rose-100 animate-pulse">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Sisa <?php echo e(ceil($daysLeft)); ?> Hari
                                </span>
                                <?php elseif($daysLeft > 7): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-wider border border-emerald-100">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Aktif s.d <?php echo e(\Carbon\Carbon::parse($program->end_date)->format('d M Y')); ?>

                                </span>
                                <?php endif; ?>
                        </div>

                        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4">
                            <?php echo e($program->title); ?>

                        </h2>

                        
                        <?php if(isset($respondentCount)): ?>
                        <div class="flex items-center gap-3 mb-6 bg-slate-50 w-fit px-4 py-2 rounded-full border border-slate-100">
                            <div class="flex -space-x-2">
                                <?php $__empty_1 = true; $__currentLoopData = $latestRespondents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $resp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                $colors = ['bg-teal-100 text-teal-700', 'bg-indigo-100 text-indigo-700', 'bg-rose-100 text-rose-700'];
                                $colorClass = $colors[$idx % count($colors)];
                                ?>
                                <div class="w-6 h-6 rounded-full <?php echo e($colorClass); ?> border-2 border-white flex items-center justify-center text-[8px] font-black shadow-sm">
                                    <?php echo e(strtoupper(substr($resp->user->username ?? 'A', 0, 1))); ?>

                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="w-6 h-6 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-[8px] font-bold text-slate-500">?</div>
                                <?php endif; ?>
                            </div>

                            <span class="text-xs font-medium text-slate-500">
                                <?php if($respondentCount > 0): ?>
                                <span class="font-black text-slate-900"><?php echo e(number_format($respondentCount)); ?></span> Partisipan telah mengisi
                                <?php else: ?>
                                Jadilah <span class="font-bold text-teal-600">Responden Pertama!</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <?php endif; ?>

                        <p class="text-slate-500 text-lg leading-relaxed border-l-4 border-teal-500 pl-4">
                            <?php echo e($program->description ?? 'Partisipasi Anda sangat berharga. Bantu kami meningkatkan kualitas layanan dengan mengisi survei singkat ini.'); ?>

                        </p>
                    </div>

                    
                    <div class="flex flex-wrap gap-3 mb-10">
                        <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-50 border border-slate-100 text-slate-600 text-xs font-bold">
                            <svg class="w-4 h-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Anonim & Aman
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-50 border border-slate-100 text-slate-600 text-xs font-bold">
                            <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Cepat (< 5 Menit)
                                </div>
                        </div>

                        
                        <a href="<?php echo e(route('public.survey.fill', ['program' => $program, 'unitKerja' => $unitKerja])); ?>"
                            class="group relative w-full inline-flex items-center justify-center bg-slate-900 text-white font-black py-5 px-8 rounded-2xl overflow-hidden shadow-xl shadow-slate-300 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-teal-500 to-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            <span class="relative flex items-center gap-3">
                                Mulai Pengisian
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                        </a>

                        
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <button @click="navigator.clipboard.writeText(window.location.href); copied=true; setTimeout(()=>copied=false, 2000)"
                                class="flex items-center justify-center gap-2 py-3 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 hover:text-slate-900 transition-all">
                                <svg x-show="!copied" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <svg x-show="copied" class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                            </button>

                            <a href="https://wa.me/?text=Ayo isi survei <?php echo e($program->title); ?> di unit <?php echo e($unitKerja->unit_kerja_name); ?>! <?php echo e(request()->url()); ?>"
                                target="_blank"
                                class="flex items-center justify-center gap-2 py-3 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>
    </section>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.unit-card-anim', {
                    y: 50,
                    opacity: 0,
                    duration: 1,
                    ease: "power3.out"
                });
                gsap.from('.animate-fade-down', {
                    y: -20,
                    opacity: 0,
                    duration: 0.8,
                    delay: 0.2
                });
            }

            // Generate QR Code (Ukuran Besar: 180)
            const surveyUrl = "<?php echo e(route('public.survey.fill', ['program' => $program, 'unitKerja' => $unitKerja])); ?>";

            new QRCode(document.getElementById("qrcode"), {
                text: surveyUrl,
                width: 180,
                height: 180,
                colorDark: "#0f172a", // Slate 900
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
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
<?php endif; ?><?php /**PATH C:\laragon\www\surveyZI\resources\views/public/unit-landing.blade.php ENDPATH**/ ?>