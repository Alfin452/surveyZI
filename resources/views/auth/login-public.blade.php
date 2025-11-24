<x-guest-layout title="Masuk - Portal Survei">

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
            background: radial-gradient(circle at 50% 0%, #f1f5f9 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, #e2e8f0 0%, transparent 50%);
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

        /* Blob Animation */
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
                transform: translate(30px, -30px);
            }
        }
    </style>
    @endpush

    <div class="bg-mesh"></div>
    <div class="bg-noise"></div>

    <div class="blob bg-indigo-200 w-96 h-96 top-0 left-0 rounded-full mix-blend-multiply"></div>
    <div class="blob bg-teal-200 w-96 h-96 bottom-0 right-0 rounded-full mix-blend-multiply animation-delay-2000"></div>

    {{-- Container Utama dengan Padding Top Besar (pt-32) agar tidak nempel header --}}
    <div class="min-h-screen flex flex-col items-center justify-center p-4 relative z-10 pt-32 pb-20">

        {{-- MAIN CARD (Clean White - Tanpa Garis Aksen) --}}
        <div class="w-full max-w-md bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.1)] border border-white/60 p-10 sm:p-12 text-center form-anim relative overflow-hidden">

            {{-- Logo Section --}}
            <div class="mb-8 relative inline-block group">
                <div class="absolute inset-0 bg-indigo-50 rounded-3xl blur-xl opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                <div class="relative w-24 h-24 bg-white rounded-3xl shadow-sm border border-slate-100 flex items-center justify-center mx-auto transform transition-transform duration-500 group-hover:scale-105">
                    <img src="{{ asset('images/logo.png') }}" alt="UIN Antasari" class="w-14 h-14 object-contain">
                </div>
            </div>

            {{-- Text Content --}}
            <div class="mb-10">
                <h1 class="text-3xl font-black text-slate-900 mb-3 tracking-tight">Selamat Datang</h1>
                <p class="text-slate-500 text-base font-medium leading-relaxed">
                    Silakan masuk untuk mengakses kuesioner dan berpartisipasi dalam survei.
                </p>
            </div>

            {{-- BIG GOOGLE BUTTON --}}
            <a href="{{ route('google.redirect') }}"
                class="group relative flex items-center justify-center w-full bg-white border-2 border-slate-100 hover:border-indigo-100 rounded-2xl py-4 px-6 shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 hover:-translate-y-1">

                {{-- Google Icon SVG --}}
                <svg class="w-7 h-7 mr-4" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                </svg>

                <span class="font-bold text-lg text-slate-700 group-hover:text-indigo-900 transition-colors">
                    Masuk dengan Google
                </span>

                {{-- Hover Glow --}}
                <div class="absolute inset-0 rounded-2xl ring-2 ring-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            </a>

            {{-- Info Note --}}
            <div class="mt-8 bg-slate-50 rounded-xl p-4 flex items-start gap-3 text-left border border-slate-100">
                <svg class="w-5 h-5 text-indigo-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xs text-slate-500 leading-relaxed font-medium">
                    Sistem menggunakan akun Google untuk validasi. Identitas Anda tetap <strong>aman & rahasia</strong>.
                </p>
            </div>

        </div>

        {{-- Footer Action --}}
        <div class="mt-8 text-center form-anim" style="animation-delay: 0.2s;">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-800 transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
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
                    stagger: 0.1,
                    ease: "power3.out"
                });
            }
        });
    </script>
    @endpush

</x-guest-layout>