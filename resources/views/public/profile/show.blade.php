<x-guest-layout title="Profil Saya">

    @push('styles')
    <style>
        /* Background System */
        body {
            background-color: #f8fafc;
        }

        .bg-mesh {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -20;
            background: radial-gradient(circle at 50% 0%, #f1f5f9 0%, transparent 50%);
            background-color: #ffffff;
        }
    </style>
    @endpush

    <div class="bg-mesh"></div>

    <main class="w-full max-w-3xl mx-auto py-20 px-4 sm:px-6">

        {{-- Header Halaman --}}
        <div class="text-center mb-10 section-title-anim">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 mb-4 shadow-sm">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Profil Saya</h1>
            <p class="text-slate-500 max-w-md mx-auto">Kelola informasi data diri Anda untuk keperluan survei.</p>
        </div>

        {{-- Kartu Profil --}}
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden section-title-anim relative">

            {{-- Decorative Top --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400"></div>

            <form action="{{ route('public.profile.update') }}" method="POST" class="p-8 sm:p-10">
                @csrf

                <div class="space-y-8">
                    {{-- Section: Identitas --}}
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-5 border-b border-slate-100 pb-2">Identitas Diri</h3>
                        <div class="space-y-5">
                            {{-- Nama Lengkap --}}
                            <div class="group">
                                <label for="full_name" class="block text-sm font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $profileData['full_name']) }}" required
                                    class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-semibold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all shadow-sm"
                                    placeholder="Nama Lengkap Anda">
                                @error('full_name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            {{-- Jenis Kelamin & Usia --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Jenis Kelamin</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="gender" value="Laki-laki" class="peer sr-only" {{ old('gender', $profileData['gender']) == 'Laki-laki' ? 'checked' : '' }}>
                                            <div class="py-2.5 px-3 rounded-lg border border-slate-200 bg-white text-center text-sm font-semibold text-slate-500 transition-all peer-checked:bg-indigo-50 peer-checked:text-indigo-700 peer-checked:border-indigo-200 peer-checked:shadow-sm hover:bg-slate-50">
                                                Laki-laki
                                            </div>
                                        </label>
                                        <label class="cursor-pointer">
                                            <input type="radio" name="gender" value="Perempuan" class="peer sr-only" {{ old('gender', $profileData['gender']) == 'Perempuan' ? 'checked' : '' }}>
                                            <div class="py-2.5 px-3 rounded-lg border border-slate-200 bg-white text-center text-sm font-semibold text-slate-500 transition-all peer-checked:bg-pink-50 peer-checked:text-pink-700 peer-checked:border-pink-200 peer-checked:shadow-sm hover:bg-slate-50">
                                                Perempuan
                                            </div>
                                        </label>
                                    </div>
                                    @error('gender') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="age" class="block text-sm font-bold text-slate-700 mb-1.5">Usia</label>
                                    <div class="relative">
                                        <input type="number" name="age" id="age" value="{{ old('age', $profileData['age']) }}" required
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-semibold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all shadow-sm"
                                            placeholder="21">
                                        <span class="absolute right-4 top-3.5 text-xs font-bold text-slate-400">Tahun</span>
                                    </div>
                                    @error('age') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Afiliasi --}}
                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-5 border-b border-slate-100 pb-2">Afiliasi Kampus</h3>
                        <div class="space-y-5">
                            <div>
                                <label for="status" class="block text-sm font-bold text-slate-700 mb-1.5">Status Anda</label>
                                <div class="relative">
                                    <select id="status" name="status" required
                                        class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-semibold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all shadow-sm appearance-none cursor-pointer">
                                        <option value="" disabled {{ old('status', $profileData['status']) ? '' : 'selected' }}>Pilih status...</option>
                                        @foreach($jenisRespondenList as $status)
                                        <option value="{{ $status }}" {{ old('status', $profileData['status']) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-500">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                                @error('status') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="unit_kerja_or_fakultas" class="block text-sm font-bold text-slate-700 mb-1.5">Fakultas / Unit Kerja</label>
                                <input type="text" name="unit_kerja_or_fakultas" id="unit_kerja_or_fakultas" value="{{ old('unit_kerja_or_fakultas', $profileData['unit_kerja_or_fakultas']) }}" required
                                    class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-semibold focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all shadow-sm"
                                    placeholder="Contoh: Fakultas Tarbiyah">
                                @error('unit_kerja_or_fakultas') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center gap-2 rounded-xl bg-slate-900 py-3.5 px-8 text-sm font-bold text-white shadow-lg shadow-slate-200 hover:bg-indigo-600 hover:shadow-indigo-500/30 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                        <span>Simpan Perubahan</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.section-title-anim', {
                    y: 30,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out"
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>