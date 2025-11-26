<x-guest-layout title="Sedang Pemeliharaan">

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
            background: radial-gradient(circle at 50% 50%, #f1f5f9 0%, transparent 50%);
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

        /* Pulse Animation for Maintenance Icon */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        .pulse-ring::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #6366f1;
            border-radius: 50%;
            z-index: -1;
            animation: pulse-ring 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }
    </style>
    @endpush

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="min-h-screen flex flex-col items-center justify-center p-4 relative z-10 pt-32 pb-20">

        {{-- MAIN CARD --}}
        <div class="w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-indigo-200/50 border border-white/60 p-10 sm:p-14 text-center form-anim relative overflow-hidden">

            {{-- Top Accent --}}
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-indigo-400 via-blue-500 to-cyan-400"></div>

            {{-- Icon Wrapper --}}
            <div class="mb-10 relative inline-block">
                <div class="relative w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto pulse-ring">
                    <svg class="w-10 h-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>

            {{-- Text Content --}}
            <div class="space-y-4 mb-10">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                    Sedang Pemeliharaan
                </h1>
                <p class="text-slate-500 text-lg leading-relaxed">
                    Kami sedang melakukan peningkatan sistem untuk melayani Anda lebih baik. Mohon kembali lagi dalam beberapa saat.
                </p>
            </div>

            {{-- Action --}}
            <div class="space-y-4">
                <button onClick="window.location.reload();"
                    class="block w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-sm uppercase tracking-widest shadow-lg hover:bg-indigo-600 hover:shadow-indigo-500/30 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Coba Muat Ulang
                </button>

                <p class="text-xs text-slate-400 font-semibold pt-2">
                    Estimasi waktu: <span class="text-indigo-500">~15 Menit</span>
                </p>
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
                    y: 30,
                    duration: 1,
                    ease: "power3.out"
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>