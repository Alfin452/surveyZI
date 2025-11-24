<x-guest-layout title="Survei Tidak Aktif">

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

        .blob {
            position: absolute;
            filter: blur(80px);
            z-index: -15;
            opacity: 0.4;
            animation: float 10s infinite alternate;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(20px, -20px);
            }
        }
    </style>
    @endpush

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="blob bg-amber-100 w-96 h-96 top-0 left-0 rounded-full mix-blend-multiply"></div>
    <div class="blob bg-rose-100 w-80 h-80 bottom-0 right-0 rounded-full mix-blend-multiply animation-delay-2000"></div>

    <div class="min-h-screen flex flex-col items-center justify-center p-4 relative z-10 pt-32 pb-20">

        {{-- MAIN CARD --}}
        <div class="w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white/60 p-10 sm:p-14 text-center form-anim relative overflow-hidden">

            {{-- Top Decoration (Amber/Warning Color) --}}
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-amber-400 via-orange-500 to-rose-500"></div>

            {{-- Icon Wrapper --}}
            <div class="mb-8 relative inline-block">
                <div class="absolute inset-0 bg-amber-100 rounded-full blur-xl opacity-50 animate-pulse"></div>
                <div class="relative w-24 h-24 rounded-full bg-amber-50 flex items-center justify-center mx-auto border border-amber-100">
                    <svg class="w-10 h-10 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            {{-- Text Content --}}
            <div class="mb-10">
                <span class="inline-block px-3 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-4">
                    Status: Tidak Aktif
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mb-3 tracking-tight leading-tight">
                    Periode Survei Berakhir
                </h1>
                <p class="text-slate-500 text-base font-medium leading-relaxed">
                    Mohon maaf, formulir survei untuk program <strong>{{ $program->title }}</strong> saat ini tidak dapat diakses karena belum dimulai atau sudah ditutup.
                </p>
            </div>

            {{-- Action --}}
            <div class="space-y-4">
                <a href="{{ route('public.programs.list') }}"
                    class="block w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm uppercase tracking-widest shadow-lg shadow-slate-300/50 hover:bg-indigo-600 hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all duration-300">
                    Cari Survei Lain
                </a>
                <a href="{{ route('home') }}" class="inline-block text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-wider transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.from('.form-anim', {
                    opacity: 0,
                    scale: 0.95,
                    y: 20,
                    duration: 0.8,
                    ease: "power2.out"
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>