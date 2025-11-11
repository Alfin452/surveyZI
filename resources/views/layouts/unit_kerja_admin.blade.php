<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Panel - Survei UIN Antasari</title>
    @vite('resources/css/app.css')

    <script src="//unpkg.com/alpinejs" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Poppins', sans-serif !important;
        }

        .bouncing-loader {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 40px;
        }

        .bouncing-loader>div {
            width: 12px;
            height: 12px;
            margin: 3px;
            border-radius: 50%;
            background-color: #6B7280;
            /* PERUBAHAN: Warna loader diubah ke abu-abu */
            opacity: 1;
            animation: bouncing-loader 2.1s infinite ease-in-out both;
        }

        .bouncing-loader .dot-1 {
            animation-delay: -0.48s;
        }

        .bouncing-loader .dot-2 {
            animation-delay: -0.24s;
        }

        @keyframes bouncing-loader {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1.0);
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal h-screen overflow-y-hidden"
    x-data="{ 
        openLogout: false, 
        openDeleteModal: false, 
        deleteUrl: '', 
        deleteItemName: '',
        openCloneModal: false,
        cloneUrl: '',
        cloneItemName: ''
    }"
    @open-delete-modal.window="openDeleteModal = true; deleteUrl = event.detail.url; deleteItemName = event.detail.name"
    @open-clone-modal.window="openCloneModal = true; cloneUrl = event.detail.url; cloneItemName = event.detail.name">

    <div x-cloak x-data x-show="$store.globals.isLoading" x-transition.opacity
        class="fixed inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-[9999]">
        <div class="bouncing-loader">
            <div class="dot-1"></div>
            <div class="dot-2"></div>
            <div class="dot-3"></div>
        </div>
    </div>

    <div class="flex h-full">

        <aside class="w-64 transition-all duration-300 flex-shrink-0 bg-gray-900 text-gray-300 flex flex-col p-4 shadow-xl">
            <div class="flex flex-col items-center justify-center pt-4 mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo UIN" class="w-14 h-14 rounded-full shadow-lg mb-3">
                <h1 class="text-lg font-bold leading-tight text-white">APLIKASI SURVEI</h1>
                <span class="text-xs text-gray-400">UIN Antasari</span>
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

                <a href="{{ route('unitkerja.admin.profile.edit') }}"
                    @click="setTimeout(() => $store.globals.isLoading = true, 300)"
                    class="flex items-center gap-3 p-3 rounded-lg transition hover:bg-indigo-500/30 {{ request()->routeIs('unitkerja.admin.profile.*') ? 'bg-white/20 text-yellow-300' : 'text-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Profil Unit</span>
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

            <div class="mt-auto">
                <button @click="openLogout = true"
                    class="w-full flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-red-600 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto bg-gray-100">
            <div class="p-2 space-y-6">
                @yield('content')
            </div>
        </main>
    </div>

    <div x-cloak x-show="openLogout" x-transition.opacity
        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
        <div x-show="openLogout" @click.away="openLogout = false" x-transition.scale
            class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md text-center">

            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mt-4">Konfirmasi Logout</h2>
            <p class="text-gray-600 my-4">
                Apakah Anda yakin ingin keluar dari sesi ini?
            </p>
            <div class="flex justify-center gap-4 mt-6">
                <button @click="openLogout = false"
                    class="px-6 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">
                    Batal
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" @click="$store.globals.isLoading = true"
                        class="px-6 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold shadow-md transition">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

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
                <strong x-text="deleteItemName" class="font-semibold text-gray-900"></strong>?<br>
                Aksi ini tidak dapat dibatalkan.
            </p>
            <div class="flex justify-center gap-4 mt-6">
                <button @click="openDeleteModal = false"
                    class="px-6 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">
                    Batal
                </button>
                <form x-bind:action="deleteUrl" method="POST"
                    @submit.prevent="$store.globals.isLoading = true; $el.submit();">
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

    <div x-cloak x-show="openCloneModal" x-transition.opacity
        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
        <div x-show="openCloneModal" @click.away="openCloneModal = false" x-transition.scale
            class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md text-center">

            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75c-.621 0-1.125-.504-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75M15.75 17.25H18M15.75 17.25v-3.375M15.75 13.875c0-.621.504-1.125 1.125-1.125h1.5c.621 0 1.125.504 1.125 1.125v3.375M15.75 13.875c0-3.313 2.687-6 6-6v6h-6z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mt-4">Konfirmasi Kloning</h2>
            <p class="text-gray-600 my-4">
                Apakah Anda yakin ingin mengkloning program
                <strong x-text="cloneItemName" class="font-semibold text-gray-900"></strong>?
                <br>Seluruh pertanyaannya juga akan disalin.
            </p>
            <div class="flex justify-center gap-4 mt-6">
                <button @click="openCloneModal = false"
                    class="px-6 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">
                    Batal
                </button>
                <form x-bind:action="cloneUrl" method="POST"
                    @submit.prevent="$store.globals.isLoading = true; $el.submit();">
                    @csrf
                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-white font-semibold shadow-md transition">
                        Ya, Kloning
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div x-cloak
        x-data="{
             show: false,
             message: '',
             type: 'success'
         }"
        x-init="
             @if (session('success'))
                 show = true;
                 message = '{{ session('success') }}';
                 type = 'success';
                 setTimeout(() => show = false, 5000);
             @endif
             @if (session('error'))
                 show = true;
                 message = '{{ session('error') }}';
                 type = 'error';
                 setTimeout(() => show = false, 5000);
             @endif
         "
        x-show="show"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.away="show = false"
        class="fixed top-4 right-4 z-[100] w-full max-w-sm">

        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden"
            :class="{ 'bg-green-50': type === 'success', 'bg-red-50': type === 'error' }">
            <div class="p-4">
                <div class="flex items-start">

                    <div class="flex-shrink-0">
                        <svg x-show="type === 'success'" class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="type === 'error'" class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.25 11.25 0 0112 2.25c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2.25 12 2.25z" />
                        </svg>
                    </div>

                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-semibold" :class="{ 'text-green-800': type === 'success', 'text-red-800': type === 'error' }" x-text="type === 'success' ? 'Berhasil!' : 'Terjadi Kesalahan!'"></p>
                        <p class="mt-1 text-sm" :class="{ 'text-green-700': type === 'success', 'text-red-700': type === 'error' }" x-text="message"></p>
                    </div>

                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="show = false" class="inline-flex rounded-md p-1 focus:outline-none focus:ring-2 focus:ring-offset-2"
                            :class="{
                                    'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-green-600 focus:ring-offset-green-50': type === 'success',
                                    'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-red-600 focus:ring-offset-red-50': type === 'error'
                                }">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('globals', {
                isLoading: false
            });
        });

        window.addEventListener('pageshow', (event) => {
            if (event.persisted) {
                if (Alpine.store('globals')) {
                    Alpine.store('globals').isLoading = false;
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datepicker", {
                altInput: true,
                altFormat: "d F Y",
                dateFormat: "Y-m-d",
                locale: "id"
            });

            flatpickr(".timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                placeholder: "Pilih jam (HH:MM)..."
            });
        });
    </script>

    @stack('scripts')
</body>

</html>