<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Survei UIN Antasari'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* PERBAIKAN: Disederhanakan, .nav-active dihapus */
        .header-scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            /* Dibuat lebih halus */
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #06b6d4, #14b8a6, #2563eb);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-slate-50 antialiased overflow-x-hidden" data-turbo="false">
    <header class="header-anim fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-xl shadow-sm z-50 border-b border-gray-200/50 transition-all duration-300">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8" x-data="{ mobileMenuOpen: false, scrolled: false }"
            @scroll.window="scrolled = window.scrollY > 20"
            :class="{ 'header-scrolled': scrolled }">

            <div class="flex items-center justify-between h-14 sm:h-16">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-600 to-teal-600 rounded-lg blur-lg opacity-0 group-hover:opacity-40 transition-all duration-300"></div>
                        <div class="relative bg-gradient-to-br from-cyan-600 to-teal-600 p-1.5 rounded-lg shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo UIN Antasari" class="relative h-6 w-6">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-base gradient-text">Survei</span>
                        <span class="text-[10px] text-gray-500 -mt-1 hidden sm:block font-semibold">UIN Antasari</span>
                    </div>
                </a>

                
                
                <div class="hidden md:flex items-center space-x-1 relative z-10">
                    
                    <a href="<?php echo e(route('home')); ?>" class="px-3 py-1.5 text-sm font-bold text-gray-700 hover:text-teal-600 transition-all duration-200 relative group rounded-lg hover:bg-teal-50">
                        Beranda
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 h-0.5 bg-gradient-to-r from-cyan-600 to-teal-600 rounded-full transition-all duration-300 
                                     <?php echo e(request()->routeIs('home') ? 'w-3/4' : 'w-0 group-hover:w-3/4'); ?>">
                        </span>
                    </a>
                    <a href="<?php echo e(route('public.tentang')); ?>" class="px-3 py-1.5 text-sm font-bold text-gray-700 hover:text-teal-600 transition-all duration-200 relative group rounded-lg hover:bg-teal-50">
                        Tentang
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 h-0.5 bg-gradient-to-r from-cyan-600 to-teal-600 rounded-full transition-all duration-300 
                                     <?php echo e(request()->routeIs('public.tentang') ? 'w-3/4' : 'w-0 group-hover:w-3/4'); ?>">
                        </span>
                    </a>
                    <a href="<?php echo e(route('public.programs.list')); ?>" class="px-3 py-1.5 text-sm font-bold text-gray-700 hover:text-teal-600 transition-all duration-200 relative group rounded-lg hover:bg-teal-50">
                        Program Survei
                        <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 h-0.5 bg-gradient-to-r from-cyan-600 to-teal-600 rounded-full transition-all duration-300 
                                     <?php echo e(request()->routeIs('public.programs.list') ? 'w-3/4' : 'w-0 group-hover:w-3/4'); ?>">
                        </span>
                    </a>
                </div>

                
                <div class="hidden md:flex items-center">
                    <?php if(auth()->guard()->check()): ?>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 px-3 py-1.5 rounded-lg hover:bg-gradient-to-r hover:from-cyan-50 hover:to-teal-50 transition-all duration-300">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 via-teal-500 to-blue-500 rounded-full flex items-center justify-center text-white font-black text-xs shadow-lg">
                                <?php echo e(strtoupper(substr(Auth::user()->username, 0, 1))); ?>

                            </div>
                            <span class="font-bold text-gray-700 text-sm"><?php echo e(Str::limit(Auth::user()->username, 12)); ?></span>
                            <svg class="h-4 w-4 text-gray-500 transition-transform duration-300" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-cloak x-show="open" @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden">

                            <div class="px-4 py-3 bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500">
                                <p class="text-sm font-black text-white"><?php echo e(Auth::user()->username); ?></p>
                                <p class="text-xs text-white/80 mt-0.5"><?php echo e(Auth::user()->email); ?></p>
                            </div>

                            <div class="py-1">
                                <a href="<?php echo e(route('public.profile')); ?>" class="flex items-center px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-teal-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>
                                <a href="<?php echo e(route('public.profile.history')); ?>" class="flex items-center px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-teal-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Riwayat Survei
                                </a>
                            </div>

                            <div class="border-t border-gray-100">
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="relative inline-flex items-center bg-gradient-to-r from-cyan-600 via-teal-600 to-blue-600 text-white px-5 py-2 rounded-lg font-bold overflow-hidden group shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-105">
                        <span class="absolute inset-0 bg-gradient-to-r from-blue-600 via-teal-600 to-cyan-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="relative h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span class="relative text-sm">Masuk</span>
                    </a>
                    <?php endif; ?>
                </div>

                
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="relative text-gray-600 hover:text-gray-900 p-2 rounded-lg hover:bg-gray-100 transition-all" aria-label="Toggle mobile menu">
                        <svg x-show="!mobileMenuOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            
            <div x-cloak x-show="mobileMenuOpen"
                @click.away="mobileMenuOpen = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden pb-4 pt-2 space-y-1 border-t border-gray-100 mt-2">

                <!-- Beranda -->
                <a href="<?php echo e(route('home')); ?>"
                    @click.prevent="mobileMenuOpen = false; setTimeout(() => window.location = '<?php echo e(route('home')); ?>', 100)"
                    class="nav-link-anim flex items-center px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-teal-50 hover:text-teal-600 rounded-lg transition-all font-bold group">
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-100 to-teal-100 rounded-lg flex items-center justify-center mr-2 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    Beranda
                </a>

                <!-- Tentang -->
                <a href="<?php echo e(route('public.tentang')); ?>"
                    @click.prevent="mobileMenuOpen = false; setTimeout(() => window.location = '<?php echo e(route('public.tentang')); ?>', 100)"
                    class="nav-link-anim flex items-center px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-teal-50 hover:text-teal-600 rounded-lg transition-all font-bold group">
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-100 to-teal-100 rounded-lg flex items-center justify-center mr-2 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    Tentang
                </a>

                <!-- Program Survei -->
                <a href="<?php echo e(route('public.programs.list')); ?>"
                    @click.prevent="mobileMenuOpen = false; setTimeout(() => window.location = '<?php echo e(route('public.programs.list')); ?>', 100)"
                    class="nav-link-anim flex items-center px-3 py-2 text-gray-700 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-teal-50 hover:text-teal-600 rounded-lg transition-all font-bold group">
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-100 to-teal-100 rounded-lg flex items-center justify-center mr-2 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    Program Survei
                </a>

                <?php if(auth()->guard()->guest()): ?>
                <div class="pt-2 border-t border-gray-100 mt-2">
                    <a href="<?php echo e(route('login')); ?>"
                        @click.prevent="mobileMenuOpen = false; setTimeout(() => window.location = '<?php echo e(route('login')); ?>', 100)"
                        class="flex items-center justify-center bg-gradient-to-r from-cyan-600 via-teal-600 to-blue-600 text-white px-3 py-2.5 rounded-lg font-bold shadow-lg hover:shadow-xl transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </a>
                </div>
                <?php else: ?>
                <div class="pt-2 border-t border-gray-100 mt-2">
                    <div class="px-3 py-2.5 bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500 rounded-lg mb-2">
                        <p class="text-sm font-black text-white"><?php echo e(Auth::user()->username); ?></p>
                        <p class="text-xs text-white/80 mt-0.5"><?php echo e(Auth::user()->email); ?></p>
                    </div>

                    <a href="<?php echo e(route('public.profile')); ?>"
                        @click.prevent="mobileMenuOpen = false; setTimeout(() => window.location = '<?php echo e(route('public.profile')); ?>', 100)"
                        class="flex items-center px-3 py-2 text-gray-700 hover:bg-teal-50 rounded-lg transition-colors font-semibold text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </a>

                    <a href="<?php echo e(route('public.profile.history')); ?>"
                        @click.prevent="mobileMenuOpen = false; setTimeout(() => window.location = '<?php echo e(route('public.profile.history')); ?>', 100)"
                        class="flex items-center px-3 py-2 text-gray-700 hover:bg-teal-50 rounded-lg transition-colors font-semibold text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Riwayat Survei
                    </a>

                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="mt-1">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            @click="mobileMenuOpen = false"
                            class="flex items-center w-full px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors font-bold text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    
    <main class="pt-0 sm:pt-0 relative z-0">
        <?php echo e($slot); ?>

    </main>

    
    <footer class="mt-20 bg-gradient-to-br from-gray-900 via-teal-900 to-cyan-900 text-gray-300 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2.5 mb-4">
                        <div class="bg-gradient-to-br from-cyan-500 to-teal-600 p-2 rounded-lg shadow-lg">
                            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="h-7 w-7">
                        </div>
                        <div>
                            <h3 class="font-black text-white text-lg">Survei</h3>
                            <p class="text-xs text-gray-400 font-semibold -mt-0.5">UIN Antasari</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Platform survei kepuasan layanan untuk meningkatkan kualitas dan integritas di UIN Antasari Banjarmasin.
                    </p>
                </div>

                <div>
                    <h4 class="font-black text-white mb-4 text-base">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?php echo e(route('home')); ?>" class="hover:text-cyan-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full mr-2 group-hover:w-3 transition-all"></span>
                                Beranda
                            </a></li>
                        <li><a href="<?php echo e(route('public.tentang')); ?>" class="hover:text-cyan-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full mr-2 group-hover:w-3 transition-all"></span>
                                Tentang Kami
                            </a></li>
                        <li><a href="<?php echo e(route('public.programs.list')); ?>" class="hover:text-cyan-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full mr-2 group-hover:w-3 transition-all"></span>
                                Program Survei
                            </a></li>
                        <li><a href="<?php echo e(route('login')); ?>" class="hover:text-cyan-400 transition-colors flex items-center group">
                                <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full mr-2 group-hover:w-3 transition-all"></span>
                                Login
                            </a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-black text-white mb-4 text-base">Kontak</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start group">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="text-gray-400 leading-relaxed text-xs">Jl. A. Yani Km. 4.5, Banjarmasin, Kalimantan Selatan</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-lg flex items-center justify-center mr-2.5 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-gray-400 text-xs">survei@uin-antasari.ac.id</span>
                        </li>
                        <li class="flex items-center group">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-lg flex items-center justify-center mr-2.5 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <span class="text-gray-400 text-xs">(0511) 3252829</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-6 text-center">
                <p class="text-sm text-gray-400">
                    &copy; <?php echo e(date('Y')); ?> <span class="font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-teal-400">Muhammad Alfin Nur Huda</span>. All rights reserved.
                </p>
                <p class="text-xs text-gray-500 mt-1.5 font-semibold">Dikembangkan untuk UIN Antasari Banjarmasin</p>
            </div>
        </div>
    </footer>
    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\laragon\www\surveyZI\resources\views/layouts/guest.blade.php ENDPATH**/ ?>