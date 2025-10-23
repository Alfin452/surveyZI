<div class="space-y-6 bg-white p-6 rounded-xl shadow-lg border">
    {{-- Judul & Deskripsi --}}
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Pelaksanaan Survei</label>
        <input type="text" name="title" id="title" value="{{ old('title', $survey->title ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $survey->description ?? '') }}</textarea>
        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    {{-- Periode Pelaksanaan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai Pelaksanaan</label>
            <input type="text" name="start_date" id="start_date" value="{{ old('start_date', $survey->start_date?->format('Y-m-d')) }}" required class="datepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="YYYY-MM-DD">
            @error('start_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai Pelaksanaan</label>
            <input type="text" name="end_date" id="end_date" value="{{ old('end_date', $survey->end_date?->format('Y-m-d')) }}" required class="datepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="YYYY-MM-DD">
            @error('end_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Opsi Tambahan --}}
    <div class="pt-4 border-t space-y-4">
        <div class="relative flex items-start">
            <div class="flex h-6 items-center">
                <input id="requires_pre_survey" name="requires_pre_survey" type="checkbox" value="1" {{ old('requires_pre_survey', $survey->requires_pre_survey ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            </div>
            <div class="ml-3 text-sm leading-6">
                <label for="requires_pre_survey" class="font-medium text-gray-900">Wajibkan Pra-Survei</label>
                <p class="text-gray-500">Responden harus mengisi data demografi sebelum memulai.</p>
            </div>
        </div>
        <div class="relative flex items-start">
            <div class="flex h-6 items-center">
                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $survey->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            </div>
            <div class="ml-3 text-sm leading-6">
                <label for="is_active" class="font-medium text-gray-900">Aktifkan Pelaksanaan</label>
                <p class="text-gray-500">Pelaksanaan yang aktif akan muncul di halaman publik.</p>
            </div>
        </div>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="mt-8 pt-6 border-t flex justify-end space-x-3">
    {{-- Tombol Batal ini sekarang akan berfungsi karena $program diteruskan dengan benar --}}
    <a href="{{ route('superadmin.programs.show', $program) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
        Simpan Pelaksanaan
    </button>
</div>