<x-guest-layout :title="'Pilih Unit - ' . $program->title">

    <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 pt-24 sm:pt-28 md:pt-32 pb-16 sm:pb-20 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-shape absolute top-20 left-10 w-32 h-32 sm:w-64 sm:h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute top-40 right-20 w-48 h-48 sm:w-96 sm:h-96 bg-yellow-300/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute bottom-20 left-1/4 w-40 h-40 sm:w-80 sm:h-80 bg-blue-300/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 50px 50px;"></div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="breadcrumb flex items-center justify-center space-x-2 text-sm mb-6">
                <a href="{{ route('home') }}" class="flex items-center text-white/80 hover:text-white transition-all duration-300 hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white font-semibold">Pilih Unit Layanan</span>
            </nav>

            <div class="text-center max-w-4xl mx-auto">
                <div class="hero-badge inline-block mb-4">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-pink-400 rounded-full blur-lg opacity-50 group-hover:opacity-75 transition-opacity"></div>
                        <span class="relative bg-white/20 text-white px-5 py-2 rounded-full text-sm font-bold backdrop-blur-md flex items-center shadow-2xl border border-white/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            {{ $program->title }}
                        </span>
                    </div>
                </div>

                <h1 class="hero-title text-3xl sm:text-4xl md:text-5xl font-black text-white mb-4 leading-tight tracking-tight" style="text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                    Pilih Unit Layanan
                </h1>

                <div class="hero-description space-y-3 mb-6">
                    <p class="text-base sm:text-lg text-white/95 max-w-3xl mx-auto leading-relaxed font-medium px-4">
                        {{ $program->description }}
                    </p>
                    <p class="text-sm sm:text-base text-white/80 max-w-2xl mx-auto px-4">
                        Pilih salah satu unit layanan untuk memberikan penilaian Anda
                    </p>
                </div>

                @if($unitKerjas->isNotEmpty())
                <div class="hero-stats inline-flex items-center gap-3 bg-white/10 backdrop-blur-xl rounded-2xl px-5 py-3 border border-white/20 shadow-2xl">
                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-2xl font-black text-white">
                            <span class="unit-count">{{ $unitKerjas->count() }}</span>
                        </div>
                        <div class="text-xs text-white/80 font-semibold">Unit Tersedia</div>
                    </div>
                </div>
                @endif

                <div class="arrow-down mt-6 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0,64L48,74.7C96,85,192,107,288,106.7C384,107,480,85,576,80C672,75,768,85,864,90.7C960,96,1056,96,1152,90.7C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="#F8FAFC" fill-opacity="0.3"></path>
                <path d="M0,80L48,85.3C96,91,192,101,288,101.3C384,101,480,91,576,85.3C672,80,768,80,864,85.3C960,91,1056,101,1152,96C1248,91,1344,75,1392,66.7L1440,58L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="#F8FAFC" fill-opacity="0.6"></path>
                <path d="M0,96L48,101.3C96,107,192,117,288,117.3C384,117,480,107,576,101.3C672,96,768,96,864,101.3C960,107,1056,117,1152,112C1248,107,1344,85,1392,74.7L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="#F8FAFC"></path>
            </svg>
        </div>
    </section>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 -mt-8 relative z-10">
        @if($unitKerjas->isNotEmpty())

        <div class="search-section max-w-xl mx-auto mb-8">
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl blur-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                <div class="relative bg-white rounded-xl shadow-xl border-2 border-gray-100 overflow-hidden">
                    <input type="text" id="searchUnit" placeholder="Cari unit layanan..."
                        class="w-full px-5 py-3 pl-12 text-base font-medium text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-indigo-200 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-center text-xs text-gray-500 mt-2">
                Ketik nama unit untuk mencari dengan cepat
            </p>
        </div>

        <div class="unit-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
            @foreach ($unitKerjas as $index => $unitKerja)
            <a href="{{ route('public.unit.landing', ['program' => $program, 'unitKerja' => $unitKerja]) }}"
                class="program-card group block rounded-3xl shadow-lg hover:shadow-2xl 
                      transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden
                      bg-white/50 backdrop-blur-lg border border-white/30"
                data-unit-name="{{ strtolower($unitKerja->unit_kerja_name) . ' ' . strtolower($unitKerja->uk_short_name ?? '') }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 absolute -bottom-8 -right-8 text-gray-900 opacity-[0.03] group-hover:opacity-10 transition-all duration-300 transform group-hover:rotate-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>

                <div class="relative z-10 p-6 flex flex-col h-full space-y-4">
                    @if($unitKerja->uk_short_name)
                    <div>
                        <span class="inline-block bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full border border-indigo-200/50">
                            {{ $unitKerja->uk_short_name }}
                        </span>
                    </div>
                    @endif

                    <div class="flex-grow">
                        <h3 class="text-xl font-black text-gray-900 group-hover:text-indigo-600 transition-colors duration-300" style="min-height: 4.5rem;">
                            {{ $unitKerja->unit_kerja_name }}
                        </h3>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <div class="flex items-center text-indigo-600 font-bold text-sm group-hover:text-indigo-700">
                            <span class="mr-2">Mulai Survei</span>
                            <div class="h-8 w-8 flex items-center justify-center rounded-full bg-indigo-100 group-hover:bg-gradient-to-r group-hover:from-indigo-600 group-hover:to-purple-600 group-hover:text-white text-indigo-600 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div id="noResults" class="hidden text-center py-12 mt-8">
            <div class="max-w-md mx-auto">
                <div class="bg-gradient-to-br from-gray-100 to-slate-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Unit tidak ditemukan</h3>
                <p class="text-gray-600 text-sm">Coba gunakan kata kunci lain</p>
            </div>
        </div>

        @else
        <div class="empty-state max-w-lg mx-auto text-center py-16 px-8">
            <div class="relative mb-6">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-200 to-purple-200 rounded-full blur-3xl opacity-30"></div>
                <div class="relative bg-gradient-to-br from-gray-100 to-slate-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <h3 class="text-2xl font-black text-gray-900 mb-3">Belum Ada Unit Layanan</h3>
            <p class="text-base text-gray-600 mb-6 leading-relaxed">
                Saat ini belum ada unit layanan yang mengaktifkan survei untuk program ini.
            </p>

            <a href="{{ route('home') }}" class="inline-flex items-center bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl font-bold hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
        @endif
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap === 'undefined') {
                return;
            }

            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            if (prefersReducedMotion) {
                gsap.set('.breadcrumb, .hero-badge, .hero-title, .hero-description, .hero-stats, .arrow-down, .search-section', {
                    opacity: 1,
                    clearProps: 'all'
                });
                return;
            }

            gsap.to('.floating-shape', {
                y: 20,
                x: 10,
                duration: 6,
                stagger: 1,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut"
            });

            const heroTL = gsap.timeline({
                defaults: {
                    ease: "power2.out",
                    duration: 0.5
                }
            });

            heroTL
                .to('.breadcrumb', {
                    opacity: 1,
                    y: 0
                })
                .to('.hero-badge', {
                    opacity: 1,
                    scale: 1
                }, "-=0.3")
                .to('.hero-title', {
                    opacity: 1,
                    y: 0
                }, "-=0.3")
                .to('.hero-description', {
                    opacity: 1
                }, "-=0.3")
                .to('.hero-stats', {
                    opacity: 1,
                    scale: 1
                }, "-=0.3")
                .to('.arrow-down', {
                    opacity: 1
                }, "-=0.3");

            gsap.from('.search-section', {
                scrollTrigger: {
                    trigger: '.search-section',
                    start: 'top 85%',
                    once: true
                },
                opacity: 0,
                y: 30,
                duration: 0.6,
                ease: "power2.out"
            });


            const unitCards = document.querySelectorAll('.program-card');
            const hasUnits = unitCards.length > 0;

            if (hasUnits) {
                const searchInput = document.getElementById('searchUnit');
                const noResults = document.getElementById('noResults');

                if (searchInput) {
                    searchInput.addEventListener('input', function(e) {
                        const searchTerm = e.target.value.toLowerCase().trim();
                        let visibleCount = 0;

                        unitCards.forEach(card => {
                            const unitName = card.dataset.unitName;
                            const isMatch = unitName.includes(searchTerm);

                            card.style.display = isMatch ? 'block' : 'none';
                            if (isMatch) visibleCount++;
                        });

                        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
                    });
                }

                const counterElement = document.querySelector('.unit-count');
                if (counterElement) {
                    const target = parseInt(counterElement.textContent);
                    gsap.from(counterElement, {
                        textContent: 0,
                        duration: 1.5,
                        ease: "power2.out",
                        snap: {
                            textContent: 1
                        },
                        delay: 0.6
                    });
                }

            } else {
                gsap.from('.empty-state', {
                    opacity: 0,
                    scale: 0.9,
                    y: 20,
                    duration: 0.8,
                    ease: "power2.out"
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>