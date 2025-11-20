<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Survei UIN Antasari</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 h-screen overflow-hidden flex items-center justify-center relative">

    {{-- Background Aurora Terang (Fresh) --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-teal-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-cyan-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    {{-- Card Login User --}}
    <div class="relative z-10 w-full max-w-md p-4">
        <div class="bg-white/70 backdrop-blur-xl border border-white/60 shadow-xl rounded-3xl p-10 text-center relative">

            {{-- Logo & Header --}}
            <div class="mb-8">
                <div class="w-24 h-24 mx-auto mb-6 drop-shadow-xl animate-bounce-slow">
                    {{-- 3D Hand Waving --}}
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Hand%20gestures/Waving%20Hand.png" alt="Hello" class="w-full h-full object-contain">
                </div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight mb-2">Selamat Datang!</h1>
                <p class="text-slate-500">Silakan masuk untuk mulai mengisi survei.</p>
            </div>

            {{-- Tombol Google (Fokus Utama) --}}
            <div class="space-y-4">
                <a href="{{ route('google.redirect') }}" class="group relative flex items-center justify-center gap-3 w-full py-4 px-6 bg-white border-2 border-slate-100 hover:border-indigo-100 rounded-2xl shadow-sm hover:shadow-xl hover:shadow-indigo-100 hover:-translate-y-1 transition-all duration-300">
                    {{-- Logo Google SVG --}}
                    <svg class="w-6 h-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                    </svg>
                    <span class="font-bold text-slate-700 text-lg group-hover:text-indigo-600 transition-colors">Masuk dengan Google</span>
                </a>

                <p class="text-xs text-slate-400 mt-6">
                    Dengan masuk, Anda menyetujui Kebijakan Privasi UIN Antasari.
                </p>
            </div>

            {{-- Footer Kecil --}}
            <div class="mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('home') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                    Batal, kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    {{-- Animasi CSS --}}
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s infinite ease-in-out;
        }
    </style>
</body>

</html>