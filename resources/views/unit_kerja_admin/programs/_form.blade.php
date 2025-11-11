<div class="space-y-6 bg-white p-6 rounded-xl shadow-lg border">
    {{-- Judul Program --}}
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Program Survei</label>
        <input type="text" name="title" id="title" value="{{ old('title', $program->title ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="Contoh: Survei Kepuasan Wifi Lab 2025">
        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    {{-- Deskripsi --}}
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="Jelaskan tujuan umum dari program survei ini...">{{ old('description', $program->description ?? '') }}</textarea>
        @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
    </div>

    {{-- Periode Program --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai Program</label>
            <input type="text" name="start_date" id="start_date" value="{{ old('start_date', $program->start_date?->format('Y-m-d')) }}" required class="datepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="YYYY-MM-DD">
            @error('start_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai Program</label>
            <input type="text" name="end_date" id="end_date" value="{{ old('end_date', $program->end_date?->format('Y-m-d')) }}" required class="datepicker mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="YYYY-MM-DD">
            @error('end_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Opsi Status Aktif & Pra-Survei --}}
    <div class="pt-4 border-t grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="relative flex items-start">
            <div class="flex h-6 items-center">
                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-teal-600 focus:ring-teal-600">
            </div>
            <div class="ml-3 text-sm leading-6">
                <label for="is_active" class="font-medium text-gray-900">Aktifkan Program</label>
                <p class="text-gray-500">Akan terlihat di halaman publik.</p>
            </div>
        </div>
        <div class="relative flex items-start">
            <div class="flex h-6 items-center">
                <input id="requires_pre_survey" name="requires_pre_survey" type="checkbox" value="1" {{ old('requires_pre_survey', $program->requires_pre_survey ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-teal-600 focus:ring-teal-600">
            </div>
            <div class="ml-3 text-sm leading-6">
                <label for="requires_pre_survey" class="font-medium text-gray-900">Wajibkan Pra-Survei</label>
                <p class="text-gray-500">Responden wajib isi data diri.</p>
            </div>
        </div>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="mt-8 pt-6 border-t flex justify-end space-x-3">
    <a href="{{ route('unitkerja.admin.programs.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
        Batal
    </a>
    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700">
        Simpan Program
    </button>
</div>