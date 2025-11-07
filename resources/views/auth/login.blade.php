<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Survei ZI UIN Antasari</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center p-4">

    {{-- Main Container --}}
    <div class="w-full max-w-5xl grid md:grid-cols-2 bg-white rounded-2xl shadow-2xl overflow-hidden">

        {{-- Left - Brand Section --}}
        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white p-8 md:p-12 flex flex-col justify-center">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-white/20 p-2 rounded-xl">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12">
                    </div>
                    <div>
                        <h2 class="text-2xl font-black">Survei ZI</h2>
                        <p class="text-sm">UIN Antasari</p>
                    </div>
                </div>
                <h3 class="text-xl font-bold mb-2">Zona Integritas</h3>
                <p class="text-white/90">Bantu kami meningkatkan kualitas layanan dengan mengisi survei.</p>
            </div>

            <div class="hidden md:block">
                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/authentication/illustration.svg" alt="illustration" class="w-64 mx-auto">
            </div>
        </div>

        {{-- Right - Form Section --}}
        <div class="p-8 md:p-12">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-black text-gray-900 mb-2">Selamat Datang!</h3>
                <p class="text-sm text-gray-600">Masuk ke akun Anda</p>
            </div>

            {{-- Error Alert --}}
            @if(session('error') || $errors->any())
            <div class="bg-red-50 border-2 border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                {{ session('error') ?? $errors->first() }}
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Admin</label>
                    <input type="email"
                        name="email"
                        required
                        placeholder="admin@uin-antasari.ac.id"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Admin</label>
                    <div class="relative">
                        <input type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg id="eye-open" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <svg id="eye-closed" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-bold py-3 rounded-xl hover:shadow-xl transform hover:scale-[1.02] transition">
                    Login sebagai Admin
                </button>
            </form>

            {{-- Divider --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-3 text-sm text-gray-500">Atau</span>
                </div>
            </div>

            {{-- Google Login --}}
            <a href="{{ route('google.redirect') }}" class="flex items-center justify-center w-full py-3 border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-indigo-300 transition font-semibold text-gray-700">
                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" class="w-5 h-5 mr-2">
                Masuk dengan Google
            </a>

            {{-- Privacy --}}
            <p class="text-xs text-center text-gray-500 mt-6">
                🔒 Data Anda aman dan bersifat anonim
            </p>

            {{-- Back --}}
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-indigo-600 font-semibold">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')

    <script>
        // Password toggle
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        toggle.addEventListener('click', () => {
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            eyeOpen.classList.toggle('hidden');
            eyeClosed.classList.toggle('hidden');
        });

        // Simple fade in animation
        if (typeof gsap !== 'undefined') {
            gsap.from('body > div', {
                opacity: 0,
                scale: 0.95,
                duration: 0.5,
                ease: "power2.out"
            });
        }
    </script>
</body>

</html>