@extends('layouts.unit_kerja_admin')

@push('styles')
{{-- Style khusus untuk ghost drag-and-drop --}}
<style>
    .section-ghost {
        background: #f0f9ff;
        border: 2px dashed #0ea5e9;
    }

    .question-ghost {
        background: #f0fdf4;
        border: 2px dashed #22c55e;
    }
</style>
@endpush

@section('content')
{{-- Inisialisasi Alpine.js untuk halaman ini --}}
<div class="p-4 sm:p-6"
    x-data="sectionManager({{ $program->questionSections->pluck('id') }})">

    {{-- Header Halaman --}}
    <div class="mb-8 bg-white rounded-xl p-4 md:p-6 border-l-4 border-teal-500 shadow-sm">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
            <div>
                {{-- Breadcrumbs --}}
                <nav class="text-sm mb-2 font-medium text-gray-500" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center"><a href="{{ route('unitkerja.admin.dashboard') }}" class="hover:text-teal-600">Dashboard</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><a href="{{ route('unitkerja.admin.programs.index') }}" class="hover:text-teal-600">Program Survei</a><span class="mx-2">/</span></li>
                        <li class="flex items-center"><span class="text-gray-700">Kelola Pertanyaan</span></li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 bg-teal-500 text-white p-3 rounded-lg shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Kelola Pertanyaan</h1>
                        <p class="text-sm text-gray-500 mt-1">Program: <span class="font-semibold">{{ $program->title }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-2 self-start md:self-end">
                <a href="{{ route('unitkerja.admin.programs.index') }}" class="bg-white text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition border">Kembali ke Program</a>

                <button type="button" x-show="isSectionOrderChanged" x-transition
                    @click="saveSectionOrder('{{ route('unitkerja.admin.programs.sections.reorder', $program) }}')"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-600 transition shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Simpan Urutan Bagian</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Notifikasi Sukses --}}
    <div x-cloak x-show="notification.show" x-transition
        class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold" x-text="notification.message"></p>
    </div>
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold">{{ session('success') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
        <p class="font-semibold">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Daftar Bagian Soal (Drag-and-Drop) --}}
    <div class="space-y-6" x-ref="sectionContainer">
        @forelse ($program->questionSections as $section)
        <div data-id="{{ $section->id }}" class="bg-white rounded-xl shadow-lg border">
            {{-- Header Bagian (Bisa di-drag) --}}
            <div class="flex items-center justify-between p-4 bg-gray-50 border-b rounded-t-xl">
                <div class="flex items-center gap-3">
                    <div class="cursor-grab text-gray-400 hover:text-gray-600 handle-section" title="Geser untuk mengubah urutan bagian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $section->title }}</h2>
                        <p class="text-sm text-gray-500">{{ $section->description }} ({{ $section->questions_count }} Pertanyaan)</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    {{-- Tombol Aksi untuk Bagian --}}
                    <button @click="$dispatch('open-edit-section-modal', @json($section->only(['id', 'title', 'description'])))" class="text-indigo-600 hover:text-indigo-800" title="Edit Bagian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                    <button @click="$dispatch('open-delete-modal', { url: '{{ route('unitkerja.admin.sections.destroy', $section) }}', name: '{{ addslashes($section->title) }}' })" class="text-red-600 hover:text-red-800" title="Hapus Bagian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Daftar Pertanyaan (Sub-list, juga bisa di-drag) --}}
            <div class="p-4 space-y-3" x-data="questionSubManager({{ $section->questions->pluck('id') }})" x-init="initQuestionSortable('{{ route('unitkerja.admin.sections.questions.reorder', $section) }}')">
                <div class="space-y-3" x-ref="questionContainer">
                    @forelse ($section->questions as $question)
                    <div data-id="{{ $question->id }}" class="bg-gray-50 border rounded-lg p-3 flex items-center justify-between group">
                        <div class="flex items-center gap-2">
                            <div class="cursor-grab text-gray-400 group-hover:text-gray-600 handle-question" title="Geser untuk mengubah urutan pertanyaan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $loop->iteration }}. {{ $question->question_body }}</p>
                                <div class="text-xs text-gray-500 mt-1 pl-2">
                                    @foreach($question->options as $option)
                                    <span>[{{ $option->option_body }}: {{ $option->option_score }}]</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('unitkerja.admin.sections.questions.edit', ['section' => $section, 'question' => $question]) }}" class="text-indigo-600 hover:text-indigo-800" title="Edit Pertanyaan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <button @click="$dispatch('open-delete-modal', { url: '{{ route('unitkerja.admin.sections.questions.destroy', ['section' => $section, 'question' => $question]) }}', name: '{{ addslashes($question->question_body) }}' })" class="text-red-600 hover:text-red-800" title="Hapus Pertanyaan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada pertanyaan di bagian ini.</p>
                    @endforelse
                </div>
                {{-- Tombol Aksi Pertanyaan --}}
                <div class="flex items-center justify-between pt-3 border-t">
                    <button type="button" x-show="isQuestionOrderChanged" x-transition
                        @click="saveQuestionOrder()"
                        class="bg-green-100 text-green-700 px-3 py-1 rounded-lg font-medium hover:bg-green-200 text-sm">
                        Simpan Urutan Soal
                    </button>
                    <a href="{{ route('unitkerja.admin.sections.questions.create', $section) }}" class="inline-flex items-center px-3 py-1 border border-dashed border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Tambah Pertanyaan
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16 px-4 border-2 border-dashed rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <p class="mt-4 font-semibold text-gray-600">Belum Ada Bagian Soal</p>
            <p class="text-sm mt-1">Klik tombol "Tambah Bagian Soal" di bawah untuk memulai.</p>
        </div>
        @endforelse
    </div>

    {{-- Form Tambah Bagian Soal (di dalam Modal) --}}
    <div class="mt-6">
        <button @click="$dispatch('open-add-section-modal')" class="w-full bg-teal-50 text-teal-700 border-2 border-dashed border-teal-200 hover:bg-teal-100 hover:border-teal-300 transition rounded-lg p-4 text-center font-semibold">
            + Tambah Bagian Soal Baru
        </button>
    </div>

    {{-- Modal untuk Tambah Bagian --}}
    <div x-cloak x-data="{ show: false }" @open-add-section-modal.window="show = true" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500/75 transition-opacity" @click="show = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Tambah Bagian Soal Baru</h3>
                <form action="{{ route('unitkerja.admin.programs.sections.store', $program) }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label for="section_title_add" class="block text-sm font-medium text-gray-700">Judul Bagian</label>
                        <input type="text" name="title" id="section_title_add" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="section_desc_add" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" id="section_desc_add" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div class="pt-4 flex justify-end space-x-2">
                        <button type="button" @click="show = false" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                        <button type="submit" class="bg-teal-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-teal-700">Simpan Bagian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal untuk Edit Bagian --}}
    <div x-cloak x-data="{ show: false, action: '', title: '', description: '' }"
        @open-edit-section-modal.window="show = true; action = '/unit-kerja-admin/my-sections/' + $event.detail.id; title = $event.detail.title; description = $event.detail.description || '';"
        x-show="show" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500/75 transition-opacity" @click="show = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Edit Bagian Soal</h3>
                <form :action="action" method="POST" class="mt-4 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="section_title_edit" class="block text-sm font-medium text-gray-700">Judul Bagian</label>
                        <input type="text" name="title" id="section_title_edit" x-model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="section_desc_edit" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" id="section_desc_edit" rows="3" x-model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div class="pt-4 flex justify-end space-x-2">
                        <button type="button" @click="show = false" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                        <button type="submit" class="bg-teal-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-teal-700">Perbarui Bagian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Library SortableJS sudah dimuat di layout utama 'unit_kerja_admin.blade.php' --}}
<script>
    // Alpine component untuk mengelola drag-and-drop Bagian (Section)
    function sectionManager(initialOrder) {
        return {
            initialOrder: [...initialOrder],
            currentOrder: [...initialOrder],
            isSectionOrderChanged: false,
            notification: {
                show: false,
                message: ''
            },

            init() {
                if (typeof Sortable === 'undefined') return;
                new Sortable(this.$refs.sectionContainer, {
                    animation: 150,
                    handle: '.handle-section',
                    ghostClass: 'section-ghost',
                    onUpdate: () => {
                        this.currentOrder = Array.from(this.$refs.sectionContainer.children).map(el => el.dataset.id);
                        this.isSectionOrderChanged = JSON.stringify(this.initialOrder) !== JSON.stringify(this.currentOrder);
                    }
                });
            },
            saveSectionOrder(url) {
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
                            this.showNotification(data.message);
                            this.initialOrder = [...this.currentOrder];
                            this.isSectionOrderChanged = false;
                        }
                    }).catch(() => alert('Gagal menyimpan urutan bagian.'));
            },
            showNotification(message) {
                this.notification.message = message;
                this.notification.show = true;
                setTimeout(() => {
                    this.notification.show = false;
                }, 3000);
            }
        }
    }

    // Alpine component terpisah untuk mengelola sub-list Pertanyaan (Question)
    function questionSubManager(initialOrder) {
        return {
            initialOrder: [...initialOrder],
            currentOrder: [...initialOrder],
            isQuestionOrderChanged: false,
            sortableInstance: null,
            saveUrl: '',

            initQuestionSortable(url) {
                this.saveUrl = url;
                if (typeof Sortable === 'undefined') return;
                this.sortableInstance = new Sortable(this.$refs.questionContainer, {
                    animation: 150,
                    handle: '.handle-question',
                    ghostClass: 'question-ghost',
                    onUpdate: () => {
                        this.currentOrder = Array.from(this.$refs.questionContainer.children).map(el => el.dataset.id);
                        this.isQuestionOrderChanged = JSON.stringify(this.initialOrder) !== JSON.stringify(this.currentOrder);
                    }
                });
            },
            saveQuestionOrder() {
                fetch(this.saveUrl, {
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
                            // Tampilkan notifikasi global
                            window.dispatchEvent(new CustomEvent('open-notification', {
                                detail: {
                                    message: data.message
                                }
                            }));
                            this.initialOrder = [...this.currentOrder];
                            this.isQuestionOrderChanged = false;
                        }
                    }).catch(() => alert('Gagal menyimpan urutan pertanyaan.'));
            }
        }
    }

    // Event listener global untuk notifikasi
    document.addEventListener('open-notification', (e) => {
        // Ini adalah trik agar notifikasi bisa dipicu dari komponen Alpine anak
        const manager = document.querySelector('[x-data^="sectionManager"]').__x.$data;
        manager.showNotification(e.detail.message);
    });
</script>
@endpush