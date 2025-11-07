<x-guest-layout :title="'Data Responden - ' . $program->title">

    {{-- Hero Section with Gradient --}}
    <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 pt-28 pb-12 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            {{-- Progress Steps --}}
            <div class="max-w-3xl mx-auto mb-8">
                <div class="flex items-center justify-center gap-2">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-indigo-600 font-black">✓</div>
                        <span class="ml-2 text-white text-sm font-semibold hidden sm:inline">Pilih Unit</span>
                    </div>
                    <div class="w-12 sm:w-20 h-1 bg-white/30"></div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-indigo-600 font-black">2</div>
                        <span class="ml-2 text-white text-sm font-semibold hidden sm:inline">Data Diri</span>
                    </div>
                    <div class="w-12 sm:w-20 h-1 bg-white/30"></div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white/30 text-white font-black">3</div>
                        <span class="ml-2 text-white/70 text-sm font-semibold hidden sm:inline">Isi Survei</span>
                    </div>
                </div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-block mb-4">
                    <span class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-bold backdrop-blur-sm">
                        📋 {{ $program->title }}
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-3">
                    Satu Langkah Lagi!
                </h1>
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto">
                    Sebelum memulai survei, mohon lengkapi data diri Anda terlebih dahulu
                </p>
            </div>
        </div>
    </section>

    {{-- Form Section --}}
    <main class="container mx-auto px-4 py-12 -mt-8 relative z-10">
        <div class="max-w-3xl mx-auto">
            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-gray-100 overflow-hidden">
                {{-- Gradient Top Bar --}}
                <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                <div class="p-6 sm:p-8 md:p-10">
                    <form action="{{ route('public.pre-survey.store', ['program' => $program, 'unitKerja' => $unitKerja]) }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div class="form-group">
                            <label for="full_name" class="block text-sm font-bold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text"
                                    name="full_name"
                                    id="full_name"
                                    value="{{ old('full_name', Auth::user()->username) }}"
                                    required
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>
                            @error('full_name')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
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
                                    <label class="flex items-center p-3 border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-indigo-50 hover:border-indigo-300 transition">
                                        <input type="radio"
                                            name="gender"
                                            value="Laki-laki"
                                            class="w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                            {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm font-semibold text-gray-700">👨 Laki-laki</span>
                                    </label>
                                    <label class="flex items-center p-3 border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-indigo-50 hover:border-indigo-300 transition">
                                        <input type="radio"
                                            name="gender"
                                            value="Perempuan"
                                            class="w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                            {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm font-semibold text-gray-700">👩 Perempuan</span>
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
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
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
                                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"
                                        placeholder="Contoh: 21">
                                </div>
                                @error('age')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Status & Unit Kerja --}}
                        <div class="grid sm:grid-cols-2 gap-6">
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status" class="block text-sm font-bold text-gray-700 mb-2">
                                    Status Anda <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <select id="status"
                                        name="status"
                                        required
                                        class="w-full pl-10 pr-10 py-3 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition appearance-none bg-white">
                                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status...</option>
                                        <option value="Mahasiswa" {{ old('status') == 'Mahasiswa' ? 'selected' : '' }}>👨‍🎓 Mahasiswa</option>
                                        <option value="Dosen" {{ old('status') == 'Dosen' ? 'selected' : '' }}>👨‍🏫 Dosen</option>
                                        <option value="Tenaga Kependidikan" {{ old('status') == 'Tenaga Kependidikan' ? 'selected' : '' }}>👔 Tenaga Kependidikan</option>
                                        <option value="Alumni" {{ old('status') == 'Alumni' ? 'selected' : '' }}>🎓 Alumni</option>
                                        <option value="Masyarakat Umum" {{ old('status') == 'Masyarakat Umum' ? 'selected' : '' }}>👥 Masyarakat Umum</option>
                                        <option value="Mitra Kerjasama" {{ old('status') == 'Mitra Kerjasama' ? 'selected' : '' }}>🤝 Mitra Kerjasama</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Unit Kerja/Fakultas --}}
                            <div class="form-group">
                                <label for="unit_kerja_or_fakultas" class="block text-sm font-bold text-gray-700 mb-2">
                                    Fakultas / Unit Kerja <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <input type="text"
                                        name="unit_kerja_or_fakultas"
                                        id="unit_kerja_or_fakultas"
                                        value="{{ old('unit_kerja_or_fakultas') }}"
                                        required
                                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"
                                        placeholder="Contoh: FTIK, UPT TIPD">
                                </div>
                                @error('unit_kerja_or_fakultas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Privacy Notice --}}
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border-2 border-indigo-100 rounded-xl p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Privasi Anda Terjaga</p>
                                    <p class="text-xs text-gray-600 mt-1">Data yang Anda masukkan bersifat anonim dan hanya digunakan untuk keperluan analisis survei.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-black py-4 px-6 rounded-xl hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                                <span>Lanjutkan ke Survei</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Footer Note --}}
            <p class="text-center text-sm text-gray-500 mt-8">
                &copy; {{ date('Y') }} Survei ZI UIN Antasari. All rights reserved.
            </p>
        </div>
    </main>

    @push('scripts')
    <script>
        if (typeof gsap !== 'undefined') {
            gsap.from('.form-group', {
                opacity: 0,
                y: 20,
                stagger: 0.1,
                duration: 0.5,
                ease: "power2.out"
            });
        }
    </script>
    @endpush

</x-guest-layout>