<x-guest-layout :title="'Data Responden - ' . $program->title">

    @push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Background Noise Halus */
        .bg-noise {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -10;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Background Gradient Mesh yang Sangat Halus */
        .bg-mesh {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -20;
            background: radial-gradient(circle at 0% 0%, #f1f5f9 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, #e2e8f0 0%, transparent 50%);
            background-color: #f8fafc;
        }

        /* Custom Scrollbar Minimalis */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
    </style>
    @endpush

    {{-- BACKGROUND LAYERS --}}
    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="min-h-screen flex flex-col items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative">

        {{-- HEADER: Premium Editorial Style --}}
        <div class="text-center mb-16 form-anim relative z-10 max-w-3xl mx-auto">

            {{-- Program Badge --}}
            <div class="inline-block mb-8 group cursor-default">
                <div class="flex items-center gap-3 px-5 py-2 bg-white rounded-full shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-slate-100 transition-transform duration-500 hover:scale-105">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                    </span>
                    <span class="text-[10px] font-bold tracking-[0.25em] text-slate-400 uppercase group-hover:text-slate-600 transition-colors">
                        {{ $program->title }}
                    </span>
                </div>
            </div>

            {{-- Main Title (Consistent Color) --}}
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tighter mb-6 leading-[0.95]">
                Identitas
                <br class="hidden sm:block" />
                <span>
                    Responden<span class="text-indigo-600">.</span>
                </span>
            </h1>

            {{-- Subtitle with Vertical Line --}}
            <div class="max-w-lg mx-auto relative mt-8">
                {{-- Decorative Vertical Line --}}
                <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-px h-10 bg-gradient-to-b from-transparent to-slate-300"></div>

                <p class="text-slate-500 font-medium text-lg leading-relaxed pt-6">
                    Mohon lengkapi profil singkat Anda untuk keperluan validasi & analisis data survei.
                </p>
            </div>
        </div>

        {{-- MAIN CARD (Clean Surface) --}}
        <div class="w-full max-w-3xl bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden form-anim">

            <div class="absolute top-0 left-0 w-full h-1 bg-slate-900"></div>

            <form action="{{ route('public.pre-survey.store', ['program' => $program, 'unitKerja' => $unitKerja]) }}" method="POST" class="p-10 sm:p-16">
                @csrf

                <div class="space-y-16">

                    <div>
                        <div class="mb-8 border-b border-slate-100 pb-4">
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-[0.15em]">Data Pribadi</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-8">
                            {{-- Nama Lengkap --}}
                            <div class="sm:col-span-8 group">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Nama Lengkap</label>
                                <input type="text" name="full_name" value="{{ old('full_name', Auth::user()->username) }}" required
                                    class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-semibold text-base placeholder:text-slate-300 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all"
                                    placeholder="Tulis nama lengkap Anda...">
                                @error('full_name') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>

                            {{-- Usia --}}
                            <div class="sm:col-span-4 group">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Usia</label>
                                <div class="relative">
                                    <input type="number" name="age" value="{{ old('age') }}" required min="15" max="100"
                                        class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-semibold text-base placeholder:text-slate-300 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all text-center"
                                        placeholder="00">
                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400 pointer-events-none tracking-wider">TAHUN</span>
                                </div>
                                @error('age') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>

                            {{-- Gender (Clean Text Tabs) --}}
                            <div class="sm:col-span-12">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Jenis Kelamin</label>
                                <div class="bg-slate-50 p-1.5 rounded-xl flex relative border border-slate-100 h-[60px]">
                                    {{-- Option: Laki-laki --}}
                                    <label class="flex-1 relative cursor-pointer z-10">
                                        <input type="radio" name="gender" value="Laki-laki" class="peer sr-only" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                        <div class="w-full h-full rounded-lg text-center text-sm font-bold text-slate-400 transition-all duration-300 peer-checked:bg-white peer-checked:text-slate-900 peer-checked:shadow-sm flex items-center justify-center tracking-wide">
                                            Laki-laki
                                        </div>
                                    </label>

                                    {{-- Option: Perempuan --}}
                                    <label class="flex-1 relative cursor-pointer z-10 ml-2">
                                        <input type="radio" name="gender" value="Perempuan" class="peer sr-only" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                        <div class="w-full h-full rounded-lg text-center text-sm font-bold text-slate-400 transition-all duration-300 peer-checked:bg-white peer-checked:text-slate-900 peer-checked:shadow-sm flex items-center justify-center tracking-wide">
                                            Perempuan
                                        </div>
                                    </label>
                                </div>
                                @error('gender') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- GROUP 2: AFILIASI --}}
                    <div>
                        <div class="mb-8 border-b border-slate-100 pb-4">
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-[0.15em]">Afiliasi</h3>
                        </div>

                        <div class="space-y-8">

                            {{-- CUSTOM DROPDOWN (No Icon, Text Only) --}}
                            <div x-data="{ 
                                open: false, 
                                selected: '{{ old('status') }}',
                                options: [
                                    { value: 'Mahasiswa', label: 'Mahasiswa', desc: 'Peserta didik aktif' },
                                    { value: 'Dosen', label: 'Dosen', desc: 'Tenaga pengajar' },
                                    { value: 'Tenaga Kependidikan', label: 'Tenaga Kependidikan', desc: 'Staf administrasi' },
                                    { value: 'Alumni', label: 'Alumni', desc: 'Lulusan universitas' },
                                    { value: 'Masyarakat Umum', label: 'Masyarakat Umum', desc: 'Publik luas' },
                                    { value: 'Mitra Kerjasama', label: 'Mitra Kerjasama', desc: 'Partner institusi' }
                                ],
                                get selectedOption() {
                                    return this.options.find(o => o.value === this.selected)
                                }
                            }" class="relative group">

                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Status</label>
                                <input type="hidden" name="status" :value="selected">

                                {{-- Trigger Button --}}
                                <button type="button"
                                    @click="open = !open"
                                    @click.away="open = false"
                                    class="w-full flex items-center justify-between px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-left transition-all focus:bg-white focus:border-slate-900 focus:ring-0 h-[72px]"
                                    :class="{'bg-white border-slate-900': open}">

                                    <div class="flex flex-col justify-center w-full">
                                        <span class="text-base font-bold text-slate-900 truncate" x-text="selectedOption ? selectedOption.label : 'Pilih Status Anda...'" :class="{'text-slate-300': !selectedOption}"></span>
                                        <span class="text-xs text-slate-400 font-medium truncate mt-1" x-show="selectedOption" x-text="selectedOption ? selectedOption.desc : ''"></span>
                                    </div>

                                    {{-- Minimal Chevron (Triangle) --}}
                                    <div class="text-slate-400 transition-transform duration-300 shrink-0 ml-3" :class="{'rotate-180 text-slate-900': open}">
                                        <div class="w-0 h-0 border-l-[5px] border-l-transparent border-r-[5px] border-r-transparent border-t-[6px] border-t-current"></div>
                                    </div>
                                </button>

                                {{-- Dropdown Menu --}}
                                <div x-show="open"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-xl ring-1 ring-black/5 py-2 max-h-[320px] overflow-y-auto custom-scrollbar"
                                    style="display: none;">

                                    <template x-for="option in options" :key="option.value">
                                        <div @click="selected = option.value; open = false"
                                            class="px-6 py-4 cursor-pointer hover:bg-slate-50 transition-colors flex items-center justify-between group">

                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900" x-text="option.label"></span>
                                                <span class="text-[10px] text-slate-400 group-hover:text-slate-500" x-text="option.desc"></span>
                                            </div>

                                            {{-- Simple Dot Indicator --}}
                                            <div x-show="selected === option.value" class="w-2 h-2 rounded-full bg-slate-900"></div>
                                        </div>
                                    </template>
                                </div>
                                @error('status') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>

                            {{-- Fakultas --}}
                            <div class="group">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Fakultas / Unit</label>
                                <div class="relative">
                                    <input type="text" name="unit_kerja_or_fakultas" value="{{ old('unit_kerja_or_fakultas') }}" required
                                        class="block w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-semibold text-base placeholder:text-slate-300 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm"
                                        placeholder="Tulis nama fakultas atau unit kerja...">
                                </div>
                                @error('unit_kerja_or_fakultas') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                </div>

                {{-- FOOTER ACTION --}}
                <div class="mt-16 pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        DATA TERENKRIPSI & AMAN
                    </div>

                    <button type="submit" class="w-full sm:w-auto bg-slate-900 text-white px-12 py-4 rounded-xl font-bold text-sm tracking-[0.15em] uppercase hover:bg-slate-800 hover:shadow-xl hover:shadow-slate-200 hover:-translate-y-0.5 transition-all duration-300 active:scale-95">
                        Mulai Survei
                    </button>
                </div>

            </form>
        </div>

        {{-- Footer Info --}}
        <div class="mt-12 text-[10px] font-bold text-slate-300 uppercase tracking-[0.2em] form-anim">
            &copy; {{ date('Y') }} SurveyZI <span class="mx-2">•</span> {{ $unitKerja->unit_kerja_name }}
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.form-anim', {
                    opacity: 0,
                    y: 30,
                    duration: 1,
                    stagger: 0.15,
                    ease: "power3.out"
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>