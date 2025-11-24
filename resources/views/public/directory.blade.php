<x-guest-layout :title="'Pilih Unit - ' . $program->title">

    @push('styles')
    <style>
        .dir-anim {
            opacity: 0;
            transform: translateY(20px);
        }

        /* Animasi Floating Background Header */
        @keyframes float-slow {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-float {
            animation: float-slow 8s ease-in-out infinite;
        }

        /* Perspektif untuk efek 3D halus pada card */
        .perspective-1000 {
            perspective: 1000px;
        }
    </style>
    @endpush

    {{-- 1. HERO SECTION (Header Aesthetic Aurora) --}}
    <section class="relative pt-32 pb-16 overflow-hidden bg-slate-50 min-h-[35vh] flex items-center">
        {{-- Background Aurora Lights --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-teal-500/10 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 right-[-10%] w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            {{-- Breadcrumb --}}
            <nav class="dir-anim flex items-center justify-center gap-2 text-sm font-medium text-slate-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-teal-600 transition-colors">Beranda</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-teal-600 font-bold">Pilih Unit Layanan</span>
            </nav>

            {{-- Judul & Deskripsi --}}
            <h1 class="dir-anim text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 leading-tight mb-4 max-w-4xl mx-auto tracking-tight">
                {{ $program->title }}
            </h1>

            <p class="dir-anim text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed mb-10">
                {{ $program->description }}
            </p>

            {{-- Search Bar (Glass Effect) --}}
            <div class="dir-anim max-w-lg mx-auto relative z-20" x-data="{ search: '' }">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-teal-400 to-blue-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                    <div class="relative bg-white rounded-xl shadow-xl flex items-center p-2 border border-slate-100">
                        <div class="pl-4 pr-3 text-slate-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        {{-- Input dispatch event ke section bawah --}}
                        <input type="text"
                            x-model.debounce.500ms="search"
                            x-init="$watch('search', value => $dispatch('filter-units', value))"
                            class="w-full bg-transparent border-none focus:ring-0 text-slate-800 placeholder-slate-400 text-base font-medium h-12"
                            placeholder="Cari nama fakultas atau unit...">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. DIRECTORY LIST (Design Aesthetic & Clear Info) --}}
    <section class="relative pb-24 z-20 min-h-[400px]"
        x-data="{ 
            search: '', 
            isSearching: false,
            init() {
                window.addEventListener('filter-units', event => {
                    this.isSearching = true;
                    this.search = event.detail.toLowerCase();
                    setTimeout(() => {
                        this.isSearching = false;
                        // Re-trigger GSAP or animations here if needed
                    }, 300); 
                });
            }
         }">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Skeleton Loading --}}
            <div x-show="isSearching" class="flex flex-wrap justify-center gap-6" style="display: none;">
                @for($i = 0; $i < 3; $i++)
                    <div class="w-full sm:w-[380px] bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm h-[380px] animate-pulse flex flex-col justify-between">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-slate-200 rounded-2xl"></div>
                        <div class="h-5 bg-slate-200 rounded w-1/3"></div>
                    </div>
                    <div class="space-y-3 mb-auto">
                        <div class="h-6 bg-slate-200 rounded w-3/4"></div>
                        <div class="h-6 bg-slate-200 rounded w-1/2"></div>
                    </div>
                    <div class="h-24 bg-slate-200 rounded-2xl mt-6"></div>
            </div>
            @endfor
        </div>

        {{-- UNIT CARDS (Real Data) --}}
        <div x-show="!isSearching" class="flex flex-wrap justify-center gap-8 perspective-1000">
            @forelse($unitKerjas as $index => $unit)
            <div class="gsap-card w-full sm:w-[380px] group"
                data-name="{{ strtolower($unit->unit_kerja_name . ' ' . ($unit->uk_short_name ?? '')) }}"
                x-show="search === '' || $el.dataset.name.includes(search)">

                <a href="{{ route('public.unit.landing', ['program' => $program, 'unitKerja' => $unit]) }}"
                    class="block bg-white rounded-[2rem] p-1 border border-slate-200 shadow-sm hover:shadow-2xl hover:shadow-teal-500/10 transition-all duration-500 h-full transform hover:-translate-y-2">

                    {{-- Card Content Wrapper --}}
                    <div class="bg-white rounded-[1.8rem] p-6 h-full flex flex-col relative overflow-hidden group-hover:bg-teal-50/10 transition-colors duration-500">

                        {{-- Decoration Blur (Backlight) --}}
                        <div class="absolute -top-12 -right-12 w-48 h-48 bg-gradient-to-br from-teal-100/40 to-blue-100/40 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        {{-- 1. Header: Icon Gedung & Badge --}}
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            @php
                            $colors = [
                            'from-teal-400 to-emerald-500',
                            'from-blue-400 to-indigo-500',
                            'from-violet-400 to-purple-500',
                            'from-amber-400 to-orange-500'
                            ];
                            $colorClass = $colors[$index % count($colors)];
                            @endphp
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $colorClass }} p-0.5 shadow-lg shadow-slate-200 group-hover:scale-105 transition-transform duration-500">
                                <div class="w-full h-full bg-white/10 backdrop-blur-sm rounded-[14px] flex items-center justify-center border border-white/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>

                            @if($unit->uk_short_name)
                            <span class="px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200 text-slate-600 text-[11px] font-bold uppercase tracking-wider shadow-sm group-hover:bg-white group-hover:border-teal-200 group-hover:text-teal-700 transition-colors">
                                {{ $unit->uk_short_name }}
                            </span>
                            @endif
                        </div>

                        {{-- 2. Body: Nama Unit (Sangat Jelas & Tebal) --}}
                        <div class="flex-1 relative z-10 flex flex-col">
                            <h3 class="text-2xl font-black text-slate-800 leading-tight mb-4 group-hover:text-teal-700 transition-colors line-clamp-2 min-h-[4rem]">
                                {{ $unit->unit_kerja_name }}
                            </h3>

                            {{-- 3. Info Box: Lokasi & Jam (Background Terpisah agar Jelas) --}}
                            <div class="mt-auto bg-slate-50 rounded-2xl p-4 border border-slate-100 group-hover:bg-white group-hover:border-teal-100 transition-all duration-300 space-y-3">

                                {{-- Lokasi --}}
                                @if($unit->address)
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-teal-500 shrink-0 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Lokasi</p>
                                        <p class="text-sm font-bold text-slate-700 leading-snug line-clamp-2">
                                            {{ $unit->address }}
                                        </p>
                                    </div>
                                </div>
                                @endif

                                {{-- Jam Layanan --}}
                                @if($unit->start_time)
                                <div class="flex items-start gap-3 border-t border-slate-200/50 pt-3">
                                    <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center text-blue-500 shrink-0 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Jam Layanan</p>
                                        <p class="text-sm font-bold text-slate-700 leading-snug">
                                            {{ \Carbon\Carbon::parse($unit->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($unit->end_time)->format('H:i') }} WITA
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- 4. Footer: Action Button (Slide Up Effect) --}}
                        <div class="mt-5 relative z-10 overflow-hidden h-[50px] flex items-end">
                            {{-- Tombol Hidden by Default (Offset) --}}
                            <div class="w-full translate-y-[120%] opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out">
                                <div class="flex items-center justify-center w-full py-3 rounded-xl bg-slate-900 text-white font-bold text-sm shadow-lg cursor-pointer group-active:scale-95 transition-transform">
                                    Mulai Survei
                                    <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Text Default (Fade Out) --}}
                            <div class="absolute inset-x-0 bottom-3 text-center transition-all duration-300 group-hover:opacity-0 group-hover:-translate-y-2">
                                <span class="text-xs font-bold text-slate-300 uppercase tracking-[0.2em]">Pilih Unit</span>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            @empty
            <div class="w-full text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4 text-slate-400 animate-bounce-slow">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada unit kerja yang terdaftar.</p>
            </div>
            @endforelse

            {{-- Empty State Search --}}
            <div class="w-full text-center py-12 hidden"
                x-show="search !== '' && !isSearching && $el.parentElement.querySelectorAll('div[data-name]:not([style*=\'display: none\'])').length === 0">
                <p class="text-slate-400">Unit tidak ditemukan.</p>
                <button @click="search = ''; $dispatch('filter-units', '')" class="mt-2 text-teal-600 font-bold text-sm hover:underline">Reset Pencarian</button>
            </div>
        </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            // Animasi Entrance menggunakan GSAP
            if (typeof gsap !== 'undefined') {
                gsap.to(".dir-anim", {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.1,
                    ease: "power2.out"
                });

                gsap.from(".gsap-card", {
                    opacity: 0,
                    y: 50,
                    duration: 0.8,
                    stagger: 0.05,
                    ease: "back.out(1.2)",
                    delay: 0.2
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>