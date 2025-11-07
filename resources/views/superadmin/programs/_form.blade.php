{{--
PERBAIKAN:
- Mengembalikan <select multiple> agar TomSelect berfungsi (sesuai permintaan Anda).
- Tetap mempertahankan pengelompokan visual (Grup 1, 2, 3, 4) agar form rapi.
--}}
<div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
    <div class="space-y-8">

        {{-- Grup 1: Info Dasar --}}
        <div class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Program Survei</label>
                <input type="text" name="title" id="title" value="{{ old('title', $program->title ?? '') }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3" placeholder="Contoh: Survei Penilaian Zona Integritas 2025">
                @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3" placeholder="Jelaskan tujuan umum dari program survei ini...">{{ old('description', $program->description ?? '') }}</textarea>
                @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Grup 2: Periode Program --}}
        <div class="space-y-4 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-900">Periode Program</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Program</label>
                    <input type="text" name="start_date" id="start_date" value="{{ old('start_date', $program->start_date?->format('Y-m-d')) }}" required class="datepicker block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3" placeholder="Pilih tanggal...">
                    @error('start_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai Program</label>
                    <input type="text" name="end_date" id="end_date" value="{{ old('end_date', $program->end_date?->format('Y-m-d')) }}" required class="datepicker block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3" placeholder="Pilih tanggal...">
                    @error('end_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- Grup 3: Opsi Status, Pra-Survei, dan Unggulan --}}
        <div class="space-y-4 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-900">Opsi Program</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="is_active" class="font-medium text-gray-900">Aktifkan Program</label>
                        <p class="text-gray-500">Akan terlihat di halaman publik.</p>
                    </div>
                </div>
                <div class="relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="requires_pre_survey" name="requires_pre_survey" type="checkbox" value="1" {{ old('requires_pre_survey', $program->requires_pre_survey ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="requires_pre_survey" class="font-medium text-gray-900">Wajibkan Pra-Survei</label>
                        <p class="text-gray-500">Responden wajib isi data diri.</p>
                    </div>
                </div>
                <div class="relative flex items-start">
                    <div class="flex h-6 items-center">
                        <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured', $program->is_featured ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="is_featured" class="font-medium text-gray-900">Program Unggulan</label>
                        <p class="text-gray-500">Tampilkan di Halaman Utama.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grup 4: Target Unit Kerja (DIKEMBALIKAN KE <select multiple>) --}}
        <div class="space-y-4 pt-6 border-t border-gray-200">
            <div>
                <label for="targeted_unit_kerjas_select" class="block text-sm font-medium text-gray-900">Targetkan ke Unit Kerja</label>
                <p class="text-sm text-gray-500 mb-2">Pilih satu atau lebih unit kerja yang akan mengisi survei ini.</p>
                <select name="targeted_unit_kerjas[]" id="targeted_unit_kerjas_select" multiple required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    {{-- TomSelect akan menggunakan placeholder, jadi option ini bisa dikosongkan --}}
                    {{-- <option value="">Pilih satu atau lebih unit kerja...</option> --}}
                    @foreach($unitKerjas as $unit)
                    <option value="{{ $unit->id }}"
                        {{ (in_array($unit->id, old('targeted_unit_kerjas', $program->targetedUnitKerjas->pluck('id')->toArray() ?? []))) ? 'selected' : '' }}>
                        {{ $unit->unit_kerja_name }}
                    </option>
                    @endforeach
                </select>
                @error('targeted_unit_kerjas') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
        <a href="{{ route('superadmin.programs.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
            Batal
        </a>
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
            Simpan Program
        </button>
    </div>
</div>