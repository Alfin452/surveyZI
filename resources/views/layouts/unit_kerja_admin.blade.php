<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Unit Kerja - Survei UIN Antasari</title>

    @vite('resources/css/app.css')

    {{-- Library CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Style TomSelect agar sesuai tema teal */
        .ts-control.focus {
            border-color: #14b8a6 !important;
            /* teal-500 */
            box-shadow: 0 0 0 2px #a7f3d0 !important;
            /* teal-200 */
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100 font-sans leading-normal tracking-normal" x-data="{ openDeleteModal: false, deleteUrl: '', deleteItemName: '' }" @open-delete-modal.window="openDeleteModal = true; deleteUrl = event.detail.url; deleteItemName = event.detail.name">

    <div class="flex h-screen bg-slate-100">
        {{-- Sidebar (Desain disamakan dengan Super Admin) --}}
        <aside class="w-64 flex-shrink-0 bg-gradient-to-b from-cyan-500 to-blue-600 text-gray-100 flex flex-col p-4 shadow-xl">
            <div class="text-xl font-semibold text-white mb-2 flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo UIN" class="w-10 h-10 rounded-full">
                <span>Survei UIN</span>
            </div>
            <div class="text-sm text-cyan-200 pl-14 mb-6">Panel Unit Kerja</div>

            <nav class="flex-1 space-y-1">
                {{-- Tautan navigasi akan kita fungsionalkan nanti --}}
                <a href="#" class="block p-4 rounded-lg transition duration-300 {{-- request()->routeIs('unitkerja.admin.dashboard') ? 'bg-white/20 text-yellow-300' : 'text-gray-100 hover:bg-white/10 hover:text-yellow-300' --}}">Dashboard</a>
                <a href="#" class="block p-4 rounded-lg transition duration-300 {{-- request()->routeIs('unitkerja.admin.programs.*') ? 'bg-white/20 text-yellow-300' : 'text-gray-100 hover:bg-white/10 hover:text-yellow-300' --}}">Program Survei</a>
                <a href="#" class="block p-4 rounded-lg transition duration-300 {{-- request()->routeIs('unitkerja.admin.surveys.*') ? 'bg-white/20 text-yellow-300' : 'text-gray-100 hover:bg-white/10 hover:text-yellow-300' --}}">Pelaksanaan Saya</a>
            </nav>

            <div class="mt-auto">
                <div class="text-sm px-4 mb-4">
                    <p class="font-semibold text-white">{{ Auth::user()->username }}</p>
                    <p class="text-cyan-200">{{ Auth::user()->unitKerja->unit_kerja_name ?? 'N/A' }}</p>
                </div>
                {{-- Tombol Logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 p-4 text-left text-gray-200 hover:bg-red-500 hover:text-white rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Konten Utama --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div x-cloak x-show="openDeleteModal" x-transition.opacity class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
        <div x-show="openDeleteModal" @click.away="openDeleteModal = false" x-transition.scale class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100"><svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg></div>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Konfirmasi Hapus</h2>
            <p class="text-gray-600 my-4">Apakah Anda yakin ingin menghapus <strong x-text="deleteItemName" class="font-semibold text-gray-900"></strong>?<br>Aksi ini tidak dapat dibatalkan.</p>
            <div class="flex justify-center gap-4 mt-6">
                <button @click="openDeleteModal = false" class="px-6 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">Batal</button>
                <form x-bind:action="deleteUrl" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Library JS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    @stack('scripts')
</body>

</html>