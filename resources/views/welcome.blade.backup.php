<x-guest-layout>
    {{-- HERO SECTION - MODERN DESIGN --}}
    <section id="beranda" class="section-nav relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-slate-900 via-cyan-900 to-teal-900 pt-16">
        {{-- Animated Background Elements --}}
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        {{-- Floating Particles Effect --}}
        <div class="absolute inset-0 overflow-hidden opacity-30">
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 5%; top: 10%; animation-delay: 0s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 15%; top: 25%; animation-delay: 0.5s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 25%; top: 40%; animation-delay: 1s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 35%; top: 15%; animation-delay: 1.5s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 45%; top: 60%; animation-delay: 2s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 55%; top: 30%; animation-delay: 2.5s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 65%; top: 70%; animation-delay: 3s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 75%; top: 20%; animation-delay: 3.5s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 85%; top: 50%; animation-delay: 4s;"></div>
            <div class="absolute w-2 h-2 bg-cyan-400 rounded-full animate-float" style="left: 95%; top: 35%; animation-delay: 4.5s;"></div>
            <div class="absolute w-2 h-2 bg-teal-400 rounded-full animate-float" style="left: 10%; top: 80%; animation-delay: 5s;"></div>
            <div class="absolute w-2 h-2 bg-teal-400 rounded-full animate-float" style="left: 20%; top: 55%; animation-delay: 5.5s;"></div>
            <div class="absolute w-2 h-2 bg-teal-400 rounded-full animate-float" style="left: 30%; top: 75%; animation-delay: 6s;"></div>
            <div class="absolute w-2 h-2 bg-teal-400 rounded-full animate-float" style="left: 40%; top: 45%; animation-delay: 6.5s;"></div>
            <div class="absolute w-2 h-2 bg-teal-400 rounded-full animate-float" style="left: 50%; top: 85%; animation-delay: 7s;"></div>
            <div class="absolute w-2 h-2 bg-blue-400 rounded-full animate-float" style="left: 60%; top: 10%; animation-delay: 7.5s;"></div>
            <div class="absolute w-2 h-2 bg-blue-400 rounded-full animate-float" style="left: 70%; top: 65%; animation-delay: 8s;"></div>
            <div class="absolute w-2 h-2 bg-blue-400 rounded-full animate-float" style="left: 80%; top: 90%; animation-delay: 8.5s;"></div>
            <div class="absolute w-2 h-2 bg-blue-400 rounded-full animate-float" style="left: 90%; top: 5%; animation-delay: 9s;"></div>
            <div class="absolute w-2 h-2 bg-blue-400 rounded-full animate-float" style="left: 12%; top: 48%; animation-delay: 9.5s;"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-12">
            <div class="max-w-6xl mx-auto">
                {{-- Main Heading --}}
                <div class="text-center mb-12 hero-title-anim">
                    <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white mb-6 leading-tight">
                        Suara Anda,<br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-teal-400 to-blue-400">
                            Masa Depan
                        </span>
                        <span class="text-white">Kita</span>
                    </h1>
                    <p class="text-xl sm:text-2xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
                        Berikan penilaian Anda untuk meningkatkan kualitas layanan di UIN Antasari Banjarmasin
                    </p>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16 hero-button-anim">
                    <a href="#unit-layanan" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-slate-900 bg-gradient-to-r from-cyan-400 to-teal-400 rounded-2xl overflow-hidden transition-all hover:scale-105 hover:shadow-2xl hover:shadow-cyan-500/50">
                        <span class="relative z-10 flex items-center">
                            Mulai Survei
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </a>
                    <a href="{{ route('public.tentang') }}" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white border-2 border-cyan-400/50 rounded-2xl hover:bg-cyan-400/10 transition-all">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                {{-- Stats Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                    <div class="stat-card card-anim group relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-br from-cyan-400 to-teal-400 mb-2 stat-number" data-target="{{ $totalRespondents }}">0</div>
                            <div class="text-sm font-semibold text-slate-300">Total Responden</div>
                        </div>
                    </div>
                    <div class="stat-card card-anim group relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-br from-teal-400 to-blue-400 mb-2 stat-number" data-target="{{ $totalPrograms }}">0</div>
                            <div class="text-sm font-semibold text-slate-300">Program Aktif</div>
                        </div>
                    </div>
                    <div class="stat-card card-anim group relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-all hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-br from-blue-400 to-cyan-400 mb-2 stat-number" data-target="{{ round($satisfactionPercentage) }}">0</div>
                            <div class="text-sm font-semibold text-slate-300">Tingkat Kepuasan</div>
                        </div>
                    </div>
                </div>

                {{-- Scroll Indicator --}}
                <div class="text-center mt-16 animate-bounce">
                    <svg class="w-8 h-8 mx-auto text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES SECTION --}}
    <section id="tentang" class="section-nav py-24 bg-gradient-to-b from-slate-50 to-white relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute inset-0 opacity-40">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-cyan-200 to-teal-200 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-gradient-to-br from-teal-200 to-blue-200 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Section Header --}}
            <div class="text-center mb-20">
                <span class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-cyan-500 to-teal-500 text-white rounded-full text-sm font-bold mb-6 shadow-lg">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                    Cara Kerja
                </span>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-900 mb-6 leading-tight">
                    Hanya <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 via-teal-600 to-blue-600">3 Langkah</span><br />Mudah
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Proses yang dirancang simpel dan efisien untuk kenyamanan Anda
                </p>
            </div>

            {{-- Features Timeline --}}
            <div class="max-w-5xl mx-auto">
                {{-- Step 1 --}}
                <div class="feature-card-anim flex flex-col md:flex-row items-center gap-8 mb-16 group">
                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-3xl blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <div class="relative w-32 h-32 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-3xl flex items-center justify-center shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="absolute -top-3 -right-3 w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg">
                            1
                        </div>
                    </div>
                    <div class="flex-1 bg-white rounded-3xl p-8 shadow-xl group-hover:shadow-2xl transition-all duration-300 border-2 border-slate-100 group-hover:border-cyan-200">
                        <h3 class="text-3xl font-black text-slate-900 mb-3 group-hover:text-cyan-600 transition-colors">
                            Pilih Program Survei
                        </h3>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            Pilih program survei yang sesuai dengan kebutuhan Anda dari daftar program yang tersedia
                        </p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="feature-card-anim flex flex-col md:flex-row-reverse items-center gap-8 mb-16 group">
                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 bg-gradient-to-br from-teal-400 to-teal-600 rounded-3xl blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <div class="relative w-32 h-32 bg-gradient-to-br from-teal-500 to-teal-600 rounded-3xl flex items-center justify-center shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="absolute -top-3 -right-3 w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg">
                            2
                        </div>
                    </div>
                    <div class="flex-1 bg-white rounded-3xl p-8 shadow-xl group-hover:shadow-2xl transition-all duration-300 border-2 border-slate-100 group-hover:border-teal-200">
                        <h3 class="text-3xl font-black text-slate-900 mb-3 group-hover:text-teal-600 transition-colors md:text-right">
                            Pilih Unit Layanan
                        </h3>
                        <p class="text-lg text-slate-600 leading-relaxed md:text-right">
                            Tentukan unit kerja atau layanan yang ingin Anda nilai berdasarkan pengalaman Anda
                        </p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="feature-card-anim flex flex-col md:flex-row items-center gap-8 group">
                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-3xl blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <div class="relative w-32 h-32 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center shadow-2xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="absolute -top-3 -right-3 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-black text-xl shadow-lg">
                            3
                        </div>
                    </div>
                    <div class="flex-1 bg-white rounded-3xl p-8 shadow-xl group-hover:shadow-2xl transition-all duration-300 border-2 border-slate-100 group-hover:border-blue-200">
                        <h3 class="text-3xl font-black text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                            Isi & Kirim Survei
                        </h3>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            Jawab pertanyaan dengan jujur sesuai pengalaman Anda untuk membantu kami meningkatkan layanan
                        </p>
                    </div>
                </div>
            </div>

            {{-- Bottom CTA --}}
            <div class="text-center mt-20">
                <a href="#unit-layanan" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-cyan-600 via-teal-600 to-blue-600 text-white text-lg font-bold rounded-2xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    Mulai Survei Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- PROGRAMS SECTION --}}
    <section id="unit-layanan" class="section-nav py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @if($featuredProgram)
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-gradient-to-r from-cyan-100 to-teal-100 text-teal-700 rounded-full text-sm font-bold mb-4">
                    Unit Layanan
                </span>
                <h2 class="text-4xl sm:text-5xl font-black text-slate-900 mb-4">
                    {{ $featuredProgram->title }}
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Pilih unit layanan untuk memulai penilaian Anda
                </p>
            </div>

            {{-- Programs Grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @forelse ($unitKerjas as $unitKerja)
                <a href="{{ route('public.unit.landing', ['program' => $featuredProgram, 'unitKerja' => $unitKerja]) }}"
                    class="program-card group relative bg-gradient-to-br from-slate-50 to-white border-2 border-slate-200 rounded-3xl p-6 hover:border-cyan-400 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">

                    {{-- Decorative Element --}}
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-cyan-500/10 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        @if($unitKerja->uk_short_name)
                        <span class="inline-block px-3 py-1 bg-gradient-to-r from-cyan-100 to-teal-100 text-teal-700 text-xs font-bold rounded-full mb-4">
                            {{ $unitKerja->uk_short_name }}
                        </span>
                        @endif

                        <h3 class="text-xl font-black text-slate-900 mb-4 group-hover:text-cyan-600 transition-colors min-h-[3.5rem]">
                            {{ $unitKerja->unit_kerja_name }}
                        </h3>

                        <div class="flex items-center text-cyan-600 font-bold text-sm group-hover:text-cyan-700">
                            <span class="mr-2">Mulai Survei</span>
                            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-cyan-100 group-hover:bg-gradient-to-r group-hover:from-cyan-500 group-hover:to-teal-500 group-hover:text-white transition-all">
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-16">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Unit Layanan Belum Tersedia</h3>
                    <p class="text-slate-600 mb-6">Admin belum mengaktifkan survei untuk program ini</p>
                    <a href="{{ route('public.programs.list') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-bold rounded-xl hover:shadow-lg transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Lihat Program Lain
                    </a>
                </div>
                @endforelse
            </div>
            @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Belum Ada Program Unggulan</h3>
                <p class="text-slate-600 mb-6">Silakan kunjungi halaman Program Survei</p>
                <a href="{{ route('public.programs.list') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-teal-600 text-white font-bold rounded-xl hover:shadow-lg transition-all">
                    Lihat Semua Program
                </a>
            </div>
            @endif
        </div>
    </section>

    @push('scripts')
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
    @endpush
</x-guest-layout>