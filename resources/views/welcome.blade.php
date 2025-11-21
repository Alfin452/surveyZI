<x-guest-layout>

    {{-- Style Khusus Halaman Ini --}}
    @push('styles')
    <style>
        /* Initial States (Disembunyikan dulu agar tidak kedip) */
        .hero-text-anim,
        .hero-btn-anim,
        .hero-stat-anim {
            opacity: 0;
            transform: translateY(30px);
            will-change: transform, opacity;
        }

        .hero-img-anim {
            opacity: 0;
            transform: translateX(30px);
            will-change: transform, opacity;
        }

        /* Step Cards Initial State */
        .step-card-anim {
            opacity: 0;
            transform: translateY(60px);
            will-change: transform, opacity;
        }

        .program-card-anim {
            opacity: 0;
            transform: translateY(50px);
            will-change: transform, opacity;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
        }

        /* Animasi Floating Custom */
        @keyframes float-delayed {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float-delayed {
            animation: float-delayed 5s ease-in-out infinite;
            animation-delay: 1s;
        }
    </style>
    @endpush

    {{-- 1. HERO SECTION --}}
    <section id="beranda" class="relative min-h-screen flex items-start pt-24 pb-16 overflow-hidden bg-slate-50">

        {{-- Background Abstrak Halus --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-teal-500/10 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-20">

                {{-- Kiri: Teks Content --}}
                <div class="lg:w-1/2 text-center lg:text-left space-y-8 mt-4 lg:mt-0">

                    {{-- Badge Status --}}
                    <div class="hero-text-anim inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 border border-slate-200 shadow-sm backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-bold text-slate-600 tracking-widest uppercase">Sistem Penjaminan Mutu Internal</span>
                    </div>

                    {{-- Headline --}}
                    <h1 class="hero-text-anim text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        Portal Survei <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-blue-600">Terintegrasi.</span>
                    </h1>

                    <p class="hero-text-anim text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0 font-medium">
                        Platform resmi evaluasi layanan akademik dan non-akademik UIN Antasari. Partisipasi objektif Anda adalah kunci peningkatan mutu institusi.
                    </p>

                    {{-- Tombol Aksi --}}
                    <div class="hero-btn-anim flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-2">
                        <a href="#program"
                            class="group inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold text-white bg-slate-900 rounded-2xl hover:bg-teal-700 transition-all shadow-lg hover:shadow-teal-500/20 hover:-translate-y-1">
                            Mulai Penilaian
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </a>
                        <a href="{{ route('public.programs.list') }}"
                            class="inline-flex items-center justify-center px-8 py-3.5 text-sm font-bold text-slate-700 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                            Lihat Semua Kuesioner
                        </a>
                    </div>

                    {{-- Statistik Simple --}}
                    <div class="hero-stat-anim pt-8 border-t border-slate-200 flex items-center justify-center lg:justify-start gap-8">
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ number_format($totalRespondents) }}+</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Partisipan</p>
                        </div>
                        <div class="w-px h-10 bg-slate-200"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ $totalPrograms }}</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Instrumen</p>
                        </div>
                        <div class="w-px h-10 bg-slate-200"></div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-black text-slate-800">{{ round($satisfactionPercentage) }}%</p>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Indeks Mutu</p>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Gambar Utama (DENGAN WADAH KACA) --}}
                <div class="lg:w-1/2 relative hero-img-anim mt-10 lg:mt-0 flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-[500px] z-10">

                        {{-- Glow Belakang --}}
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-gradient-to-tr from-teal-500/30 via-blue-500/30 to-purple-500/30 rounded-full blur-[80px] -z-10 opacity-60 animate-pulse"></div>

                        {{-- 1. WADAH KACA (Glass Frame - INI YANG DIKEMBALIKAN) --}}
                        <div class="relative p-3 bg-white/20 backdrop-blur-md border border-white/40 rounded-[2.5rem] shadow-2xl shadow-indigo-500/10 group">
                            {{-- Inner Container --}}
                            <div class="rounded-[2rem] overflow-hidden relative">
                                {{-- Overlay Gradient Tipis --}}
                                <div class="absolute inset-0 bg-gradient-to-tr from-indigo-900/10 to-transparent mix-blend-overlay pointer-events-none z-10"></div>

                                {{-- Gambar --}}
                                <img src="{{ asset('images/hero-survey-uin5.png') }}"
                                    alt="Survey Illustration"
                                    class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. ALUR PARTISIPASI --}}
    <section id="langkah" class="py-24 bg-white relative border-t border-slate-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
                <h2 class="text-3xl font-black text-slate-900 mb-4">Alur Partisipasi</h2>
                <p class="text-slate-500">Proses pengisian survei yang dirancang efisien.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <div class="hidden md:block absolute top-16 left-0 w-full h-0.5 bg-slate-100 -z-10"></div>

                {{-- Step 1 --}}
                <div class="step-card-anim group bg-slate-50 hover:bg-white p-8 rounded-3xl border border-slate-100 hover:border-teal-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 text-center relative">
                    <div class="w-16 h-16 mx-auto bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-teal-600 mb-6 shadow-sm group-hover:scale-110 transition-transform group-hover:bg-teal-50 group-hover:border-teal-100">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">1. Pilih Kuesioner</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Temukan survei yang relevan dengan status atau unit layanan Anda.</p>
                </div>

                {{-- Step 2 --}}
                <div class="step-card-anim group bg-slate-50 hover:bg-white p-8 rounded-3xl border border-slate-100 hover:border-blue-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 text-center relative">
                    <div class="w-16 h-16 mx-auto bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-blue-600 mb-6 shadow-sm group-hover:scale-110 transition-transform group-hover:bg-blue-50 group-hover:border-blue-100">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">2. Isi Penilaian</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Lengkapi pertanyaan dengan objektif. Identitas Anda terjaga.</p>
                </div>

                {{-- Step 3 --}}
                <div class="step-card-anim group bg-slate-50 hover:bg-white p-8 rounded-3xl border border-slate-100 hover:border-indigo-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 text-center relative">
                    <div class="w-16 h-16 mx-auto bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 shadow-sm group-hover:scale-110 transition-transform group-hover:bg-indigo-50 group-hover:border-indigo-100">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">3. Kirim Data</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Selesai. Masukan Anda langsung masuk ke sistem untuk dianalisis.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. PROGRAM UNGGULAN (Dengan Fitur Pencarian & Debounce) --}}
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
                <div>
                    <h2 class="text-3xl font-black text-slate-900 mb-2">Program Prioritas</h2>
                    <p class="text-slate-500">Daftar kuesioner utama yang sedang berjalan.</p>
                </div>

                <div class="relative w-full md:w-72 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-teal-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                        x-model.debounce.400ms="search"
                        class="block w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-transparent shadow-sm bg-white placeholder-slate-400 transition-all"
                        placeholder="Cari survei...">

                    <div x-show="isSearching" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="animate-spin h-4 w-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- SKELETON LOADING --}}
            <div x-show="isSearching"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @for($i = 0; $i < 3; $i++)
                    <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-sm h-full">
                    <div class="animate-pulse space-y-6">
                        <div class="flex justify-between">
                            <div class="h-5 bg-slate-200 rounded w-1/4"></div>
                            <div class="h-6 w-6 bg-slate-200 rounded-full"></div>
                        </div>
                        <div class="space-y-3">
                            <div class="h-6 bg-slate-200 rounded w-3/4"></div>
                            <div class="h-6 bg-slate-200 rounded w-1/2"></div>
                        </div>
                        <div class="space-y-2">
                            <div class="h-3 bg-slate-200 rounded"></div>
                            <div class="h-3 bg-slate-200 rounded"></div>
                            <div class="h-3 bg-slate-200 rounded w-5/6"></div>
                        </div>
                        <div class="h-12 bg-slate-200 rounded-xl mt-auto"></div>
                    </div>
            </div>
            @endfor
        </div>

        {{-- GRID PROGRAM --}}
        <div x-show="!isSearching"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($featuredPrograms as $program)
            <div class="program-card-anim group flex flex-col h-full bg-white border border-slate-200 rounded-3xl p-8 hover:border-teal-300 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden"
                data-title="{{ strtolower($program->title) }}"
                x-show="search === '' || $el.dataset.title.includes(search.toLowerCase())">

                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-400 via-blue-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                <div class="flex justify-between items-start mb-6">
                    <span class="px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 group-hover:bg-teal-50 group-hover:text-teal-700 transition-colors">
                        {{ $program->unit_kerja_id ? 'Unit Lokal' : 'Institusional' }}
                    </span>
                    @if($program->is_featured)
                    <span class="text-amber-500" title="Unggulan">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </span>
                    @endif
                </div>

                <h3 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-teal-700 transition-colors">
                    {{ $program->title }}
                </h3>
                <p class="text-sm text-slate-500 mb-8 line-clamp-3 leading-relaxed flex-1 border-l-2 border-slate-100 pl-3 group-hover:border-teal-200">
                    {{ $program->description }}
                </p>

                <div class="mt-auto">
                    <a href="{{ route('public.survey.directory', $program->alias) }}" class="flex items-center justify-center w-full py-3.5 rounded-xl bg-slate-900 text-white font-bold text-sm shadow-lg group-hover:bg-teal-600 group-hover:shadow-teal-500/30 transition-all transform group-hover:-translate-y-1">
                        Isi Kuesioner
                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-slate-300">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-50 rounded-full mb-4 text-slate-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada program prioritas saat ini.</p>
                <a href="{{ route('public.programs.list') }}" class="mt-4 inline-block text-teal-600 font-bold text-sm hover:underline">Lihat Arsip Program &rarr;</a>
            </div>
            @endforelse

            <div class="col-span-full py-12 text-center" x-cloak x-show="search !== '' && !isSearching && $el.parentElement.querySelectorAll('.program-card-anim[style*=\'display: none\']').length === {{ count($featuredPrograms) }}">
                <div class="inline-flex bg-slate-50 px-4 py-2 rounded-full">
                    <p class="text-slate-500 text-sm">Tidak ditemukan program dengan kata kunci "<span x-text="search" class="font-bold text-slate-800"></span>"</p>
                </div>
            </div>
        </div>

        {{-- Mobile View All --}}
        <div class="mt-12 text-center md:hidden">
            <a href="{{ route('public.programs.list') }}" class="inline-block px-6 py-3 bg-white border border-slate-200 text-teal-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-all text-sm">
                Lihat Semua Program →
            </a>
        </div>
        </div>
    </section>

    {{-- 4. FAQ SECTION --}}
    <section id="faq" class="py-24 bg-white relative overflow-hidden border-t border-slate-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 animate-on-scroll">
                <h2 class="text-3xl font-black text-slate-900 mb-4">Pertanyaan Umum</h2>
                <p class="text-slate-500">Informasi penting yang sering ditanyakan.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4" x-data="{ active: null }">
                <div class="group bg-slate-50 hover:bg-white border border-slate-200 rounded-2xl transition-all duration-300 hover:shadow-lg overflow-hidden">
                    <button @click="active = (active === 1 ? null : 1)" class="flex items-center justify-between w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Apakah identitas saya aman?</span>
                        <span class="p-2 bg-white rounded-full shadow-sm text-slate-400 group-hover:text-teal-600 transition-transform duration-300" :class="active === 1 ? 'rotate-180' : ''"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg></span>
                    </button>
                    <div x-show="active === 1" x-collapse x-cloak>
                        <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-100 pt-4"><strong class="text-teal-600">100% Aman.</strong> Sistem kami menggunakan enkripsi data. Identitas Anda hanya untuk validasi akses.</div>
                    </div>
                </div>
                <div class="group bg-slate-50 hover:bg-white border border-slate-200 rounded-2xl transition-all duration-300 hover:shadow-lg overflow-hidden">
                    <button @click="active = (active === 2 ? null : 2)" class="flex items-center justify-between w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Bagaimana jika salah pilih unit?</span>
                        <span class="p-2 bg-white rounded-full shadow-sm text-slate-400 group-hover:text-teal-600 transition-transform duration-300" :class="active === 2 ? 'rotate-180' : ''"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg></span>
                    </button>
                    <div x-show="active === 2" x-collapse x-cloak>
                        <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-100 pt-4">Jawaban yang sudah dikirim tidak dapat diedit. Hubungi LPM untuk bantuan reset data jika kesalahan fatal.</div>
                    </div>
                </div>
                <div class="group bg-slate-50 hover:bg-white border border-slate-200 rounded-2xl transition-all duration-300 hover:shadow-lg overflow-hidden">
                    <button @click="active = (active === 3 ? null : 3)" class="flex items-center justify-between w-full p-6 text-left focus:outline-none">
                        <span class="text-lg font-bold text-slate-800 group-hover:text-teal-600 transition-colors">Apakah survei ini wajib?</span>
                        <span class="p-2 bg-white rounded-full shadow-sm text-slate-400 group-hover:text-teal-600 transition-transform duration-300" :class="active === 3 ? 'rotate-180' : ''"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg></span>
                    </button>
                    <div x-show="active === 3" x-collapse x-cloak>
                        <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-slate-100 pt-4">Beberapa survei mungkin bersifat wajib sebagai syarat administrasi akademik. Cek ketentuan yang berlaku.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer (Dari Layout) --}}
    <div class="h-10"></div>

    {{-- Script Animations --}}
    @push('scripts')
    <script>
        // Fungsi Penunggu (Agar GSAP tidak error)
        function waitForGlobal(key, callback) {
            if (window[key]) {
                callback();
            } else {
                setTimeout(() => waitForGlobal(key, callback), 50);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            waitForGlobal("gsap", () => {
                waitForGlobal("ScrollTrigger", () => {
                    // Hero Anim
                    const tl = gsap.timeline();
                    tl.to(".hero-text-anim", {
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            stagger: 0.1,
                            ease: "power2.out"
                        })
                        .to(".hero-btn-anim", {
                            opacity: 1,
                            y: 0,
                            duration: 0.6,
                            ease: "back.out(1.7)"
                        }, "-=0.4")
                        .to(".hero-stat-anim", {
                            opacity: 1,
                            y: 0,
                            duration: 0.6,
                            ease: "power2.out"
                        }, "-=0.2")
                        .to(".hero-img-anim", {
                            opacity: 1,
                            x: 0,
                            duration: 1,
                            ease: "power3.out"
                        }, "-=0.8");

                    // Step Cards
                    gsap.utils.toArray(".step-card-anim").forEach((card, i) => {
                        gsap.to(card, {
                            scrollTrigger: {
                                trigger: "#langkah",
                                start: "top 85%"
                            },
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            delay: i * 0.1,
                            ease: "back.out(1.2)"
                        });
                    });

                    // Program Cards
                    gsap.utils.toArray(".program-card-anim").forEach((card, i) => {
                        gsap.to(card, {
                            scrollTrigger: {
                                trigger: "#program",
                                start: "top 85%"
                            },
                            opacity: 1,
                            y: 0,
                            duration: 0.6,
                            delay: i * 0.1,
                            ease: "power2.out"
                        });
                    });

                    // Titles
                    gsap.utils.toArray(".animate-on-scroll").forEach((el) => {
                        gsap.to(el, {
                            scrollTrigger: {
                                trigger: el,
                                start: "top 90%"
                            },
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                            ease: "power2.out"
                        });
                    });
                });
            });
        });
    </script>
    @endpush

    
</x-guest-layout>