<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo e($title ?? 'Survei UIN Antasari'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Header Scrolled State */
        .header-scrolled {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.05);
        }

        /* Nav Link Hover Effect */
        .nav-link-anim {
            position: relative;
        }

        .nav-link-anim::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0%;
            height: 2px;
            background: linear-gradient(to right, #0d9488, #0891b2);
            /* Teal to Cyan */
            transition: width 0.3s ease;
        }

        .nav-link-anim:hover::after,
        .nav-link-anim.active::after {
            width: 100%;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden flex flex-col min-h-screen">

    
    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
        x-data="{ mobileMenuOpen: false, scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 10)"
        :class="{ 'header-scrolled py-3': scrolled, 'bg-transparent py-5': !scrolled }">

        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">

                
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 group z-50 relative">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>
                        <div class="relative bg-white p-1.5 rounded-xl shadow-sm border border-white/50">
                            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="h-8 w-8 sm:h-9 sm:w-9 object-contain">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-lg sm:text-xl tracking-tight text-slate-900 leading-none group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-teal-600 group-hover:to-cyan-600 transition-all">
                            Survei
                        </span>
                        <span class="text-[10px] sm:text-xs font-bold text-slate-400 tracking-widest uppercase">UIN Antasari</span>
                    </div>
                </a>

                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link-anim text-sm font-bold text-slate-600 hover:text-teal-700 transition-colors <?php echo e(request()->routeIs('home') ? 'active text-teal-700' : ''); ?>">Beranda</a>
                    <a href="<?php echo e(route('public.tentang')); ?>" class="nav-link-anim text-sm font-bold text-slate-600 hover:text-teal-700 transition-colors <?php echo e(request()->routeIs('public.tentang') ? 'active text-teal-700' : ''); ?>">Tentang</a>
                    <a href="<?php echo e(route('public.programs.list')); ?>" class="nav-link-anim text-sm font-bold text-slate-600 hover:text-teal-700 transition-colors <?php echo e(request()->routeIs('public.programs.list') ? 'active text-teal-700' : ''); ?>">Program</a>

                    
                    <div class="pl-6 border-l border-slate-200/60 ml-2">
                        <?php if(auth()->guard()->check()): ?>
                        
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 py-1 px-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center text-white font-bold text-xs shadow-md border-2 border-white">
                                    <?php echo e(strtoupper(substr(Auth::user()->username, 0, 1))); ?>

                                </div>
                                <span class="text-sm font-bold text-slate-700 max-w-[100px] truncate hidden lg:block"><?php echo e(Auth::user()->username); ?></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            
                            <div x-show="open" @click.away="open = false" x-transition.origin.top.right x-cloak
                                class="absolute right-0 mt-3 w-60 bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden ring-1 ring-black ring-opacity-5 z-50">
                                <div class="px-4 py-3 bg-slate-50 border-b border-slate-100">
                                    <p class="text-sm font-bold text-slate-800 truncate"><?php echo e(Auth::user()->username); ?></p>
                                    <p class="text-xs text-slate-500 truncate"><?php echo e(Auth::user()->email); ?></p>
                                </div>

                                
                                <div class="p-1">
                                    <?php if(auth()->user()->role_id == 1): ?>
                                    <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="flex items-center gap-2 px-3 py-2 text-sm font-bold text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                        Dashboard Admin
                                    </a>
                                    <?php elseif(auth()->user()->role_id == 2): ?>
                                    <a href="<?php echo e(route('unitkerja.admin.dashboard')); ?>" class="flex items-center gap-2 px-3 py-2 text-sm font-bold text-teal-600 hover:bg-teal-50 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                        </svg>
                                        Dashboard Unit
                                    </a>
                                    <?php else: ?>
                                    <a href="<?php echo e(route('public.profile')); ?>" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Profil Saya
                                    </a>
                                    <a href="<?php echo e(route('public.profile.history')); ?>" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Riwayat Survei
                                    </a>
                                    <?php endif; ?>
                                </div>

                                <div class="border-t border-slate-100 p-1">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="flex w-full items-center gap-2 px-3 py-2 text-sm font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-bold text-white transition-all duration-200 bg-slate-900 rounded-xl hover:bg-teal-600 hover:shadow-lg hover:shadow-teal-500/30 hover:-translate-y-0.5 active:scale-95">
                            Masuk
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-xl text-slate-600 hover:bg-slate-100 transition-colors focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>

        
        <div x-cloak x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden absolute top-full left-0 w-full bg-white/95 backdrop-blur-xl border-b border-slate-200 shadow-xl z-40">

            <div class="px-4 py-6 space-y-2">
                <a href="<?php echo e(route('home')); ?>" class="block px-4 py-3 rounded-xl text-base font-bold text-slate-600 hover:bg-teal-50 hover:text-teal-700 transition-colors <?php echo e(request()->routeIs('home') ? 'bg-teal-50 text-teal-700' : ''); ?>">Beranda</a>
                <a href="<?php echo e(route('public.tentang')); ?>" class="block px-4 py-3 rounded-xl text-base font-bold text-slate-600 hover:bg-teal-50 hover:text-teal-700 transition-colors <?php echo e(request()->routeIs('public.tentang') ? 'bg-teal-50 text-teal-700' : ''); ?>">Tentang</a>
                <a href="<?php echo e(route('public.programs.list')); ?>" class="block px-4 py-3 rounded-xl text-base font-bold text-slate-600 hover:bg-teal-50 hover:text-teal-700 transition-colors <?php echo e(request()->routeIs('public.programs.list') ? 'bg-teal-50 text-teal-700' : ''); ?>">Program Survei</a>

                <div class="border-t border-slate-100 my-2 pt-2">
                    <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="block w-full text-center px-4 py-3 rounded-xl bg-slate-900 text-white font-bold shadow-lg mt-4 active:scale-95 transition-transform">Masuk / Login</a>
                    <?php else: ?>
                    <div class="px-4 py-2 flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-teal-500 flex items-center justify-center text-white font-bold text-sm shadow">
                            <?php echo e(strtoupper(substr(Auth::user()->username, 0, 1))); ?>

                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800"><?php echo e(Auth::user()->username); ?></p>
                            <p class="text-xs text-slate-500"><?php echo e(Auth::user()->email); ?></p>
                        </div>
                    </div>

                    <?php if(auth()->user()->role_id == 1): ?>
                    <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold text-indigo-600 hover:bg-indigo-50">Dashboard Admin</a>
                    <?php elseif(auth()->user()->role_id == 2): ?>
                    <a href="<?php echo e(route('unitkerja.admin.dashboard')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold text-teal-600 hover:bg-teal-50">Dashboard Unit</a>
                    <?php else: ?>
                    <a href="<?php echo e(route('public.profile')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50">Profil Saya</a>
                    <a href="<?php echo e(route('public.profile.history')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50">Riwayat</a>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-sm font-bold text-rose-600 hover:bg-rose-50">Keluar</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    
    
    <main class="relative z-0 flex-grow pt-10">
        <?php echo e($slot); ?>

    </main>

    
    <footer class="relative bg-slate-900 text-slate-300 pt-20 pb-10 overflow-hidden mt-auto">

        
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] bg-teal-500/20 rounded-full blur-[100px] mix-blend-screen animate-blob"></div>
            <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-indigo-500/20 rounded-full blur-[100px] mix-blend-screen animate-blob animation-delay-2000"></div>
            
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-16">

                
                <div class="lg:col-span-4 space-y-6">
                    <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-3 group">
                        <div class="bg-white p-1.5 rounded-xl shadow-lg shadow-teal-500/20 group-hover:scale-105 transition-transform duration-300">
                            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="h-9 w-9">
                        </div>
                        <div>
                            <span class="block text-2xl font-black text-white tracking-tight group-hover:text-teal-400 transition-colors">SURVEI</span>
                            <span class="block text-[10px] font-bold text-slate-500 tracking-widest uppercase">UIN Antasari</span>
                        </div>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Platform resmi penjaminan mutu. Partisipasi Anda adalah kunci utama dalam peningkatan kualitas layanan akademik dan fasilitas kampus.
                    </p>

                    
                    <div class="flex items-center gap-3 pt-2">
                        
                        <a href="#" class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:bg-[#1877F2] hover:text-white transition-all hover:-translate-y-1" title="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036c-2.148 0-2.797 1.651-2.797 2.895v1.076h3.44l-.571 3.667h-2.869v7.98h-5.018Z" />
                            </svg>
                        </a>
                        
                        <a href="#" class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:bg-black hover:text-white transition-all hover:-translate-y-1" title="Twitter">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                        
                        <a href="#" class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:bg-gradient-to-tr hover:from-[#f9ce34] hover:via-[#ee2a7b] hover:to-[#6228d7] hover:text-white transition-all hover:-translate-y-1" title="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        
                        <a href="#" class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:bg-[#FF0000] hover:text-white transition-all hover:-translate-y-1" title="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        
                        <a href="#" class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:bg-black hover:text-white transition-all hover:-translate-y-1" title="TikTok">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 1 0 7.75 6.76V7.9A9 9 0 0 0 16 8.47 8.23 8.23 0 0 0 19.59 6.69z" />
                            </svg>
                        </a>
                    </div>
                </div>

                
                <div class="lg:col-span-3 grid grid-cols-2 gap-8">
                    
                    <div>
                        <h4 class="text-white font-bold mb-5 text-sm border-l-2 border-teal-500 pl-3">Navigasi</h4>
                        <ul class="space-y-3 text-sm">
                            <li>
                                <a href="<?php echo e(route('home')); ?>" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="w-1 h-1 bg-teal-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span> Beranda
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('public.programs.list')); ?>" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="w-1 h-1 bg-teal-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span> Program Survei
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('public.tentang')); ?>" class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 group">
                                    <span class="w-1 h-1 bg-teal-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span> Tentang Kami
                                </a>
                            </li>
                        </ul>
                    </div>

                    
                    <div>
                        <h4 class="text-white font-bold mb-5 text-sm border-l-2 border-blue-500 pl-3">Akses</h4>
                        <ul class="space-y-3 text-sm">
                            <li>
                                <a href="<?php echo e(route('login')); ?>" class="text-slate-400 hover:text-blue-400 transition-colors flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Masuk Responden
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                
                <div class="lg:col-span-5">
                    <h4 class="text-white font-bold mb-5 text-sm border-l-2 border-purple-500 pl-3">Kontak & Lokasi</h4>
                    <ul class="space-y-5 text-sm">

                        
                        <li class="flex flex-wrap gap-6">
                            <div class="flex items-center gap-3 group">
                                <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center text-teal-400 group-hover:bg-teal-500 group-hover:text-white transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <span class="text-slate-300 font-mono">(0511) 3252929</span>
                            </div>
                            <div class="flex items-center gap-3 group">
                                <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center text-teal-400 group-hover:bg-teal-500 group-hover:text-white transition-all">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <a href="mailto:info@uin-antasari.ac.id" class="text-slate-300 hover:text-white transition-colors">info@uin-antasari.ac.id</a>
                            </div>
                        </li>

                        
                        <li class="flex items-start gap-3 group">
                            <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center flex-shrink-0 text-teal-400 group-hover:bg-teal-500 group-hover:text-white transition-all mt-0.5">
                                <span class="font-bold text-xs">01</span>
                            </div>
                            <div>
                                <strong class="block text-white text-xs mb-1">Kampus 1:</strong>
                                <a href="https://maps.app.goo.gl/7tRLB2fJchCmV5Rf9" target="_blank" class="text-slate-400 hover:text-teal-400 transition-colors leading-relaxed">
                                    Jl. Jenderal Ahmad Yani KM. 4,5 Banjarmasin, Kalimantan Selatan, Indonesia 70235
                                </a>
                            </div>
                        </li>

                        
                        <li class="flex items-start gap-3 group">
                            <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center flex-shrink-0 text-teal-400 group-hover:bg-teal-500 group-hover:text-white transition-all mt-0.5">
                                <span class="font-bold text-xs">02</span>
                            </div>
                            <div>
                                <strong class="block text-white text-xs mb-1">Kampus 2:</strong>
                                <a href="https://maps.app.goo.gl/dsPD1NRJC9tAq7Gb8" target="_blank" class="text-slate-400 hover:text-teal-400 transition-colors leading-relaxed">
                                    Jl. Pandarapan, Guntung Manggis, Banjarbaru, Kalimantan Selatan, Indonesia
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            
            <div class="border-t border-white/10 pt-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-500">
                    &copy; <?php echo e(date('Y')); ?> <strong class="text-slate-300">UIN Antasari Banjarmasin</strong>. All rights reserved.
                </p>
                <p class="text-xs text-slate-600">Dikembangkan oleh Muhammad Alfin Nur Huda</p>
            </div>
        </div>
    </footer>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\laragon\www\surveyZI\resources\views/layouts/guest.blade.php ENDPATH**/ ?>