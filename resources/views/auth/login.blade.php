<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Survei UIN Antasari</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .input-anim {
            transition: all 0.3s ease-in-out;
        }
        .input-anim:focus {
            box-shadow: 0 0 12px rgba(79, 70, 229, 0.4); /* Menggunakan warna indigo */
            transform: scale(1.02);
            border-color: #4f46e5; /* Indigo-600 */
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 to-white p-4">

    {{-- Kelas 'fade-in' dihapus dari div ini --}}
    <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Bagian Kiri -->
        {{-- Latar belakang diubah menjadi indigo solid --}}
        <div class="rounded-2xl bg-indigo-600 text-white p-8 flex flex-col justify-between shadow-2xl">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo UIN Antasari" class="w-16 h-16 mb-4">
                <h2 class="text-3xl font-bold mb-2">Kuisioner UIN Antasari</h2>
                <p class="text-sm opacity-90">Bantu kami meningkatkan kualitas layanan dengan memberikan masukan Anda.</p>
            </div>
            <div class="mt-8 text-xs opacity-80">
                <p class="font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 20.944A12.02 12.02 0 0012 21a11.955 11.955 0 008.618-3.04 12.02 12.02 0 003-9.944c0-2.296-.632-4.44-1.742-6.258z" />
                    </svg>
                    <span>Data Anda Dilindungi</span>
                </p>
                <p class="mt-1">Partisipasi Anda sangat berharga dan akan dijaga kerahasiaannya.</p>
            </div>
        </div>

        <!-- Bagian Kanan (Login Form) -->
        <div class="rounded-2xl bg-white/40 backdrop-blur-md shadow-2xl p-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-6">Masuk ke Akun Anda</h3>

            @if(session('error') || $errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') ?? $errors->first() }}</span>
            </div>
            @endif

            {{-- Form Login Manual untuk Admin --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Admin</label>
                    <input id="email" type="email" name="email" required autofocus class="input-anim mt-1 block w-full rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 p-3 bg-white/60 backdrop-blur-sm text-gray-900 placeholder-gray-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password Admin</label>
                    <input id="password" type="password" name="password" required class="input-anim mt-1 block w-full rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 p-3 bg-white/60 backdrop-blur-sm text-gray-900 placeholder-gray-500">
                </div>
                <div>
                    <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out">
                        Login sebagai Admin
                    </button>
                </div>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500 rounded-full">Atau masuk sebagai Responden</span>
                </div>
            </div>

            {{-- Tombol Login Google --}}
            <div>
                <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center py-3 px-4 bg-white hover:bg-gray-100 text-gray-700 font-medium rounded-lg shadow-md border border-gray-200 transition duration-300 ease-in-out">
                    <img class="w-5 h-5 mr-3" src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo">
                    Masuk dengan Google
                </a>
            </div>

        </div>
    </div>

</body>

</html>

