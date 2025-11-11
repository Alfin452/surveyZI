<x-guest-layout :title="$program->title">

    <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 pt-28 pb-12 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: linear-gradient(white 1px, transparent 1px), linear-gradient(90deg, white 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto mb-8">
                <div class="flex items-center justify-center gap-2">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white text-indigo-600 font-black flex items-center justify-center">✓</div>
                        <span class="ml-2 text-white text-sm font-semibold hidden sm:inline">Pilih Unit</span>
                    </div>
                    <div class="w-12 sm:w-20 h-1 bg-white/30"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white text-indigo-600 font-black flex items-center justify-center">✓</div>
                        <span class="ml-2 text-white text-sm font-semibold hidden sm:inline">Data Diri</span>
                    </div>
                    <div class="w-12 sm:w-20 h-1 bg-white/30"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white text-indigo-600 font-black flex items-center justify-center">3</div>
                        <span class="ml-2 text-white text-sm font-semibold hidden sm:inline">Isi Survei</span>
                    </div>
                </div>
            </div>

            <div class="text-center mb-8">
                <div class="inline-block mb-4">
                    <span class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-bold backdrop-blur-sm">
                        📝 {{ $unitKerja->unit_kerja_name }}
                    </span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-3">
                    {{ $program->title }}
                </h1>
                <p class="text-base sm:text-lg text-white/90 max-w-2xl mx-auto">
                    {{ $program->description ?? 'Berikan penilaian Anda untuk setiap pertanyaan berikut' }}
                </p>

                @if($program->questions)
                <div class="inline-flex items-center bg-white/10 backdrop-blur-md rounded-full px-6 py-3 mt-6 border border-white/20">
                    <svg class="w-5 h-5 text-yellow-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-white font-bold">
                        <span class="text-yellow-300">{{ $program->questions->count() }}</span> Pertanyaan
                    </span>
                </div>
                @endif
            </div>
        </div>
    </section>

    <main class="container mx-auto px-4 py-12 -mt-8 relative z-10">
        <div class="max-w-4xl mx-auto">
            <form action="{{ route('public.survey.storeResponse', ['program' => $program, 'unitKerja' => $unitKerja]) }}" method="POST" id="surveyForm">
                @csrf

                @php($questionCounter = 1)

                <div class="space-y-12">
                    @forelse($program->questionSections as $section)
                    <div class="survey-section">
                        <div class="pb-4 border-b-2 border-indigo-200 mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $section->title }}</h2>
                            @if($section->description)
                            <p class="mt-1 text-sm text-gray-600">{{ $section->description }}</p>
                            @endif
                        </div>

                        <div class="space-y-6">
                            @forelse($section->questions as $question)

                            <div class="question-card bg-white rounded-2xl shadow-xl border-2 border-gray-100 overflow-hidden transform hover:scale-[1.01] transition-all duration-300">

                                <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <span class="bg-white text-indigo-600 font-black text-lg px-4 py-2 rounded-lg shadow-lg">
                                                {{ $questionCounter }}
                                            </span>
                                            @if($program->questions)
                                            <span class="text-white text-sm font-semibold">dari {{ $program->questions->count() }}</span>
                                            @endif
                                        </div>
                                        <div class="hidden sm:flex items-center gap-2 bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-full">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-white text-xs font-semibold">Wajib Dijawab</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-6 sm:p-8">
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-6 leading-relaxed">
                                        {{ $questionCounter }}. {{ $question->question_body }}
                                    </h3>

                                    <fieldset>
                                        <legend class="sr-only">Pilihan untuk pertanyaan {{ $questionCounter }}</legend>
                                        <div class="space-y-3">
                                            @forelse($question->options as $option)
                                            <label for="option-{{ $option->id }}"
                                                class="option-label group flex items-center p-4 sm:p-5 border-2 border-gray-300 rounded-xl cursor-pointer transition-all duration-300 hover:border-indigo-400 hover:bg-indigo-50 hover:shadow-md has-[:checked]:bg-gradient-to-r has-[:checked]:from-indigo-50 has-[:checked]:to-purple-50 has-[:checked]:border-indigo-600 has-[:checked]:ring-4 has-[:checked]:ring-indigo-100 has-[:checked]:shadow-lg">
                                                <input id="option-{{ $option->id }}"
                                                    name="answers[{{ $question->id }}]"
                                                    type="radio"
                                                    value="{{ $option->id }}"
                                                    required
                                                    class="w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 focus:ring-offset-2">
                                                <span class="ml-4 text-sm sm:text-base font-semibold text-gray-700 group-has-[:checked]:text-indigo-700 flex-1">
                                                    {{ $option->option_body }}
                                                </span>
                                                <svg class="w-6 h-6 text-indigo-600 opacity-0 group-has-[:checked]:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </label>
                                            @empty
                                            <div class="text-center py-8 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                                                <p class="text-gray-500 text-sm font-semibold">Tidak ada opsi untuk pertanyaan ini</p>
                                            </div>
                                            @endforelse
                                        </div>
                                        @error('answers.' . $question->id)
                                        <p class="mt-3 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </fieldset>
                                </div>
                            </div>
                            @php($questionCounter++)

                            @empty
                            <div class="text-center py-16 px-4 bg-white rounded-xl shadow-md border-2 border-dashed">
                                <p class="font-semibold text-gray-600">Belum Ada Pertanyaan</p>
                                <p class="text-sm mt-1">Admin belum menambahkan pertanyaan untuk bagian ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16 px-4 bg-white rounded-xl shadow-md border-2 border-dashed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-4 font-semibold text-gray-600">Belum Ada Bagian Soal</p>
                        <p class="text-sm mt-1">Admin belum menambahkan bagian soal atau pertanyaan untuk survei ini.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-10 bg-white rounded-2xl shadow-2xl border-2 border-gray-100 p-6 sm:p-8">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-black text-gray-900 mb-2">
                            Siap Mengirim Jawaban?
                        </h3>
                        <p class="text-sm text-gray-600">
                            Pastikan semua pertanyaan sudah dijawab sebelum mengirim
                        </p>
                    </div>

                    <button type="submit"
                        class="submit-button w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-black py-4 px-8 rounded-xl hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-3 group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Kirim Jawaban Survei</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>

                    <p class="text-xs text-center text-gray-500 mt-4">
                        🔒 Jawaban Anda akan tersimpan secara anonim dan aman
                    </p>
                </div>
            </form>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- AWAL PERBAIKAN ---
            const firstError = document.querySelector('.text-red-600');
            if (firstError) {
                // 1. Temukan kartu error
                const errorCard = firstError.closest('.question-card');

                // 2. Cek apakah kartunya ada, baru scroll
                if (errorCard) {
                    errorCard.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
            // --- AKHIR PERBAIKAN ---

            if (typeof gsap !== 'undefined') {
                gsap.from('.question-card', {
                    opacity: 0,
                    y: 30,
                    stagger: 0.1,
                    duration: 0.6,
                    ease: "power2.out",
                    clearProps: "all"
                });

                gsap.from('.submit-button', {
                    scrollTrigger: {
                        trigger: '.submit-button',
                        start: 'top 90%',
                        once: true
                    },
                    opacity: 0,
                    scale: 0.9,
                    duration: 0.6,
                    ease: "back.out(1.5)",
                    clearProps: "all"
                });

                setTimeout(() => {
                    gsap.set('.question-card, .submit-button', {
                        opacity: 1,
                        clearProps: "all"
                    });
                }, 2000);
            }

            const form = document.getElementById('surveyForm');
            const questions = document.querySelectorAll('.question-card');

            questions.forEach((card, index) => {
                const radios = card.querySelectorAll('input[type="radio"]');
                radios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        const badge = card.querySelector('.bg-white.text-indigo-600');
                        if (badge && !badge.textContent.includes('✓')) {
                            // badge.innerHTML = `${index + 1} <span class="text-green-500">✓</span>`;
                        }
                    });
                });
            });

            form.addEventListener('submit', function(e) {
                const unanswered = [];
                questions.forEach((card, index) => {
                    const radios = card.querySelectorAll('input[type="radio"]');
                    const isAnswered = Array.from(radios).some(r => r.checked);
                    if (!isAnswered) {
                        unanswered.push(index + 1);
                    }
                });

                if (unanswered.length > 0) {
                    e.preventDefault();
                    alert(`Mohon jawab pertanyaan nomor: ${unanswered.join(', ')}`);

                    const firstUnanswered = questions[unanswered[0] - 1];
                    firstUnanswered.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    firstUnanswered.classList.add('ring-4', 'ring-red-300');
                    setTimeout(() => {
                        firstUnanswered.classList.remove('ring-4', 'ring-red-300');
                    }, 2000);
                }
            });
        });
    </script>
    @endpush

</x-guest-layout>