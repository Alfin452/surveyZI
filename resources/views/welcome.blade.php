<x-guest-layout>
    <section id="beranda" class="section-nav relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 pt-24 sm:pt-28 md:pt-32 pb-20 sm:pb-28 md:pb-36 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-shape absolute top-20 left-10 w-32 h-32 sm:w-64 sm:h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute top-40 right-20 w-48 h-48 sm:w-96 sm:h-96 bg-yellow-300/10 rounded-full blur-3xl"></div>
            <div class="floating-shape absolute bottom-20 left-1/4 w-40 h-40 sm:w-80 sm:h-80 bg-blue-300/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 50px 50px;"></div>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="text-center lg:text-left space-y-4 sm:space-y-6">
                    <div class="hero-badge inline-block fade-down-anim">
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-pink-400 rounded-full blur-lg opacity-50 group-hover:opacity-75 transition-opacity"></div>
                            <span class="relative bg-white/20 text-white px-6 py-2.5 rounded-full text-sm font-bold backdrop-blur-md flex items-center shadow-2xl border border-white/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                Survei Kepuasan Layanan
                            </span>
                        </div>
                    </div>

                    <h1 class="hero-title-anim text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight tracking-tight" style="text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                        Suara Anda,<br />
                        <span class="text-yellow-300">Masa Depan</span> Kita
                    </h1>

                    <p class="hero-subtitle-anim text-lg sm:text-xl text-white/95 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Berikan penilaian untuk meningkatkan kualitas layanan dan fasilitas di UIN Antasari Banjarmasin
                    </p>

                    <div class="hero-button-anim flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                        <a href="#unit-layanan" class="nav-link-anim inline-flex items-center justify-center bg-white text-indigo-600 px-8 py-4 rounded-2xl text-base font-black hover:bg-yellow-300 hover:text-indigo-700 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 hover:scale-105 group">
                            Mulai Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-6 w-6 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('public.tentang') }}" class="inline-flex items-center justify-center bg-transparent text-white border-2 border-white px-8 py-4 rounded-2xl text-base font-bold hover:bg-white hover:text-indigo-600 transition-all duration-300 shadow-lg">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <div class="hero-stats grid grid-cols-3 gap-3 sm:gap-4 pt-6 sm:pt-8">
                        <div class="stat-card card-anim bg-white/10 backdrop-blur-xl rounded-2xl px-4 py-5 border border-white/20 text-center transform hover:scale-105 transition-all">
                            <div class="stat-number text-3xl sm:text-4xl font-black text-yellow-300" data-target="{{ $totalRespondents }}">0</div>
                            <div class="text-xs sm:text-sm text-white/90 font-semibold mt-1">Responden</div>
                        </div>
                        <div class="stat-card card-anim bg-white/10 backdrop-blur-xl rounded-2xl px-4 py-5 border border-white/20 text-center transform hover:scale-105 transition-all">
                            <div class="stat-number text-3xl sm:text-4xl font-black text-yellow-300" data-target="{{ $totalPrograms }}">0</div>
                            <div class="text-xs sm:text-sm text-white/90 font-semibold mt-1">Program</div>
                        </div>
                        <div class="stat-card card-anim bg-white/10 backdrop-blur-xl rounded-2xl px-4 py-5 border border-white/20 text-center transform hover:scale-105 transition-all">
                            <div class="stat-number text-3xl sm:text-4xl font-black text-yellow-300" data-target="{{ round($satisfactionPercentage) }}">0</div>
                            <div class="text-xs sm:text-sm text-white/90 font-semibold mt-1">% Puas</div>
                        </div>
                    </div>
                </div>
                <div class="hero-image-anim hidden lg:flex justify-center items-center">
                    <div class="relative w-full max-w-lg">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-pink-400 rounded-3xl blur-3xl opacity-30 animate-pulse"></div>
                        <img src="{{ asset('images/hero-survey-uin.png') }}" alt="Ilustrasi survei" class="relative rounded-3xl shadow-2xl border-4 border-white/30 backdrop-blur w-full h-auto transform hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>

            <div class="arrow-down text-center mt-12 sm:mt-16 animate-bounce fade-down-anim">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M0,96L48,112C96,128,192,160,288,165.3C384,171,480,149,576,128C672,107,768,85,864,90.7C960,96,1056,128,1152,138.7C1248,149,1344,139,1392,133.3L1440,128L1440,200L1392,200C1344,200,1248,200,1152,200C1056,200,960,200,864,200C768,200,672,200,576,200C480,200,384,200,288,200C192,200,96,200,48,200L0,200Z" fill="#F8FAFC" fill-opacity="0.3"></path>
                <path d="M0,128L48,138.7C96,149,192,171,288,165.3C384,160,480,128,576,117.3C672,107,768,117,864,128C960,139,1056,149,1152,144C1248,139,1344,117,1392,106.7L1440,96L1440,200L1392,200C1344,200,1248,200,1152,200C1056,200,960,200,864,200C768,200,672,200,576,200C480,200,384,200,288,200C192,200,96,200,48,200L0,200Z" fill="#F8FAFC" fill-opacity="0.6"></path>
                <path d="M0,160L48,154.7C96,149,192,139,288,138.7C384,139,480,149,576,160C672,171,768,181,864,176C960,171,1056,149,1152,138.7C1248,128,1344,128,1392,128L1440,128L1440,200L1392,200C1344,200,1248,200,1152,200C1056,200,960,200,864,200C768,200,672,200,576,200C480,200,384,200,288,200C192,200,96,200,48,200L0,200Z" fill="#F8FAFC"></path>
            </svg>
        </div>
    </section>

    <section id="tentang" class="section-nav py-16 sm:py-20 md:py-24 bg-slate-50 relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-100 rounded-full blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-100 rounded-full blur-3xl opacity-20"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 sm:mb-16 md:mb-20">
                <div class="inline-block mb-4">
                    <span class="fade-down-anim bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 px-6 py-2 rounded-full text-sm font-bold border-2 border-indigo-200">
                        Cara Kerja
                    </span>
                </div>
                <h2 class="section-title-anim text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4">
                    Mudah dalam <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">3 Langkah</span>
                </h2>
                <p class="fade-down-anim text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">Proses yang simpel, cepat, dan efisien untuk memberikan penilaian Anda</p>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="block md:hidden space-y-6">
                    @foreach([
                    ['number' => 1, 'title' => 'Pilih Program', 'desc' => 'Pilih salah satu program survei yang tersedia sesuai kebutuhan Anda', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['number' => 2, 'title' => 'Pilih Unit Layanan', 'desc' => 'Tentukan unit kerja atau layanan yang ingin Anda nilai', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ['number' => 3, 'title' => 'Isi & Kirim', 'desc' => 'Jawab pertanyaan dengan jujur sesuai pengalaman Anda', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z']
                    ] as $step)
                    <div class="feature-step feature-card-anim bg-white rounded-3xl p-6 shadow-xl border-2 border-gray-100 hover:border-indigo-300 transition-all transform hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-600 to-purple-600 text-white w-14 h-14 rounded-2xl flex items-center justify-center text-2xl font-black shadow-lg">
                                {{ $step['number'] }}
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-black text-gray-900 mb-2">{{ $step['title'] }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        <div class="mt-5 bg-gradient-to-br from-indigo-50 to-purple-50 p-5 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="hidden md:block relative">
                    <div class="timeline-line absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-indigo-200 via-purple-200 to-pink-200"></div>

                    @foreach([
                    ['number' => 1, 'title' => 'Pilih Program', 'desc' => 'Pilih salah satu program survei yang tersedia sesuai kebutuhan Anda', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'side' => 'right'],
                    ['number' => 2, 'title' => 'Pilih Unit Layanan', 'desc' => 'Tentukan unit kerja atau layanan yang ingin Anda nilai', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'side' => 'left'],
                    ['number' => 3, 'title' => 'Isi & Kirim', 'desc' => 'Jawab pertanyaan dengan jujur sesuai pengalaman Anda', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z', 'side' => 'right']
                    ] as $index => $step)
                    <div class="feature-step feature-card-anim relative {{ $index < 2 ? 'mb-20' : '' }}">
                        <div class="flex items-center {{ $step['side'] == 'left' ? 'flex-row-reverse' : '' }}">
                            <div class="w-1/2 {{ $step['side'] == 'right' ? 'pr-16 text-right' : 'pl-16 text-left' }}">
                                <h3 class="text-2xl lg:text-3xl font-black text-gray-900 mb-3">{{ $step['title'] }}</h3>
                                <p class="text-base lg:text-lg text-gray-600 leading-relaxed">{{ $step['desc'] }}</p>
                            </div>

                            <div class="absolute left-1/2 transform -translate-x-1/2 z-10">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-3xl blur-xl opacity-50"></div>
                                    <div class="relative bg-gradient-to-br from-indigo-600 to-purple-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center text-3xl font-black shadow-2xl border-4 border-white">
                                        {{ $step['number'] }}
                                    </div>
                                </div>
                            </div>

                            <div class="w-1/2 {{ $step['side'] == 'right' ? 'pl-16' : 'pr-16' }}">
                                <div class="bg-white p-8 rounded-3xl shadow-2xl border-2 border-gray-100 transform hover:scale-105 transition-all">
                                    <div class="bg-gradient-to-br from-indigo-100 to-purple-100 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="unit-layanan" class="section-nav py-16 sm:py-20 md:py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: linear-gradient(#4f46e5 1px, transparent 1px), linear-gradient(90deg, #4f46e5 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            @if($featuredProgram)
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-block mb-4">
                    <span class="fade-down-anim bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 px-6 py-2 rounded-full text-sm font-bold border-2 border-indigo-200">
                        Unit Layanan
                    </span>
                </div>
                <h2 class="section-title-anim text-3xl sm:text-4xl md:text-5xl font-black text-gray-900 mb-4">
                    <span class="text-black bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">{{ $featuredProgram->title }}</span>
                </h2>
                <p class="fade-down-anim text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">Pilih Unit Layanan untuk memulai penilaian Anda</p>
            </div>

            <div class="programs-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 md:gap-8 max-w-7xl mx-auto">
                @forelse ($unitKerjas as $unitKerja)
                <a href="{{ route('public.unit.landing', ['program' => $featuredProgram, 'unitKerja' => $unitKerja]) }}"
                    class="program-card group block rounded-3xl shadow-lg hover:shadow-2xl 
                          transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden
                          bg-white/50 backdrop-blur-lg border border-white/30">

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
                @empty
                <div class="empty-state scale-anim sm:col-span-2 lg:col-span-3 text-center py-20 px-8">
                    <div class="max-w-lg mx-auto">
                        <div class="relative mb-8">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-200 to-purple-200 rounded-full blur-3xl opacity-30"></div>
                            <div class="relative bg-gradient-to-br from-gray-100 to-slate-100 rounded-full w-32 h-32 flex items-center justify-center mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-black text-gray-900 mb-4">Unit Layanan Belum Siap</h3>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Admin unit kerja untuk program ini belum mengaktifkan survei pelaksanaan.
                        </p>
                        <a href="{{ route('public.programs.list') }}" class="inline-flex items-center bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white px-8 py-4 rounded-2xl font-black hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Lihat Program Lain
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
            @else
            <div class="empty-state scale-anim text-center py-20 px-8">
                <div class="max-w-lg mx-auto">
                    <div class="relative mb-8">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-200 to-purple-200 rounded-full blur-3xl opacity-30"></div>
                        <div class="relative bg-gradient-to-br from-gray-100 to-slate-100 rounded-full w-32 h-32 flex items-center justify-center mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900 mb-4">Belum Ada Program Unggulan</h3>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Saat ini belum ada program survei yang diunggulkan. Silakan kunjungi halaman Program Survei untuk melihat semua program.
                    </p>
                    <a href="{{ route('public.programs.list') }}" class="inline-flex items-center bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white px-8 py-4 rounded-2xl font-black hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Lihat Semua Program
                    </a>
                </div>
            </div>
            @endif

        </div>
    </section>

    @push('scripts')
    {{-- Kosong! Semua ditangani oleh app.js --}}
    @endpush
</x-guest-layout>