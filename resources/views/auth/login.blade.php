<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Survei UIN Antasari</title>
    {{-- Menggunakan Tailwind CDN untuk kemudahan --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- MENGGANTI FONT KE POPPINS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* MENERAPKAN FONT POPPINS */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .input-anim {
            transition: all 0.2s ease-in-out;
        }

        .input-anim:focus-within {
            box-shadow: 0 0 12px rgba(20, 184, 166, 0.4);
            transform: scale(1.01);
            border-color: #14b8a6;
        }

        #login-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        #login-card.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-100 p-4">

    <div id="login-card" class="w-full max-w-md md:max-w-3xl lg:max-w-4xl grid grid-cols-1 md:grid-cols-2 bg-white shadow-2xl rounded-2xl overflow-hidden">

        <!-- Bagian Kiri (Informasi & Ilustrasi) -->
        <div class="bg-gradient-to-br from-teal-400 to-cyan-500 text-white p-6 md:p-10 flex flex-col justify-between">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo UIN Antasari" class="w-16 h-16 mb-6">
                <h2 class="text-3xl md:text-3xl font-bold mb-3">Kuisioner UIN Antasari</h2>
                <p class="text-base opacity-90 leading-relaxed">Bantu kami meningkatkan kualitas layanan dengan mengisi formulir ini.</p>
            </div>

            <div class="mt-8 hidden sm:block">
                <svg viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg">
                    <rect x="40" y="10" width="150" height="110" rx="8" fill="white" fill-opacity="0.2" />
                    <rect x="55" y="30" width="100" height="8" rx="4" fill="white" fill-opacity="0.6" />
                    <rect x="55" y="50" width="120" height="8" rx="4" fill="white" fill-opacity="0.6" />
                    <rect x="55" y="70" width="80" height="8" rx="4" fill="white" fill-opacity="0.6" />
                    <circle cx="25" cy="40" r="15" fill="white" fill-opacity="0.8" />
                    <path d="M25 55 C 15 55, 10 70, 10 80 L 40 80 C 40 70, 35 55, 25 55 Z" fill="white" fill-opacity="0.8" />
                    <circle cx="150" cy="100" r="18" fill="#14b8a6" />
                    <path d="M145 100 L148 104 L156 95" stroke="white" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <div class="mt-8 text-sm opacity-90">
                <p class="font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 20.944A12.02 12.02 0 0012 21a11.955 11.955 0 008.618-3.04 12.02 12.02 0 003-9.944c0-2.296-.632-4.44-1.742-6.258z" />
                    </svg>
                    <span>Data Anda Dilindungi</span>
                </p>
                <p class="mt-2">Data yang Anda masukkan disimpan secara anonim dan hanya untuk keperluan survei.</p>
            </div>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="p-6 md:p-10 flex flex-col justify-center">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Masuk ke Akun Anda</h3>

            @if(session('error') || $errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 text-sm" role="alert">
                <span class="block sm:inline">{{ session('error') ?? $errors->first() }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email Admin</label>
                    <div class="input-anim flex items-center w-full rounded-lg border border-gray-300 bg-white">
                        <input id="email" type="email" name="email" required autofocus placeholder="contoh@uin-antasari.ac.id" class="w-full p-3 bg-transparent border-0 focus:ring-0 text-gray-900 placeholder-gray-400">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Password Admin</label>
                    <div class="input-anim relative flex items-center w-full rounded-lg border border-gray-300 bg-white">
                        <input id="password" type="password" name="password" required placeholder="••••••••" class="w-full p-3 bg-transparent border-0 focus:ring-0 text-gray-900 placeholder-gray-400">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2 2 0 01-2.828 2.828l-1.515-1.514A4 4 0 0010 14a4 4 0 10-4.47-5.447z" clip-rule="evenodd" />
                                <path d="M10.707 12.293a1 1 0 00-1.414-1.414l-1 1a1 1 0 001.414 1.414l1-1zM10 10a.75.75 0 00.75-.75V8.5a.75.75 0 00-1.5 0v.75A.75.75 0 0010 10z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full mt-2 py-3 px-4 bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        Login sebagai Admin
                    </button>
                </div>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm"><span class="px-3 bg-white text-gray-500 rounded-full">Atau masuk sebagai Responden</span></div>
            </div>

            <div>
                <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center py-3 px-4 bg-white hover:bg-gray-50 text-gray-600 font-medium rounded-lg shadow-sm border border-gray-300 transition-all duration-300 ease-in-out">
                    <img class="w-5 h-5 mr-3" src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo">
                    Masuk dengan Google
                </a>
            </div>
        </div>
    </div>

    <script>
        // Script untuk animasi fade-in
        window.addEventListener('load', function() {
            document.getElementById('login-card').classList.add('is-visible');
        });

        // Script untuk toggle lihat/sembunyikan password
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeSlashIcon = document.getElementById('eye-slash-icon');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.classList.toggle('hidden');
            eyeSlashIcon.classList.toggle('hidden');
        });
    </script>

</body>

</html>