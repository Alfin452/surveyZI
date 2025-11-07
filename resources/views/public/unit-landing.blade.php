<x-guest-layout :title="$unitKerja->unit_kerja_name . ' - ' . $program->title">

    {{-- Hero Section with Gradient Background --}}
    <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 pt-32 sm:pt-36 pb-20 sm:pb-24 overflow-hidden min-h-screen flex items-center">
        {{-- Animated Background --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-shape absolute top-20 left-10 w-32 h-32 sm:w-64 sm:h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute top-40 right-20 w-48 h-48 sm:w-96 sm:h-96 bg-yellow-300/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute bottom-20 left-1/4 w-40 h-40 sm:w-80 sm:h-80 bg-blue-300/10 rounded-full blur-3xl"></div>

            {{-- Grid Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 50px 50px;"></div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Breadcrumb --}}
            <nav class="breadcrumb flex items-center justify-center space-x-2 text-sm mb-8 sm:mb-10">
                <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('public.survey.directory', $program) }}" class="text-white/80 hover:text-white transition-colors">
                    {{ Str::limit($program->title, 20) }}
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white font-semibold">{{ Str::limit($unitKerja->unit_kerja_name, 25) }}</span>
            </nav>

            {{-- Main Content Card --}}
            <div class="max-w-4xl mx-auto">
                <div class="unit-card bg-white rounded-3xl shadow-2xl overflow-hidden">
                    {{-- Gradient Header --}}
                    <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                    <div class="p-8 sm:p-12 text-center">
                        {{-- Icon with Animation --}}
                        <div class="unit-icon-wrapper mb-8">
                            <div class="relative inline-block">
                                <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-3xl blur-2xl opacity-50 animate-pulse"></div>
                                <div class="relative bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 text-indigo-600 h-24 w-24 sm:h-28 sm:w-28 rounded-3xl flex items-center justify-center shadow-2xl transform hover:rotate-6 hover:scale-110 transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-14 sm:w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Unit Name --}}
                        <h1 class="unit-title text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-3 leading-tight">
                            {{ $unitKerja->unit_kerja_name }}
                        </h1>

                        {{-- Short Name Badge --}}
                        @if($unitKerja->uk_short_name)
                        <div class="unit-badge inline-block mb-6">
                            <span class="bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 px-6 py-2 rounded-full text-sm font-bold border-2 border-indigo-200">
                                {{ $unitKerja->uk_short_name }}
                            </span>
                        </div>
                        @endif

                        {{-- Address/Description --}}
                        <p class="unit-address text-base sm:text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed mb-8">
                            {{ $unitKerja->address ?? 'Layanan ' . $unitKerja->unit_kerja_name . ' UIN Antasari Banjarmasin.' }}
                        </p>

                        {{-- Divider --}}
                        <div class="divider-line flex items-center justify-center my-8">
                            <div class="h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent w-full max-w-md"></div>
                        </div>

                        {{-- Survey Action Card --}}
                        <div class="survey-action-card bg-gradient-to-br from-slate-50 to-indigo-50 p-6 sm:p-8 rounded-2xl border-2 border-indigo-100 shadow-lg">
                            {{-- Program Info --}}
                            <div class="mb-6">
                                <div class="flex items-center justify-center mb-3">
                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 py-1.5 rounded-full text-xs font-black">
                                        PROGRAM SURVEI
                                    </div>
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-black text-gray-900 mb-2">
                                    {{ $program->title }}
                                </h2>
                                <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                                    {{ $program->description ?? 'Berikan feedback untuk meningkatkan kualitas layanan kami.' }}
                                </p>
                            </div>

                            {{-- Features List --}}
                            <div class="features-list grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                                <div class="feature-item bg-white p-4 rounded-xl shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs font-bold text-gray-700">Cepat & Mudah</p>
                                </div>
                                <div class="feature-item bg-white p-4 rounded-xl shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <p class="text-xs font-bold text-gray-700">Aman & Anonim</p>
                                </div>
                                <div class="feature-item bg-white p-4 rounded-xl shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <p class="text-xs font-bold text-gray-700">Berdampak Nyata</p>
                                </div>
                            </div>

                            {{-- CTA Button --}}
                            <a href="{{ route('public.survey.fill', ['program' => $program, 'unitKerja' => $unitKerja]) }}"
                                class="cta-button group relative inline-flex items-center justify-center w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-black py-5 px-8 rounded-2xl text-base sm:text-lg overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                                <span class="absolute inset-0 bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                <span class="relative flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Isi Survei Sekarang
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </a>

                            {{-- Info Text --}}
                            <p class="info-text mt-4 text-xs text-gray-500">
                                🔒 Data Anda aman dan bersifat rahasia
                            </p>
                        </div>

                        {{-- Back Button --}}
                        <div class="back-button mt-8">
                            <a href="{{ route('public.survey.directory', $program) }}" class="inline-flex items-center text-gray-600 hover:text-indigo-600 font-semibold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Daftar Unit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wave Bottom --}}
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="#F8FAFC"></path>
            </svg>
        </div>
    </section>

    {{-- GSAP Animations - FIXED --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isMobile = window.innerWidth < 768;

            // === FORCE VISIBILITY FIRST (IMPORTANT!) ===
            gsap.set('.cta-button, .survey-action-card, .unit-card', {
                opacity: 1,
                visibility: 'visible'
            });

            // === FLOATING SHAPES ===
            gsap.to('.floating-shape', {
                y: 30,
                x: 20,
                duration: 4,
                stagger: 0.5,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });

            // === MAIN TIMELINE ===
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                },
                onStart: () => {
                    // Ensure elements are visible when animation starts
                    gsap.set('.cta-button', {
                        opacity: 1,
                        visibility: 'visible'
                    });
                }
            });

            tl.from('.breadcrumb', {
                    opacity: 0,
                    y: -20,
                    duration: 0.6
                })
                .from('.unit-card', {
                    opacity: 0,
                    scale: 0.9,
                    y: 50,
                    duration: 0.8,
                    ease: "back.out(1.3)",
                    clearProps: "opacity,scale,y"
                }, "-=0.3")
                .from('.unit-icon-wrapper', {
                    opacity: 0,
                    scale: 0.5,
                    rotation: -180,
                    duration: 0.8,
                    ease: "back.out(1.5)",
                    clearProps: "opacity,scale,rotation"
                }, "-=0.5")
                .from('.unit-title', {
                    opacity: 0,
                    y: 20,
                    duration: 0.6,
                    clearProps: "opacity,y"
                }, "-=0.4")
                .from('.unit-badge', {
                    opacity: 0,
                    scale: 0.8,
                    duration: 0.5,
                    clearProps: "opacity,scale"
                }, "-=0.3")
                .from('.unit-address', {
                    opacity: 0,
                    y: 15,
                    duration: 0.5,
                    clearProps: "opacity,y"
                }, "-=0.3")
                .from('.divider-line', {
                    opacity: 0,
                    scaleX: 0,
                    duration: 0.6,
                    clearProps: "opacity,scaleX"
                }, "-=0.2")
                .from('.survey-action-card', {
                    opacity: 0,
                    y: 30,
                    duration: 0.7,
                    ease: "power2.out",
                    clearProps: "opacity,y"
                }, "-=0.3")
                .from('.feature-item', {
                    opacity: 0,
                    y: 20,
                    stagger: 0.1,
                    duration: 0.5,
                    clearProps: "opacity,y"
                }, "-=0.4")
                .from('.cta-button', {
                    opacity: 0,
                    scale: 0.9,
                    duration: 0.6,
                    ease: "back.out(1.5)",
                    clearProps: "all"
                }, "-=0.3")
                .from('.info-text', {
                    opacity: 0,
                    duration: 0.4,
                    clearProps: "opacity"
                }, "-=0.2")
                .from('.back-button', {
                    opacity: 0,
                    x: -20,
                    duration: 0.5,
                    clearProps: "opacity,x"
                }, "-=0.2");

            // === CTA BUTTON PULSE ===
            gsap.to('.cta-button', {
                boxShadow: "0 0 40px rgba(79, 70, 229, 0.6)",
                duration: 2,
                repeat: -1,
                yoyo: true,
                ease: "power1.inOut"
            });

            // === FALLBACK: Ensure button is always visible after 2 seconds ===
            setTimeout(() => {
                gsap.set('.cta-button, .survey-action-card, .unit-card, .feature-item', {
                    opacity: 1,
                    visibility: 'visible',
                    clearProps: "all"
                });
            }, 2000);

            // === FEATURE ITEMS HOVER ===
            document.querySelectorAll('.feature-item').forEach((item, index) => {
                item.addEventListener('mouseenter', () => {
                    gsap.to(item, {
                        y: -5,
                        scale: 1.05,
                        boxShadow: "0 10px 30px rgba(79, 70, 229, 0.2)",
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });

                item.addEventListener('mouseleave', () => {
                    gsap.to(item, {
                        y: 0,
                        scale: 1,
                        boxShadow: "0 4px 6px rgba(0, 0, 0, 0.1)",
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
            });
        });
    </script>
    @endpush
</x-guest-layout>