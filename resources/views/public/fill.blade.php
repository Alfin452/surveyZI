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
        <div class="container mx-auto px-4 mb-8">
            <div class="bg-white border border-slate-200 rounded-lg shadow-sm p-6 flex flex-col md:flex-row items-center justify-between gap-6">

                <div class="flex items-center gap-5 w-full md:w-auto">
                    <a href="{{ route('home') }}" class="p-3 rounded-md bg-slate-50 text-slate-500 hover:bg-emerald-600 hover:text-white transition-colors border border-slate-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <div class="flex items-center gap-3 mb-1 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <span>{{ $unitKerja->unit_kerja_name }}</span>
                            <span class="text-slate-300">|</span>
                            <span x-text="'BAGIAN ' + (step + 1) + ' / ' + totalSteps"></span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-black text-slate-900 leading-none tracking-tight">
                            {{ $program->title }}
                        </h1>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="w-full md:w-64 flex flex-col gap-2">
                    <div class="flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        <span>Kelengkapan</span>
                        <span x-text="Math.round(((Object.keys(answers).length) / {{ $program->questionSections->flatMap->questions->count() }}) * 100) + '%'"></span>
                    </div>
                    <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 transition-all duration-500 ease-out"
                            :style="`width: ${((Object.keys(answers).length) / {{ $program->questionSections->flatMap->questions->count() }}) * 100}%`"></div>
                    </div>
                </div>

                {{-- Mobile Toggle --}}
                <button @click="showMobileNav = !showMobileNav" class="lg:hidden absolute top-6 right-6 p-2 text-slate-400 hover:text-emerald-600">
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
        <div x-show="showMobileNav" class="fixed inset-0 z-50 lg:hidden" style="display: none;">
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" @click="showMobileNav = false" x-transition.opacity></div>
            <div class="absolute right-0 top-0 bottom-0 w-80 bg-white shadow-2xl p-8 overflow-y-auto"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0">

                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest">Peta Soal</h3>
                    <button @click="showMobileNav = false" class="text-slate-400 hover:text-slate-900"><svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg></button>
                </div>

                @if($program->questionSections->count() > 0)
                <div class="space-y-8">
                    @php $mGlobalIndex = 1; @endphp
                    @foreach($program->questionSections as $sIndex => $section)
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase mb-4 tracking-wider">Bagian {{ $sIndex + 1 }}</div>
                        <div class="grid grid-cols-5 gap-3">
                            @foreach($section->questions as $question)
                            <button type="button" @click="jumpToSection({{ $sIndex }}, 'q-{{ $question->id }}'); showMobileNav = false"
                                class="h-10 rounded-2xl text-xs font-bold flex items-center justify-center transition-all"
                                :class="isAnswered({{ $question->id }}) ? 'bg-emerald-500 text-white shadow-md shadow-emerald-200' : 'bg-slate-50 text-slate-400'">
                                {{ $mGlobalIndex++ }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

    </div>

</x-guest-layout>