{{-- Menggunakan Alpine.js untuk mengelola opsi jawaban secara dinamis --}}
<div x-data='{
    options: {{ 
        json_encode(
            old('options', ($question->exists && $question->options) ? $question->options->map->only(['option_body', 'option_score']) : [['option_body' => '', 'option_score' => '']])
        ) 
    }}
}'>
    <div class="space-y-6 bg-white p-6 rounded-xl shadow-lg border">
        {{-- Tipe Pertanyaan (saat ini tersembunyi karena hanya ada satu tipe) --}}
        <input type="hidden" name="type" value="multiple_choice">

        {{-- Isi Pertanyaan --}}
        <div>
            <label for="question_body" class="block text-sm font-medium text-gray-700">Teks Pertanyaan</label>
            <textarea name="question_body" id="question_body" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('question_body', $question->question_body ?? '') }}</textarea>
            @error('question_body') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        {{-- Opsi Jawaban Dinamis --}}
        <div class="pt-4 border-t">
            <label class="block text-sm font-medium text-gray-700">Opsi Jawaban</label>
            <div class="mt-2 space-y-4">
                <template x-for="(option, index) in options" :key="index">
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg border">
                        {{-- Input Teks Opsi --}}
                        <div class="flex-grow">
                            <input type="text" :name="`options[${index}][option_body]`" x-model="option.option_body" required class="w-full rounded-md border-gray-300 shadow-sm sm:text-sm" placeholder="Tulis teks jawaban...">
                        </div>
                        {{-- Input Skor Opsi --}}
                        <div class="w-24">
                            <input type="number" :name="`options[${index}][option_score]`" x-model="option.option_score" required class="w-full rounded-md border-gray-300 shadow-sm sm:text-sm" placeholder="Skor">
                        </div>
                        {{-- Tombol Hapus Opsi --}}
                        <button type="button" @click="if(options.length > 1) options.splice(index, 1)" :class="{'opacity-50 cursor-not-allowed': options.length <= 1}" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
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
    <div class="mt-8 pt-6 border-t flex justify-end space-x-3">
        <a href="{{ route('superadmin.surveys.show', $survey) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            Batal
        </a>
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
            Simpan Pertanyaan
        </button>
    </div>
</div>