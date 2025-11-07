<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Unit Kerja - Survei UIN Antasari</title>

    @vite('resources/css/app.css')

    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    {{-- Library CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />

    <style>
        /* Pastikan Poppins diterapkan secara global ke semua elemen */
        html,
        body,
        #app {
            font-family: 'Poppins', sans-serif;
        }

        /* Terapkan ke elemen form & UI supaya konsisten */
        body,
        div,
        span,
        p,
        a,
        button,
        input,
        textarea,
        select,
        label,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* Tombol pakai bobot normal (500) */
        button,
        .btn {
            font-weight: 500;
        }

        /* Utility kecil */
        [x-cloak] {
            display: none !important;
        }

        /* Loading dots */
        .pulsing-dots div {
            animation: pulse 1.4s infinite ease-in-out both;
            background-color: #3b82f6;
            border-radius: 50%;
            display: inline-block;
            height: 10px;
            width: 10px;
        }

        .pulsing-dots .dot-1 {
            animation-delay: -0.32s;
        }

        .pulsing-dots .dot-2 {
            animation-delay: -0.16s;
        }

        @keyframes pulse {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1.0);
            }
        }

        /* SortableJS ghost style */
        .sortable-ghost {
            background-color: #d1fae5;
            opacity: 0.7;
            border: 2px dashed #10b981;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal"
    x-data="{ openDeleteModal: false, deleteUrl: '', deleteItemName: '', showToast: false, toastMessage: '', openLogout: false }"
    @open-delete-modal.window="openDeleteModal = true; deleteUrl = event.detail.url; deleteItemName = event.detail.name">

    {{-- Loading overlay (global store) --}}
    <div x-cloak x-data x-show="$store.globals.isLoading" x-transition.opacity
        class="fixed inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-[9999]">
        <div class="pulsing-dots space-x-2">
            <div class="dot-1"></div>
            <div class="dot-2"></div>
            <div class="dot-3"></div>
        </div>
    </div>

    {{-- Toast --}}
    <div x-cloak x-show="showToast" x-transition
        class="fixed top-5 right-5 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-[10000]">
        <span x-text="toastMessage"></span>
    </div>

    <div class="flex h-screen">
        <aside
            class="w-64 transition-all duration-300 flex-shrink-0 bg-gradient-to-b from-indigo-600 to-blue-700 text-gray-100 flex flex-col p-4 shadow-xl">

            <div class="flex items-center mb-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo UIN" class="w-10 h-10 rounded-full" />
                    <h1 class="text-lg font-bold leading-tight">SURVEY ZI UIN Antasari</h1>
                </div>
            </div>

            <nav class="flex-1 space-y-2">
                <a href="{{ route('unitkerja.admin.dashboard') }}"
                    @click="setTimeout(() => $store.globals.isLoading = true, 300)"
                    class="flex items-center gap-3 p-3 rounded-lg transition hover:bg-indigo-500/30 {{ request()->routeIs('unitkerja.admin.dashboard') ? 'bg-white/20 text-yellow-300' : 'text-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 12h18M3 6h18M3 18h18" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('unitkerja.admin.programs.index') }}"
                    @click="setTimeout(() => $store.globals.isLoading = true, 300)"
                    class="flex items-center gap-3 p-3 rounded-lg transition hover:bg-indigo-500/30 {{ request()->routeIs('unitkerja.admin.programs.*') ? 'bg-white/20 text-yellow-300' : 'text-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5h6m-7 4h8m-8 4h8m-8 4h8M9 3h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2z" />
                    </svg>
                    <span>Program Survei</span>
                </a>
            </nav>

            {{-- Logout block: tombol pemicu modal --}}
            <div class="mt-auto">
                <div class="text-sm px-2 mb-4">
                    <p class="font-semibold text-white">{{ Auth::user()->username }}</p>
                    <p class="text-indigo-200">{{ Auth::user()->unitKerja->unit_kerja_name ?? 'N/A' }}</p>
                </div>

                <button @click="openLogout = true"
                    class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-red-500 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 
                            2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-2">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div x-cloak x-show="openDeleteModal" x-transition.opacity
        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
        <div x-show="openDeleteModal" @click.away="openDeleteModal = false" x-transition.scale
            class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 
                        0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 
                        0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Konfirmasi Hapus</h2>
            <p class="text-gray-600 my-4">
                Apakah Anda yakin ingin menghapus
                <strong x-text="deleteItemName" class="font-semibold text-gray-900"></strong>?<br />
                Aksi ini tidak dapat dibatalkan.
            </p>
            <div class="flex justify-center gap-4 mt-6">
                <button @click="openDeleteModal = false"
                    class="px-6 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">
                    Batal
                </button>
                <form x-bind:action="deleteUrl" method="POST"
                    @submit.prevent="toastMessage='Data berhasil dihapus'; showToast=true; setTimeout(()=>showToast=false,3000); $el.submit();">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Logout (ditempatkan setelah modal hapus) --}}
    <div x-cloak x-show="openLogout" x-transition.opacity
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div x-show="openLogout" @click.away="openLogout = false" x-transition.scale
            class="bg-white rounded-xl shadow-xl p-6 w-80 text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Logout</h2>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar?</p>
            <div class="flex justify-center gap-3">
                <button @click="openLogout = false"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">
                    Batal
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" @click="$store.globals.isLoading = true"
                        class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white font-medium shadow-md transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- JS libs --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('globals', {
                isLoading: false
            });
        });

        window.addEventListener('pageshow', (event) => {
            if (event.persisted && Alpine.store('globals')) {
                Alpine.store('globals').isLoading = false;
            }
        });
    </script>

    @stack('scripts')
</body>

</html>