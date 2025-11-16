<x-guest-layout :title="'Data Responden - ' . $program->title">

    {{-- Hero Section with Gradient --}}
    <section class="relative bg-gradient-to-br from-cyan-600 via-teal-600 to-blue-600 pt-28 pb-16 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Progress Steps --}}
            <div class="max-w-4xl mx-auto mb-10">
                <div class="flex items-center justify-between">
                    {{-- Step 1: Completed --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-white text-teal-600 font-black shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="mt-2 text-white text-xs sm:text-sm font-bold">Pilih Unit</span>
                    </div>

                    {{-- Connector 1 --}}
                    <div class="flex-1 h-1 bg-white mx-2"></div>

                    {{-- Step 2: Active --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-white text-teal-600 font-black shadow-lg ring-4 ring-white/30 animate-pulse">
                            2
                        </div>
                        <span class="mt-2 text-white text-xs sm:text-sm font-bold">Data Diri</span>
                    </div>

                    {{-- Connector 2 --}}
                    <div class="flex-1 h-1 bg-white/30 mx-2"></div>

                    {{-- Step 3: Upcoming --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-white/20 text-white font-black">
                            3
                        </div>
                        <span class="mt-2 text-white/70 text-xs sm:text-sm font-bold">Isi Survei</span>
                    </div>
                </div>
            </div>

            {{-- Header --}}
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-block mb-4">
                    <span class="bg-white/20 text-white px-5 py-2 rounded-full text-sm font-bold backdrop-blur-sm border border-white/30">
                        📋 {{ $program->title }}
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-4">
                    Lengkapi Data Diri Anda
                </h1>
                <p class="text-base sm:text-lg text-white/90">
                    Mohon isi data dengan lengkap dan benar sebelum memulai survei
                </p>
            </div>
        </div>
    </section>

    {{-- Form Section --}}
    <main class="container mx-auto px-4 py-12 -mt-10 relative z-10">
        <div class="max-w-4xl mx-auto">
            {{-- Main Card --}}
            <div class="bg-white rounded-3xl shadow-2xl border-2 border-gray-100 overflow-hidden">
                {{-- Gradient Top Bar --}}
                <div class="h-2 bg-gradient-to-r from-cyan-500 via-teal-500 to-blue-500"></div>

                <form action="{{ route('public.pre-survey.store', ['program' => $program, 'unitKerja' => $unitKerja]) }}" method="POST">
                    @csrf

                    {{-- Section 1: Informasi Pribadi --}}
                    <div class="section-form p-6 sm:p-8 md:p-10 border-b-4 border-gray-50">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-xl flex items-center justify-center text-white font-black shadow-lg">
                                1
                            </div>
                            <div class="ml-4">
                                <h2 class="text-xl sm:text-2xl font-black text-gray-900">Informasi Pribadi</h2>
                                <p class="text-sm text-gray-500">Data identitas dasar Anda</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Nama Lengkap --}}
                            <div class="form-group">
                                <label for="full_name" class="block text-sm font-bold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text"
                                        name="full_name"
                                        id="full_name"
                                        value="{{ old('full_name', Auth::user()->username) }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-100 outline-none transition text-gray-900 font-medium"
                                        placeholder="Masukkan nama lengkap Anda">
                                </div>
                                @error('full_name')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Jenis Kelamin & Usia --}}
                            <div class="grid sm:grid-cols-2 gap-6">
                                {{-- Jenis Kelamin --}}
                                <div class="form-group">
                                    <label class="block text-sm font-bold text-gray-700 mb-3">
                                        Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <div class="space-y-3">
                                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-teal-50 hover:border-teal-400 transition group">
                                            <input type="radio"
                                                name="gender"
                                                value="Laki-laki"
                                                class="w-5 h-5 text-teal-600 border-gray-300 focus:ring-teal-500"
                                                {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                            <span class="ml-3 text-base font-semibold text-gray-700 group-hover:text-teal-700">👨 Laki-laki</span>
                                        </label>
                                        <label class="flex items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-teal-50 hover:border-teal-400 transition group">
                                            <input type="radio"
                                                name="gender"
                                                value="Perempuan"
                                                class="w-5 h-5 text-teal-600 border-gray-300 focus:ring-teal-500"
                                                {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                            <span class="ml-3 text-base font-semibold text-gray-700 group-hover:text-teal-700">👩 Perempuan</span>
                                        </label>
                                    </div>
                                    @error('gender')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Usia --}}
                                <div class="form-group">
                                    <label for="age" class="block text-sm font-bold text-gray-700 mb-2">
                                        Usia <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="number"
                                            name="age"
                                            id="age"
                                            value="{{ old('age') }}"
                                            required
                                            min="10"
                                            max="100"
                                            class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-100 outline-none transition text-gray-900 font-medium"
                                            placeholder="Contoh: 21">
                                    </div>
                                    <p class="mt-1.5 text-xs text-gray-500">Masukkan usia Anda dalam tahun</p>
                                    @error('age')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Status & Afiliasi --}}
                    <div class="section-form p-6 sm:p-8 md:p-10">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-black shadow-lg">
                                2
                            </div>
                            <div class="ml-4">
                                <h2 class="text-xl sm:text-2xl font-black text-gray-900">Status & Afiliasi</h2>
                                <p class="text-sm text-gray-500">Informasi status dan unit kerja Anda</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status" class="block text-sm font-bold text-gray-700 mb-2">
                                    Status Anda <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <select id="status"
                                        name="status"
                                        required
                                        class="w-full pl-12 pr-10 py-3.5 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-100 outline-none transition appearance-none bg-white text-gray-900 font-medium cursor-pointer">
                                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status Anda...</option>
                                        <option value="Mahasiswa" {{ old('status') == 'Mahasiswa' ? 'selected' : '' }}>👨‍🎓 Mahasiswa</option>
                                        <option value="Dosen" {{ old('status') == 'Dosen' ? 'selected' : '' }}>👨‍🏫 Dosen</option>
                                        <option value="Tenaga Kependidikan" {{ old('status') == 'Tenaga Kependidikan' ? 'selected' : '' }}>👔 Tenaga Kependidikan</option>
                                        <option value="Alumni" {{ old('status') == 'Alumni' ? 'selected' : '' }}>🎓 Alumni</option>
                                        <option value="Masyarakat Umum" {{ old('status') == 'Masyarakat Umum' ? 'selected' : '' }}>👥 Masyarakat Umum</option>
                                        <option value="Mitra Kerjasama" {{ old('status') == 'Mitra Kerjasama' ? 'selected' : '' }}>🤝 Mitra Kerjasama</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Unit Kerja/Fakultas --}}
                            <div class="form-group">
                                <label for="unit_kerja_or_fakultas" class="block text-sm font-bold text-gray-700 mb-2">
                                    Fakultas / Unit Kerja <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <input type="text"
                                        name="unit_kerja_or_fakultas"
                                        id="unit_kerja_or_fakultas"
                                        value="{{ old('unit_kerja_or_fakultas') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-4 focus:ring-teal-100 outline-none transition text-gray-900 font-medium"
                                        placeholder="Contoh: FTIK, UPT TIPD, Fakultas Tarbiyah">
                                </div>
                                <p class="mt-1.5 text-xs text-gray-500">Sebutkan fakultas atau unit kerja tempat Anda bernaung</p>
                                @error('unit_kerja_or_fakultas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Privacy Notice --}}
                            <div class="bg-gradient-to-r from-cyan-50 to-teal-50 border-2 border-teal-200 rounded-xl p-5">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-sm font-bold text-teal-900">🔒 Privasi Anda Terjaga</h3>
                                        <p class="text-sm text-teal-700 mt-1 leading-relaxed">
                                            Data yang Anda masukkan bersifat anonim dan hanya digunakan untuk keperluan analisis survei. Kami berkomitmen menjaga kerahasiaan informasi Anda.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Section --}}
                    <div class="p-6 sm:p-8 md:p-10 bg-gradient-to-br from-slate-50 to-gray-50 border-t-2 border-gray-200">
                        <button type="submit" class="w-full bg-gradient-to-r from-cyan-600 via-teal-600 to-blue-600 text-white font-black py-5 px-6 rounded-xl hover:shadow-2xl transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-3 group">
                            <span class="text-lg">Lanjutkan ke Survei</span>
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                        <p class="text-center text-xs text-gray-500 mt-4">
                            Dengan melanjutkan, Anda menyetujui data yang diisi adalah benar dan akurat
                        </p>
                    </div>
                </form>
            </div>

            {{-- Footer Note --}}
            <div class="text-center mt-8 space-y-2">
                <p class="text-sm text-gray-600">
                    <span class="font-bold">{{ $unitKerja->unit_kerja_name }}</span>
                </p>
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Survei ZI UIN Antasari. All rights reserved.
                </p>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                // Animate sections
                gsap.from('.section-form', {
                    opacity: 0,
                    y: 30,
                    stagger: 0.2,
                    duration: 0.6,
                    ease: "power2.out"
                });

                // Animate form groups
                gsap.from('.form-group', {
                    opacity: 0,
                    x: -20,
                    stagger: 0.1,
                    duration: 0.5,
                    ease: "power2.out",
                    delay: 0.3
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>