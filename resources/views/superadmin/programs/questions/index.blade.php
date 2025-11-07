@extends('layouts.superadmin')

@section('content')
<div class="space-y-1" x-data="questionManager({{ $program->questions->pluck('id') }})">

    {{-- Notifikasi "Toast" Lokal --}}
    <div x-cloak
        x-show="notification.show"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.away="notification.show = false"
        class="fixed top-4 right-4 z-[100] w-full max-w-sm">

        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden"
            :class="{ 'bg-green-50': notification.type === 'success', 'bg-red-50': notification.type === 'error' }">
            <div class="p-4">
                <div class="flex items-start">

                    {{-- Ikon --}}
                    <div class="flex-shrink-0">
                        <svg x-show="notification.type === 'success'" class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="notification.type === 'error'" class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.25 11.25 0 0112 2.25c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2.25 12 2.25z" />
                        </svg>
                    </div>

                    {{-- Pesan --}}
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-semibold" :class="{ 'text-green-800': notification.type === 'success', 'text-red-800': notification.type === 'error' }" x-text="notification.type === 'success' ? 'Berhasil!' : 'Terjadi Kesalahan!'"></p>
                        <p class="mt-1 text-sm" :class="{ 'text-green-700': notification.type === 'success', 'text-red-700': notification.type === 'error' }" x-text="notification.message"></p>
                    </div>

                    {{-- Tombol Close --}}
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="notification.show = false" class="inline-flex rounded-md p-1 focus:outline-none focus:ring-2 focus:ring-offset-2"
                            :class="{
                                    'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-green-600 focus:ring-offset-green-50': notification.type === 'success',
                                    'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-red-600 focus:ring-offset-red-50': notification.type === 'error'
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

    {{-- Header Halaman --}}
    <div class="bg-white rounded-lg p-5 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                {{-- Breadcrumbs --}}
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="{{ route('superadmin.dashboard') }}" class="hover:text-blue-600">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.index') }}" class="hover:text-blue-600">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Kelola Pertanyaan</span></li>
                    </ol>
                </nav>
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Kelola Pertanyaan</h1>
                        <p class="text-sm text-gray-500 mt-1">Program: <span class="font-semibold">{{ $program->title }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="{{ route('superadmin.programs.index') }}" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border border-gray-300 shadow-sm">
                    Kembali
                </a>

                {{-- Tombol Simpan Urutan (hanya muncul jika urutan berubah) --}}
                <button type="button" x-show="isOrderChanged" x-transition
                    @click="saveOrder('{{ route('superadmin.programs.questions.reorder', $program) }}')"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-600 transition shadow-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Simpan Urutan</span>
                </button>

                <a href="{{ route('superadmin.programs.questions.create', $program) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition shadow-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Tambah Pertanyaan</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Daftar Pertanyaan --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Pertanyaan ({{ $program->questions->count() }})</h2>

        {{-- Container untuk SortableJS --}}
        <div class="space-y-4" x-ref="sortableContainer">
            @forelse ($program->questions as $question)
            {{--
                PERBAIKAN: Menambahkan 'list-none' untuk menghapus bullet point
            --}}
            <div data-id="{{ $question->id }}" class="list-item list-none bg-gray-50 border rounded-lg p-4 flex items-center justify-between group">
                <div class="flex items-center">
                    {{-- Handle Drag-and-Drop --}}
                    <div class="cursor-grab text-gray-400 group-hover:text-gray-600 mr-3 handle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">
                            <span class="item-number mr-2">{{ $loop->iteration }}</span>
                            {{ $question->question_body }}
                        </p>
                        <div class="text-sm text-gray-600 mt-2 space-y-1 pl-4 border-l-2 ml-1">
                            @foreach($question->options as $option)
                            <p><span class="font-semibold text-indigo-600">{{ $option->option_score }} Poin:</span> {{ $option->option_body }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('superadmin.programs.questions.edit', ['program' => $program, 'question' => $question]) }}" class="text-indigo-600 hover:text-indigo-800" title="Edit Pertanyaan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.programs.questions.destroy', ['program' => $program, 'question' => $question]) }}', name: '{{ addslashes($question->question_body) }}' })" class="text-red-600 hover:text-red-800" title="Hapus Pertanyaan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
            @empty
            <div class="text-center py-16 px-4 border-2 border-dashed rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-4 font-semibold text-gray-600">Belum Ada Pertanyaan</p>
                <p class="text-sm mt-1">Klik tombol "Tambah Pertanyaan" untuk memulai.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Library SortableJS sudah dimuat di layout utama 'superadmin.blade.php' --}}
<script>
    function questionManager(initialOrder) {
        return {
            initialOrder: [...initialOrder],
            currentOrder: [...initialOrder],
            isOrderChanged: false,

            notification: {
                show: false,
                message: '',
                type: 'success'
            },

            init() {
                if (typeof Sortable === 'undefined') {
                    console.error('SortableJS is not loaded.');
                    return;
                }

                new Sortable(this.$refs.sortableContainer, {
                    animation: 150,
                    handle: '.handle',
                    ghostClass: 'sortable-ghost',

                    onUpdate: () => {
                        this.currentOrder = Array.from(this.$refs.sortableContainer.children)
                            .filter(el => el.classList.contains('list-item'))
                            .map(el => el.dataset.id);
                        this.isOrderChanged = JSON.stringify(this.initialOrder) !== JSON.stringify(this.currentOrder);
                        this.updateNumbering();
                    }
                });
            },

            updateNumbering() {
                this.$refs.sortableContainer.querySelectorAll('.item-number').forEach((el, index) => {
                    el.textContent = (index + 1);
                });
            },

            saveOrder(url) {
                Alpine.store('globals').isLoading = true;

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order: this.currentOrder
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            this.showNotification(data.message, 'success');
                            this.initialOrder = [...this.currentOrder];
                            this.isOrderChanged = false;
                        } else {
                            this.showNotification(data.message || 'Gagal menyimpan urutan.', 'error');
                        }
                    })
                    .catch(() => {
                        this.showNotification('Terjadi error. Gagal terhubung ke server.', 'error');
                    })
                    .finally(() => {
                        Alpine.store('globals').isLoading = false;
                    });
            },

            showNotification(message, type = 'success') {
                this.notification.message = message;
                this.notification.type = type;
                this.notification.show = true;
                setTimeout(() => {
                    this.notification.show = false;
                }, 3000);
            }
        }
    }
</script>
@endpush