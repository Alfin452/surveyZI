@extends('layouts.unit_kerja_admin')

@push('styles')
<style>
    .section-ghost {
        background: rgba(204, 251, 241, 0.6);
        border: 2px dashed #0d9488;
        opacity: 0.5;
        border-radius: 1rem;
    }

    .question-ghost {
        background: rgba(240, 253, 250, 0.8);
        border: 2px dashed #99f6e4;
        opacity: 0.5;
        border-radius: 0.75rem;
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush

@section('content')
{{-- Background Aurora --}}
<div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-teal-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/3 w-96 h-96 bg-cyan-400/20 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
</div>

<div class="relative z-10 space-y-8"
    x-data="sectionManager(@json($program->questionSections->pluck('id')))"
    x-init="init()"
    @open-edit-section-modal.window="showEditModal = true; editData = $event.detail"
    @open-add-section-modal.window="showAddModal = true"
    @open-delete-modal.window="openDeleteModal = true; deleteUrl = $event.detail.url; deleteItemName = $event.detail.name">

    {{-- Hero Header --}}
    <div class="bg-white/60 backdrop-blur-xl rounded-3xl px-6 py-5 border border-white/40 shadow-lg relative overflow-hidden group hover:shadow-teal-100/50 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500/5 via-emerald-500/5 to-cyan-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-16 h-16 flex-shrink-0 drop-shadow-lg">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Clipboard.png" alt="Questions Icon" class="w-full h-full object-contain">
                </div>
                <div>
                    <nav class="flex items-center text-xs font-medium text-slate-500 mb-1 space-x-2">
                        <a href="{{ route('unitkerja.admin.programs.index') }}" class="hover:text-teal-600 transition-colors">Program</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-slate-800">Pertanyaan</span>
                    </nav>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">Kelola Pertanyaan</h1>
                    <p class="text-slate-500 text-sm font-medium mt-0.5 line-clamp-1">
                        Program: <span class="text-teal-600 font-bold">{{ $program->title }}</span>
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('unitkerja.admin.programs.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-50 transition shadow-sm">
                    Kembali
                </a>
                <button type="button" x-show="isSectionOrderChanged" x-transition
                    @click="saveSectionOrder('{{ route('unitkerja.admin.programs.sections.reorder', $program) }}')"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition shadow-lg hover:shadow-blue-500/30 flex items-center gap-2 animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Urutan
                </button>
                <button @click="showAddModal = true" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl text-xs font-bold hover:bg-teal-700 transition shadow-lg hover:shadow-teal-500/30 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Bagian Baru
                </button>
            </div>
        </div>
    </div>

    {{-- Drag & Drop Area --}}
    <div x-ref="sectionContainer" class="space-y-6 pb-10">
        @forelse ($program->questionSections as $section)
        <div data-id="{{ $section->id }}" class="bg-white/80 backdrop-blur-md rounded-3xl border border-white/50 shadow-sm hover:shadow-md transition-all duration-300 group/section">

            {{-- Section Header --}}
            <div class="flex items-center justify-between p-5 border-b border-slate-100 bg-gradient-to-r from-slate-50/80 to-transparent rounded-t-3xl">
                <div class="flex items-center gap-4">
                    <div class="cursor-grab text-slate-300 hover:text-teal-500 handle-section p-1 rounded hover:bg-teal-50 transition-colors" title="Geser Bagian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            {{ $section->title }}
                            <span class="text-[10px] bg-teal-100 text-teal-600 px-2 py-0.5 rounded-full font-extrabold tracking-wide">
                                {{ $section->questions_count }} SOAL
                            </span>
                        </h2>
                        @if($section->description) <p class="text-xs text-slate-500 mt-0.5">{{ $section->description }}</p> @endif
                    </div>
                </div>

                <div class="flex items-center gap-1 opacity-60 group-hover/section:opacity-100 transition-opacity">
                    <button @click="$dispatch('open-edit-section-modal', @js($section->only(['id','title','description'])))"
                        class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                    <button @click="$dispatch('open-delete-modal', { url: '{{ route('unitkerja.admin.sections.destroy', $section) }}', name: '{{ addslashes($section->title) }}' })"
                        class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Questions List --}}
            <div class="p-5 bg-white/40 rounded-b-3xl" x-data="questionSubManager(@json($section->questions->pluck('id')))" x-init="initQuestionSortable('{{ route('unitkerja.admin.sections.questions.reorder', $section) }}')">
                <div class="space-y-3 min-h-[50px]" x-ref="questionContainer">
                    @forelse ($section->questions as $question)
                    <div data-id="{{ $question->id }}" x-data="{ isOptionsVisible: false }"
                        class="group bg-white border border-slate-100 rounded-xl p-4 shadow-sm hover:shadow-md hover:border-teal-100 transition-all duration-200">
                        <div class="flex items-start gap-3">
                            <div class="cursor-grab text-slate-300 group-hover:text-teal-400 handle-question pt-1" title="Geser Soal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div @click="isOptionsVisible = !isOptionsVisible" class="flex justify-between cursor-pointer select-none">
                                    <div class="flex gap-3">
                                        <span class="item-number flex-shrink-0 w-6 h-6 rounded-full bg-slate-100 text-slate-600 text-xs font-bold flex items-center justify-center mt-0.5">{{ $loop->iteration }}</span>
                                        <p class="text-sm font-semibold text-slate-700 leading-relaxed group-hover:text-teal-700 transition-colors">{{ $question->question_body }}</p>
                                    </div>
                                    <div class="text-slate-300 group-hover:text-teal-400 transition-transform duration-300" :class="{ 'rotate-180': isOptionsVisible }">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div x-show="isOptionsVisible" x-collapse class="mt-4 pl-9">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($question->options as $option)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-medium bg-slate-50 text-slate-600 border border-slate-200">
                                            {{ $option->option_body }}
                                            <span class="bg-teal-100 text-teal-600 px-1.5 rounded text-[10px] font-bold ml-1">{{ $option->option_score }}</span>
                                        </span>
                                        @empty
                                        <span class="text-xs text-slate-400 italic">Tidak ada opsi (esai/isian)</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity pt-0.5">
                                <a href="{{ route('unitkerja.admin.sections.questions.edit', ['section' => $section, 'question' => $question]) }}"
                                    class="p-1.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <button @click="$dispatch('open-delete-modal', { url: '{{ route('unitkerja.admin.sections.questions.destroy', ['section' => $section, 'question' => $question]) }}', name: '{{ addslashes($question->question_body) }}' })"
                                    class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 border-2 border-dashed border-slate-200 rounded-xl">
                        <p class="text-slate-400 text-sm font-medium">Belum ada pertanyaan di bagian ini.</p>
                    </div>
                    @endforelse
                </div>
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-slate-100">
                    <div class="h-8">
                        <button type="button" x-show="isQuestionOrderChanged" x-transition
                            @click="saveQuestionOrder()"
                            class="px-3 py-1.5 bg-teal-50 text-teal-600 rounded-lg text-xs font-bold hover:bg-teal-100 transition-colors flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Simpan Urutan
                        </button>
                    </div>
                    <a href="{{ route('unitkerja.admin.sections.questions.create', $section) }}"
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-lg text-xs font-bold hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Tambah Soal
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="flex flex-col items-center justify-center py-16 bg-white/50 backdrop-blur-sm rounded-3xl border-2 border-dashed border-slate-300">
            <div class="w-24 h-24 mb-4 opacity-60">
                <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Card%20File%20Box.png" alt="Empty" class="w-full h-full object-contain">
            </div>
            <h3 class="text-lg font-bold text-slate-700">Belum Ada Bagian Soal</h3>
            <button @click="showAddModal = true" class="mt-6 px-6 py-2.5 bg-teal-600 text-white rounded-xl text-sm font-bold hover:bg-teal-700 shadow-lg transition-all">
                + Buat Bagian Baru
            </button>
        </div>
        @endforelse
    </div>

    {{-- Modal Add Section (Dipersingkat agar muat, struktur sama persis dengan Superadmin) --}}
    <div x-cloak x-show="showAddModal" class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div x-show="showAddModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showAddModal = false"></div>
            <div x-show="showAddModal" class="inline-block w-full max-w-lg p-8 my-8 text-left align-middle transition-all transform bg-white rounded-3xl shadow-2xl relative z-10">
                <h3 class="text-2xl font-black text-slate-800 mb-4">Bagian Baru</h3>
                <form action="{{ route('unitkerja.admin.programs.sections.store', $program) }}" method="POST" class="space-y-5">
                    @csrf
                    <div><label class="block text-xs font-bold text-slate-500 uppercase mb-2">Judul</label><input type="text" name="title" class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-teal-500" required></div>
                    <div><label class="block text-xs font-bold text-slate-500 uppercase mb-2">Deskripsi</label><textarea name="description" rows="3" class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-teal-500"></textarea></div>
                    <div class="pt-4 flex justify-end gap-3"><button type="button" @click="showAddModal = false" class="px-5 py-2.5 bg-white border rounded-xl text-sm font-bold text-slate-600">Batal</button><button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl text-sm font-bold hover:bg-teal-700">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Section --}}
    <div x-cloak x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 text-center">
            <div x-show="showEditModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showEditModal = false"></div>
            <div x-show="showEditModal" class="inline-block w-full max-w-lg p-8 my-8 text-left align-middle transition-all transform bg-white rounded-3xl shadow-2xl relative z-10">
                <h3 class="text-2xl font-black text-slate-800 mb-4">Edit Bagian</h3>
                <form :action="'/unit-kerja-admin/my-sections/' + (editData ? editData.id : '')" method="POST" class="space-y-5">
                    @csrf @method('PUT')
                    <div><label class="block text-xs font-bold text-slate-500 uppercase mb-2">Judul</label><input type="text" name="title" x-model="editData.title" class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-teal-500" required></div>
                    <div><label class="block text-xs font-bold text-slate-500 uppercase mb-2">Deskripsi</label><textarea name="description" x-model="editData.description" rows="3" class="block w-full px-4 py-3 bg-slate-50 border-slate-200 rounded-xl text-sm focus:ring-teal-500"></textarea></div>
                    <div class="pt-4 flex justify-end gap-3"><button type="button" @click="showEditModal = false" class="px-5 py-2.5 bg-white border rounded-xl text-sm font-bold text-slate-600">Batal</button><button type="submit" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl text-sm font-bold hover:bg-teal-700">Simpan</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Logic AlpineJS & SortableJS (TETAP SAMA AGAR FUNGSI TIDAK RUSAK)
    function sectionManager(initialOrder) {
        return {
            showEditModal: false,
            editData: {
                id: null,
                title: '',
                description: ''
            },
            showAddModal: false,
            openDeleteModal: false,
            deleteUrl: '',
            deleteItemName: '',
            notification: {
                show: false,
                message: '',
                type: 'success'
            },
            initialOrder: [...initialOrder],
            currentOrder: [...initialOrder],
            isSectionOrderChanged: false,
            init() {
                if (typeof Sortable === 'undefined') return;
                new Sortable(this.$refs.sectionContainer, {
                    animation: 150,
                    handle: '.handle-section',
                    ghostClass: 'section-ghost',
                    onUpdate: () => {
                        this.currentOrder = Array.from(this.$refs.sectionContainer.children).filter(el => el.dataset.id).map(el => el.dataset.id);
                        this.isSectionOrderChanged = JSON.stringify(this.initialOrder) !== JSON.stringify(this.currentOrder);
                    }
                });
            },
            showNotification(message, type = 'success') {
                this.notification.message = message;
                this.notification.type = type;
                this.notification.show = true;
                setTimeout(() => {
                    this.notification.show = false;
                }, 3000);
            },
            saveSectionOrder(url) {
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
                            this.isSectionOrderChanged = false;
                        } else {
                            this.showNotification(data.message || 'Gagal.', 'error');
                        }
                    })
                    .catch(() => this.showNotification('Error koneksi.', 'error'))
                    .finally(() => {
                        Alpine.store('globals').isLoading = false;
                    });
            }
        }
    }

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
                        this.updateNumbering();
                    }
                });
                this.updateNumbering();
            },
            updateNumbering() {
                this.$refs.questionContainer.querySelectorAll('.item-number').forEach((el, index) => {
                    el.textContent = (index + 1);
                });
            },
            saveQuestionOrder() {
                Alpine.store('globals').isLoading = true;
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
                            this.$dispatch('open-notification', {
                                message: data.message,
                                type: 'success'
                            });
                            this.initialOrder = [...this.currentOrder];
                            this.isQuestionOrderChanged = false;
                        } else {
                            this.$dispatch('open-notification', {
                                message: data.message || 'Gagal.',
                                type: 'error'
                            });
                        }
                    }).catch(() => {
                        this.$dispatch('open-notification', {
                            message: 'Error koneksi.',
                            type: 'error'
                        });
                    })
                    .finally(() => {
                        Alpine.store('globals').isLoading = false;
                    });
            }
        }
    }

    document.addEventListener('open-notification', (e) => {
        const manager = document.querySelector('[x-data^="sectionManager"]').__x.$data;
        if (manager) {
            manager.showNotification(e.detail.message, e.detail.type || 'success');
        }
    });
</script>
@endpush