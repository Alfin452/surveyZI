{{-- Menggunakan Alpine.js untuk mengelola opsi jawaban secara dinamis --}}
<div x-data='{
    options: {{ 
        json_encode(
            old('options', ($question->exists && $question->options->count()) ? $question->options->map->only(['option_body', 'option_score']) : [['option_body' => '', 'option_score' => '']])
        ) 
    }}
}'>
    {{-- PERBAIKAN: Menyamakan style card (shadow, border, radius) --}}
    <div class="space-y-8 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        {{-- Tipe Pertanyaan (saat ini tersembunyi karena hanya ada satu tipe) --}}
        <input type="hidden" name="type" value="multiple_choice">

        {{-- Grup 1: Isi Pertanyaan --}}
        <div class="space-y-4">
            <div>
                <label for="question_body" class="block text-sm font-medium text-gray-700 mb-1">Teks Pertanyaan</label>
                <textarea name="question_body" id="question_body" rows="3" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('question_body', $question->question_body ?? '') }}</textarea>
                @error('question_body') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Grup 2: Opsi Jawaban Dinamis --}}
        <div class="space-y-4 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-900">Opsi Jawaban</h3>

            <div class="mt-2 space-y-4">
                <template x-for="(option, index) in options" :key="index">
                    <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-lg border">
                        {{-- Input Teks Opsi --}}
                        <div class="flex-grow">
                            {{-- PERBAIKAN: Menambahkan label sr-only untuk aksesibilitas --}}
                            <label :for="`option_body_${index}`" class="sr-only">Teks Opsi</label>
                            <input type="text" :id="`option_body_${index}`" :name="`options[${index}][option_body]`" x-model="option.option_body" required class="w-full rounded-md border-gray-300 shadow-sm sm:text-sm" placeholder="Tulis teks jawaban...">
                        </div>

                        {{-- Input Skor Opsi --}}
                        <div class="w-24">
                            {{-- PERBAIKAN: Menambahkan label sr-only untuk aksesibilitas --}}
                            <label :for="`option_score_${index}`" class="sr-only">Skor</label>
                            <input type="number" :id="`option_score_${index}`" :name="`options[${index}][option_score]`" x-model="option.option_score" required class="w-full rounded-md border-gray-300 shadow-sm sm:text-sm" placeholder="Skor">
                        </div>

                        {{-- Tombol Hapus Opsi --}}
                        <button type="button"
                            @click="if(options.length > 1) options.splice(index, 1)"
                            :disabled="options.length <= 1"
                            :class="{'opacity-50 cursor-not-allowed': options.length <= 1}"
                            class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition-colors">
                            <span class="sr-only">Hapus Opsi</span>
                            {{-- PERBAIKAN: Mengganti ikon agar konsisten --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </template>
            </div>

            @error('options.*') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
            @error('options') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror

            {{-- Tombol Tambah Opsi --}}
            <button type="button" @click="options.push({ option_body: '', option_score: '' })" class="mt-4 inline-flex items-center px-4 py-2 border border-dashed border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                Tambah Opsi
            </button>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    {{-- PERBAIKAN: Menyamakan 'mt-8 pt-6' dan warna tombol 'bg-indigo-600' --}}
    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
        <a href="{{ route('superadmin.programs.questions.index', $program) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            Batal
        </a>
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
            Simpan Pertanyaan
        </button>
    </div>
</div>