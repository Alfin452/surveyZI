{{-- 1. DATA PREPARATION (PHP) --}}
@php
// Mapping ID Pertanyaan => Index Section
$sectionMap = [];
$allQuestionIds = [];

foreach($program->questionSections as $sIndex => $section) {
foreach($section->questions as $question) {
$sectionMap[$question->id] = $sIndex;
$allQuestionIds[] = $question->id;
}
}

// Ambil data lama jika ada error validasi server (Old Input)
$oldAnswers = old('answers', []);
@endphp

<x-guest-layout :title="$program->title">

    @push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Background */
        body {
            background-color: #f8fafc;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Scrollbar Minimalis */
        .nav-scroll::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        /* Animation Shake */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-4px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(4px);
            }
        }

        .animate-shake {
            animation: shake 0.4s cubic-bezier(.36, .07, .19, .97) both;
        }
    </style>
    @endpush

    {{-- MAIN WRAPPER --}}
    <div x-data="{
            step: 0,
            totalSteps: {{ $program->questionSections->count() }},
            answers: {{ json_encode((object)$oldAnswers) }}, // Load old inputs
            sectionMap: {{ json_encode($sectionMap) }},
            allQuestions: {{ json_encode($allQuestionIds) }},
            showMobileNav: false,
            isSubmitting: false, // STATE LOADING

            init() {
                window.scrollTo(0, 0);
            },
            nextStep() {
                if (this.step < this.totalSteps - 1) {
                    this.step++;
                    this.scrollToTop();
                }
            },
            prevStep() {
                if (this.step > 0) {
                    this.step--;
                    this.scrollToTop();
                }
            },
            jumpToSection(index, elementId = null) {
                this.step = index;
                if (elementId) {
                    setTimeout(() => {
                        const el = document.getElementById(elementId);
                        if (el) {
                            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            el.classList.add('ring-2', 'ring-emerald-500', 'ring-offset-2');
                            setTimeout(() => el.classList.remove('ring-2', 'ring-emerald-500', 'ring-offset-2'), 1500);
                        }
                    }, 300);
                } else {
                    this.scrollToTop();
                }
            },
            
            // VALIDASI & SUBMIT DENGAN LOADING
            validateAndSubmit() {
                let firstUnansweredId = this.allQuestions.find(id => !this.answers[id]);

                if (firstUnansweredId) {
                    let targetSection = this.sectionMap[firstUnansweredId];
                    this.step = targetSection;

                    setTimeout(() => {
                        const el = document.getElementById('q-' + firstUnansweredId);
                        if (el) {
                            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            el.classList.add('ring-2', 'ring-red-400', 'bg-red-50', 'animate-shake');
                            
                            window.dispatchEvent(new CustomEvent('notify', { 
                                detail: { message: 'Mohon lengkapi semua pertanyaan!', type: 'error' } 
                            }));

                            setTimeout(() => {
                                el.classList.remove('ring-2', 'ring-red-400', 'bg-red-50', 'animate-shake');
                            }, 2000);
                        }
                    }, 300);
                } else {
                    // Modal Konfirmasi
                    window.dispatchEvent(new CustomEvent('confirm-action', { 
                        detail: { 
                            title: 'Kirim Jawaban?', 
                            message: 'Pastikan semua jawaban sudah sesuai. Data tidak dapat diubah setelah dikirim.',
                            callback: () => {
                                // Aktifkan Loading State
                                this.isSubmitting = true; 
                                document.getElementById('surveyForm').submit();
                            }
                        } 
                    }));
                }
            },

            handleAnswer(questionId, value, nextElementId = null) {
                this.answers[questionId] = value;
                if (nextElementId) {
                    setTimeout(() => {
                        const nextEl = document.getElementById(nextElementId);
                        if (nextEl) {
                            nextEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }, 500);
                }
            },
            isAnswered(questionId) {
                return this.answers[questionId] != null;
            },
            scrollToTop() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }"
        class="min-h-screen flex flex-col pt-28 pb-24">

        {{-- 1. HEADER PROGRAM --}}
        {{-- 1. HEADER PROGRAM --}}
        <div class="container mx-auto px-4 mb-8">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-5 md:p-6 relative overflow-hidden">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                    {{-- KIRI: Back Button & Judul --}}
                    <div class="flex items-start gap-4 w-full md:w-auto pr-12 md:pr-0 relative z-10">
                        {{-- Tombol Kembali --}}
                        <a href="{{ route('home') }}" class="shrink-0 p-2.5 md:p-3 rounded-xl bg-slate-50 text-slate-500 hover:bg-emerald-600 hover:text-white transition-colors border border-slate-200 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>

                        {{-- Info Judul --}}
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mb-1.5 text-[10px] md:text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <span class="truncate max-w-[150px] md:max-w-none">{{ $unitKerja->unit_kerja_name }}</span>
                                <span class="text-slate-300">|</span>
                                <span x-text="'BAGIAN ' + (step + 1) + ' / ' + totalSteps" class="text-emerald-600"></span>
                            </div>
                            <h1 class="text-lg md:text-2xl font-black text-slate-900 leading-snug tracking-tight break-words">
                                {{ $program->title }}
                            </h1>
                        </div>
                    </div>

                    {{-- KANAN: Tombol Edit & Progress --}}
                    <div class="w-full md:w-auto flex flex-col md:items-end gap-4 relative z-10">

                        {{-- Wrapper untuk Edit & Progress (Mobile: Column Reverse agar progress di bawah) --}}
                        <div class="flex flex-col md:flex-col gap-4 w-full md:w-auto">

                            {{-- Tombol Edit Data Diri --}}
                            @if($program->requires_pre_survey)
                            <a href="{{ route('public.pre-survey.create', ['program' => $program->alias, 'unitKerja' => $unitKerja->alias]) }}"
                                class="order-2 md:order-1 w-full md:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 bg-amber-50 text-amber-700 rounded-xl text-xs font-bold border border-amber-200 hover:bg-amber-100 transition-all shadow-sm group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500 group-hover:text-amber-700" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit Data Diri
                            </a>
                            @endif

                            {{-- Progress Bar --}}
                            <div class="order-1 md:order-2 w-full md:w-64 flex flex-col gap-2">
                                <div class="flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                    <span>Kelengkapan</span>
                                    <span x-text="Math.round(((Object.keys(answers).length) / {{ $program->questionSections->flatMap->questions->count() }}) * 100) + '%'"></span>
                                </div>
                                <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500 transition-all duration-500 ease-out"
                                        :style="`width: ${((Object.keys(answers).length) / {{ $program->questionSections->flatMap->questions->count() }}) * 100}%`"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Mobile Toggle (Absolute Positioned Top Right) --}}
                <button @click="showMobileNav = !showMobileNav" class="lg:hidden absolute top-5 right-5 p-2 bg-white/80 backdrop-blur-sm rounded-lg text-slate-400 hover:text-emerald-600 border border-transparent hover:border-slate-200 transition-all z-20">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

            </div>
        </div>

        {{-- 2. MAIN CONTENT --}}
        <div class="flex-1 container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8 items-start">

                {{-- GLOBAL COUNTER --}}
                @php $qNumber = 1; @endphp

                {{-- LEFT: NAVIGATOR --}}
                @if($program->questionSections->count() > 0)
                <aside class="hidden lg:block w-80 shrink-0 sticky top-32">
                    <div class="bg-white rounded-[2rem] shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col max-h-[calc(100vh-10rem)]">
                        <div class="p-6 border-b border-slate-50">
                            <span class="text-xs font-bold text-slate-800 uppercase tracking-widest">Peta Soal</span>
                        </div>

                        <div class="p-6 overflow-y-auto nav-scroll space-y-8 flex-1">
                            @php $navIndex = 1; @endphp
                            @foreach($program->questionSections as $sIndex => $section)
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Bagian {{ $sIndex + 1 }}</span>
                                    <span x-show="step === {{ $sIndex }}" class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                                </div>
                                <div class="grid grid-cols-5 gap-2">
                                    @foreach($section->questions as $question)
                                    <button type="button" @click="jumpToSection({{ $sIndex }}, 'q-{{ $question->id }}')"
                                        class="w-10 h-10 rounded-2xl text-xs font-bold transition-all duration-300 flex items-center justify-center relative group"
                                        :class="isAnswered({{ $question->id }}) 
                                                ? 'bg-emerald-500 text-white shadow-md shadow-emerald-200 transform scale-105' 
                                                : (step === {{ $sIndex }} ? 'bg-slate-800 text-white shadow-lg shadow-slate-300 scale-110' : 'bg-slate-50 text-slate-400 hover:bg-emerald-50 hover:text-emerald-500')">
                                        {{ $navIndex++ }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
                @endif

                {{-- RIGHT: FORM QUESTIONS --}}
                <div class="flex-1 w-full min-w-0">
                    <form id="surveyForm" action="{{ route('public.survey.storeResponse', ['program' => $program, 'unitKerja' => $unitKerja]) }}" method="POST">
                        @csrf

                        @if($program->questionSections->count() > 0)
                        @foreach($program->questionSections as $index => $section)
                        <div x-show="step === {{ $index }}" x-cloak
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 translate-y-12"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="space-y-10">

                            {{-- Section Header --}}
                            <div class="px-4 md:px-0">
                                <span class="inline-block px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-widest mb-3">
                                    Bagian {{ $index + 1 }}
                                </span>
                                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 tracking-tight">{{ $section->title }}</h2>
                                @if($section->description)
                                <p class="text-slate-500 text-lg leading-relaxed max-w-3xl">{{ $section->description }}</p>
                                @endif
                            </div>

                            {{-- Questions List --}}
                            <div class="space-y-8">
                                @forelse($section->questions as $qIndex => $question)

                                @php
                                $nextQuestion = $section->questions->get($qIndex + 1);
                                $nextElementId = $nextQuestion ? 'q-' . $nextQuestion->id : null;
                                @endphp

                                <div id="q-{{ $question->id }}"
                                    class="group bg-white rounded-[2.5rem] p-8 md:p-10 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.03)] transition-all duration-500 hover:shadow-[0_20px_40px_-10px_rgba(0,0,0,0.07)] scroll-mt-40 relative"
                                    :class="isAnswered({{ $question->id }}) ? 'bg-gradient-to-br from-white to-emerald-50/30' : ''">

                                    {{-- Indikator Terjawab --}}
                                    <div x-show="isAnswered({{ $question->id }})"
                                        x-transition.scale.origin.center
                                        class="absolute top-8 right-8 w-8 h-8 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-sm">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>

                                    <div class="flex gap-6">
                                        {{-- Nomor Soal --}}
                                        <div class="shrink-0 text-3xl font-black text-slate-200 select-none group-hover:text-emerald-100 transition-colors duration-500">
                                            {{ str_pad($qNumber++, 2, '0', STR_PAD_LEFT) }}
                                        </div>

                                        <div class="flex-1 pt-1.5">
                                            <h3 class="text-xl font-bold text-slate-800 mb-8 leading-relaxed">
                                                {{ $question->question_body }}
                                            </h3>

                                            {{-- Pilihan Jawaban Hijau --}}
                                            <div class="grid gap-4">
                                                @foreach($question->options as $option)
                                                <label class="relative cursor-pointer group/opt">
                                                    <input type="radio"
                                                        name="answers[{{ $question->id }}]"
                                                        value="{{ $option->id }}"
                                                        {{-- Old value --}}
                                                        {{ old('answers.'.$question->id) == $option->id ? 'checked' : '' }}
                                                        @click="handleAnswer({{ $question->id }}, '{{ $option->id }}', '{{ $nextElementId }}')"
                                                        class="peer sr-only">

                                                    {{-- Card Styling (Green Focus) --}}
                                                    <div class="px-6 py-5 rounded-2xl bg-slate-50 border-2 border-transparent transition-all duration-200
                                                                    hover:bg-white hover:shadow-md hover:border-emerald-200 hover:-translate-y-0.5
                                                                    peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:shadow-lg peer-checked:shadow-emerald-200/50
                                                                    flex items-center gap-4">

                                                        {{-- Radio Circle Filled --}}
                                                        <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center transition-all duration-200
                                                                        peer-checked:border-emerald-600 peer-checked:bg-emerald-600 shrink-0 group-hover/opt:border-emerald-400">
                                                            {{-- Dot Putih --}}
                                                            <div class="w-2 h-2 rounded-full bg-white opacity-0 transition-all duration-200 transform scale-0 peer-checked:opacity-100 peer-checked:scale-100"></div>
                                                        </div>

                                                        <span class="text-base font-semibold text-slate-600 group-hover/opt:text-slate-800 peer-checked:text-emerald-900 transition-colors">
                                                            {{ $option->option_body }}
                                                        </span>
                                                    </div>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                                    <p class="text-slate-400 font-medium">Tidak ada pertanyaan.</p>
                                </div>
                                @endforelse
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="flex items-center justify-between pt-16 pb-8">
                                <button type="button" @click="prevStep()" x-show="step > 0"
                                    class="px-8 py-4 rounded-2xl text-sm font-bold text-slate-500 hover:bg-white hover:shadow-md hover:text-slate-900 transition-all flex items-center gap-3">
                                    <span class="text-lg">&larr;</span> Sebelumnya
                                </button>
                                <div x-show="step === 0"></div>

                                <div class="flex gap-4">
                                    <button type="button" @click="nextStep()" x-show="step < totalSteps - 1"
                                        class="bg-white text-slate-800 px-10 py-4 rounded-2xl font-bold text-sm shadow-[0_10px_30px_-10px_rgba(0,0,0,0.1)] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center gap-3">
                                        Selanjutnya <span class="text-lg">&rarr;</span>
                                    </button>

                                    {{-- TOMBOL KIRIM (Loading State) --}}
                                    <button type="button"
                                        x-show="step === totalSteps - 1"
                                        @click="validateAndSubmit()"
                                        :disabled="isSubmitting"
                                        class="bg-emerald-600 text-white px-12 py-4 rounded-2xl font-bold text-sm shadow-xl shadow-emerald-500/30 hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300 flex items-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed">

                                        <span x-show="!isSubmitting">Kirim Jawaban</span>
                                        <svg x-show="!isSubmitting" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>

                                        <svg x-show="isSubmitting" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span x-show="isSubmitting">Memproses...</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                        @endforeach
                        @else
                        {{-- EMPTY STATE --}}
                        <div class="text-center py-32 bg-white rounded-[3rem] shadow-sm">
                            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 mb-2">Belum Ada Soal</h3>
                            <p class="text-slate-500 font-medium mb-8">Hubungi admin untuk input data.</p>
                            <a href="{{ route('home') }}" class="px-8 py-3.5 bg-slate-900 text-white rounded-2xl text-sm font-bold hover:bg-slate-800 transition-all">Kembali</a>
                        </div>
                        @endif

                    </form>
                </div>

            </div>
        </div>

        {{-- MOBILE NAV --}}
        {{-- MOBILE NAV DRAWER --}}
        <div x-show="showMobileNav"
            class="fixed inset-0 z-40 lg:hidden"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="display: none;">

            {{-- Backdrop (Gelap) --}}
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                @click="showMobileNav = false"></div>

            {{-- Drawer Panel --}}
            {{-- [PERBAIKAN UTAMA] 
                 1. z-40: Agar berada di layer "belakang" Header Utama (yang biasanya z-50).
                 2. pt-20: Memberi jarak 80px dari atas agar Judul "Peta Soal" tidak tertutup Header.
            --}}
            <div class="absolute right-0 top-0 bottom-0 w-[85%] max-w-[320px] bg-white shadow-2xl flex flex-col h-full border-l border-slate-100 pt-20"
                x-transition:enter="transition transform ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition transform ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">

                {{-- Drawer Header --}}
                <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/80 backdrop-blur-md">
                    <div>
                        <h3 class="text-base font-black text-slate-900 tracking-tight">Peta Soal</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">Navigasi Cepat</p>
                    </div>
                    <button @click="showMobileNav = false" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-rose-500 hover:border-rose-200 transition-all shadow-sm active:scale-95">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Drawer Content (Scrollable) --}}
                <div class="flex-1 overflow-y-auto p-5 custom-scrollbar bg-white">
                    @if($program->questionSections->count() > 0)
                    <div class="space-y-6">
                        @php $mGlobalIndex = 1; @endphp
                        @foreach($program->questionSections as $sIndex => $section)

                        {{-- Section Card --}}
                        <div class="rounded-2xl border transition-colors duration-300 {{ $loop->index == 0 ? 'mt-1' : '' }}"
                            :class="step === {{ $sIndex }} ? 'bg-emerald-50/50 border-emerald-100' : 'bg-slate-50/50 border-slate-100'">

                            <div class="p-4">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded-md"
                                        :class="step === {{ $sIndex }} ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-500'">
                                        Bagian {{ $sIndex + 1 }}
                                    </span>

                                    {{-- Indikator Sedang Aktif --}}
                                    <div x-show="step === {{ $sIndex }}" class="flex items-center gap-1.5">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                        </span>
                                        <span class="text-[9px] font-bold text-emerald-600 uppercase tracking-wider">Aktif</span>
                                    </div>
                                </div>

                                {{-- Grid Nomor Soal --}}
                                <div class="grid grid-cols-5 gap-2">
                                    @foreach($section->questions as $question)
                                    <button type="button"
                                        @click="jumpToSection({{ $sIndex }}, 'q-{{ $question->id }}'); showMobileNav = false"
                                        class="h-11 rounded-xl text-xs font-bold flex items-center justify-center transition-all duration-200 shadow-sm active:scale-90"
                                        :class="isAnswered({{ $question->id }}) 
                                                ? 'bg-emerald-500 text-white shadow-emerald-200 border-b-2 border-emerald-600' 
                                                : (step === {{ $sIndex }} ? 'bg-white ring-2 ring-emerald-400 text-emerald-700' : 'bg-white border border-slate-200 text-slate-400 hover:border-slate-300')">
                                        {{ $mGlobalIndex++ }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="h-full flex flex-col items-center justify-center text-center p-6 opacity-50">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-slate-400">Belum ada peta soal.</p>
                    </div>
                    @endif
                </div>

                {{-- Drawer Footer --}}
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    <button @click="showMobileNav = false" class="w-full py-3.5 bg-slate-900 text-white rounded-xl font-bold text-sm shadow-lg shadow-slate-200 hover:bg-slate-800 transition-all active:scale-[0.98]">
                        Tutup Navigasi
                    </button>
                </div>

            </div>
        </div>

    </div>

</x-guest-layout>