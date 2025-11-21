<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Unit - Survei UIN Antasari</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="//unpkg.com/alpinejs" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Sidebar Gradient (Teal Theme) */
        @keyframes aurora-sidebar {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .sidebar-gradient {
            background: linear-gradient(-45deg, #0f172a, #0f766e, #115e59, #0f172a);
            background-size: 400% 400%;
            animation: aurora-sidebar 15s ease infinite;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 font-sans leading-normal tracking-normal h-screen overflow-hidden"
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

    {{-- Loading Overlay --}}
    <div x-cloak x-show="$store.globals.isLoading" x-transition.opacity
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-md flex items-center justify-center z-[9999]">
        <div class="bg-white p-4 rounded-2xl shadow-2xl flex items-center gap-3">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-teal-500"></span>
            </span>
            <span class="text-sm font-bold text-slate-700 animate-pulse">Memproses...</span>
        </div>
    </div>

    <div class="flex h-full">

        {{-- Sidebar Estetik --}}
        <aside class="w-72 flex-shrink-0 sidebar-gradient text-white flex flex-col shadow-2xl relative z-50">

            {{-- Logo Area --}}
            <div class="flex flex-col items-center justify-center pt-8 pb-6 px-4 border-b border-white/10">
                <div class="relative group cursor-pointer">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-teal-400 to-emerald-500 rounded-full opacity-75 group-hover:opacity-100 transition duration-200 blur"></div>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo UIN" class="relative w-16 h-16 rounded-full bg-white p-1">
                </div>
                <h1 class="mt-4 text-lg font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-teal-200">UNIT ADMIN</h1>
                <span class="text-[10px] font-bold text-teal-200 uppercase tracking-widest bg-white/10 px-2 py-0.5 rounded-full mt-1">UIN Antasari</span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 space-y-1.5 p-4 overflow-y-auto">
                @php
                function isActive($route) {
                return request()->routeIs($route) ? 'bg-white/10 text-white shadow-lg border border-white/10 backdrop-blur-sm' : 'text-teal-100 hover:bg-white/5 hover:text-white';
                }
                @endphp

                <a href="{{ route('unitkerja.admin.dashboard') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ isActive('unitkerja.admin.dashboard') }}">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <div class="px-4 pt-4 pb-2">
                    <p class="text-[10px] font-bold text-teal-300 uppercase tracking-wider">Menu Utama</p>
                </div>

                <a href="{{ route('unitkerja.admin.profile.edit') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ isActive('unitkerja.admin.profile.*') }}">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="font-medium text-sm">Profil Unit</span>
                </a>

                <a href="{{ route('unitkerja.admin.programs.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ isActive('unitkerja.admin.programs.*') }}">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="font-medium text-sm">Program Survei</span>
                </a>
            </nav>

            {{-- Logout Button --}}
            <div class="p-4 border-t border-white/10 bg-black/20 backdrop-blur-sm">
                <button @click="openLogout = true"
                    class="w-full flex items-center justify-center gap-2 p-2.5 rounded-lg text-rose-300 hover:bg-rose-500/20 hover:text-rose-200 transition-all duration-300 border border-transparent hover:border-rose-500/30">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="font-semibold text-sm">Keluar Aplikasi</span>
                </button>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto bg-slate-50 relative">
            <div class="p-6 space-y-6 max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- 1. Modal Logout (Aurora Glass) --}}
    <div x-cloak x-show="openLogout" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div x-show="openLogout" @click.away="openLogout = false" x-transition.scale class="bg-white/90 rounded-3xl shadow-2xl p-8 w-full max-w-md text-center border border-white/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-500/5 to-orange-500/5 pointer-events-none"></div>
            <div class="w-20 h-20 mx-auto mb-4 drop-shadow-lg">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Smilies/Sleeping%20Face.png" alt="Sleep" class="w-full h-full object-contain">
            </div>
            <h2 class="text-2xl font-black text-slate-800 mb-2">Sudah Selesai?</h2>
            <p class="text-slate-500 mb-8 text-sm">Apakah Anda yakin ingin mengakhiri sesi dan keluar dari aplikasi?</p>
            <div class="flex justify-center gap-3 relative z-10">
                <button @click="openLogout = false" class="px-6 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition shadow-sm">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-bold shadow-lg hover:shadow-rose-500/30 transition">Ya, Logout</button>
                </form>
            </div>
        </div>
    </div>

    {{-- 2. Modal Hapus (Aurora Glass) --}}
    <div x-cloak x-show="openDeleteModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div x-show="openDeleteModal" @click.away="openDeleteModal = false" x-transition.scale class="bg-white/90 rounded-3xl shadow-2xl p-8 w-full max-w-md text-center border border-white/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-pink-500/5 pointer-events-none"></div>
            <div class="w-20 h-20 mx-auto mb-4 drop-shadow-lg">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Symbols/Warning.png" alt="Warning" class="w-full h-full object-contain">
            </div>
            <h2 class="text-2xl font-black text-slate-800 mb-2">Hapus Data Permanen?</h2>
            <p class="text-slate-500 mb-8 text-sm">Anda akan menghapus <strong x-text="deleteItemName" class="text-slate-800 bg-slate-100 px-1 rounded"></strong>. <br>Tindakan ini tidak bisa dibatalkan.</p>
            <div class="flex justify-center gap-3 relative z-10">
                <button @click="openDeleteModal = false" class="px-6 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition shadow-sm">Batal</button>
                <form x-bind:action="deleteUrl" method="POST" @submit.prevent="$store.globals.isLoading = true; $el.submit();">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold shadow-lg hover:shadow-red-500/30 transition">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>

    {{-- 3. Modal Kloning (Aurora Glass) --}}
    <div x-cloak x-show="openCloneModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div x-show="openCloneModal" @click.away="openCloneModal = false" x-transition.scale class="bg-white/90 rounded-3xl shadow-2xl p-8 w-full max-w-md text-center border border-white/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-cyan-500/5 pointer-events-none"></div>
            <div class="w-20 h-20 mx-auto mb-4 drop-shadow-lg">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Clipboard.png" alt="Clone" class="w-full h-full object-contain">
            </div>
            <h2 class="text-2xl font-black text-slate-800 mb-2">Duplikasi Data?</h2>
            <p class="text-slate-500 mb-8 text-sm">Kami akan menyalin program <strong x-text="cloneItemName" class="text-slate-800 bg-slate-100 px-1 rounded"></strong> beserta seluruh pertanyaannya.</p>
            <div class="flex justify-center gap-3 relative z-10">
                <button @click="openCloneModal = false" class="px-6 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition shadow-sm">Batal</button>
                <form x-bind:action="cloneUrl" method="POST" @submit.prevent="$store.globals.isLoading = true; $el.submit();">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-lg hover:shadow-blue-500/30 transition">Ya, Duplikasi</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Toast Notification --}}
    <div x-cloak x-data="{ show: false, message: '', type: 'success' }"
        x-init="@if(session('success')) show = true; message = '{{ session('success') }}'; type = 'success'; setTimeout(() => show = false, 4000); @endif @if(session('error')) show = true; message = '{{ session('error') }}'; type = 'error'; setTimeout(() => show = false, 4000); @endif"
        x-show="show" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed top-6 right-6 z-[100] w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
        <div class="p-4 flex items-start gap-4">
            <div class="flex-shrink-0">
                <template x-if="type === 'success'">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg></div>
                </template>
                <template x-if="type === 'error'">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg></div>
                </template>
            </div>
            <div class="flex-1 pt-0.5">
                <p class="text-sm font-bold text-slate-800" x-text="type === 'success' ? 'Berhasil!' : 'Oops, Gagal!'"></p>
                <p class="text-sm text-slate-500 mt-1" x-text="message"></p>
            </div>
            <button @click="show = false" class="text-slate-400 hover:text-slate-600 transition"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('globals', {
                isLoading: false
            });
        });
        window.addEventListener('pageshow', (event) => {
            if (event.persisted && Alpine.store('globals')) Alpine.store('globals').isLoading = false;
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
                placeholder: "Pilih jam..."
            });
        });
    </script>
    @stack('scripts')
</body>

</html>