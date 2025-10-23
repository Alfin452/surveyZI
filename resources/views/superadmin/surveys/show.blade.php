@extends('layouts.superadmin')

@section('content')
{{-- Inisialisasi Alpine.js untuk mengelola state drag-and-drop --}}
<div class="p-4 sm:p-6" x-data="questionManager({{ $survey->questions->pluck('id') }})">
    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-blue-500 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                {{-- Breadcrumbs --}}
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="{{ route('superadmin.dashboard') }}" class="hover:text-blue-600">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.index') }}" class="hover:text-blue-600">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('superadmin.programs.show', $survey->surveyProgram) }}" class="hover:text-blue-600">Detail Program</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Kelola Pertanyaan</span></li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Kelola Pertanyaan</h1>
                        <p class="text-sm text-gray-500 mt-1">Survei: <span class="font-semibold">{{ $survey->title }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="{{ route('superadmin.programs.show', $survey->surveyProgram) }}" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border">Kembali</a>

                {{-- Tombol Simpan Urutan (hanya muncul jika urutan berubah) --}}
                <button typeA="button" x-show="isOrderChanged" x-transition
                    @click="saveOrder('{{ route('superadmin.surveys.questions.reorder', $survey) }}')"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-600 transition shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Simpan Urutan</span>
                </button>

                <a href="{{ route('superadmin.surveys.questions.create', $survey) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition">Tambah Pertanyaan</a>
            </div>
        </div>
    </div>

    {{-- Notifikasi Sukses --}}
    <div x-cloak x-show="notification.show" x-transition
        class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold" x-text="notification.message"></p>
    </div>

    {{-- Daftar Pertanyaan --}}
    <div class="bg-white rounded-xl shadow-lg border p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Pertanyaan ({{ $survey->questions->count() }})</h2>

        {{-- Container untuk SortableJS --}}
        <div class="space-y-4" x-ref="sortableContainer">
            @forelse ($survey->questions as $question)
            <div data-id="{{ $question->id }}" class="bg-gray-50 border rounded-lg p-4 flex items-center justify-between group">
                <div class="flex items-center">
                    {{-- Handle Drag-and-Drop --}}
                    <div class="cursor-grab text-gray-400 group-hover:text-gray-600 mr-3 handle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ $loop->iteration }}. {{ $question->question_body }}</p>
                        <div class="text-sm text-gray-600 mt-2 space-y-1 pl-4 border-l-2 ml-1">
                            @foreach($question->options as $option)
                            <p><span class="font-semibold text-indigo-600">{{ $option->option_score }} Poin:</span> {{ $option->option_body }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('superadmin.surveys.questions.edit', ['survey' => $survey, 'question' => $question]) }}" class="text-indigo-600 hover:text-indigo-800" title="Edit Pertanyaan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <button type="button" @click="$dispatch('open-delete-modal', { url: '{{ route('superadmin.surveys.questions.destroy', ['survey' => $survey, 'question' => $question]) }}', name: '{{ addslashes($question->question_body) }}' })" class="text-red-600 hover:text-red-800" title="Hapus Pertanyaan">
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
                message: ''
            },

            init() {
                // Memastikan Sortable sudah dimuat
                if (typeof Sortable === 'undefined') {
                    console.error('SortableJS is not loaded.');
                    return;
                }

                const sortable = new Sortable(this.$refs.sortableContainer, {
                    animation: 150,
                    handle: '.handle', // Tentukan elemen mana yang bisa di-drag
                    ghostClass: 'sortable-ghost', // Kelas CSS untuk bayangan

                    // Fungsi ini akan dipanggil setelah drag-and-drop selesai
                    onUpdate: () => {
                        // Perbarui array 'currentOrder' dengan urutan ID yang baru
                        this.currentOrder = Array.from(sortable.el.children).map(el => el.dataset.id);
                        // Bandingkan urutan baru dengan urutan awal untuk menampilkan/menyembunyikan tombol simpan
                        this.isOrderChanged = JSON.stringify(this.initialOrder) !== JSON.stringify(this.currentOrder);
                    }
                });
            },

            // Fungsi untuk menyimpan urutan baru ke server
            saveOrder(url) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order: this.currentOrder // Kirim array urutan ID yang baru
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Tampilkan notifikasi sukses
                            this.showNotification(data.message);
                            // Set urutan awal menjadi urutan yang baru disimpan
                            this.initialOrder = [...this.currentOrder];
                            this.isOrderChanged = false;
                        } else {
                            alert('Gagal menyimpan urutan.');
                        }
                    })
                    .catch(() => alert('Terjadi error. Gagal terhubung ke server.'));
            },

            // Fungsi untuk menampilkan notifikasi
            showNotification(message) {
                this.notification.message = message;
                this.notification.show = true;
                setTimeout(() => {
                    this.notification.show = false;
                }, 3000);
            }
        }
    }
</script>
@endpush